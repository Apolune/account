<?php namespace Apolune\Account\Models\Traits;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = '__pandaac_accounts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['remember_token'];

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @param  string  $column
	 * @return string
	 */
	public function getRememberToken($column)
	{
		return $this->{$column};
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $column
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($column, $value)
	{
		$this->{$column} = $value;

		$this->save();
	}

}
