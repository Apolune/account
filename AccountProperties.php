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
    protected $fillable = ['account_id', 'verification'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];
}
