<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
	protected $table = 'device';

	public $timestamps = false;

	public function sensors()
	{
		return $this->hasMany(Sensor::class, 'device_id', 'id');
	}
}
