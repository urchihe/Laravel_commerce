<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginfos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('loginDate');
            $table->string('name');
            $table->string('activity');
            $table->dateTime('actiondate');
            $table->string('username');
            $table->string('countryname');
            $table->dateTime('logoutdate');
            $table->string('operation');
            $table->string('logID');
            $table->string('remote_ip');
            $table->string('remote_host');
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
        Schema::dropIfExists('loginfos');
    }
}
