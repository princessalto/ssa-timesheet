<?php

namespace Modules\Scheduler;

use Illuminate\Database\Eloquent\Model;
use Modules\Client\Client;
use Modules\Employee\Employee;

class Scheduler extends Model
{
    // protected $table = 'schedulers';

    public function client()
    {
    	return $this->belongsTo('Modules\Client\Client');
    }

    public function employee()
    {
    	return $this->belongsTo('Modules\Employee\Employee');
    }

    public function getClientNameAttribute()
    {
    	return $this->client->name;
    }

    public function getTimeAttribute()
    {
        return date('m/d/Y h:i:s A', strtotime($this->start_time)) . " - " . date('m/d/Y h:i:s A', strtotime($this->end_time));
    }

    public function getHoursInDayAttribute()
    {
        return ( strtotime($this->start_time) - strtotime($this->end_time) ) / 86400;
    }
}