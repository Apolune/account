<?php

namespace Apolune\Account\Http\Controllers\Registration;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Account\Jobs\Registration\Edit;
use Apolune\Account\Jobs\Registration\Accept;
use Apolune\Account\Jobs\Registration\Cancel;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Registration\EditRequest;
use Apolune\Account\Http\Requests\Registration\AcceptRequest;
use Apolune\Account\Http\Requests\Registration\CancelRequest;

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

        $this->middleware('registered');
    }

    /**
     * Show the edit account registration page.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $account = $this->auth->user();

        if ($account->canAcceptPendingRegistration()) {
            return view('theme::account.registration.edit.accept', compact('account'));
        } elseif ($account->hasPendingRegistration()) {
            return view('theme::account.registration.edit.request', compact('account'));
        }

        $countries = countries();
        $years = $this->years();

        return view('theme::account.registration.edit.form', compact('account', 'countries', 'years'));
    }

    /**
     * Validate the provided registration data upon editing.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\EditRequest  $request
     * @return \Illuminate\View\View
     */
    public function update(EditRequest $request)
    {
        $this->dispatch(
            new Edit($this->auth->user())
        );

        return view('theme::account.registration.edit.requested');
    }

    /**
     * Accept the new registration data.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\AcceptRequest  $request
     * @return \Illuminate\View\View
     */
    public function accept(AcceptRequest $request)
    {
        $this->dispatch(
            new Accept($this->auth->user())
        );

        return view('theme::account.registration.edit.accepted');
    }

    /**
     * Cancel the new registration data.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\CancelRequest  $request
     * @return \Illuminate\View\View
     */
    public function cancel(CancelRequest $request)
    {
        $this->dispatch(
            new Cancel($this->auth->user())
        );

        return view('theme::account.registration.edit.cancelled');
    }

    /**
     * Compile an array of years.
     *
     * @param  integer  $amount  100
     * @return array
     */
    protected function years($amount = 100)
    {
        $start = (date('Y') - ($amount + 5));
        $end   = (date('Y') - 5);

        return array_reverse(range($start, $end));
    }
}
