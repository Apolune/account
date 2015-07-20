<?php

namespace Apolune\Account\Http\Controllers;

use Apolune\Core\Http\Controllers\Controller;

class Recovery extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the lost account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme::account.recovery.index');
    }
}
