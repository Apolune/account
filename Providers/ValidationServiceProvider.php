<?php

namespace Apolune\Account\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->gender();
        $this->vocation();
        $this->world();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * A validation rule that checks the validity of a gender.
     *
     * @return void
     */
    private function gender()
    {
        Validator::extend('gender', function ($attribute, $value, array $parameters) {
            return (boolean) gender($value);
        });
    }

    /**
     * A validation rule that checks the validity of a vocation.
     *
     * @return void
     */
    private function vocation()
    {
        Validator::extend('vocation', function ($attribute, $value, array $parameters) {
            return (boolean) vocation($value, !! isset($parameters[0]));
        });
    }

    /**
     * A validation rule that checks the validity of a world.
     *
     * @return void
     */
    private function world()
    {
        Validator::extend('world', function ($attribute, $value, array $parameters) {
            return (boolean) world($value);
        });
    }
}
