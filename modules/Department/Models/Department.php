<?php

namespace Modules\Department;

use Illuminate\Database\Eloquent\Model;
use Modules\Employee\Detail;

class Department extends Model
{
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function typable()
    {
    	return $this->morphTo();
    }

    // public function detail()
    // {
    //     return $this->hasOne('Modules\Employee\Detail');
    // }
}