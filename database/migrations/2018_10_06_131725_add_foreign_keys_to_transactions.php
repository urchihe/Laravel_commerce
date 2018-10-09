<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
     Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });   
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('transactions', function (Blueprint $table) {
        $table->dropForeign(['seller_id']);
        $table->dropForeign(['buyer_id']);
        $table->dropForeign(['country_id']);
        $table->dropForeign(['currency_id']);
       });     
    
    }
}
