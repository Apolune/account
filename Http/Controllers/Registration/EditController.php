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
        $account = $this->auth->user();

        $countries = countries();

        $years = array_reverse(range((date('Y') - 105), (date('Y') - 5)));

        $format = function ($month) { return (new Carbon)->month($month)->format('F'); };

        return view('theme::account.registration.edit', compact('account', 'countries', 'years', 'format'));
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
            'requested_firstname' => $request->get('firstname'),
            'requested_surname'   => $request->get('surname'),
            'requested_country'   => $request->get('country'),
        ]);

        // ...
        dd('test');
    }
}
