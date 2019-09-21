<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('device')) {
			Schema::create('device', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 128);
				$table->timestamp('last_active')->nullable();
				$table->timestamp('created_at');
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
		Schema::table('device', function (Blueprint $table) {
			//
		});
	}
}
