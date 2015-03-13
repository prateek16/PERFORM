<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->enum('role', array('manager', 'officer', 'admin'));
			$table->string('level',1);
			$table->string('firstName',20);
			$table->string('lastName',20);
			$table->string('address');
			$table->string('contact');
			$table->string('organization');
			$table->string('password',60);
			$table->integer('projectId');
			$table->text('remember_token')->nullable();
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
		Schema::drop('users');
	}

}
