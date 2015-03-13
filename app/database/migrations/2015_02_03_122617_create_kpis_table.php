<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKpisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kpis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description' , 1000);
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->integer('theme_id')->unsigned();
			$table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
			$table->integer('currency');
			$table->string('type');
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
		Schema::drop('kpis');
	}

}
