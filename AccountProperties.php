<?php

namespace Apolune\Account;

use Apolune\Core\Database\Eloquent\Model;
use Apolune\Core\Traits\AuthenticatableProperties;
use Apolune\Contracts\Account\AccountProperties as Contract;

class AccountProperties extends Model implements Contract
{
    use AuthenticatableProperties;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '__pandaac_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id', 'email_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * Retrieve the pending email address.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Retrieve the email verification code.
     *
     * @return string
     */
    public function emailCode()
    {
        return $this->email_code;
    }
    
    /**
     * Retrieve the pending email address date.
     *
     * @return \Carbon\Carbon
     */
    public function emailDate()
    {
        $days = config('pandaac.mail.timers.email-change');

        return (new Carbon($this->email_date))->addDays($days);
    }

    /**
     * Retrieve the amount of email confirmation requests.
     *
     * @return integer
     */
    public function emailRequests()
    {
        return (int) $this->email_requests;
    }

    /**
     * Set a new email verification code.
     *
     * @return void
     */
    public function setEmailCode()
    {
        $this->email_code = str_random(40);
        $this->save();
    }

    /**
     * Retrieve the deleted value.
     *
     * @return integer
     */
    public function softDeleted()
    {
        return $this->deleted;
    }
}
