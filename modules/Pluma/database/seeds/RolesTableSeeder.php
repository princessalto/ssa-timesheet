<?php

namespace Pluma\Database\Seeds;

use Illuminate\Database\Seeder;
use Pluma\Models\Role;

class RolesTableSeeder extends Seeder
{

	public function run()
	{
		$role = new Role();
		$role->name = "Superadmin";
		$role->slug = "superadmin";
		$role->description = "The root access";
		$role->save();
		// $role-

		$role = new Role();
		$role->name = "Admin";
		$role->slug = "admin";
		$role->description = "The admin access";
		$role->save();

		$role = new Role();
		$role->name = "Author";
		$role->slug = "author";
		$role->description = "An author";
		$role->save();
	}

}