<?php namespace Apolune\Account\Models;

use Apolune\Core\Traits\Authenticatable;
use Apolune\Contracts\Account\Account as AccountContract;

use Illuminate\Database\Eloquent\Model;

class Account extends Model implements AccountContract {

	use Authenticatable;

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
	 * @return \Apolune\Contracts\Account\Traits\Account
	 */
	public function traits()
	{
		return $this->hasOne('Apolune\Account\Models\Traits\Account');
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

}
