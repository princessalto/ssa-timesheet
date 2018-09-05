<?php

Route::group(['prefix' => 'admin'], function () {

	Route::get('departments/categories', 'Modules\Department\DepartmentController@categories');

	Route::resource('departments', 'Modules\Department\DepartmentController');
});