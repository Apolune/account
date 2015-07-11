<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\EmailRequest;

class EmailController extends Controller
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

        $this->middleware('auth');
    }

    /**
     * Show the change email page.
     *
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        $account = $this->auth->user();

        if ($account->isAwaitingEmailChange()) {
            return view('theme::account.email.awaiting');
        }

        return view('theme::account.email.form');
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

        $credentials = [
            'name'         => $account->name(),
            'password'     => $request->get('password'),
        ];

        if (! $this->auth->validate($credentials)) {
            throw new HttpResponseException($request->response([
                'current' => trans('theme::account.email.form.error'),
            ]));
        }

        $account->properties->email = $request->get('email');
        $account->properties->email_date = Carbon::now();
        $account->properties->save();

        return view('theme::account.email.request', compact('account'));
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