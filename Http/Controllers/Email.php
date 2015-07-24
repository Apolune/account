<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\EmailRequest;
use Apolune\Account\Events\RequestVerificationEmail;

class Email extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth', [
            'except' => 'confirm',
        ]);
    }

    /**
     * Show the change email page.
     *
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        $account = $this->auth->user();

        if ($account->hasPendingEmail()) {
            $account->load('properties');
            
            return view('theme::account.email.awaiting', compact('account'));
        }

        return view('theme::account.email.form');
    }

    /**
     * Show the confirm email page.
     *
     * @param  string  $email
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function confirm($email, $code)
    {
        $email = base64_decode($email);

        $account = app('account')
            ->with('properties')
            ->where('email', $email)
            ->whereHas('properties', function ($query) use ($code) {
                $query->where('email_code', $code);
            })->first();

        if (! $account) {
            return redirect('/account');
        }

        $account->properties->email_code = null;
        $account->properties->save();

        return view('theme::account.email.confirm', compact('account'));
    }

    /**
     * Show the re-request confirmation email page.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        $account = $this->auth->user();

        $account->load('properties');

        if (! config('pandaac.mail.confirmation') or $account->properties->emailRequests() >= 2) {
            return redirect('/account');
        }

        $account->properties->email_requests += 1;
        $account->properties->save();

        event(new RequestVerificationEmail($account));

        return view('theme::account.email.request', compact('account'));
    }

    /**
     * Show the change email page.
     *
     * @param  \Apolune\Account\Http\Requests\EmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(EmailRequest $request)
    {
        $account = $this->auth->user();
        
        $account->properties->email = $request->get('email');
        $account->properties->email_date = Carbon::now();
        $account->properties->save();

        return view('theme::account.email.update', compact('account'));
    }

    /**
     * Show the cancel email page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelEmail()
    {
        $account = $this->auth->user();

        $account->properties->email = null;
        $account->properties->email_date = null;
        $account->properties->save();

        return view('theme::account.email.cancelled');
    }
}
