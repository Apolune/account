<?php

namespace Apolune\Account\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory as Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Validator $validator)
    {
        $provider = $this;

        collect(get_class_methods($this))->filter(function ($value) {
            return starts_with($value, 'validate');
        })->each(function ($method) use ($provider, $validator) {
            $name = snake_case(preg_replace('/^validate/i', null, $method));

            $validator->extend($name, [$provider, $method]);
        });
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    private function validateGender($attribute, $value, array $parameters)
    {
        return (boolean) gender($value);
    }

    /**
     * A validation rule that checks the validity of a vocation.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    private function validateVocation($attribute, $value, array $parameters)
    {
        return (boolean) vocation($value, !! head($parameters));
    }

    /**
     * A validation rule that checks the validity of a world.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    private function validateWorld($attribute, $value, array $parameters)
    {
        return (boolean) world($value);
    }

    /**
     * A validation rule that checks that at least X words are present.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    private function validateMinWords($attribute, $value, array $parameters)
    {
        return str_word_count($value) >= (int) head($parameters) ?: 1;
    }

    /**
     * A validation rule that checks that no more than X words are present.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    private function validateMaxWords($attribute, $value, array $parameters)
    {
        return ! str_word_count($value) <= head($parameters) ?: 1;
    }
}
