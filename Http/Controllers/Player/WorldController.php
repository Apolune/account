<?php

namespace Apolune\Account\Http\Controllers\Player;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Contracts\Account\Player;
use Apolune\Core\Http\Controllers\Controller;

class WorldController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth');
    }

    /**
     * Show the change world form.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function form(Player $player)
    {
        $worlds = worlds()->forget($player->world()->id());

        return view('theme::account.player.world.form', compact('player', 'worlds'));
    }

    /**
     * Update the player world.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function update(Player $player)
    {
    }
}
