<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToExtendedDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
     Schema::table('extended_dates', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });   
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('extended_dates', function (Blueprint $table) {
        $table->dropForeign(['transaction_id']);
    });
    
    }
}
