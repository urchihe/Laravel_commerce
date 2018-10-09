<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaystackBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paystack_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('longcode');
            $table->string('transcode');
            $table->string('gateway');
            $table->tinyinteger('pay_with_bank');
            $table->tinyinteger('Active');
            $table->tinyinteger('is_deleted');
            $table->dateTime('createdAt');
            $table->dateTime('updatedAt');
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
        Schema::dropIfExists('paystack_banks');
    }
}
