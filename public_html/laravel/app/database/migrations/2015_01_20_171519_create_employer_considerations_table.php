<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerConsiderationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employer_considerations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employer_id');
			$table->integer('applicant_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop('employer_considerations');
	}

}
