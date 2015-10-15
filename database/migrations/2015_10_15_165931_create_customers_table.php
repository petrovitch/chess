<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-15 16:59:31
// ------------------------------------------------------------

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('customer', 40)->nullable();
			$table->string('street', 40)->nullable();
			$table->string('city', 40)->nullable();
			$table->string('state', 2)->nullable();
			$table->string('zip', 5)->nullable();
			$table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
			$table->timestamp('updated_at')->default("0000-00-00 00:00:00");
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('customers');
	}
}