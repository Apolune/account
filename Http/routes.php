<?php

$router->group(['namespace' => 'Apolune\Account\Http\Controllers'], function () {

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Account.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account',                 'Account@overview');
    get('/account/manage',          'Account@manage');
    get('/account/password',        'Account@password');
    get('/account/rename',          'Account@rename');
    get('/account/terminate',       'Account@terminate');
    
    put('/account/password',        'Account@updatePassword');
    put('/account/rename',          'Account@updateName');

    delete('/account/terminate',    'Account@destroy');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Email.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/email/request',           'Email@request');
    get('/account/email',                   'Email@email');
    get('/account/confirm/{email}/{code}',  'Email@confirm');

    put('/account/email',                   'Email@updateEmail');

    delete('/account/email',                'Email@cancelEmail');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Authentication.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/create',  'Authentication@create');
    get('/account/login',   'Authentication@login');
    get('/account/logout',  'Authentication@logout');

    post('/account/create', 'Authentication@store');
    post('/account/login',  'Authentication@authenticate');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Character.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/character',               'Character@create');
    get('/account/character/{id}',          'Character@edit');
    get('/account/character/{id}/delete',   'Character@delete');
    get('/account/character/{id}/name',     'Character@name');
    get('/account/character/{id}/world',    'Character@world');
    get('/account/character/{id}/sex',      'Character@sex');

    put('/account/character/{id}',          'Character@update');
    put('/account/character/{id}/name',     'Character@updateName');
    put('/account/character/{id}/world',    'Character@updateWorld');
    put('/account/character/{id}/sex',      'Character@updateSex');
    
    post('/account/character',              'Character@store');

    delete('/account/character/{id}',       'Character@destroy');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Miscellaneous.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/download',    'Miscellaneous@download');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Recovery.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/recover',     'Recovery@index');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Registration.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/register',            'Registration@registration');
    get('/account/register/verify',     'Registration@verification');
    get('/account/register/key',        'Registration@register');
    get('/account/register/edit',       'Registration@edit');

    put('/account/register',            'Registration@validation');
    put('/account/register/verify',     'Registration@verify');
    put('/account/register/edit',       'Registration@update');

});
