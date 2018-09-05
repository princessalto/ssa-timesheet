<?php

namespace Pluma\Models;

use Pluma\Models\Model;
use Pluma\Models\Role;

class Permission extends Model
{
	protected $fillable = ['name', 'slug', 'method', 'description'];

	public function roles()
	{
		return $this->belongsToMany( Role::class );
	}
}