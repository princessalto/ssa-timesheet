<?php

Route::group(['prefix' => 'admin'], function () {

	Route::get('scheduler/categories', 'Modules\Scheduler\SchedulerController@categories');
	Route::post('scheduler/{scheduler}/generate', 'Modules\Scheduler\SchedulerController@generate')->name('scheduler.generate');
	Route::resource('scheduler', 'Modules\Scheduler\SchedulerController');
});


Route::get('/u/debug/{id}', 'Modules\Scheduler\SchedulerController@debug');