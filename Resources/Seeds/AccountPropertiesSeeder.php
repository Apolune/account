<?php

namespace Apolune\Account\Resources\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AccountPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = app('account')->doesntHave('properties')->get();

        foreach ($accounts as $account) {
            $properties = app('account.properties');

            $properties->email_code = str_random(40);
            $properties->created_at = Carbon::now();

            $account->properties()->save($properties);
        }
    }
}
