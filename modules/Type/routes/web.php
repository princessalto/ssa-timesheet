<?php

Route::group(['prefix' => 'admin'], function () {

	Route::get('types/categories', 'Modules\Type\TypeController@categories');

	Route::delete('types/many', 'Modules\Type\TypeController@destroyMany')->name('types.destroy-many');
	Route::resource('types', 'Modules\Type\TypeController');
});