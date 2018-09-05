<?php

namespace Pluma\Support\Traits;

use Pluma\Models\Role;
use Pluma\Models\Permission;
use Closure;

/**
 * Attachable to User Model
 * Trait to use for the Model User
 *
 */
trait HasRole
{
	/**
	 * Default roles.
	 * Roles specified here have privilege to access all views/routes.
	 * @var array
	 */
	protected $root_roles = ['superadmin', 'root', 'god'];//['superadmin', 'root', 'god'];

	/**
	 * The roles that belong to the user.
	 * @return Role
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class); // , 'user_role', 'user_id', 'role_id');
	}

	public function isRoot()
	{
		foreach ( $this->roles as $role ) {
			if ( in_array($role->slug, $this->root_roles) ) return true;
		}

		return false;
	}

	public function getPermissionsAttribute()
	{
		return $this->with('roles.permissions')->get();
	}

	public function getRoleNamesAttribute()
	{
		$roles = [];
		// dd($this->roles);
		foreach ( $this->roles as $role ) {
			$roles[] = $role->name;
		}
		return implode(" / ", $roles);
	}

	public function hasRole($roles)
	{
		if ( auth()->user()->isRoot() ) return true;

		if ( ! $roles ) return false;

		if ( is_array( $roles ) ) {
			foreach ( $roles as $role ) {
				if ( $this->has( trim( $role ) ) ) return true;
			}
		} else {
			return $this->has( trim( $roles ) );
		}

		return false;
	}

	private function has($role)
	{
		if ( $this->roles()->where('slug', $role)->orWhere('name', $role)->exists() ) return true;

		return false;
	}
}