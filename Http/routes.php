<?php

$router->group(['prefix' => '/account', 'namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {
    $router->get('/', 'AccountController@index');
    $router->get('/manage', 'AccountController@manage');

    $router->get('/login', 'AuthController@login');
    $router->post('/login', 'AuthController@authenticate');

    $router->get('/logout', 'AuthController@logout');

    $router->get('/create', 'AuthController@create');
    $router->post('/create', 'AuthController@store');

    $router->get('/password', 'AccountController@password');
    $router->put('/password', 'AccountController@updatePassword');

    $router->get('/email', 'AccountController@email');
    $router->put('/email', 'AccountController@updateEmail');

    $router->get('/rename', 'AccountController@rename');
    $router->put('/rename', 'AccountController@updateName');

    $router->get('/terminate', 'AccountController@terminate');
    $router->delete('/terminate', 'AccountController@destroy');
});

$router->group(['prefix' => '/account/character', 'namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {
    $router->get('/', 'CharacterController@create');
    $router->post('/', 'CharacterController@store');

    $router->get('/{id}', 'CharacterController@edit');
    $router->put('/{id}', 'CharacterController@update');

    $router->get('/{id}/delete', 'CharacterController@delete');
    $router->delete('/{id}', 'CharacterController@destroy');

    $router->get('/{id}/name', 'CharacterController@name');
    $router->put('/{id}/name', 'CharacterController@updateName');

    $router->get('/{id}/world', 'CharacterController@world');
    $router->put('/{id}/world', 'CharacterController@updateWorld');

    $router->get('/{id}/sex', 'CharacterController@sex');
    $router->put('/{id}/sex', 'CharacterController@updateSex');
});
