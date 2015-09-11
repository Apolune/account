<?php

namespace Apolune\Account\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;

class DashboardController extends Controller
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

        $this->middleware('auth', ['except' => 'download']);
    }

    /**
     * Show the account overview page.
     *
     * @return \Illuminate\View\View
     */
    public function overview()
    {
        $account = $this->auth->user();

        $account->load('properties', 'registration', 'players.properties');

        return view('theme::account.overview', compact('account'));
    }

    /**
     * Show the account management page.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $account = $this->auth->user();

        $account->load('properties', 'registration');

        return view('theme::account.manage', compact('account'));
    }

    /**
     * Show the download client page.
     *
     * @return \Illuminate\View\View
     */
    public function download()
    {
        return view('theme::account.download');
    }
}
