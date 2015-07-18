<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Account\AccountRegistration;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Registration\VerificationRequest;
use Apolune\Account\Http\Requests\Registration\ValidationRequest;

class RegistrationController extends Controller
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

        $this->middleware('auth');
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
        $this->request->session()->flashInput(
            $input = $this->request->session()->getOldInput()
        );

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
        $this->request->session()->flashInput(
            $input = $this->request->session()->getOldInput()
        );

        if (session('state') !== 2) {
            return redirect('/account/register');
        }

        $birthday = vsprintf("%d-%d-%d", [
            (new Carbon)->year($this->request->old('year'))->format('Y'),
            (new Carbon)->month($this->request->old('month'))->format('m'),
            (new Carbon)->day($this->request->old('day'))->format('d'),
        ]);

        $key = strtoupper(implode('-', str_split(str_random(20), 5)));

        $properties = account()->properties;
        $properties->recovery_key = bcrypt($key);
        $properties->save();

        account()->registration()->create([
            'firstname' => $this->request->old('firstname'),
            'surname'   => $this->request->old('surname'),
            'country'   => $this->request->old('country'),
            'birthday'  => $birthday,
            'gender'    => $this->request->old('gender'),
        ]);

        return view('theme::account.registration.register', compact('key'));
    }
}
