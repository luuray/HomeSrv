<?php

namespace App\Observers;

use App\Model\Sensor;
use App\Model\SensorRecord;

class SensorRecordObserver
{
	/**
	 * Handle the sensor record "created" event.
	 *
	 * @param SensorRecord $sensorRecord
	 *
	 * @return void
	 */
	public function created(SensorRecord $sensorRecord)
	{
		$sensorRecord->sensor->update(['last_active' => $sensorRecord->timestamp]);
		$sensorRecord->device->update(['last_active' => $sensorRecord->timestamp]);
	}

	/**
	 * Handle the sensor record "updated" event.
	 *
	 * @param SensorRecord $sensorRecord
	 *
	 * @return void
	 */
	public function updated(SensorRecord $sensorRecord)
	{
		//
	}

	/**
	 * Handle the sensor record "deleted" event.
	 *
	 * @param SensorRecord $sensorRecord
	 *
	 * @return void
	 */
	public function deleted(SensorRecord $sensorRecord)
	{
		//
	}

	/**
	 * Handle the sensor record "restored" event.
	 *
	 * @param SensorRecord $sensorRecord
	 *
	 * @return void
	 */
	public function restored(SensorRecord $sensorRecord)
	{
		//
	}

	/**
	 * Handle the sensor record "force deleted" event.
	 *
	 * @param SensorRecord $sensorRecord
	 *
	 * @return void
	 */
	public function forceDeleted(SensorRecord $sensorRecord)
	{
		//
	}
}
