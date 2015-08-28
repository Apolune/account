<?php

namespace Apolune\Account;

use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\PlayerOnline as Contract;

class PlayerOnline extends Model implements Contract
{
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

    /**
     * Retrieve the player.
     *
     * @return \Apolune\Contracts\Account\Player
     */
    public function player()
    {
        return $this->hasOne('player');
    }
}
