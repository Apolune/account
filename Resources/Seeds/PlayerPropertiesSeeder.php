<?php

namespace Apolune\Account\Resources\Seeds;

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
        $players = app('player')->all();

        foreach ($players as $player) {
            $player->properties()->create([]);
        }
    }
}
