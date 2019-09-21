<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('sensor')) {
			Schema::create('sensor', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('device_id', false, true);
				$table->string('name', 128);
				$table->timestamp('last_active')->nullable();
				$table->timestamp('createed_at');
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
		Schema::table('sensor', function (Blueprint $table) {
			//
		});
	}
}
