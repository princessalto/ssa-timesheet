<?php

Route::get('{slug?}', '\Pluma\Controllers\PublicController@show');
Route::post('{slug?}', '\Pluma\Controllers\PublicController@store');
Route::get('/', '\Pluma\Controllers\PublicController@show');

Route::get('assets/{module?}/{file?}', function ($module = null, $file = null) {
	$path = base_path("modules/$module/assets/$file");
	$is_css = explode('/', $file)[0] == 'css' ? true : false;

	if ( \File::exists( $path ) ) {
		return response()->file($path, $is_css ? array('Content-Type' => 'text/css') : []);
	}

	return response()->json([ ], 404);
})->where('file', '.*');