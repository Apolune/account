<?php

namespace Apolune\Account\Jobs\Email;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Email\AccountConfirmed;

class ConfirmAccount extends Job
{
    /**
     * Holds the email.
     *
     * @var string
     */
    protected $email;

    /**
     * Holds the code.
     *
     * @var string
     */
    protected $code;

    /**
     * Create a new job instance.
     *
     * @param  string  $email
     * @param  string  $code
     * @return void
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle()
    {
        list($email, $code) = [base64_decode($this->email), $this->code];

        $account = app('account')
            ->with('properties')
            ->where('email', $email)
            ->whereHas('properties', function ($query) use ($code) {
                $query->where('email_code', $code);
            })->first();

        if (! $account) {
            return null;
        }

        $account->properties->email_code = null;
        $account->properties->save();

        event(new AccountConfirmed($account));

        return $account;
    }
}
