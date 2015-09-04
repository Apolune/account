<?php

namespace Apolune\Account\Providers;

use Apolune\Core\ServiceProvider;
use Apolune\Account\Exceptions\DeletedPlayerException;
use Apolune\Account\Exceptions\NotDeletedPlayerException;
use Apolune\Account\Exceptions\DifferentAccountPlayerException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionsServiceProvider extends ServiceProvider
{   
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->exceptions->handle(DeletedPlayerException::class, function ($e) {
            $player = app('router')->getCurrentRoute()->getParameter('player');

            return redirect(url('/account/character', $player->slug()));
        });

        $this->exceptions->handle(NotDeletedPlayerException::class, function ($e) {
            $player = app('router')->getCurrentRoute()->getParameter('player');

            return redirect(url('/account/character', $player->slug()));
        });

        $this->exceptions->handle(DifferentAccountPlayerException::class, function ($e) {
            return redirect('/account');
        });
    }
}
