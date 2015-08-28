<?php

namespace Apolune\Account;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\Player as Contract;

class Player extends Model implements Contract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'account_id', 'vocation', 'town_id', 'sex', 'conditions'];

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
        return $this->belongsTo('account');
    }

    /**
     * Retrieve the player properties.
     *
     * @return \Apolune\Contracts\Account\PlayerProperties
     */
    public function properties()
    {
        return $this->hasOne('player.properties');
    }

    /**
     * Retrieve the player online relationship.
     *
     * @return \Apolune\Contracts\Account\PlayerOnline
     */
    public function playerOnline()
    {
        return $this->hasOne('player.online');
    }

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
     * Scope a query to only include online players.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Apolune\Contracts\Server\World  $world
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromWorld($query, $world)
    {
        // dd(get_class_methods(
        //     $this->getConnection()->getDoctrineConnection()
        // ));
        return $query;
    }

    /**
     * Retrieve the player ID.
     *
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Retrieve the player name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Retrieve the player group.
     *
     * @return integer
     */
    public function group()
    {
        return $this->group_id;
    }

    /**
     * Retrieve the player level.
     *
     * @return integer
     */
    public function level()
    {
        return $this->level;
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
     * Retrieve the player health.
     *
     * @return integer
     */
    public function health()
    {
        return (int) $this->health;
    }

    /**
     * Retrieve the player max health.
     *
     * @return integer
     */
    public function maxHealth()
    {
        return (int) $this->healthmax;
    }

    /**
     * Retrieve the player experience.
     *
     * @return integer
     */
    public function experience()
    {
        return (int) $this->experience;
    }

    /**
     * Retrieve the player lookbody.
     *
     * @return integer
     */
    public function lookBody()
    {
        return (int) $this->lookbody;
    }

    /**
     * Retrieve the player lookfeet.
     *
     * @return integer
     */
    public function lookFeet()
    {
        return (int) $this->lookfeet;
    }

    /**
     * Retrieve the player lookhead.
     *
     * @return integer
     */
    public function lookHead()
    {
        return (int) $this->lookhead;
    }

    /**
     * Retrieve the player looklegs.
     *
     * @return integer
     */
    public function lookLegs()
    {
        return (int) $this->looklegs;
    }

    /**
     * Retrieve the player looktype.
     *
     * @return integer
     */
    public function lookType()
    {
        return (int) $this->looktype;
    }

    /**
     * Retrieve the player lookaddons.
     *
     * @return integer
     */
    public function lookAddons()
    {
        return (int) $this->lookaddons;
    }

    /**
     * Retrieve the player magic level.
     *
     * @return integer
     */
    public function magicLevel()
    {
        return (int) $this->maglevel;
    }

    /**
     * Retrieve the player mana.
     *
     * @return integer
     */
    public function mana()
    {
        return (int) $this->mana;
    }

    /**
     * Retrieve the player max mana.
     *
     * @return integer
     */
    public function maxMana()
    {
        return (int) $this->manamax;
    }

    /**
     * Retrieve the player mana spent.
     *
     * @return integer
     */
    public function manaSpent()
    {
        return (int) $this->manaspent;
    }

    /**
     * Retrieve the player soul points.
     *
     * @return integer
     */
    public function soul()
    {
        return (int) $this->soul;
    }

    /**
     * Retrieve the player town.
     *
     * @return \Apolune\Contracts\Server\Town
     */
    public function town()
    {
        return (int) $this->town_id;
    }

    /**
     * Retrieve the player position.
     *
     * @return array
     */
    public function position()
    {
        return [$this->posx, $this->posy, $this->posz];
    }

    /**
     * Retrieve the player conditions.
     *
     * @return null
     */
    public function conditions()
    {
        return null;
    }

    /**
     * Retrieve the player capacity.
     *
     * @return integer
     */
    public function capacity()
    {
        return (int) $this->cap;
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
     * Retrieve the player last login.
     *
     * @return \Carbon\Carbon
     */
    public function lastLogin()
    {
        return Carbon::createFromTimestamp($this->lastlogin);
    }

    /**
     * Retrieve the player save status.
     *
     * @return integer
     */
    public function saveStatus()
    {
        return (int) $this->save;
    }

    /**
     * Retrieve the player skull.
     *
     * @return integer
     */
    public function skull()
    {
        return (int) $this->skull;
    }

    /**
     * Retrieve the player skull time.
     *
     * @return integer
     */
    public function skullTime()
    {
        return (int) $this->skulltime;
    }

    /**
     * Retrieve the player last logout.
     *
     * @return \Carbon\Carbon
     */
    public function lastLogout()
    {
        return Carbon::createFromTimestamp($this->lastlogout);
    }

    /**
     * Retrieve the player blessings.
     *
     * @return integer
     */
    public function blessings()
    {
        return (int) $this->blessings;
    }

    /**
     * Retrieve the player online time.
     *
     * @return integer
     */
    public function onlineTime()
    {
        return (int) $this->onlinetime;
    }

    /**
     * Retrieve the player deletion.
     *
     * @return integer
     */
    public function deletion()
    {
        return (int) $this->deletion;
    }

    /**
     * Retrieve the player balance.
     *
     * @return integer
     */
    public function balance()
    {
        return (int) $this->balance;
    }

    /**
     * Retrieve the player offline-training time.
     *
     * @return integer
     */
    public function offlinetrainingTime()
    {
        return (int) $this->offlinetraining_time;
    }

    /**
     * Retrieve the player offline-training skill.
     *
     * @return integer
     */
    public function offlinetrainingSkill()
    {
        return (int) $this->offlinetraining_skill;
    }

    /**
     * Retrieve the player stamina.
     *
     * @return integer
     */
    public function stamina()
    {
        return (int) $this->stamina;
    }

    /**
     * Retrieve the player fist fighting.
     *
     * @return integer
     */
    public function fist()
    {
        return (int) $this->skill_fist;
    }

    /**
     * Retrieve the player fist fighting tries.
     *
     * @return integer
     */
    public function fistTries()
    {
        return (int) $this->skill_fist_tries;
    }

    /**
     * Retrieve the player club fighting.
     *
     * @return integer
     */
    public function club()
    {
        return (int) $this->skill_club;
    }

    /**
     * Retrieve the player club fighting tries.
     *
     * @return integer
     */
    public function clubTries()
    {
        return (int) $this->skill_club_tries;
    }

    /**
     * Retrieve the player sword fighting.
     *
     * @return integer
     */
    public function sword()
    {
        return (int) $this->skill_sword;
    }

    /**
     * Retrieve the player sword fighting tries.
     *
     * @return integer
     */
    public function swordTries()
    {
        return (int) $this->skill_sword_tries;
    }

    /**
     * Retrieve the player axe fighting.
     *
     * @return integer
     */
    public function axe()
    {
        return (int) $this->skill_axe_tries;
    }

    /**
     * Retrieve the player axe fighting tries.
     *
     * @return integer
     */
    public function axeTries()
    {
        return (int) $this->skill_axe_tries;
    }

    /**
     * Retrieve the player distance fighting.
     *
     * @return integer
     */
    public function distance()
    {
        return (int) $this->skill_dist_tries;
    }

    /**
     * Retrieve the player distance fighting tries.
     *
     * @return integer
     */
    public function distanceTries()
    {
        return (int) $this->skill_dist_tries;
    }

    /**
     * Retrieve the player shielding skill.
     *
     * @return integer
     */
    public function shielding()
    {
        return (int) $this->skill_shielding_tries;
    }

    /**
     * Retrieve the player shielding skill tries.
     *
     * @return integer
     */
    public function shieldingTries()
    {
        return (int) $this->skill_shielding_tries;
    }

    /**
     * Retrieve the player fishing skill.
     *
     * @return integer
     */
    public function fishing()
    {
        return (int) $this->skill_fishing_tries;
    }

    /**
     * Retrieve the player fishing skill tries.
     *
     * @return integer
     */
    public function fishingTries()
    {
        return (int) $this->skill_fishing_tries;
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

    /**
     * Check if a player is online or not.
     *
     * @return boolean
     */
    public function isOnline()
    {
        return (boolean) $this->playerOnline;
    }

    /**
     * Check if the player has been hidden.
     *
     * @return boolean
     */
    public function isHidden()
    {
        return (boolean) $this->properties->hidden();
    }

    /**
     * Check if the player has been deleted.
     *
     * @return boolean
     */
    public function isDeleted()
    {
        return (boolean) $this->properties->deletion();
    }

    /**
     * Retrieve a URL friendly slug.
     *
     * @return string
     */
    public function slug()
    {
        return strtolower(Str::slug($this->name()));
    }
}
