<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantMetas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applicant_metas', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->string('last_name_kana');
		    $table->string('first_name_kana');
		    $table->string('zip_code');
		    $table->string('prefecture_id');
		    $table->string('city');
            $table->string('other_address_1');
            $table->string('other_address_2');
		    $table->integer('birth_year');
		    $table->integer('birth_month');
		    $table->integer('birth_day');
		    $table->integer('gender');	// 1 => male, 2 => female
		    $table->string('tel')->nullable();
		    $table->string('current_job');
		    $table->string('education');
		    $table->text('qualification');
		    $table->text('career');
		    $table->text('introduction');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applicant_metas');
	}

}
