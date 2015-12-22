<?php

namespace Apolune\Account\Jobs\Auth;

use App\Jobs\Job;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Auth\Created;

class Create extends Job
{
    /**
     * Execute the job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle(Request $request)
    {
        $account = app('account');

        $account->name      = $request->get('name');
        $account->email     = $request->get('email');
        $account->password  = bcrypt($request->get('password'));
        $account->creation  = time();

        $account->save();
        $account->properties->setEmailCode();

        event(new Created($account));

        return $account;
    }
}
