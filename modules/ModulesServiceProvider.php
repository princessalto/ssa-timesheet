<?php
namespace Modules;

/**
 * ServiceProvider
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author John Lioneil Dionisio <john.dionisio1@gmail.com>
 * @package Modules
 */
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Will make sure that the required modules have been fully loaded
	 *
	 * @return void
	 */
	public function boot()
	{
		// For each of the registered modules, include their routes and Views
		$modules = config("modules.enabled");

		foreach ($modules as $module) {
			// Load the web routes for each of the modules
			if ( file_exists( __DIR__ . "/$module/routes/web.php" ) ) {
				include __DIR__ . "/$module/routes/web.php";
			}

			// Load the public routes for each of the modules
			if ( file_exists( __DIR__ . "/$module/routes/public.php" ) ) {
				include __DIR__ . "/$module/routes/public.php";
			}

			// Load the backend routes for each of the modules
			if ( file_exists( __DIR__ . "/$module/routes/backend.php" ) ) {
				include __DIR__ . "/$module/routes/backend.php";
			}

			// Load the api routes for each of the modules
			if ( file_exists( __DIR__ . "/$module/routes/api.php" ) ) {
				include __DIR__ . "/$module/routes/api.php";
			}

			// Load the console routes for each of the modules
			if ( file_exists( __DIR__ . "/$module/routes/console.php" ) ) {
				include __DIR__ . "/$module/routes/console.php";
			}

			// Load the views
			if ( is_dir( __DIR__ . "/$module/views" ) ) {
				$this->loadViewsFrom( __DIR__ . "/$module/views", $module );
			}

			// Load the views composer
			if ( file_exists( __DIR__ . "/$module/config/composer.php" ) ) {
				$composers = require_once __DIR__ . "/$module/config/composer.php";
				if ( is_array( $composers ) ) {
					foreach ( $composers as $composer ) {
						view()->composer($composer['views'], $composer['class']);
					}
				}
			}

			// Publish Configs
			if ( file_exists( __DIR__ . "/$module/config/" . strtolower( $module ) . ".php" ) ) {
				$this->publishes([
					__DIR__ . "/$module/config/" . strtolower( $module ) . ".php" => config_path( strtolower( $module ) . ".php" ),
				], 'config');
			}
		}

		// if ( file_exists( __DIR__ . "/Admin/routes/admin.php" ) ) {
		// 	include __DIR__ . "/Admin/routes/admin.php";
		// }
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$modules = config("modules.enabled");

		foreach ($modules as $module) {
			if ( file_exists( __DIR__ . "/$module/config/" . strtolower( $module ) . ".php" ) ) {
				$this->mergeConfigFrom( __DIR__ . "/$module/config/" . strtolower( $module ) . '.php', $module );
			}

			/**
			 * Register the ServiceProvider if any
			 */
			if ( file_exists( base_path("modules/$module/Providers/{$module}ServiceProvider.php") ) ) {
				$this->app->register("$module\Providers\\".$module."ServiceProvider");
				// $loader = \Illuminate\Foundation\AliasLoader::getInstance();
				// $loader->alias('Breadcrumbs', 'DaveJamesMiller\Breadcrumbs\Facade');
			}
		}
	}
}
