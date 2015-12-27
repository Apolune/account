<?php

namespace Apolune\Account\Http\Controllers\Email;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Jobs\Email\ConfirmAccount;
use Apolune\Account\Http\Requests\EmailRequest;
use Apolune\Account\Jobs\Email\RequestVerificationCode;

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
    }

    /**
     * Show the re-request confirmation email page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function request()
    {
        $account = $this->dispatch(
            new RequestVerificationCode($this->auth->user())
        );

        if (! $account) {
            return redirect('/account');
        }

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
        $account = $this->dispatch(
            new ConfirmAccount($email, $code)
        );

        if (! $account) {
            return redirect('/account');
        }

        return view('theme::account.email.request.confirm', compact('account'));
    }
}
