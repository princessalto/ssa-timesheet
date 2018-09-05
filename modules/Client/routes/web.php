<?php

Route::group(['prefix' => '/admin'], function () {

	Route::get('clients/types', 'Modules\Client\ClientController@types');
	Route::resource('clients', 'Modules\Client\ClientController');

	// Route::get('client', 'Modules\Client\ClientController@index');
	// Route::get('client/{client}', 'Modules\Client\ClientController@show');
	// Route::get('client/create', 'Modules\Client\ClientController@create');
	// Route::post('client/store', 'Modules\Client\ClientController@create');
	// Route::get('client/{client}/edit', 'Modules\Client\ClientController@edit');
	// Route::put('client/{client}', 'Modules\Client\ClientController@update');
	// Route::delete('client/{client}', 'Modules\Client\ClientController@destroy');
});