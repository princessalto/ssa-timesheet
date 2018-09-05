<?php
namespace Pluma\Helpers;

use StdClass;

/*
|--------------------------------------------------------------------------
| Menus Helpers
|--------------------------------------------------------------------------
|
| Here are some functions to help in manipulating menus.
|
*/
class Menus
{
	protected static $attributes = array(
        	'parent' => array(
                'menu' => array(
                    'id' => [],
                    'class' => ['nav', 'sidebar-stacked'],
                ),
                'item' => array(
                    'class' => ['sidebar-item'],
                ),
                'link' => array(
                    'class' => ['sidebar-link', 'dropdown-toggle'],
                ),
            ),
           'child' => array(
                'item' => array(
                    'class' => ['sidebar-item', 'dropdown'],
                ),
                'menu' => array(
                    'id' => [],
                    'class' => ['dropdown-menu'],
                ),
                'link' => array(
                    'class' => ['dropdown-item'],
                ),
           ),
	);

	protected static $icon = array(
		'class' => '',
		'tag' => 'i',
		'content' => '&nbsp;',
	);

	public static function setAttributes( $attributes = array() )
	{
		return array_merge( self::$attributes, $attributes );
	}

	public static function getAttributes()
	{
		return self::$attributes;
	}

	/**
	 * Create menu icon.
	 *
	 * @param  mixed $icon         The array of options for the icon
	 *
	 * @return html
	 */
	public static function makeIcon( $icon )
	{
		if ( is_string( $icon ) ) return $icon;

		$icon = (array) array_merge(
			self::$icon,
			(array) $icon
		);

		$icon = (object) $icon;

		return "<$icon->tag class='$icon->class'>$icon->content</$icon->tag>";
	}
}