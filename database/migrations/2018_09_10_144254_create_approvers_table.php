<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
			$table->string('dept');
			$table->string('email');
			$table->string('company');
			$table->Integer('role')->nullable();
			$table->string('location');			
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
        Schema::dropIfExists('approvers');
    }
}
