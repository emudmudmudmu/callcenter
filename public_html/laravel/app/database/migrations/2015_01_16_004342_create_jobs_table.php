<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('title');
            $table->string('catch_phrase');
            $table->text('catch_text');
			$table->text('description');
			$table->text('capacity');
			$table->string('job_pattern');
			$table->integer('prefecture_id');
			$table->string('other_address');
			$table->string('other_address2');
			$table->text('transportation');
			$table->text('duty_hours');
			$table->text('salary');
			$table->text('holiday');
			$table->text('benefit');
			$table->text('choice_process');
			$table->text('interview_address');
			$table->string('pic_department');
			$table->string('pic_name');
			$table->text('pic_comment');
			$table->integer('notification_type');
			$table->string('notification_email');
			$table->integer('application_ceiling');
			$table->integer('application_count');
			$table->boolean('recommended')->default(false);
			$table->boolean('displayed')->default(false);
			$table->boolean('activated')->default(false);
			$table->datetime('released')->nullable();
			$table->integer('sort');
			$table->timestamps();
		});
		
		Schema::create('job_metas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->index();
			$table->string('meta_key');
			$table->string('meta_value');
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop('jobs');
		Schema::drop('job_metas');
	}

}
