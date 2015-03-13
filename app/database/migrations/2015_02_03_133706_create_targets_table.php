<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('targets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('kpi_id')->unsigned();
			$table->foreign('kpi_id')->references('id')->on('kpis')->onDelete('cascade')->onUpdate('cascade');

			$table->decimal('target', 5, 3);
			$table->decimal('value', 5, 3);
			$table->integer('return_id');
			$table->integer('project_id');
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
		Schema::drop('targets');
	}

}
