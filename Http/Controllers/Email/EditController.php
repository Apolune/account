<?php

namespace Apolune\Account\Http\Controllers\Email;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Email\EditRequest;
use Apolune\Account\Events\RequestVerificationEmail;

class EditController extends Controller
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
     * Show the change email form.
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        $account = $this->auth->user();

        if ($account->hasPendingEmail()) {
            $account->load('properties');
            
            return view('theme::account.email.edit.awaiting', compact('account'));
        }

        return view('theme::account.email.edit.form', compact('account'));
    }

    /**
     * Change the email.
     *
     * @param  \Apolune\Account\Http\Requests\Email\EditRequest  $request
     * @return \Illuminate\View\View
     */
    public function edit(EditRequest $request)
    {
        $account = $this->auth->user();
        
        if ($account->isConfirmed()) {
            $account->properties->email = $request->get('email');
            $account->properties->email_date = Carbon::now();
            $account->properties->save();
        } else {
            $account->email = $request->get('email');
            $account->save();

            event(new RequestVerificationEmail($account));
        }

        return view('theme::account.email.edit.edited', compact('account'));
    }

    /**
     * Cancel the active email change.
     *
     * @return \Illuminate\View\View
     */
    public function cancel()
    {
        $account = $this->auth->user();

        $account->properties->email = null;
        $account->properties->email_date = null;
        $account->properties->save();

        return view('theme::account.email.edit.cancelled');
    }
}
