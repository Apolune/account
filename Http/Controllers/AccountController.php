<?php namespace Apolune\Account\Http\Controllers;

use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\PasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Exception\HttpResponseException;

class AccountController extends Controller {

	/**
	 * The Guard implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Guard
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
	 * Show the account page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getIndex()
	{
		return view('theme::account.index');
	}

	/**
	 * Show the account management page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getManage()
	{
		return view('theme::account.manage');
	}

	/**
	 * Show the change password page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getPassword()
	{
		return view('theme::account.password');
	}

	/**
	 * Process changing the password.
	 *
	 * @param  \Apolune\Account\Http\Requests\PasswordRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function putPassword(PasswordRequest $request)
	{
		$account = $this->auth->user();

		$credentials = [
			'name'		 => $account->name(),
			'password'	 => $request->get('current'),
		];

		if ( ! $this->auth->validate($credentials))
		{
			throw new HttpResponseException($request->response([
				'current' => trans('theme::account.password.form.error'),
			]));
		}

		$account->password = bcrypt($request->get('password'));
		$account->save();

		return redirect('/account')->with('success', trans('theme::account.password.form.success'));
	}

	/**
	 * Show the change email page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getEmail()
	{
		return view('theme::account.email');
	}

	/**
	 * Show the change email page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function putEmail()
	{
		
	}

	/**
	 * Show the rename account page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRename()
	{
		return view('theme::account.rename');
	}

	/**
	 * Show the rename account page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function putRename()
	{
		
	}

	/**
	 * Show the terminate account page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getTerminate()
	{
		return view('theme::account.terminate');
	}

	/**
	 * Show the terminate account page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function deleteTerminate()
	{
		
	}

}
