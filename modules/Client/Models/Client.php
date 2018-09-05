<?php

namespace Modules\Client;

use Illuminate\Database\Eloquent\Model;
use Modules\Type\Type;
use Modules\Scheduler\Scheduler;

class Client extends Model
{
    
	public function types()
	{
		return $this->belongsToMany('Modules\Type\Type');
	}

	public function scheduler()
	{
		return $this->hasOne('Modules\Scheduler\Scheduler');
	}

	public function getCreatedAttribute()
	{
		return date( "d-M-Y \(h:i a\)", strtotime( $this->created_at ) );
	}

	public function getModifiedAttribute()
	{
		return date ( "d-M-Y \(h:i a\)", strtotime( $this->created_at ) );
	}

	public function getTypeListAttribute()
	{
		$type_list = [];
		foreach ( $this->types as $type ) {
			$type_list[] = "<a href=''>$type->name</a>";
		}

		return implode(", ", $type_list);
	}

	public function getTypeNameAttribute()
	{
		$type_name = [];
		foreach ( $this->types as $type ) {
			$type_name[] = "$type->name";
		}

		return implode(", ", $type_name);
	}
}