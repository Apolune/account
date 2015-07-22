<?php

namespace Apolune\Account\Resources\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePandaacRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countries = server()->countries();

        Schema::create('__pandaac_registration', function (Blueprint $table) use ($countries) {
            $table->increments('id');
            $table->integer('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->string('firstname', 50);
            $table->string('surname', 50);
            $table->enum('country', $countries->keys()->toArray());
            $table->date('birthday')->default('0000-00-00');
            $table->enum('gender', ['female', 'male']);
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
        Schema::drop('__pandaac_registration');
    }
}
