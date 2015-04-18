<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('job_id');
			$table->integer('user_id');
			$table->integer('job_type_id');
			$table->string('name');
			$table->string('kana');
		    $table->string('zip_code');
		    $table->string('prefecture_id');
		    $table->string('city');
		    $table->string('other_address_1');
		    $table->string('other_address_2');
		    $table->integer('birth_year');
		    $table->integer('birth_month');
		    $table->integer('birth_day');
			$table->integer('gender');
			$table->string('tel')->nullable();
			$table->string('email');
		    $table->string('current_job');
		    $table->string('education');
		    $table->string('qualification');
		    $table->string('career');
		    $table->text('introduction');
		    $table->text('remark');
		    $table->text('comment');
		    $table->text('memo');
		    $table->date('employed_date')->nullable();
		    $table->integer('status')->default(0);
		    $table->boolean('checked')->default(false);
		    $table->integer('applied_year');
		    $table->integer('applied_month');
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
		Schema::drop('applications');
	}

}
