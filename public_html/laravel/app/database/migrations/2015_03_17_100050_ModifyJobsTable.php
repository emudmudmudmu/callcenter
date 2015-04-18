<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyJobsTable extends Migration {

    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('jobs', function($table)
        {   
            $table->string('other_address2', 255);
        }); 
    }   

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('jobs', function($table)                                                                                                                                      
        {   
            $table->dropColumn('other_address2');
        }); 

    } 

}
