<?php

namespace Pluma\Models;

use Pluma\Support\Traits\HasRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasRole, SoftDeletes;

    public function getFullnameAttribute()
    {
        $prefixname = $this->prefixname ? $this->prefixname : "";
        $firstname = $this->firstname ? $this->firstname : "";
        $middlename = $this->middlename ? substr( $this->middlename, 0, 1 ) . "." : "";
        $lastname = $this->lastname ? $this->lastname : "";
        return "$prefixname $firstname $middlename $lastname";
    }

    public function departments()
    {
        return $this->hasOne('Modules\Department\Department');
    }

    public function detail()
    {
        return $this->hasOne('Modules\Employee\Detail', 'user_id');
    }
}