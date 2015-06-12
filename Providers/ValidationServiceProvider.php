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
        $this->minWords();
        $this->maxWords();
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
            return (boolean) vocation($value, !! head($parameters));
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

    /**
     * A validation rule that checks that at least X words are present.
     *
     * @return void
     */
    private function minWords()
    {
        Validator::extend('min_words', function ($attribute, $value, array $parameters) {
            return str_word_count($value) >= (int) head($parameters) ?: 1;
        });
    }

    /**
     * A validation rule that checks that no more than X words are present.
     *
     * @return void
     */
    private function maxWords()
    {
        Validator::extend('max_words', function ($attribute, $value, array $parameters) {
            return ! str_word_count($value) <= head($parameters) ?: 1;
        });
    }
}
