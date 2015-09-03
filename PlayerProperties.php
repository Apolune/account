<?php

namespace Apolune\Account;

use Carbon\Carbon;
use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\PlayerProperties as Contract;

class PlayerProperties extends Model implements Contract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '__pandaac_players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['player_id'];

    /**
     * Retrieve the original deletion date.
     *
     * @return string|null
     */
    public function deletion()
    {
        return $this->deletion;
    }

    /**
     * Retrieve the actual deletion date.
     *
     * @return \Carbon\Carbon
     */
    public function deletedAt()
    {
        $days = config('pandaac.apolune.account.deletion-days');
        
        return (new Carbon($this->deletion))->addDays($days);
    }

    /**
     * Retrieve the hidden status.
     *
     * @return boolean
     */
    public function hidden()
    {
        return $this->hide;
    }

    /**
     * Retrieve the comment.
     *
     * @return string
     */
    public function comment()
    {
        return $this->comment;
    }

    /**
     * Retrieve the signature.
     *
     * @return string
     */
    public function signature()
    {
        return $this->signature;
    }
}
