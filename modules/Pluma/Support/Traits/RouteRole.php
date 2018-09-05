<?php

namespace Pluma\Support\Traits;

use Illuminate\Http\Request;
use Pluma\Models\Role;
use Closure;
use App;

trait RouteRole
{
	protected $roles;
	protected $route;

	public function __construct(Request $request)
	{
		$this->route = $request->route();
	}

	public function setRequest($request)
	{
		$this->route = $request->route();
		return $this;
	}

	public function roles(Request $request)
	{
		$permissions = [];
		foreach ( auth()->user()->roles as $role ) {
			foreach ( $role->permissions as $permission ) {
				$permissions[] = $permission;
			}
		}

		if ( App::runningInConsole() ) return [];

		$roles = [];
				// dd($request->route()->getAction());
		foreach ( $permissions as $permission ) {
			if ( ! empty( $request ) &&
				isset( $request->route()->getAction()['as'] ) &&
				$request->route()->getAction()['as'] == $permission->name ) {
				$roles[] = $permission->roles;
			}
		}

		foreach ( $roles as $collection ) {
			foreach ( $collection as $role ) {
				$this->roles[] = $role->slug;
			}
		}

		return $this->roles;
	}
}