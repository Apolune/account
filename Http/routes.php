<?php

$router->group(['namespace' => 'Apolune\Account\Http\Controllers'], function () {

    /*
    |--------------------------------------------------------------------------
    | AccountController
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account', 'AccountController@index');
    get('/account/manage', 'AccountController@manage');
    get('/account/password', 'AccountController@password');
    put('/account/password', 'AccountController@updatePassword');
    get('/account/email', 'AccountController@email');
    put('/account/email', 'AccountController@updateEmail');
    get('/account/rename', 'AccountController@rename');
    put('/account/rename', 'AccountController@updateName');
    get('/account/terminate', 'AccountController@terminate');
    delete('/account/terminate', 'AccountController@destroy');

    /*
    |--------------------------------------------------------------------------
    | AuthController
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/create', 'AuthController@create');
    post('/account/create', 'AuthController@store');
    get('/account/login', 'AuthController@login');
    post('/account/login', 'AuthController@authenticate');
    get('/account/logout', 'AuthController@logout');

    /*
    |--------------------------------------------------------------------------
    | CharacterController
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/character', 'CharacterController@create');
    post('/account/character', 'CharacterController@store');
    get('/account/character/{id}', 'CharacterController@edit');
    put('/account/character/{id}', 'CharacterController@update');
    get('/account/character/{id}/delete', 'CharacterController@delete');
    delete('/account/character/{id}', 'CharacterController@destroy');
    get('/account/character/{id}/name', 'CharacterController@name');
    put('/account/character/{id}/name', 'CharacterController@updateName');
    get('/account/character/{id}/world', 'CharacterController@world');
    put('/account/character/{id}/world', 'CharacterController@updateWorld');
    get('/account/character/{id}/sex', 'CharacterController@sex');
    put('/account/character/{id}/sex', 'CharacterController@updateSex');

    /*
    |--------------------------------------------------------------------------
    | GenericController
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/download', 'GenericController@download');

    /*
    |--------------------------------------------------------------------------
    | RecoverController
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/recover', 'RecoverController@index');

});
