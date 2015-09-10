<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Account\Player as PlayerContract;

trait PlayerOnline
{
    /**
     * Retrieve the player.
     *
     * @return \Apolune\Contracts\Account\Player
     */
    public function player()
    {
        return $this->hasOne(PlayerContract::class);
    }
}
