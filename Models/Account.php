<?php

namespace Apolune\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Apolune\Core\Traits\Authenticatable;
use Apolune\Contracts\Account\Account as AccountContract;

class Account extends Model implements AccountContract
{
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
     * Retrieve the account properties.
     *
     * @return \Apolune\Contracts\Account\Properties\Account
     */
    public function properties()
    {
        return $this->hasOne('Apolune\Account\Models\Properties\Account');
    }

    /**
     * Retrieve the account players.
     *
     * @return \Apolune\Contracts\Account\Player
     */
    public function players()
    {
        return $this->hasMany('Apolune\Account\Models\Player');
    }

    /**
     * Retrieve the account id.
     *
     * @return integer
     */
    public function id()
    {
        return $this->id;
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
