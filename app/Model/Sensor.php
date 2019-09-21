<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table='sensor';

    public $timestamps = false;

    public function device()
    {
    	return $this->belongsTo(Device::class, 'device_id');
    }

    public function records()
    {
    	return $this->hasMany(SensorRecord::class, 'sensor_id');
    }
}
