<?php
// Login
Route::get('login', 'Pluma\Controllers\Auth\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'Pluma\Controllers\Auth\LoginController@login')->name('login.login');
Route::any('logout', 'Pluma\Controllers\Auth\LoginController@logout')->name('login.logout');

// Registration
Route::get('register', 'Pluma\Controllers\Auth\RegisterController@showRegistrationForm')->name('register.show');
Route::post('register', 'Pluma\Controllers\Auth\RegisterController@register')->name('register.register');

// Password Reset
Route::get('password/reset/{token?}', 'Pluma\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.show');
Route::post('password/email', 'Pluma\Controllers\Auth\ResetPasswordController@sendResetLinkEmail')->name('password.send');
Route::post('password/reset', 'Pluma\Controllers\Auth\ResetPasswordController@reset')->name('password.reset');

// Permissions
Route::get('roles/permissions/refresh', 'Pluma\Controllers\Permission\RefreshPermissionController@showRefreshMessage')->name('permissions.show');
Route::post('roles/permissions/refresh', 'Pluma\Controllers\Permission\RefreshPermissionController@refresh')->name('permissions.refresh');
Route::resource('roles/permissions', 'Pluma\Controllers\Permission\PermissionController', ['except' => ['create', 'destroy', 'show']]);

// Roles
Route::get('roles/trash', 'Pluma\Controllers\RoleController@trash')->name('roles.trash');
Route::post('roles/{role}/restore', 'Pluma\Controllers\RoleController@restore')->name('roles.restore');
Route::resource('roles', 'Pluma\Controllers\RoleController');

// Settings
Route::get('settings', function () {
    return redirect(route('settings.form.general'));
})->name('settings.settings');
Route::get('settings/general', 'Pluma\Controllers\SettingsController@getGeneralForm')->name('settings.form.general');
Route::get('settings/profile', 'Pluma\Controllers\SettingsController@getProfileForm')->name('settings.form.profile');
Route::post('settings/general', 'Pluma\Controllers\SettingsController@general')->name('settings.general');
Route::post('settings/profile', 'Pluma\Controllers\SettingsController@profile')->name('settings.profile');


// Route::get('x/debug', function ()
// {
//     $roles = Pluma\Models\Role::with('permissions')->find(1);
//     // $roles->permissions()->sync([1, 2, 3]);
//     dd($roles->permissions);
// });