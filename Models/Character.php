<?php

namespace Apolune\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Apolune\Contracts\Account\Character as CharacterContract;

class Character extends Model implements CharacterContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

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
}
