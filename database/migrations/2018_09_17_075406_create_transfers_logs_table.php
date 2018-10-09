<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',25,2);
            $table->integer('transaction_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->decimal('transfer_fee',10,2);
            $table->dateTime('transfered_at');
            $table->string('transfer_status');
            $table->mediumtext('complete_message');
            $table->tinyinteger('requires_approval')->default(0);
            $table->tinyinteger('is_approved')->default(0);
            $table->string('approver');
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
        Schema::dropIfExists('transfers_logs');
    }
}
