<?php

namespace Apolune\Account\Http\Controllers\Action;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Action\RenameRequest;

class RenameController extends Controller
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

        $this->middleware('auth');
    }

    /**
     * Show the rename account page.
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        $account = $this->auth->user();
        
        return view('theme::account.action.rename.form', compact('account'));
    }

    /**
     * Change the account name.
     *
     * @param  \Apolune\Account\Http\Requests\Action\RenameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RenameRequest $request)
    {
        $account = $this->auth->user();

        $account->name = $request->get('name');
        $account->save();

        return redirect('/account');
    }
}
