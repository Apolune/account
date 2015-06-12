<?php

namespace Apolune\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Apolune\Contracts\Account\Player as Contract;

class Player extends Model implements Contract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'account_id', 'conditions'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Retrieve the associated account.
     *
     * @return \Apolune\Contracts\Account\Account
     */
    public function account()
    {
        return $this->belongsTo('Apolune\Account\Models\Account');
    }

    /**
     * Retrieve the player gender.
     *
     * @return \Apolune\Contracts\Server\Gender
     */
    public function gender()
    {
        return gender($this->sex);
    }

    /**
     * Retrieve the player vocation.
     *
     * @return \Apolune\Contracts\Server\Vocation
     */
    public function vocation()
    {
        return vocation($this->vocation);
    }

    /**
     * Retrieve the player world.
     *
     * @return \Apolune\Contracts\Server\World
     */
    public function world()
    {
        if (! isset($this->world_id)) {
            return world($this->world_id);
        }

        return worlds()->first();
    }
}
