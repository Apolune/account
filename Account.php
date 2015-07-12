<?php

namespace Apolune\Account;

use Carbon\Carbon;
use Apolune\Core\Traits\Authenticatable;
use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\Account as Contract;

class Account extends Model implements Contract
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
     * @return \Apolune\Contracts\Account\AccountProperties
     */
    public function properties()
    {
        return $this->hasOne('account.properties');
    }

    /**
     * Retrieve the account players.
     *
     * @return \Apolune\Contracts\Account\Player
     */
    public function players()
    {
        return $this->hasMany('player');
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

    /**
     * Retrieve the account type.
     *
     * @return integer
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Retrieve the account premium days.
     *
     * @return integer
     */
    public function premiumDays()
    {
        return $this->premdays;
    }

    /**
     * Retrieve the account last day.
     *
     * @return integer
     */
    public function lastDay()
    {
        return $this->lastday;
    }

    /**
     * Retrieve the account creation date.
     *
     * @return integer
     */
    public function creation()
    {
        return $this->creation;
    }

    /**
     * Check if the account is currently awaiting an email change.
     *
     * @return boolean
     */
    public function isAwaitingEmailChange()
    {
        return config('pandaac.mail.enabled') and $this->emailChange() !== null;
    }

    /**
     * Get the requested email address.
     *
     * @return string
     */
    public function emailChange()
    {
        return $this->properties->email;
    }

    /**
     * Get the date of when the requested email address change goes through.
     *
     * @return string
     */
    public function emailChangeDate()
    {
        $days = config('pandaac.mail.timers.email-change');

        return (new Carbon($this->properties->email_date))->addDays($days);
    }
}
