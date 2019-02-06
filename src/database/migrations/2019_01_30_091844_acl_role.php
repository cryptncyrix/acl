<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AclRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            // For Example Admin / Guest
            $table->string('name')->unique();
            // F.E. Give default_access Admin True
            // F.E. Give default_access Guest False
            $table->boolean('default_access');
            // Short Description
            $table->string('info');
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
        Schema::drop('roles');
    }
}
