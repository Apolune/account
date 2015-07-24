<?php

namespace Apolune\Account\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Unconfirmed
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
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
        if ($this->auth->check() and $this->auth->user()->isConfirmed()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect("/account");
            }
        }

        return $next($request);
    }
}
