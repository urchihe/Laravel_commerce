<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_id')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('lga_id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('businessname')->nullable();
            $table->boolean('is_registered')->default(false);
            $table->boolean('is_anonymous')->default(false);
            $table->string('api_token',60)->uniqid();
            $table->string('recipient_code')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('password');
            $table->boolean('acccountstatus')->default(false);
            $table->boolean('allownopwd')->default(false);
            $table->string('address')->nullable();
            $table->string('username')->nullable();
            $table->string('bio_url')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        
    }
}
