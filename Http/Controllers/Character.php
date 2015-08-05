<?php

namespace Apolune\Account\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Apolune\Core\Http\Controllers\Controller;
use Apolune\Account\Http\Requests\Character\StoreRequest;
use Apolune\Account\Http\Requests\Character\DeleteRequest;
use Apolune\Account\Http\Requests\Character\UpdateRequest;
use Apolune\Account\Http\Requests\Character\RestoreRequest;

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
     * Confirm the new character.
     * 
     * @param  \Apolune\Account\Http\Requests\Character\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(StoreRequest $request)
    {
        $request->flash();

        return view('theme::account.character.confirm');
    }

    /**
     * Store the character.
     *
     * @param  \Apolune\Account\Http\Requests\Character\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->get('back') === "") {
            return redirect('/account/character')->withInput($request->all());
        }

        $player = $this->auth->user()->players()->create([
            'name'          => $request->get('player'),
            'account_id'    => $this->auth->id(),
            'vocation'      => $request->get('vocation'),
            'sex'           => $request->get('sex'),
            'conditions'    => '',
        ]);

        $player->properties()->create([]);

        return view('theme::account.character.created', compact('player'));
    }

    /**
     * Show the edit character page.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.edit', compact('player'));
    }

    /**
     * Update the character.
     *
     * @param  integer  $id
     * @param  \Apolune\Account\Http\Requests\Character\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $player = app('player')->findOrFail($id);

        $player->properties->hide = (boolean) $request->get('hide');
        $player->properties->comment = $request->get('comment');
        $player->properties->signature = $request->get('signature');
        $player->properties->save();

        return view('theme::account.character.updated', compact('player'));
    }

    /**
     * Show the delete character page.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.delete', compact('player'));
    }

    /**
     * Destroy the character.
     *
     * @param  integer  $id
     * @param  \Apolune\Account\Http\Requests\Character\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteRequest $request)
    {
        $player = app('player')->findOrFail($id);

        $player->properties->deletion = Carbon::now();
        $player->properties->save();

        return view('theme::account.character.deleted', compact('player'));
    }

    /**
     * Show the undelete character page.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function undelete($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.undelete', compact('player'));
    }

    /**
     * Destroy the character.
     *
     * @param  integer  $id
     * @param  \Apolune\Account\Http\Requests\Character\RestoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id, RestoreRequest $request)
    {
        $player = app('player')->findOrFail($id);

        $player->properties->deletion = null;
        $player->properties->save();

        return view('theme::account.character.restored', compact('player'));
    }

    /**
     * Show the change character name page.
     *
     * @return \Illuminate\Http\Response
     */
    public function name($id)
    {
        $player = app('player')->findOrFail($id);

        return view('theme::account.character.name', compact('player'));
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
