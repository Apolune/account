<?php

namespace Apolune\Account\Traits\Scopes;

trait Player
{
    /**
     * Scope a query to only include online players.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnline($query)
    {
        return $query->has('playerOnline');
    }

    /**
     * Scope a query to only include visible players.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->whereHas('properties', function ($query) {
            return $query->where('hide', 0);
        });
    }

    /**
     * Scope a query to only include hidden players.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHidden($query)
    {
        return $query->whereHas('properties', function ($query) {
            return $query->where('hide', 1);
        });
    }

    /**
     * Scope a query to only include players from a specific world.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Apolune\Contracts\Server\World  $world
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromWorld($query, $world)
    {
        if ($this->hasColumn('world_id') and worlds()->count() > 1) {
            return $query->where('world_id', $world->id());
        }

        return $query;
    }
}
