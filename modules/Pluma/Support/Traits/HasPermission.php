<?php

namespace Pluma\Support\Traits;

use Pluma\Models\Permission;
use Closure;

/**
 * Attachable to User Model
 * Trait to use for the Model User
 *
 */
trait HasPermission
{
	/**
	 * Default permissions.
	 * Permissions specified here have privilege to access all views/routes.
	 * @var array
	 */
	protected $root_permissions = ['superadmin', 'root', 'god'];

	/**
	 * The permissions that belong to the user.
	 * @return Permission
	 */
	public function permissions()
	{
		return $this->belongsToMany(Permission::class); // , 'user_permission', 'user_id', 'permission_id');
	}

	public function hasPermission($permissions)
	{
		if ( ! $permissions ) return false;

		if ( is_array( $permissions ) ) {
			foreach ( $permissions as $permission ) {
				if ( $this->has( trim( $permission ) ) ) return true;
			}
		} else {
			return $this->has( $permissions );
		}

		return false;
	}

	private function has($permission)
	{
		if ( $this->permissions()->whereIn('slug', $this->root_permissions)->orWhereIn('name', $this->root_permissions)->exists() ) return true;

		if ( $this->permissions()->where('slug', $permission)->orWhere('name', $permission)->exists() ) return true;

		return false;
	}
}