<?php 

// Route::group(['middleware' => 'auth.admin'], function () {
	// DEBUG
	Route::get('api/scheduler', 'Modules\Scheduler\API\SchedulerController@index');
	Route::post('api/scheduler', 'Modules\Scheduler\API\SchedulerController@index');
	Route::post('api/scheduler/widgets', 'Modules\Scheduler\API\SchedulerController@widgets');
// });