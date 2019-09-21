<?php
/**
 * HomeSrv
 *
 * SensorRepository
 *
 * @author Luuray
 * @copyright Rainhan System
 * @id $Id$
 *
 * Copyright (c) 2010-2019, Rainhan System
 * Site: www.rainhan.net/?proj=HomeSrv
 */


namespace App\Repositories;

use App\Model\Sensor;

class SensorRepository implements IRepository
{
	protected $sensor;

	public function __construct(Sensor $sensor)
	{
		$this->sensor = $sensor;
	}

	public static function getSensorOrCreate($device_id, $sensor_name)
	{
		$sensor = Cache::get("sensor_{$device_id}_{$sensor_name}", function () use ($device_id, $sensor_name) {
			return Sensor::firstOrCreate([
				'device_id' => DeviceRepository::findOrCreate($device_id),
				'name'      => $sensor_name
			], [
				'last_active' => time()
			]);
		});

		return new self($sensor);
	}

	public function newRecord()
	{
	}
}