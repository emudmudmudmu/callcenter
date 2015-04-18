<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantJobLocations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applicant_job_locations', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('prefecture_id');
		    $table->integer('city_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applicant_job_locations');
	}

}
