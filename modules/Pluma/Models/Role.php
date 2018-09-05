<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Support\Traits\HasPermission;
use Pluma\Support\Traits\HasUsers;
use Pluma\Models\User;

class Role extends Model
{
	use SoftDeletes, HasUsers, HasPermission;
}
