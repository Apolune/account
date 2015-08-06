<?php

namespace Apolune\Account\Http\Controllers\Email;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\EmailRequest;
use Apolune\Account\Events\RequestVerificationEmail;

class RequestController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth');
    }

    /**
     * Show the re-request confirmation email page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\Response
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

        return view('theme::account.email.request.request', compact('account'));
    }

    /**
     * Show the confirm email page.
     *
     * @param  string  $email
     * @param  string  $code
     * @return \Illuminate\View\View|\Illuminate\Http\Response
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

        return view('theme::account.email.request.confirm', compact('account'));
    }
}
