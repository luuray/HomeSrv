<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SensorRecord
 * @package App\Model
 *
 * @payload {"timestamp": 1555147341, "device_id": 1, "temperature": 22.66, "pressure": 1007.4759669737368, "humidity": 25.28989515095013, "luminosity": 342.71999999999997}
 */
class SensorRecord extends Model
{
	protected $table = 'sensor_record';

	public $timestamps = false;

	protected $attributes = [
		'timestamp' => 0,
	    'temperature'=>0,
	    'pressure'=>0,
	    'humidity'=>0,
	    'luminosity'=>0
    ];

	protected $fillable= ['timestamp', 'device_id', 'temperature', 'pressure', 'humidity', 'luminosity'];

    public function sensor()
    {
	    return $this->belongsTo(Sensor::class, 'sensor_id');
    }

    public function device()
    {
	    return $this->belongsTo(Device::class, 'device_id');
    }
}
