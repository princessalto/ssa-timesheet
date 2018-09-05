<?php

namespace Pluma\Database\Seeds;

use Illuminate\Database\Seeder;
use Pluma\Models\Permission;

class PermissionsTableSeeder extends Seeder
{

	public function run()
	{
		$modules = config("modules.enabled");
		$permissions = [];
		foreach ( $modules as $module ) {
			if ( file_exists( base_path("modules/$module/config/permissions.php") ) ) {
				$permissions += (array) require base_path("modules/$module/config/permissions.php");
			}
		}

		foreach ( $permissions as $name => $permission ) {
			Permission::create(array(
				'name' => $permission['name'],
				'slug' => $permission['slug'],
				'description' => $permission['description'],
			));
		}
	}

}