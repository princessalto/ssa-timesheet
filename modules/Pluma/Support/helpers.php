<?php

if ( ! function_exists('assets') ) {
	/**
	 * Load the assets from the Module.
	 *
	 * @param  string  $path
	 * @param  mixed   $parameters
	 * @param  bool    $secure
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	function assets($path, $secure = null)
	{
		return app('url')->asset("assets/$path");
	}
}

if ( ! function_exists('css') ) {
	/**
	 * Load the assets from the Module.
	 *
	 * @param  string  $path
	 * @param  mixed   $parameters
	 * @param  bool    $secure
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	function css($path)
	{
		return url("assets/$path");
	}
}

if ( ! function_exists('js') ) {
	/**
	 * Load the assets from the Module.
	 *
	 * @param  string  $path
	 * @param  mixed   $parameters
	 * @param  bool    $secure
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	function js($path)
	{
		return url("assets/$path");
	}
}