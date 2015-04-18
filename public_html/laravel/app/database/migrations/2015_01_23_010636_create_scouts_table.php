<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scouts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id');
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
		Schema::drop('scouts');
	}

}
