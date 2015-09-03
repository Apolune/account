<?php

namespace Apolune\Account\Http\Controllers\Registration;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Jobs\Registration\Create;
use Apolune\Account\Http\Requests\Registration\CreateRequest;
use Apolune\Account\Http\Requests\Registration\ConfirmationRequest;

class CreateController extends Controller
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

        $this->middleware('unregistered');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        $countries = countries();

        $years = $this->years();

        return view('theme::account.registration.create.form', compact('countries', 'years'));
    }

    /**
     * Show the account registration verification page.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\ConfirmationRequest  $request
     * @return \Illuminate\View\View
     */
    public function confirm(ConfirmationRequest $request)
    {
        $request->isMethod('POST') ? $request->flash() : $request->session()->keep('_old_input');

        return view('theme::account.registration.create.confirm');
    }

    /**
     * Register the account.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\CreateRequest  $request
     * @return \Illuminate\View\View
     */
    public function register(CreateRequest $request)
    {
        $key = $this->dispatch(
            new Create($this->auth->user())
        );

        return view('theme::account.registration.create.registered', compact('key'));
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
