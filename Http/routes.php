<?php

$router->group(['namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account',            'DashboardController@overview');
    $router->get('/account/manage',     'DashboardController@manage');
    $router->get('/account/download',   'DashboardController@download');

    /*
    |--------------------------------------------------------------------------
    | Account Actions
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/password',       'Action\PasswordController@form');
    $router->put('/account/password',       'Action\PasswordController@update');

    $router->get('/account/rename',         'Action\RenameController@form');
    $router->put('/account/rename',         'Action\RenameController@update');
    
    $router->get('/account/terminate',      'Action\TerminateController@confirm');
    $router->delete('/account/terminate',   'Action\TerminateController@terminate');

    /*
    |--------------------------------------------------------------------------
    | Account Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->get('/account/login',   'Auth\AuthenticateController@form');
    $router->post('/account/login',  'Auth\AuthenticateController@login');
    $router->get('/account/logout',  'Auth\AuthenticateController@logout');

    $router->get('/account/create',  'Auth\CreateController@form');
    $router->post('/account/create', 'Auth\CreateController@create');

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

    $router->get('/account/character/{player}',             'Player\EditController@form')->where('player', '[0-9]+');
    $router->put('/account/character/{player}',             'Player\EditController@edit')->where('player', '[0-9]+');
    
    $router->get('/account/character/{player}/delete',      'Player\DeleteController@confirm')->where('player', '[0-9]+');
    $router->delete('/account/character/{player}',          'Player\DeleteController@delete')->where('player', '[0-9]+');
    
    $router->get('/account/character/{player}/undelete',    'Player\UndeleteController@confirm')->where('player', '[0-9]+');
    $router->post('/account/character/{player}/undelete',   'Player\UndeleteController@undelete')->where('player', '[0-9]+');
    
    // $router->get('/account/character/{player}/name',     'Player\NameController@form');
    // $router->put('/account/character/{player}/name',     'Player\NameController@update');

    // $router->get('/account/character/{player}/sex',      'Player\SexController@form');
    // $router->put('/account/character/{player}/sex',      'Player\SexController@update');
    
    // $router->get('/account/character/{player}/world',    'Player\WorldController@form');
    // $router->put('/account/character/{player}/world',    'Player\WorldController@update');

});
