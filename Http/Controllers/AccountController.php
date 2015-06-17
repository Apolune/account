<?php

namespace Apolune\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\EmailRequest;
use Apolune\Account\Http\Requests\PasswordRequest;
use Illuminate\Http\Exception\HttpResponseException;

class AccountController extends Controller
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
     * Show the account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme::account.index');
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

        $credentials = [
            'name'         => $account->name(),
            'password'     => $request->get('current'),
        ];

        if (! $this->auth->validate($credentials)) {
            throw new HttpResponseException($request->response([
                'current' => trans('theme::account.password.form.error'),
            ]));
        }

        $account->password = bcrypt($request->get('password'));
        $account->save();

        return redirect('/account')->with('success', trans('theme::account.password.form.success'));
    }

    /**
     * Show the change email page.
     *
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        return view('theme::account.email');
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

        return redirect('/account')->with('success', trans('theme::account.email.form.success'));
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
     * @return \Illuminate\Http\Response
     */
    public function updateName()
    {
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
     * Show the terminate account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    }
}
