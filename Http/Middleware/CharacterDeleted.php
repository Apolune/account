<?php

namespace Apolune\Account\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Registrar as Router;
use Apolune\Account\Exceptions\DeletedPlayerException;

class CharacterDeleted
{
    /**
     * The Router implementation.
     *
     * @var \Illuminate\Contracts\Routing\Registrar
     */
    protected $router;

    /**
     * Create a new filter instance.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     * @return void
     */
    public function __construct(Router $router)
    {
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

        if (! $player or ! $player->isDeleted()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                throw new DeletedPlayerException;
            }
        }

        return $next($request);
    }
}
