<?php

namespace Apolune\Account\Resources\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PlayerPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = app('player')->doesntHave('properties')->get();

        foreach ($players as $player) {
            $properties = app('player.properties');

            $properties->created_at = Carbon::now();

            $player->properties()->save($properties);
        }
    }
}
