<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funding', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',100);

			$table->integer('pid')->unsigned();
			$table->foreign('pid')->references('id')->on('projects')->onDelete('cascade');

			$table->decimal('total', 5, 3);
			$table->string('type',10);
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
		Schema::drop('funding');
	}

}
