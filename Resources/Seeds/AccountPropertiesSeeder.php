<?php

namespace Apolune\Account\Resources\Seeds;

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
        $accounts = app('account')->all();

        foreach ($accounts as $account) {
            $account->properties()->create([
                'email_code' => str_random(40),
            ]);
        }
    }
}
