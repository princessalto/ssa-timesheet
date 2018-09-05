<?php
namespace Pluma\Composers;

use Pluma\Support\Traits\CheckIfMenuIsViewableByUser;
use Illuminate\View\View;
use Illuminate\Support\Facades\Request;
use Pluma\Helpers\Arrays;
use Pluma\Helpers\Menus;
use Pluma\Helpers\Permission;
use stdClass;

/**
 * -----------------------------------
 * Menu View Composer
 * -----------------------------------
 * The view composer for dynamic menus based on modules.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 */
class MenuViewComposer
{
	use CheckIfMenuIsViewableByUser;

	protected $urlPrefix = 'admin';
	protected $currentUrl;
	protected $currentItems;
	protected $menus;
	protected $allMenus;
	protected $attributes = array(
		'default' => array(
			'menu' => array(
				'id' => [],
				'class' => ['sidebar-menu'],
			),
			'item' => array(
				'class' => [''],
			),
			'link' => array(
				'class' => ['sidebar-link'],
			),
		),

		'parent' => array(
			'menu' => array(
				'id' => [],
				'class' => ['sidebar-menu'],
			),
			'item' => array(
				'class' => ['treeview'],
			),
			'link' => array(
				'class' => [''],
			),
		),

		'child' => array(
			'menu' => array(
				'id' => [],
				'class' => ['dropdown-menu', 'treeview-menu'],
			),
			'item' => array(
				'class' => ['dropdown-item-group'],
			),
			'link' => array(
				'class' => ['dropdown-item'],
			),
		),

		'active' => array(
			'default' => array(
				'menu' => array(
					'class' => ['active'],
				),
				'item' => array(
					'class' => ['active'],
				),
				'link' => array(
					'class' => ['active'],
				),
			),
			'parent' => array(
				'menu' => array(
					'class' => ['active'],
				),
				'item' => array(
					'class' => ['active'],
				),
				'link' => array(
					'class' => ['active'],
				),
			),
			'child' => array(
				'menu' => array(
					'id' => [],
					'class' => ['active'],
				),
				'item' => array(
					'class' => ['active'],
				),
				'link' => array(
					'class' => ['active'],
				),
			),
			'single-parent' => array(
				'menu' => array(
					'class' => ['active'],
				),
				'item' => array(
					'class' => ['active'],
				),
				'link' => array(
					'class' => ['active'],
				),
			),
		),
	);

	protected $icon = array(
		'class' => '',
		'tag' => 'i',
		'content' => '&nbsp;',
	);

	/**
	 * Main function to tie everything together.
	 *
	 * @param  View   $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$this->setAttributes();
		$this->setMenus();
		$this->setActiveLink();
		$view->with('menus', $this->makeMenus());
	}

	public function setActiveLink()
	{
		$this->currentUrl = Request::url();
	}

	public function getActiveLink()
	{
		return $this->currentUrl;
	}

	public function setActiveItems( $currentItems )
	{
		$this->currentItems = null;
		foreach ( $currentItems as $menu ) {
			$this->currentItems[] = $menu->slug;
		}
	}

	public function getActiveItems()
	{
		return $this->currentItems;
	}

	public function isItemActive( $url )
	{
		$active_items = $this->getActiveItems();
		return in_array( $url, (array) $active_items );
	}

	public function isLinkActive( $url )
	{
		return $url === $this->getActiveLink();
	}

	public function setAttributes( $attributes = array() )
	{
		$attributes = array_merge( $this->attributes, $attributes );

		foreach ( $attributes as $typename => $types ) {
			foreach ( $types as $name => $attribute ) {
				if ( is_array( $attribute ) ) {
					foreach ( $attribute as $a => $attr ) {
						$attribute[ $a ] = $attr;
					}
				}

				$this->attributes[ $typename ][ $name ] = $attribute;
			}
		}

		return $this->attributes;
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function setMenus()
	{
		$modules = config('modules.enabled');
		$menus = [];
		foreach ( $modules as $module ) {
			if ( file_exists( base_path("modules/$module/config/menu.php") ) ) {
				$menus += (array) require base_path("modules/$module/config/menu.php");
			}
		}

		$menus = $this->checkIfMenuIsViewableByUser($menus);

		foreach ($menus as $name => $menu) {
			$menu = $this->addMenu( $menu );
			$this->menus[ $name  ] = $menu;
			if ( isset( $menu->parent ) ) {
				unset( $this->menus[$name] );
				$this->menus[ $menu->parent ]->children[$name] = $menu;
				$this->menus[ $menu->parent ]->has_children = true;
			}

			$this->allMenus[ $name ] = $menu;
		}

		uasort( $this->menus, function ($a, $b){
			return ( $a->order <= $b->order ) ? -1 : 1;
		});

		$this->menus = $this->checkIfMenuHasChild($this->menus);

		return $this->menus = Arrays::to_object_recursive( $this->menus );
	}

	/**
	 * Adds Menu to the global $menu.
	 *
	 * @param object $menu
	 */
	public function addMenu( $menu )
	{
		/**
		 * Converts the $menu to an object recursively.
		 * This the menu to be modified.
		 *
		 * @var object
		 */
		$menu = Arrays::to_object_recursive( (array) $menu );

		$menu->name = $menu->name;
		$menu->single = $menu->label->singular_name;
		$menu->plural = $menu->label->plural_name;
		$menu->label = $menu->plural;

		$menu->has_parent = isset( $menu->is_child_of ) ?: false;
		$menu->has_children = isset( $menu->children ) ?: false;
		$menu->parent = $menu->has_parent ? $menu->is_child_of : null;

		$parent = $menu->has_parent ? $this->menus[ $menu->parent ]->slug : null;
		$menu->slug = $menu->has_parent ? url( rtrim("$parent/{$menu->slug}", "/\t\n\r") ) : url( "$this->urlPrefix/$menu->slug" );
		$menu->icon = isset( $menu->icon ) && ! empty( $menu->icon ) ? Menus::makeIcon( $menu->icon ) : null;

		return $menu;
	}

	/**
	 * Create The HTML markup for the menu.
	 *
	 * @param  object  $menus  The menus to iterate; defaults to the global $menus.
	 * @param  integer $level  The current depth the loop is in.
	 * @param  string  $type   Used to decide what $attributes to use.
	 * @param  boolean $active If current menu item's url set is active.
	 *
	 * @return html
	 */
	public function makeMenus( $menus = null, $level = 1, $type = 'parent', $active = false )
	{
		/**
		 * Replaces the $menus if no menus where given.
		 *
		 * @var object
		 */
		$menus = is_null( $menus ) ? $this->getMenus() : $menus;
		$menus_obj = [];

		/**
		 * Sets the active items.
		 *
		 */
		$this->setActiveItems( Arrays::to_object_recursive( [ array( 'slug' => $this->getActiveLink() ) ] ) );

		/**
		 * Sets the active link.
		 *
		 */
		$this->setActiveLink();

		/**
		 * Gets the Attributes to use in the HTML.
		 *
		 * @var object
		 */
		$attributes = $this->getAttributes();
		$attributes = Arrays::to_object_recursive( $attributes[ $type ] );

		/**
		 * Check if a link is active within the list of active items, and we are not on level 1.
		 * If met, this means our current menu set is active;
		 * and we will override the $attributes variable to use the `active attributes` instead.
		 *
		 */
		if ( $this->isItemActive( $this->getActiveLink() ) && $level !== 1 ) {
			$active_attributes = $this->getAttributes();
			$active_attributes = Arrays::to_object_recursive( $active_attributes[ 'active' ]['parent'] );
			$classes = array_merge( (array) $attributes->menu->class, (array) $active_attributes->menu->class );
			$attributes->menu->class = implode( ' ', $classes );
		}

		/**
		 * Process and display our menu attribute.
		 */
		$attributes->menu = Arrays::to_key_value_string( (array) $attributes->menu );
		$html = "<ul $attributes->menu>";

		/**
		 * Builds the menu items from the $menus.
		 *
		 * @var object
		 */
		foreach ( $menus as $module => $menu ) {
			/**
			 * Processes $attributes anew.
			 *
			 */
			$attributes = $this->processAttributes( $menu, $level, $type );
			$attributes->item = isset( $menu->attributes->item ) && "" != $menu->attributes->item ? $menu->attributes->item : $attributes->item;
			$attributes->link = isset( $menu->attributes->link ) && "" != $menu->attributes->link ? $menu->attributes->link : $attributes->link;
			$attributes->item = ! is_string( $attributes->item ) ? Arrays::to_key_value_string( (array) $attributes->item ) : $attributes->item;
			$attributes->link = ! is_string( $attributes->link ) ? Arrays::to_key_value_string( (array) $attributes->link ) : $attributes->link;

			/**
			 * Displays the items and links with the processed $attributes.
			 *
			 */
			$html .= "<li $attributes->item>";

			/**
			 * Displays the link's tag.
			 */
			$html .= "<a href='" . ( $menu->has_children ? '#' : $menu->slug ) . "' $attributes->link>$menu->icon<span>$menu->label</span></a>";

			/**
			 * Builds the menu's children if any.
			 *
			 */
			$child_depth = $level + 1;
			if ( $menu->has_children ) {
				$child_menus = $this->makeMenus( $menu->children, $child_depth, 'child' );
				// dd($child_menus);
				$html .= $child_menus->html;
			}

			/**
			 * Closes the item's tag.
			 *
			 */
			$html .= "</li>";

			$menus_obj['segments'][] = array(
				'name' => $menu->label,
				'attributes' => $attributes,
				'menu' => $menu,
			);
		}

		/**
		 * Close the menu's tag.
		 *
		 */
		$html .= "</ul>";

		/**
		 * Return the menu.
		 *
		 */
		$menus_obj['html'] = $html;
		return Arrays::to_object_recursive( $menus_obj );
	}

	/**
	 * Gets the current $menus.
	 *
	 * @return object
	 */
	public function getMenus()
	{
		return $this->menus;
	}

	/**
	 * Processess the Attributes according to level, menu type, and current URL.
	 *
	 * @param  object $menu  the current $menu from $menus.
	 * @param  int $level The current level.
	 * @return object
	 */
	private function processAttributes( $menu, $level, $type )
	{
		/**
		 * Gets a fresh copy of attributes.
		 */
		$attributes = $this->getAttributes();

		/**
		 * Checks if:
		 * 	1. the current $menu is a parent;
		 * 	2. the current $menu is also inside a parent; and
		 *  	3. we are on level 1.
		 *
		 * if met, let's override the $attributes to use the `default`.
		 * else we'll use whatever was passed on the $type variable.
		 */
		if ( ! $menu->has_children && ! $menu->has_parent && $level == 1 ) {
			$attributes = $attributes['default'];
		} else {
			$attributes = $attributes[ $type ];
		}
		# Converts the $attribute into an object (just for easy writing), speed of processing be damned.
		$attributes = Arrays::to_object_recursive( $attributes );

		/**
		 * Checks if we are on level 1
		 *
		 */
		if ( $level === 1 ) {

			/**
			 * We are on level 1,
			 * Check if we have children...
			 *
			 */
			if ( $menu->has_children ) {

				/**
				 * If we have children, set those children as the currently ACTIVE ITEMS.
				 *
				 */
				$this->setActiveItems( Arrays::to_object_recursive( $menu->children ) );

				/**
				 * If we do have children and one of them is the current ACTIVE LINK,
				 * then set the $attributes to `parent` under `active`.
				 *
				 */
				if ( $this->isItemActive( $this->getActiveLink() ) ) {
					$active_attributes = $this->getAttributes();
					$active_attributes = Arrays::to_object_recursive( $active_attributes['active']['parent'] );
					$active_classes = implode( ' ', (array) $active_attributes->item->class );
					$classes = array_merge_recursive( (array) $attributes->item->class, (array) $active_classes );
					$attributes->item->class = $classes;
				}

			/**
			 * ...else, we don't have children.
			 */
			} else {

				/**
				 * Sets the current ACTIVE ITEMS to just our current menu's $slug.
				 */
				$this->setActiveItems( Arrays::to_object_recursive( [ [ 'slug' => $menu->slug ] ] ) );

				/**
				 * Checks if the current URL is our $slug.
				 * If it is, then oh boy, we gonna have some fun.
				 * And also sets an `active` - `default` to our attributes.
				 *
				 */
				if ( $this->isLinkActive( $menu->slug ) ) {
					$active_attributes = $this->getAttributes();
					$active_attributes = Arrays::to_object_recursive( $active_attributes['active']['default'] );
					$classes = array_merge_recursive( (array) $attributes->item->class, (array) $active_attributes->item->class );
					$attributes->item->class = array_shift( $classes );
				}
			}

		/**
		 * We are not on level 1.
		 *
		 */
		} else {

			/**
			 * Checks if we don't have children and our $slug is the current URL.
			 * If met, override $attributes with `active` - `default`.
			 */
			if ( ! $menu->has_children && $this->isLinkActive( $menu->slug ) ) {
				$active_attributes = $this->getAttributes();
				$active_attributes = Arrays::to_object_recursive( $active_attributes['active']['default'] );
				$classes = array_merge_recursive( (array) $attributes->item->class, (array) $active_attributes->item->class );
				$attributes->item->class = array_shift( $classes );
			}
		}

		/**
		 * Finally, fade to black...
		 */
		return $attributes;
	}

	private function get_heading(View $view)
	{
		$this->heading = new stdClass;
		$this->heading->app_name = env("APP_NAME");
		$this->heading->tagline = "";

		if (null == Route::getFacadeRoot()->current()) {
			$this->heading->title = "404";
			$this->heading->app_name;
			$this->heading->active = null;
			$this->heading->plainActive = null;
			return $view->with('heading', $this->heading);
		}

		  $uri = explode("/", Route::getFacadeRoot()->current()->uri());
		  $this->heading->title = ('admin' == strtolower($uri[0])) ? ucfirst($uri[1]) : ucfirst($uri[0]);

		  $year = env("APP_YEAR", date('Y'));
		  $year = $year == date('Y') ? $year : $year . "-" . date('Y');
		  $this->heading->copyright = "&copy; Copyright $year. All rights reserved.";

		  $this->heading->theme = "light-theme"; // TODO: put this option on database
		  $this->heading->breadcrumb = $this->get_breadcrumb();


		  $this->heading->active = function ($path=null, $class=" active") {
				return $this->get_active($path, $class);
		  };

		  $this->heading->plainActive = function ($path = null, $route = null, $class = " active") {
				if (is_array($route)) {
					 foreach ($route as $r) {
						  return $path == $r ? $class : "";
					 }
				}
				return ($path == $route) ? $class : "";
		  };

		  $view->with('heading', $this->heading);
	 }

	 public function get_columns(View $view)
	 {
		  if (null == Route::getFacadeRoot()->current()) return false;

		  $this->columns = Schema::getColumnListing(strtolower($this->heading->title));
		  $view->with('columns', $this->columns);
	 }
}