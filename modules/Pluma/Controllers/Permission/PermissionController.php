<?php
namespace Pluma\Controllers\Permission;

use Pluma\Controllers\AdminController as BaseController;
use Illuminate\Http\Request;
use Pluma\Models\Permission;
use Pluma\Models\Role;
use Route;

class PermissionController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$resources = Permission::all();
		return view("Pluma::permissions.index")->with( compact('resources') );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$resource = Permission::find( $id );
		$roles_options = Role::pluck('name', 'id');
		return view("Pluma::permissions.edit")->with( compact('resource', 'roles_options') );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		# code...
	}
}