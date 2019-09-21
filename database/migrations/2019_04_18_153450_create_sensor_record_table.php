<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorRecordTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('sensor_record')) {
			Schema::create('sensor_record', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('sensor_id', false, true);
				$table->timestamp('timestamp');
				$table->decimal('temperature', 8, 2)->default(0);
				$table->decimal('pressure', 10, 4)->default(0);
				$table->decimal('humidity', 6, 3)->default(0);
				$table->decimal('luminosity', 10, 2)->default(0);
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sensor_table', function (Blueprint $table) {
			//
		});
	}
}
