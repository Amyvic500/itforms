<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('fName');
			$table->string('lName');
			$table->string('comp');
			$table->string('loc');
			$table->string('dept')->nullable();
			$table->string('post')->nullable();
			$table->string('status');
			$table->string('curr');
			$table->string('notes');
			$table->string('hod');			
			$table->string('sir')->nullable();
			$table->string('email')->nullable();
			$table->string('net')->nullable();		
			$table->string('hrms')->nullable();
			$table->string('sap')->nullable();
			$table->string('remote')->nullable();			
			$table->string('ingress')->nullable();	
			$table->string('spark')->nullable();
			$table->string('eLeave')->nullable();
			$table->string('eApp1')->nullable();
			$table->string('eApp2')->nullable();			
			$table->string('eApp3')->nullable();
			$table->string('eApp4')->nullable();
			$table->string('eApp5')->nullable();			
			$table->string('eApp6')->nullable();
			$table->string('eApp7')->nullable();			
			$table->string('existed')->nullable();
			$table->string('repFormat')->nullable();			
			$table->string('selApp')->nullable();
			$table->string('selFile')->nullable();			
			$table->smallInteger('apprStatus')->nullable();
			$table->smallInteger('changeStat')->nullable();			
			$table->string('approval')->nullable();
			$table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
