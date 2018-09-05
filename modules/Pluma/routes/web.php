<?php

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', function () {
		return redirect('admin/dashboard');
	});

	Route::get('dashboard', 'Pluma\Controllers\DashboardController@index');
	Route::get('chartjs', 'Pluma\Controllers\DashboardController@index');
});