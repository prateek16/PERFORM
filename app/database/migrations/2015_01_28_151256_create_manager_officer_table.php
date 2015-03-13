<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManagerOfficerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('manager_officer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('manager_id')->unsigned()->index();
			$table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
			$table->integer('officer_id')->unsigned()->index();
			$table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
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
		Schema::drop('manager_officer');
	}

}
