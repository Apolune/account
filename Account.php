<?php

namespace Apolune\Account;

use Carbon\Carbon;
use Apolune\Core\Traits\Authenticatable;
use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\Account as Contract;
use Apolune\Account\Traits\Relations\Account as AccountRelations;

class Account extends Model implements Contract
{
    use Authenticatable, AccountRelations;

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
     * @return \Carbon\Carbon
     */
    public function creation()
    {
        return Carbon::createFromTimestamp($this->creation);
    }

    /**
     * Check if the account has been confirmed.
     *
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->properties->emailCode() === null;
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
        return ! ($this->properties->deletion()->format('Y') < 0);
    }

    /**
     * Check if the account has a pending email address.
     *
     * @return boolean
     */
    public function hasPendingEmail()
    {
        return $this->properties->email() !== null;
    }

    /**
     * Check if the user can accept the new email address.
     *
     * @return boolean
     */
    public function canAcceptPendingEmail()
    {
        return $this->hasPendingEmail() and $this->properties->emailDate()->isPast();
    }

    /**
     * Check if the account has a pending registration change.
     *
     * @return boolean
     */
    public function hasPendingRegistration()
    {
        return $this->isRegistered() and $this->registration->requestFirstname() !== null;
    }

    /**
     * Check if the user can accept the new registration data.
     *
     * @return boolean
     */
    public function canAcceptPendingRegistration()
    {
        return $this->hasPendingRegistration() and $this->registration->requestDate()->isPast();
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
