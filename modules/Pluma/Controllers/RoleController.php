<?php
namespace Pluma\Controllers;

use Pluma\Controllers\AdminController;
use Illuminate\Http\Request;
use Pluma\Models\Permission;
use Pluma\Models\Role;
use Pluma\Requests\RoleRequest;
use Route;

class RoleController extends AdminController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
		    // Ignores notices and reports all other kinds... and warnings
		    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
		$resources = Role::paginate(config("modules.settings.pagination_count", 20));
		$trashed = Role::onlyTrashed()->get();
		return view("Pluma::roles.index")->with( compact('resources', 'trashed') );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$permissions = Permission::pluck('name', 'id');
		return view("Pluma::roles.create")->with( compact("permissions") );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(RoleRequest $request)
	{
		$role = new Role();
		$role->name = $request->input('name');
		$role->slug = $request->input('slug');
		$role->description = $request->input('description');
		$role->save();
		$role->permissions()->attach( $request->input('permissions') );

		session()->flash('type', 'success');
		session()->flash('status', 'Role successfully updated');

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return view("Pluma::roles.show");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$resource = Role::find( $id );
		$permissions = Permission::all();

		return view("Pluma::roles.edit")->with( compact('resource', 'permissions') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(RoleRequest $request, $id)
	{
		$resource = Role::find( $id );

		$resource->name = $request->input('name');
		$resource->slug = $request->input('slug');
		$resource->description = $request->input('description');
		$resource->save();
		$resource->permissions()->sync($request->input('permissions'));

		session()->flash('type', 'success');
		session()->flash('status', 'Role successfully updated');

		return back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$resource = Role::find($id);
		$resource->delete();

		session()->flash('status', 'Resource was remove');
		session()->flash('type', 'success');
		return back();
	}

	public function trash()
	{
		$resources = Role::onlyTrashed()->paginate( config("modules.settings.pagination_count", 20) );
		return view("Pluma::roles.trash")->with( compact('resources') );
	}

	public function restore($id)
	{
		$resource = Role::onlyTrashed()->whereId( $id )->first();
		$resource->restore();

		session()->flash('status', 'Resource was restored');
		session()->flash('type', 'success');
		return back();
	}
}
