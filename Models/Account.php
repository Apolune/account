<?php namespace Apolune\Account\Models;

use Apolune\Core\Contracts\Account as AccountContract;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Account extends Model implements AccountContract, AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Retrieve the user's traits.
	 *
	 * @return \Apolune\Account\Models\Traits\Account
	 */
	final public function traits()
	{
		return $this->hasOne('\Apolune\Account\Models\Traits\Account');
	}

	/**
	 * Retrieve the account name.
	 *
	 * @return string
	 */
	public function name()
	{
		return strtoupper($this->name);
	}

	/**
	 * Retrieve the account email.
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->email;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		if ( ! $this->traits) return null;

		return $this->traits->getRememberToken($this->getRememberTokenName());
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		if ( ! $this->traits) return;

		$this->traits->setRememberToken($this->getRememberTokenName(), $value);
	}

}
