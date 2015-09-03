<?php

namespace Apolune\Account\Jobs\Action;

use App\Jobs\Job;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Action\RenamedAccount;

class RenameAccount extends Job implements SelfHandling
{
    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    protected $account;

    /**
     * Create a new job instance.
     *
     * @param  \Apolune\Contracts\Account\Account  $account
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle(Request $request)
    {
        $this->account->name = $request->get('name');
        $this->account->save();

        event(new RenamedAccount($this->account));

        return $this->account;
    }
}
