<?php

namespace Modules\Type;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function typable()
    {
    	return $this->morphTo();
    }
}