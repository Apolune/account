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
    put('/account/password',        'Account@updatePassword');

    get('/account/rename',          'Account@rename');
    put('/account/rename',          'Account@updateName');
    
    get('/account/terminate',       'Account@terminate');
    delete('/account/terminate',    'Account@destroy');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Email.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/email',                   'Email@email');
    put('/account/email',                   'Email@updateEmail');

    get('/account/email/request',           'Email@request');
    get('/account/confirm/{email}/{code}',  'Email@confirm');

    delete('/account/email',                'Email@cancelEmail');

    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Authentication.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/login',   'Authentication@login');
    post('/account/login',  'Authentication@authenticate');

    get('/account/create',  'Authentication@create');
    post('/account/create', 'Authentication@store');
    
    get('/account/logout',  'Authentication@logout');


    /*
    |--------------------------------------------------------------------------
    | \Apolune\Account\Http\Controllers\Character.php
    |--------------------------------------------------------------------------
    |
    | The following routes belong to the aforementioned controller.
    |
    */

    get('/account/character',                'Character@create');
    post('/account/character/confirm',       'Character@confirm');
    post('/account/character',               'Character@store');

    get('/account/character/{id}',           'Character@edit')->where('id', '[0-9]+');
    put('/account/character/{id}',           'Character@update')->where('id', '[0-9]+');
    
    get('/account/character/{id}/delete',    'Character@delete')->where('id', '[0-9]+');
    delete('/account/character/{id}',        'Character@destroy')->where('id', '[0-9]+');
    
    get('/account/character/{id}/undelete',  'Character@undelete')->where('id', '[0-9]+');
    post('/account/character/{id}/undelete', 'Character@restore')->where('id', '[0-9]+');
    
    // get('/account/character/{id}/name',     'Character@name');
    // put('/account/character/{id}/name',     'Character@updateName');
    
    // get('/account/character/{id}/world',    'Character@world');
    // put('/account/character/{id}/world',    'Character@updateWorld');

    // get('/account/character/{id}/sex',      'Character@sex');
    // put('/account/character/{id}/sex',      'Character@updateSex');


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
    put('/account/register',            'Registration@validation');

    get('/account/register/verify',     'Registration@verification');
    put('/account/register/verify',     'Registration@verify');

    get('/account/register/key',        'Registration@register');
    
    put('/account/register/edit',       'Registration@update');
    get('/account/register/edit',       'Registration@edit');


});
