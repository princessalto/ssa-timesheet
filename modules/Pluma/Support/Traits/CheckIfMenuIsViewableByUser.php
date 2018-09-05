<?php

namespace Pluma\Support\Traits;

trait CheckIfMenuIsViewableByUser
{
	protected $excludables = ['dashboard', 'settings', 'view-settings'];
	protected $permissions;

	public function checkIfMenuIsViewableByUser($menus)
	{
		if ( auth()->user() && auth()->user()->isRoot() ) return $menus;

		$this->setPermissionsFromUser();
		$menus = $this->setViewableMenus( $menus );
		// dd($menus);
		return $menus;
	}

	public function setPermissionsFromUser()
	{
		if ( ! auth()->user() ) return [];

		foreach ( auth()->user()->roles as $role ) {
			foreach ( $role->permissions as $permission ) {
				$this->permissions[] = $permission->slug;
			}
		}

		return $this->permissions;
	}

	public function setViewableMenus($menus)
	{
		foreach ( $menus as $slug => $menu ) {
			if ( $this->permissions && ! isset( $menu['parent'] ) && ! in_array( $slug, $this->excludables ) && ! in_array( $slug, $this->permissions ) ) unset( $menus[ $slug ] );
		}
			// dd($menus);
		return $menus;
		// $this->menus = $permissionables;
	}

	public function checkIfMenuHasChild($menus)
	{
		if ( auth()->user() && auth()->user()->isRoot() ) return $menus;

		foreach ( $menus as $slug => $menu ) {
			if ( ! in_array( $slug, $this->excludables ) && ! $menu->has_children ) unset( $menus[ $slug ] );
		}

		return $menus;
	}
}