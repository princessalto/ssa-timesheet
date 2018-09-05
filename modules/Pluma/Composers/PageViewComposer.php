<?php
namespace Pluma\Composers;

use Illuminate\View\View;
use Pluma\Composers\MenuViewComposer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Pluma\Helpers\Arrays;
use Pluma\Helpers\Menus;
use stdClass;

/**
 * -----------------------------------
 * Page View Composer
 * -----------------------------------
 * The view composer for dynamic headings, subheading, and other content on page.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 */
class PageViewComposer extends MenuViewComposer
{
	protected $page;
	protected $currentUrl;
	protected $adminPrefix = 'admin';

	/**
	 * Main function to tie everything together.
	 *
	 * @param  View   $view
	 * @return void
	 */
	public function compose(View $view)
	{
		parent::compose($view);

		$this->setCurrentUrl( Request::path() );
		$view->with( 'page', $this->makePage() );
	}

	public function setCurrentUrl( $currentUrl )
	{
		$this->currentUrl = $currentUrl;
	}

	public function getCurrentUri()
	{
		return $this->currentUrl;
	}

	public function makePage()
	{
		$this->setApp();
		$this->setCopyright();
		$this->setHeading();
		$this->setHead();

		return Arrays::to_object_recursive( $this->page );
	}

	public function setHead( $head = null )
	{
		$uri = $this->getCurrentUri();

		$this->page['head']['separator'] = '|';
		if ( '/' == $uri || 'home' == $uri ) {
			$this->page['head']['title'] = $this->page['app']['title'];
			$this->page['head']['subtitle'] = $this->page['app']['tagline'];
		} else {
			$this->page['head']['title'] = $this->page['heading']['title'];
			$this->page['head']['subtitle'] = $this->page['app']['title'];
		}
		$this->page['head']['fullTitle'] = "{$this->page['head']['title']} {$this->page['head']['separator']} {$this->page['head']['subtitle']}";

		if ( null !== $head ) $this->page['head'] = $head;
	}

	public function setHeading()
	{
		$modules = config('modules.enabled');
		$menus = [];
		foreach ( $modules as $module ) {
			if ( file_exists( base_path("modules/$module/config/menu.php") ) ) {
				$menus += (array) require base_path("modules/$module/config/menu.php");
			}
		}

		$uri = explode( "/", $this->getCurrentUri() );
		$this->page['heading']['title'] = ( $this->adminPrefix == strtolower( $uri[0] ) ) ? ucfirst( $uri[ count($uri) - 1 ] ) : ucfirst( $uri[0] );

		foreach ( $this->allMenus as $menu ) {
			if ( url( $this->getCurrentUri() ) == url( $menu->slug ) ) {
				$this->page['heading']['title'] = $menu->label;
			}
		}
	}

	public function setApp()
	{
		$this->page['app']['title'] = env('APP_NAME', "Pluma&trade;");
		$this->page['app']['name'] = env('APP_NAME', "Pluma");
		$this->page['app']['subtitle'] = env('APP_TAGLINE', "Advanced CMS for everyone.");
		$this->page['app']['tagline'] = env('APP_TAGLINE', "Advanced CMS for everyone.");
		$this->page['app']['full'] = "{$this->page['app']['title']} - {$this->page['app']['subtitle']}";
		$this->page['app']['fullhtml'] = "<strong>{$this->page['app']['title']}</strong> <span class='text-muted'>| {$this->page['app']['subtitle']}</span>";
		$this->page['app']['version'] = env('APP_VERSION', "1.0.0");
	}

	public function setCopyright()
	{
		$year = env("APP_YEAR", 2016);
		$year = $year == date('Y') ? $year : $year . "-" . date('Y');
		$this->page['copyright']['full'] = "Copyright &copy; $year. All Rights Reserved.";
		$this->page['copyright']['year'] = $year;
	}
}