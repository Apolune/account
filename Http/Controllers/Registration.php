<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Account\AccountRegistration;
use Apolune\Core\Http\Controllers\Controller;
use Illuminate\Http\Exception\HttpResponseException;
use Apolune\Account\Http\Requests\Registration\EditRequest;
use Apolune\Account\Http\Requests\Registration\ValidationRequest;
use Apolune\Account\Http\Requests\Registration\VerificationRequest;

class Registration extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The Request implementation.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Holds the custom attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Guard $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;

        $this->middleware('unregistered', [
            'except' => ['edit', 'update'],
        ]);
    }

    /**
     * Show the account registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function registration()
    {
        $countries = countries();

        $years = array_reverse(range((date('Y') - 105), (date('Y') - 5)));

        $format = function ($month) { return (new Carbon)->month($month)->format('F'); };

        return view('theme::account.registration.form', compact('countries', 'years', 'format'));
    }

    /**
     * Validate the provided registration data.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\ValidationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function validation(ValidationRequest $request)
    {
        return redirect('/account/register/verify')->withInput()->with('state', 1);
    }

    /**
     * Show the account registration verification page.
     *
     * @return \Illuminate\Http\Response
     */
    public function verification()
    {
        $this->request->session()->flashInput($input = $this->request->session()->getOldInput());

        if (session('state') !== 1) {
            return redirect('/account/register')->withInput($input);
        }

        $formatted = (new Carbon)->month($input['month'])->format('F');

        return view('theme::account.registration.verify', compact('formatted'));
    }

    /**
     * Validate the provided registration data.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\VerificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(VerificationRequest $request)
    {
        return redirect('/account/register/key')->withInput()->with('state', 2);
    }

    /**
     * Register the account.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        if (session('state') !== 2) {
            return redirect('/account/register');
        }

        $key = $this->auth->user()->generateRecoveryKey();

        $this->auth->user()->registration()->create([
            'firstname' => $this->request->old('firstname'),
            'surname'   => $this->request->old('surname'),
            'country'   => $this->request->old('country'),
            'birthday'  => $this->compileBirthday($this->request->session()->getOldInput()),
            'gender'    => $this->request->old('gender'),
        ]);

        return view('theme::account.registration.register', compact('key'));
    }

    /**
     * Show the edit account registration page.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request)
    {
        $this->auth->user()->registration()->update([
            'requested_firstname' => $this->request->get('firstname'),
            'requested_surname'   => $this->request->get('surname'),
            'requested_country'   => $this->request->get('country'),
        ]);

        // ...
    }

    /**
     * Compile a lone day, a lone month and a lone year into a birth date.
     *
     * @param  array $attributes
     * @return string
     */
    protected function compileBirthday(array $attributes)
    {
        return vsprintf("%d-%d-%d", [
            (new Carbon)->year($attributes['year'])->format('Y'),
            (new Carbon)->month($attributes['month'])->format('m'),
            (new Carbon)->day($attributes['day'])->format('d'),
        ]);
    }
}
