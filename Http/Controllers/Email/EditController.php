<?php

namespace Apolune\Account\Http\Controllers\Email;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Jobs\Email\ChangeRequest;
use Apolune\Account\Http\Requests\Email\EditRequest;
use Apolune\Account\Http\Requests\Email\CancelRequest;
use Apolune\Account\Http\Requests\Email\AcceptRequest;
use Apolune\Account\Jobs\Email\UpdateUnconfirmedAccount;
use Apolune\Account\Jobs\Email\AcceptRequest as AcceptEmailRequest;
use Apolune\Account\Jobs\Email\CancelRequest as CancelEmailRequest;

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
        $account->load('properties');

        if ($account->canAcceptPendingEmail()) {
            return view('theme::account.email.edit.accept', compact('account'));
        } elseif ($account->hasPendingEmail()) {
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

        $this->dispatch(
            $account->isConfirmed() 
                ? new ChangeRequest($account) 
                : new UpdateUnconfirmedAccount($account)
        );

        return view('theme::account.email.edit.edited', compact('account'));
    }

    /**
     * Accept the new email address.
     *
     * @param  \Apolune\Account\Http\Requests\Email\AcceptRequest  $request
     * @return \Illuminate\View\View
     */
    public function accept(AcceptRequest $request)
    {
        $this->dispatch(
            new AcceptEmailRequest($this->auth->user())
        );

        return view('theme::account.email.edit.accepted');
    }

    /**
     * Cancel the active email change.
     *
     * @param  \Apolune\Account\Http\Requests\Email\CancelRequest  $request
     * @return \Illuminate\View\View
     */
    public function cancel(CancelRequest $request)
    {
        $this->dispatch(
            new CancelEmailRequest($this->auth->user())
        );

        return view('theme::account.email.edit.cancelled');
    }
}
