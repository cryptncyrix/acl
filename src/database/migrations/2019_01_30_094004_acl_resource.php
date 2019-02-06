<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AclResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            // For Example Home / acl.overwiev
            $table->string('name')->unique();
            // F.E. Give default_access acl.overwiev False
            // F.E. Give default_access home True
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
        Schema::drop('resources');
    }
}
