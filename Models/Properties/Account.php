<?php

namespace Apolune\Account\Models\Properties;

use Illuminate\Database\Eloquent\Model;
use Apolune\Core\Traits\AuthenticatableTraits;
use Apolune\Contracts\Account\Properties\Account as AccountContract;

class Account extends Model implements AccountContract
{
    use AuthenticatableTraits;

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
}
