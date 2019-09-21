<?php
/**
 * HomeSrv
 *
 * DeviceRepository
 *
 * @author Luuray
 * @copyright Rainhan System
 * @id $Id$
 *
 * Copyright (c) 2010-2019, Rainhan System
 * Site: www.rainhan.net/?proj=HomeSrv
 */


namespace App\Repositories;

use App\Model\Device;

class DeviceRepository implements IRepository
{
	public static function findOrCreate($device_id, $name='')
	{
		return Device::firstOrCreate(['id'=>$device_id], ['name'=>$name, 'last_active'=>time()]);
	}
}