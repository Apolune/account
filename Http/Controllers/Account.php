<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Account\AccountRegistration;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\RenameRequest;
use Apolune\Account\Http\Requests\PasswordRequest;
use Apolune\Account\Http\Requests\RegisterRequest;
use Apolune\Account\Http\Requests\TerminateRequest;

class Account extends Controller
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
     * Show the account overview page.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        return view('theme::account.overview');
    }

    /**
     * Show the account management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('theme::account.manage');
    }

    /**
     * Show the change password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('theme::account.password');
    }

    /**
     * Process changing the password.
     *
     * @param  \Apolune\Account\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(PasswordRequest $request)
    {
        $account = $this->auth->user();

        $account->password = bcrypt($request->get('password'));
        $account->save();

        return redirect('/account');
    }

    /**
     * Show the rename account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function rename()
    {
        return view('theme::account.rename');
    }

    /**
     * Show the rename account page.
     *
     * @param  \Apolune\Account\Http\Requests\RenameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateName(RenameRequest $request)
    {
        $account = $this->auth->user();

        $account->name = $request->get('name');
        $account->save();

        return redirect('/account');
    }

    /**
     * Show the terminate account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terminate()
    {
        return view('theme::account.terminate');
    }

    /**
     * Terminate the account.
     *
     * @param  \Apolune\Account\Http\Requests\TerminateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(TerminateRequest $request)
    {
        $account = $this->auth->user();

        $account->properties->deleted = 1;
        $account->properties->save();

        $this->auth->logout();

        return redirect('/account/login');
    }
}
