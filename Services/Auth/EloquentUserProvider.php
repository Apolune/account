<?php

namespace Apolune\Account\Services\Auth;

use Illuminate\Foundation\Application;
use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class EloquentUserProvider extends UserProvider
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $model
     * @return void
     */
    public function __construct(Application $app, HasherContract $hasher, $model)
    {
        $this->app = $app;
        $this->model = $model;
        $this->hasher = $hasher;
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
        return $this->app->make($this->model);
    }
}
