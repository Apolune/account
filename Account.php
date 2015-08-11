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
     * @var boolean
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
     * Retrieve the account registration.
     *
     * @return \Apolune\Contracts\Account\AccountRegistration
     */
    public function registration()
    {
        return $this->hasOne('account.registration');
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
     * Check if the account has been confirmed.
     *
     * @return boolean
     */
    public function isConfirmed()
    {
        return config('pandaac.mail.enabled') and config('pandaac.mail.confirmation') and $this->properties->emailCode() === null;
    }

    /**
     * Check if the account has been registered.
     *
     * @return boolean
     */
    public function isRegistered()
    {
        return (boolean) $this->registration;
    }

    /**
     * Check if the account has been deleted.
     *
     * @return boolean
     */
    public function isDeleted()
    {
        return (boolean) $this->properties->deletion();
    }

   /**
     * Check if the account has a pending email address.
     *
     * @return boolean
     */
    public function hasPendingEmail()
    {
        return config('pandaac.mail.enabled') and $this->properties->email() !== null;
    }

    /**
     * Generate a recovery key.
     *
     * @param  boolean  $pretend  false
     * @return string
     */
    public function generateRecoveryKey($pretend = false)
    {
        $key = strtoupper(implode('-', str_split(str_random(20), 5)));

        if (! $pretend) {
            $this->properties->recovery_key = bcrypt($key);
            $this->properties->save();
        }

        return $key;
    }
}
