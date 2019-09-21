<?php
/**
 * HomeSrv
 *
 * SensorService
 *
 * @author Luuray
 * @copyright Rainhan System
 * @id $Id$
 *
 * Copyright (c) 2010-2019, Rainhan System
 * Site: www.rainhan.net/?proj=HomeSrv
 */


namespace App\Services;

use App\Repositories\SensorRepository;

class SensorService implements IService
{
	protected $sensorRepository;

	public function __construct(SensorRepository $repository)
	{
		$this->sensorRepository = $repository;
	}

	public function createRecord($data)
	{
		$this->sensorRepository->newRecord();
	}
}