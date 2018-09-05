<?php
namespace Pluma\Controllers\Permission;

use Pluma\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Pluma\Models\Permission;

class RefreshPermissionController extends Controller
{
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function refresh()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		\DB::table('permission_role')->truncate();
		Permission::truncate();
		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		\Artisan::call('db:seed', ['--class' => '\Pluma\Database\Seeds\PermissionsTableSeeder']);

		session()->flash('type', 'success');
		session()->flash('status', 'Resource successfully refreshed.');

		return back();
	}

	public function showRefreshMessage($value='')
	{
		return view("Pluma::permissions.show");
	}
}