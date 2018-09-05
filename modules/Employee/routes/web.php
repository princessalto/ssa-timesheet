<?php

Route::group(['prefix' => '/admin'], function () {

	Route::get('employees/categories', 'Modules\Employee\EmployeeController@categories');

	Route::resource('employees', 'Modules\Employee\EmployeeController');
	Route::resource('employees/password', 'Modules\Employee\PasswordController');
});