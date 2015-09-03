<?php

namespace Apolune\Account\Jobs\Registration;

use App\Jobs\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Registration\Created;

class Create extends Job implements SelfHandling
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
     * @return string|null
     */
    public function handle(Request $request)
    {
        $key = $this->account->generateRecoveryKey();

        $registration = app('account.registration');

        $registration->account_id   = $this->account->id();
        $registration->firstname    = $request->old('firstname');
        $registration->surname      = $request->old('surname');
        $registration->country      = $request->old('country');
        $registration->gender       = $request->old('gender');
        $registration->birthday     = $this->birthday($request);

        $registration->save();

        event(new Created($this->account));

        return $key;
    }

    /**
     * Compile the birthday.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function birthday(Request $request)
    {
        list($year, $month, $day) = array_values($request->only('year', 'month', 'day'));

        return (new Carbon)->year($year)->month($month)->day($day)->format('Y-m-d');
    }
}
