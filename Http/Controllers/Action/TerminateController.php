<?php

namespace Apolune\Account\Http\Controllers\Action;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Action\TerminateRequest;

class TerminateController extends Controller
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
     * Show the terminate account page.
     *
     * @return \Illuminate\View\View
     */
    public function confirm()
    {
        return view('theme::account.action.terminate.form');
    }

    /**
     * Terminate the account.
     *
     * @param  \Apolune\Account\Http\Requests\Action\TerminateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function terminate(TerminateRequest $request)
    {
        $account = $this->auth->user();

        $account->properties->deleted = 1;
        $account->properties->save();

        $this->auth->logout();

        return redirect('/account/login');
    }
}
