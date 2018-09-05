<?php

namespace Pluma\Models;

use Pluma\Models\Model;
use Pluma\Models\Settings;

class Taxonomy extends Model
{

	public function settings()
	{
		return $this->belongsTo(Settings::class);
	}
}