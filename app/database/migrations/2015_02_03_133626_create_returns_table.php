<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReturnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('returns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user');
			$table->string('type');
			$table->integer('Project_id');
			$table->string('record');
			$table->string('start_date');
			$table->string('end_date');
			$table->string('target_date');
			$table->integer('track');
			$table->integer('fund_id');

			$table->integer('kpi');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('returns');
	}

}
