<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendedDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extended_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('posted_at');
            $table->integer('transaction_id')->unsigned();
            $table->date('started_at');
            $table->date('old_fulfilled_at');
            $table->date('new_fulfilled_at');
            $table->dateTime('extended_at');
            $table->text('reasons');
            $table->string('request_status');
            $table->string('requester');
            $table->string('reject_reason');
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
        Schema::dropIfExists('extended_dates');
    }
}
