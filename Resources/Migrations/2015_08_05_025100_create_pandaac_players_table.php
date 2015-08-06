<?php

namespace Apolune\Account\Resources\Migrations;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Apolune\Core\Facades\Database\Trigger;
use Illuminate\Database\Migrations\Migration;

class CreatePandaacPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__pandaac_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->timestamp('deletion')->nullable();
            $table->boolean('hide')->default(false);
            $table->string('comment', 500)->nullabe();
            $table->string('signature', 500)->nullabe();

            $table->timestamps();
        });

        Trigger::after('insert')->on('players')->create(function ($query) {
            $query->table('__pandaac_players')->insert([
                'player_id' => DB::raw('NEW.`id`')
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Trigger::after('insert')->on('players')->rollback();

        Schema::drop('__pandaac_players');
    }
}
