<?php

namespace Apolune\Account\Traits\Mutators
;

trait Player
{
    /**
     * Set the players world id.
     *
     * @param  integer  $value
     * @return void
     */
    public function setWorldIdAttribute($value)
    {
        if (! $this->hasColumn('world_id')) {
            return;
        }

        $this->attributes['world_id'] = $value;
    }
}
