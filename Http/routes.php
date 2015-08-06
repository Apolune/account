<?php

$router->group(['namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {

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
    | Account Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/login',   'Account\AuthenticateController@form');
    $router->post('/account/login',  'Account\AuthenticateController@login');
    $router->get('/account/logout',  'Account\AuthenticateController@logout');

    $router->get('/account/create',  'Account\CreateController@form');
    $router->post('/account/create', 'Account\CreateController@create');

    /*
    |--------------------------------------------------------------------------
    | Email Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/email',                   'Email\EditController@form');
    $router->put('/account/email',                   'Email\EditController@edit');
    $router->delete('/account/email',                'Email\EditController@cancel');

    $router->get('/account/email/request',           'Email\RequestController@request');
    $router->get('/account/confirm/{email}/{code}',  'Email\RequestController@confirm');

    /*
    |--------------------------------------------------------------------------
    | Account Registration
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/register',                               'Registration\CreateController@form');
    $router->match(['GET', 'POST'], '/account/register/confirm',    'Registration\CreateController@confirm');
    $router->post('/account/register',                              'Registration\CreateController@register');

    $router->get('/account/register/edit',                          'Registration\EditController@edit');
    $router->put('/account/register/edit',                          'Registration\EditController@update');


    /*
    |--------------------------------------------------------------------------
    | Player Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/character',                      'Player\CreateController@form');
    $router->post('/account/character/confirm',             'Player\CreateController@confirm');
    $router->post('/account/character',                     'Player\CreateController@create');

    $router->get('/account/character/{player}',             'Player\EditController@form');
    $router->put('/account/character/{player}',             'Player\EditController@edit');
    
    $router->get('/account/character/{player}/delete',      'Player\DeleteController@confirm');
    $router->delete('/account/character/{player}',          'Player\DeleteController@delete');
    
    $router->get('/account/character/{player}/undelete',    'Player\UndeleteController@confirm');
    $router->post('/account/character/{player}/undelete',   'Player\UndeleteController@undelete');
    
    // $router->get('/account/character/{player}/name',     'Player\NameController@form');
    // $router->put('/account/character/{player}/name',     'Player\NameController@update');

    // $router->get('/account/character/{player}/sex',      'Player\SexController@form');
    // $router->put('/account/character/{player}/sex',      'Player\SexController@update');
    
    // $router->get('/account/character/{player}/world',    'Player\WorldController@form');
    // $router->put('/account/character/{player}/world',    'Player\WorldController@update');


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

});
