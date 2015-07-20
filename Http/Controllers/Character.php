<?php

namespace Apolune\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;

class Character extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
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
     * Show the create character page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme::account.character.create');
    }

    /**
     * Store the character.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Show the edit character page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.edit')->withPlayer($player);
    }

    /**
     * Update the character.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
    }

    /**
     * Show the delete character page.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.delete')->withPlayer($player);
    }

    /**
     * Destroy the character.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    }

    /**
     * Show the change character name page.
     *
     * @return \Illuminate\Http\Response
     */
    public function name($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.name')->withPlayer($player);
    }

    /**
     * Change the character name.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateName()
    {
    }

    /**
     * Show the change character world page.
     *
     * @return \Illuminate\Http\Response
     */
    public function world($id)
    {
        $player = app('player')->findOrFail($id);

        $worlds = worlds()->forget($player->world()->id());

        return view('theme::account.character.world', compact('player', 'worlds'));
    }

    /**
     * Change the character world.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateWorld()
    {
    }

    /**
     * Show the change character sex page.
     *
     * @return \Illuminate\Http\Response
     */
    public function sex($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.sex', compact('player'));
    }

    /**
     * Change the character sex.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSex()
    {
    }
}
