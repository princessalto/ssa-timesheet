<?php

namespace Pluma\Providers;

use Illuminate\Support\ServiceProvider;
use Pluma\Middleware\AuthenticateAdmin;
use Pluma\Middleware\CheckRole;
use Pluma\Console\Kernel;
use Pluma\Models\Settings;

/**
 * PlumaServiceProvider
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 * @package Pluma
 */
class SettingsServiceProvider extends ServiceProvider
{
	/**
	 * Will make sure that the required modules have been fully loaded
	 *
	 * @return void
	 */
	public function boot()
	{
		// config()->set('modules.settings', Settings::pluck('value', 'key')->all());
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}