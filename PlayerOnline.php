<?php

namespace Apolune\Account;

use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\PlayerOnline as Contract;
use Apolune\Account\Traits\Relations\PlayerOnline as PlayerOnlineRelations;

class PlayerOnline extends Model implements Contract
{
    use PlayerOnlineRelations;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players_online';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'player_id';
}
