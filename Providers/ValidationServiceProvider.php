<?php

namespace Apolune\Account\Providers;

use Apolune\Core\ServiceProvider;
use Illuminate\Validation\Factory as Validator;
use Apolune\Account\Services\Validation\Validator as Rules;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Validator $validator)
    {
        $rules = new Rules;

        collect(get_class_methods($rules))->each(function ($method) use ($validator) {
            $name = snake_case(preg_replace('/^validate/i', null, $method));

            $validator->extend($name, sprintf('%s@%s', 
                Rules::class, 
                $method
            ));
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
}
