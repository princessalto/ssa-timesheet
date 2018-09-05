<?php

namespace Pluma\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Pluma\Helpers\Arrays;
use Pluma\Helpers\Menus;
use stdClass;

/**
 * -----------------------------------
 * Breadcrumb View Composer
 * -----------------------------------
 * The view composer for dynamic breadcrumbs based on URLs.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 */
class BreadcrumbViewComposer
{
	protected $breadcrumbs = "Home / ";
	protected $replacableSegments = array(
		'admin' => 'Home',
		'create' => 'New',
		'/' => 'All',
	);

	/**
	 * Main function to tie everything together.
	 *
	 * @param  View   $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with( 'breadcrumbs', $this->makeBreadcrumbs() );
	}

	public function makeBreadcrumbs()
	{
		if ( null == Route::getFacadeRoot()->current() ) return false;

		$uri = explode( "/", Request::path() );

		$breadcrumb = "<ul class='breadcrumb'>";

		$segment_builder = "";
		$breadcrumb_obj = [];
		foreach ( $uri as $i => $segment ) {
			$segment_builder .= $segment . '/';
			$segment = ucfirst( $this->makeSegment( $segment ) );

			$breadcrumb_obj['segments'][] = array(
				'name' => $segment,
				'url' => url($segment_builder)
			);

			if ( $i == count($uri) - 1 ) {
				$breadcrumb .= "<li class='breadcrumb-item'>$segment</li>";
			} else {
				$breadcrumb .= "<li class='breadcrumb-item'><a href='" . url( $segment_builder ) . "'>$segment</a></li>";
			}
		}
		$breadcrumb .= "</ul>";

		$breadcrumb_obj['html'] = $breadcrumb;

		return Arrays::to_object_recursive( $breadcrumb_obj );
	}

	public function setReplacableSegments( $replacableSegments )
	{
		$this->replacableSegments = $replacableSegments;
	}

	public function getReplacableSegments()
	{
		return $this->replacableSegments;
	}

	public function makeSegment( $segment )
	{
		foreach ( $this->getReplacableSegments() as $matched => $replacer ) {
			if ( $segment === $matched ) {
				return str_replace( $segment, $replacer, $segment );
			}
		}

		return $segment;
	}
}