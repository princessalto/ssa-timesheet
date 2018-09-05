<?php

namespace Modules\Employee;

use Modules\Scheduler\Scheduler;
use Pluma\Models\Model;
use Modules\Department\Department;
use Pluma\Models\User;

class Detail extends Model
{

    protected $table = 'employees';

    // public function schedulers()
    // {
    // 	return $this->hasMany('Modules\Scheduler\Scheduler');
    // }

    // public static function all($columns = ['*'])
    // {
    // 	$instance = new static;
    // 	return $instance->where('role', 'empl')->get();
    // }

    public function getDepartmentNameAttribute()
    {
        return $this->department ? $this->department->name : 'No department';
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Department');
    }

    public function user()
    {
        return $this->belongsTo('Pluma\Models\User');
    }
}
