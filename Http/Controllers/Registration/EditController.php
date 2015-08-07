<?php

namespace Apolune\Account\Http\Controllers\Registration;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Registration\EditRequest;

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
        $countries = countries();

        $years = $this->years();

        return view('theme::account.registration.edit.form', compact('countries', 'years'));
    }

    /**
     * Validate the provided registration data upon editing.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\EditRequest  $request
     * @return \Illuminate\View\View
     */
    public function update(EditRequest $request)
    {
        $this->auth->user()->registration()->update([
            'request_date'      => Carbon::now(),
            'request_firstname' => $request->get('firstname'),
            'request_surname'   => $request->get('surname'),
            'request_country'   => $request->get('country'),
        ]);

        return view('theme::account.registration.edit.requested');
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
