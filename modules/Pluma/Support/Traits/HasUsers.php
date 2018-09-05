<?php

namespace Pluma\Support\Traits;

use Pluma\Models\User;
use Closure;

/**
 * Trait to use for the Model User
 *
 */
trait HasUsers
{
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
}