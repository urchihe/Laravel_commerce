<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersLogTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers_log_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recipient_email');
            $table->string('recipient_name');
            $table->string('gateway');
            $table->string('transcode');
            $table->decimal('amount',25,2);
            $table->decimal('transfer_fee',10,2);
            $table->string('currency');
            $table->dateTime('transfer_date');
            $table->text('description');
            $table->string('bank_code');
            $table->string('bank_name');
            $table->string('transfer_status');
            $table->string('accountno');
            $table->string('accountname');
            $table->mediumtext('complete_message');
            $table->tinyinteger('requires_approval')->default(0);;
            $table->tinyinteger('is_approved')->default(0);;
            $table->string('approver');
            $table->integer('transfer_id')->default(0);;
            $table->integer('batch_id');
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
        Schema::dropIfExists('transfers_log_tests');
    }
}
