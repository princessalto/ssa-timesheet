<?php

namespace Modules\Employee;

use Illuminate\Database\Eloquent\Model;
use Pluma\Models\User;
use Modules\Scheduler\Scheduler;
use Pluma\Support\Traits\HasRole;
use Modules\Department\Department;

class Employee extends User
{

    use HasRole;
    
    protected $table = 'users';

    public function schedulers()
    {
    	return $this->hasMany('Modules\Scheduler\Scheduler');
    }

    // public function detail()
    // {
    //     return $this->hasOne('Modules\Employee\Detail', 'employee_id');
    // }

    
    // public static function all($columns = ['*'])
    // {
    // 	$instance = new static;
    // 	return $instance->where('role', 'empl')->get();
    // }
}
