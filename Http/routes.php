<?php

$router->group(['middleware' => 'web', 'namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {

    /*
    |--------------------------------------------------------------------------
    | Account Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->group([], function ($router) {

        // Log In
        $router->group(['middleware' => 'guest'], function ($router) {
            $router->get('/account/login',   'Auth\AuthenticateController@form');
            $router->post('/account/login',  'Auth\AuthenticateController@login');
        });

        // Create Account
        $router->group(['middleware' => 'guest'], function ($router) {
            $router->get('/account/create',  'Auth\CreateController@form');
            $router->post('/account/create', 'Auth\CreateController@create');
        });

        // Log Out
        $router->get('/account/logout',  'Auth\AuthenticateController@logout')->middleware('auth');

    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->group(['middleware' => 'auth'], function ($router) {

        $router->get('/account', 'DashboardController@overview');
        $router->get('/account/manage', 'DashboardController@manage');
        $router->get('/account/download', 'DashboardController@download');

    });

    /*
    |--------------------------------------------------------------------------
    | Account Actions
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->group(['middleware' => 'auth'], function ($router) {

        // Change Password
        $router->get('/account/password', 'Action\PasswordController@form');
        $router->put('/account/password', 'Action\PasswordController@update');

        // Rename Account
        $router->get('/account/rename', 'Action\RenameController@form');
        $router->put('/account/rename', 'Action\RenameController@update');
        
        // Terminate Account
        $router->get('/account/terminate', 'Action\TerminateController@confirm');
        $router->delete('/account/terminate', 'Action\TerminateController@terminate');

    });

    /*
    |--------------------------------------------------------------------------
    | Email Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->group([], function ($router) {

        // Update Email
        $router->group(['middleware' => 'auth'], function ($router) {
            $router->get('/account/email', 'Email\EditController@form');
            $router->put('/account/email', 'Email\EditController@edit');
            $router->post('/account/email', 'Email\EditController@accept');
            $router->get('/account/email/cancel', 'Email\EditController@cancel');
        });

        // Email Confirmation
        $router->get('/account/email/request', 'Email\RequestController@request')->middleware(['auth', 'unconfirmed']);
        $router->get('/account/confirm/{email}/{code}', 'Email\RequestController@confirm');

    });

    /*
    |--------------------------------------------------------------------------
    | Account Registration
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    $router->group(['middleware' => 'auth'], function ($router) {

        // Register Account
        $router->get('/account/register', 'Registration\CreateController@form');
        $router->match(['GET', 'POST'], '/account/register/confirm', 'Registration\CreateController@confirm');
        $router->post('/account/register', 'Registration\CreateController@register');

        // Change Registration
        $router->get('/account/register/edit', 'Registration\EditController@edit');
        $router->put('/account/register/edit', 'Registration\EditController@update');
        $router->post('/account/register/edit', 'Registration\EditController@accept');
        $router->get('/account/register/cancel', 'Registration\EditController@cancel');
    
    });

    /*
    |--------------------------------------------------------------------------
    | Player Management
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */
   
    $router->group(['middleware' => 'auth'], function ($router) {

        // Create Character
        $router->get('/account/character', 'Player\CreateController@form');
        $router->post('/account/character/confirm', 'Player\CreateController@confirm');
        $router->post('/account/character', 'Player\CreateController@create');

        // Edit Character
        $router->group(['middleware' => 'account.character'], function ($router) {
            $router->get('/account/character/{player}', 'Player\EditController@form')->where('player', '[A-Za-z\-]+');
            $router->put('/account/character/{player}', 'Player\EditController@edit')->where('player', '[A-Za-z\-]+');
        });

        // Delete Character
        $router->group(['middleware' => ['account.character', 'character.notdeleted']], function ($router) {
            $router->get('/account/character/{player}/delete', 'Player\DeleteController@confirm')->where('player', '[A-Za-z\-]+');
            $router->delete('/account/character/{player}', 'Player\DeleteController@delete')->where('player', '[A-Za-z\-]+');
        });

        // Undelete Character
        $router->group(['middleware' => ['account.character', 'character.deleted']], function ($router) {
            $router->get('/account/character/{player}/undelete', 'Player\UndeleteController@confirm')->where('player', '[A-Za-z\-]+');
            $router->post('/account/character/{player}/undelete', 'Player\UndeleteController@undelete')->where('player', '[A-Za-z\-]+');
        });

        // Change Name
        // $router->group(['middleware' => 'account.character'], function ($router) {
        //     $router->get('/account/character/{player}/name', 'Player\NameController@form')->where('player', '[A-Za-z\-]+');
        //     $router->put('/account/character/{player}/name', 'Player\NameController@update')->where('player', '[A-Za-z\-]+');
        // });

        // Change Sex
        // $router->group(['middleware' => 'account.character'], function ($router) {
        //     $router->get('/account/character/{player}/sex', 'Player\SexController@form')->where('player', '[A-Za-z\-]+');
        //     $router->put('/account/character/{player}/sex', 'Player\SexController@update')->where('player', '[A-Za-z\-]+');
        // });

        // Change World
        // $router->group(['middleware' => 'account.character'], function ($router) {
        //     $router->get('/account/character/{player}/world', 'Player\WorldController@form')->where('player', '[A-Za-z\-]+');
        //     $router->put('/account/character/{player}/world', 'Player\WorldController@update')->where('player', '[A-Za-z\-]+');
        // });

    });

});
