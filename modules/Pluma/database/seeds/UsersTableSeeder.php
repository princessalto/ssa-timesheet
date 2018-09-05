<?php

namespace Pluma\Database\Seeds;

use Illuminate\Database\Seeder;
use Pluma\Models\User;
use Pluma\Models\Role;
use Hash;

class UsersTableSeeder extends Seeder
{

	public function run()
	{
		User::truncate();

		$user = new User();
		$user->firstname = "John Lioneil";
		$user->lastname = "Dionisio";
		$user->username = "john";
		$user->email = "john@ssagroup.com";
		$user->password = Hash::make('admin');
		$user->save();
		$user->roles()->save( Role::find(1) );

		$user = new User();
		$user->firstname = "Princess Ellen";
		$user->lastname = "Alto";
		$user->username = "princess";
		$user->email = "ellen@ssagroup.com";
		$user->password = Hash::make('admin');
		$user->save();
		$user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Lora Monica";
		// $user->lastname = "Lenomeron";
		// $user->username = "lora";
		// $user->email = "monica@ssagroup.com";
		// $user->password = Hash::make('lmrenomeron');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Pauline";
		// $user->lastname = "Kuizon";
		// $user->username = "pau";
		// $user->email = "pau@ssagroup.com";
		// $user->password = Hash::make('phkuizon');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Anna Kristina";
		// $user->lastname = "Castillo";
		// $user->username = "ak";
		// $user->email = "anna@ssagroup.com";
		// $user->password = Hash::make('akcastillo');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Chad";
		// $user->lastname = "Aranzaso";
		// $user->username = "chad";
		// $user->email = "chad@ssagroup.com";
		// $user->password = Hash::make('caranzaso');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Meynard";
		// $user->lastname = "Amparo";
		// $user->username = "meynard";
		// $user->email = "meynard@ssagroup.com";
		// $user->password = Hash::make('jmamparo');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
		//
		// $user = new User();
		// $user->firstname = "Abigail";
		// $user->lastname = "Ang";
		// $user->username = "aby";
		// $user->email = "abigail@ssagroup.com";
		// $user->password = Hash::make('admin');
		// $user->save();
		// $user->roles()->save( Role::find(1) );
	}
}
