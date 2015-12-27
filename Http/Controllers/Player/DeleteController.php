<?php

namespace Apolune\Account\Http\Controllers\Player;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Contracts\Account\Player;
use Apolune\Account\Jobs\Player\Delete;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Player\DeleteRequest;

class DeleteController extends Controller
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
    }

    /**
     * Show the delete confirmation.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function confirm(Player $player)
    {
        return view('theme::account.player.delete.confirm', compact('player'));
    }

    /**
     * Delete the character.
     *
     * @param  \Apolune\Account\Http\Requests\Player\DeleteRequest  $request
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return \Illuminate\View\View
     */
    public function delete(DeleteRequest $request, Player $player)
    {
        $this->dispatch(
            new Delete($player)
        );

        return view('theme::account.player.delete.deleted', compact('player'));
    }
}
