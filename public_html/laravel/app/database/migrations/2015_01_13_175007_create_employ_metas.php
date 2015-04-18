<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployMetas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employer_metas', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->date('foundation_date');
		    $table->string('representative');
		    $table->integer('capital_stock');
		    $table->string('employees');
		    $table->string('business_content');
		    $table->string('zip_code_1');
		    $table->string('zip_code_2');
		    $table->string('prefecture_id');
		    $table->string('city_id');
		    $table->string('other_address');
		    $table->string('building');
		    $table->string('pic_department')->nullable();
		    $table->string('pic_name')->nullable();
		    $table->string('tel')->nullable();
		    $table->string('fax')->nullable();
		    $table->integer('image_file_id');
		    $table->string('raw_password');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employer_metas');
	}

}
