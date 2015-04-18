<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyGiftRemarks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('gifts', function($table)
        {   
            $table->text('remarks');
        }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('gifts', function($table)                                                                                                                                      
        {   
            $table->dropColumn('remarks');
        }); 
	}

}
