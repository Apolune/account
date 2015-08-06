<?php

namespace Apolune\Account\Http\Controllers\Registration;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Registration\ValidationRequest;
use Apolune\Account\Http\Requests\Registration\VerificationRequest;

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

        $format = function ($month) { return (new Carbon)->month($month)->format('F'); };

        return view('theme::account.registration.form', compact('countries', 'years', 'format'));
    }

    /**
     * Show the account registration verification page.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\ValidationRequest  $request
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function confirm()
    {
        $request = new Request;

        dd($request->method());
        
        if ($request->method() === 'POST') {
            $request->flash();

            $request = new ValidationRequest;
        }

        if ($request->method() === 'GET') {
            dd($request->all());
        }

        $formatted = (new Carbon)->month($request->get('month'))->format('F');

        return view('theme::account.registration.verify', compact('formatted'));
    }

    /**
     * Register the account.
     *
     * @param  \Apolune\Account\Http\Requests\Registration\VerificationRequest  $request
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function register(VerificationRequest $request)
    {
        $key = $this->auth->user()->generateRecoveryKey();

        $this->auth->user()->registration()->create([
            'firstname' => $request->old('firstname'),
            'surname'   => $request->old('surname'),
            'country'   => $request->old('country'),
            'gender'    => $request->old('gender'),
            'birthday'  => $this->birthday($request),
        ]);

        return view('theme::account.registration.register', compact('key'));
    }

    /**
     * Compile the birthday.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function birthday(Request $request)
    {
        list($year, $month, $day) = $request->only('year', 'month', 'day');

        return (new Carbon)->year($year)->month($month)->day($day)->format('Y-m-d');
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
