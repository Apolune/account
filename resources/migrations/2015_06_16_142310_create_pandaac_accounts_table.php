<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePandaacAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__pandaac_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->string('email', 100)->nullable();
            $table->timestamp('email_date')->nullable();
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
        Schema::drop('__pandaac_accounts');
    }
}
