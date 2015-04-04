<?php namespace Apolune\Account\Http\Controllers;

use Apolune\Core\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

class AccountController extends Controller {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new authentication controller instance.
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
	 * Show the account landing page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getIndex()
	{
		return view('theme::account.index');
	}

}
