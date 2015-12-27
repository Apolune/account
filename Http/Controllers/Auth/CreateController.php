<?php

namespace Apolune\Account\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Auth\CreateRequest;
use Apolune\Account\Jobs\Auth\Create as CreateAccount;
use Apolune\Account\Jobs\Player\Create as CreatePlayer;

class CreateController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var Guard
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
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        return view('theme::account.auth.create');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Apolune\Account\Http\Requests\Account\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request)
    {
        $account = $this->dispatch(
            new CreateAccount
        );

        $player = $this->dispatch(
            new CreatePlayer($account)
        );

        $this->auth->login($account);

        return redirect('/account');
    }
}
