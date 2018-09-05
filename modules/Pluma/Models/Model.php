<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
	public function getFullnameAttribute()
	{
		$prefixname = $this->prefixname ? $this->prefixname : "";
		$firstname = $this->firstname ? $this->firstname : "";
		$middlename = $this->middlename ? substr( $this->middlename, 0, 1 ) . "." : "";
		$lastname = $this->lastname ? $this->lastname : "";
		return "$prefixname $firstname $middlename $lastname";
	}

	public function getEmailLinkAttribute()
	{
		return $this->email ? "<a href='mailto:$this->email'>$this->email</a>" : '';
	}

	public function getCreatedAttribute()
	{
		return date( 'M d, Y \@ h:i a', strtotime( $this->created_at ) );
	}

	public function getModifiedAttribute()
	{
		return $this->updated_at ? date( 'M d, Y \@ h:i a', strtotime( $this->updated_at ) ) : '';
	}
}
