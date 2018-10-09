<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('is_api');
            $table->integer('transaction_id')->unsigned();
            $table->string('gateway_id');
            $table->string('payment_type');
            $table->string('payment_reference');
            $table->mediumtext('payment_description');
            $table->dateTime('insert_date');
            $table->dateTime('updated_date');
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
        Schema::dropIfExists('payment_logs');
    }
}
