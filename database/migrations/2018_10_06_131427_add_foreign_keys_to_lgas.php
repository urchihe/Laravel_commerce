<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToLgas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
     Schema::table('lgas', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });   
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('lgas', function (Blueprint $table) {
        $table->dropForeign(['country_id']);
        $table->dropForeign(['state_id']);
    });
    
    }
}
