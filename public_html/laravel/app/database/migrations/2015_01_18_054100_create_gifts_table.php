<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gifts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id');
			$table->integer('user_id')->nullable();
			$table->string('shipping_name');
            $table->string('shipping_address');
            $table->string('email');
			$table->date('interview_date');
			$table->text('memo');
			$table->boolean('check_flag');
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
		Schema::drop('gifts');
	}

}
