<?php

namespace Pluma\Providers;

use Illuminate\Support\ServiceProvider;
use Pluma\Middleware\AuthenticateAdmin;
use Pluma\Middleware\CheckRole;
use Pluma\Console\Kernel;
use Pluma\Models\Role;
use Pluma\Policies\RolePolicy;
use Pluma\Middleware\RedirectToDashboardIfAuthenticated;

/**
 * PlumaServiceProvider
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 * @package Pluma
 */
class PlumaServiceProvider extends ServiceProvider
{

	/**
	 * Will make sure that the required modules have been fully loaded
	 *
	 * @return void
	 */
	public function boot()
	{
		// Custom Error handler
		$this->app->singleton(
			\Illuminate\Contracts\Debug\ExceptionHandler::class,
			\Pluma\Exceptions\Handler::class
		);

		$router = $this->app['router'];
		$router->middleware('auth.admin', AuthenticateAdmin::class);
		$router->middleware('roles', CheckRole::class);
		$router->middleware('auth.guest', RedirectToDashboardIfAuthenticated::class);

		include_once base_path("modules/Pluma/Support/helpers.php");
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$console = new Kernel();
		$this->commands( $console->commands );
		$this->app->register("Pluma\Providers\SettingsServiceProvider");
	}
}