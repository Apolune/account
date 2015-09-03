<?php

namespace Apolune\Account\Jobs\Email;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Email\RequestAccepted;

class AcceptRequest extends Job implements SelfHandling
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
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle()
    {
        $password = str_random(rand(8, 10));

        $this->account->email = $this->account->properties->email();
        $this->account->password = bcrypt($password);
        
        $this->account->properties->email = null;
        $this->account->properties->email_date = null;

        $this->account->push();

        event(new RequestAccepted($this->account, $password));

        return $this->account;
    }
}
