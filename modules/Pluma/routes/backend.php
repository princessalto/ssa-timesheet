<?php
/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => config("modules.backend.prefix"), 'middleware' => ['web']], function () {
	$modules = config("modules.enabled");
	foreach ( $modules as $module ) {
		if ( file_exists( base_path("modules/$module/routes/admin.php") ) ) {
			include_once base_path("modules/$module/routes/admin.php");
		}
	}
});

// Route::any('{.*}', 'Pluma\Controllers\AdminController@page');