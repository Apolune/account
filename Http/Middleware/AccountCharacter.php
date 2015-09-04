<?php

namespace Apolune\Account\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Registrar as Router;

class AccountCharacter
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The Router implementation.
     *
     * @var \Illuminate\Contracts\Routing\Registrar
     */
    protected $router;

    /**
     * Create a new filter instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     * @return void
     */
    public function __construct(Guard $auth, Router $router)
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $player = $this->router->getCurrentRoute()->getParameter('player');
        $player->load('account');

        if (! $this->auth->check() or ! $player or $this->auth->id() !== $player->account->id()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/account');
            }
        }

        return $next($request);
    }
}
