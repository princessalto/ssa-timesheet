<?php

namespace Pluma\Models;

use Pluma\Models\Model;
use Pluma\Models\Taxonomy;

class Settings extends Model
{
	protected $table = 'settings';

	public function taxonomy()
	{
		return $this->hasOne(Taxonomy::class);
	}
}