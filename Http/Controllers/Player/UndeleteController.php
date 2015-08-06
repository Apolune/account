<?php

namespace Apolune\Account\Http\Controllers\Player;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Contracts\Account\Player;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Player\UndeleteRequest;

class UndeleteController extends Controller
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
     * Show the undelete confirmation.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function confirm(Player $player)
    {
        return view('theme::account.player.undelete.confirm', compact('player'));
    }

    /**
     * Undelete the character.
     *
     * @param  \Apolune\Account\Http\Requests\Player\UndeleteRequest  $request
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function undelete(UndeleteRequest $request, Player $player)
    {
        $player->properties->deletion = null;
        $player->properties->save();

        return view('theme::account.player.undelete.undeleted', compact('player'));
    }
}
