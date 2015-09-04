<?php

namespace Apolune\Account\Http\Controllers\Player;

use Illuminate\Contracts\Auth\Guard;
use Apolune\Contracts\Account\Player;
use Apolune\Account\Jobs\Player\Edit;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Player\EditRequest;

class EditController extends Controller
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

        $this->middleware('account.character');
    }

    /**
     * Show the edit character form.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function form(Player $player)
    {
        return view('theme::account.player.edit.form', compact('player'));
    }

    /**
     * Update the character.
     *
     * @param  \Apolune\Account\Http\Requests\Player\EditRequest  $request
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function edit(EditRequest $request, Player $player)
    {
        $this->dispatch(
            new Edit($player)
        );

        return view('theme::account.player.edit.edited', compact('player'));
    }
}
