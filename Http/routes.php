<?php

$router->group(['prefix' => '/account', 'namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {
    $router->get('/', 'AccountController@getIndex');
    $router->get('/manage', 'AccountController@getManage');

    $router->get('/login', 'AuthController@getLogin');
    $router->post('/login', 'AuthController@postLogin');

    $router->get('/logout', 'AuthController@getLogout');

    $router->get('/create', 'AuthController@getCreate');
    $router->post('/create', 'AuthController@postCreate');

    $router->get('/password', 'AccountController@getPassword');
    $router->put('/password', 'AccountController@putPassword');

    $router->get('/email', 'AccountController@getEmail');
    $router->put('/email', 'AccountController@putEmail');

    $router->get('/rename', 'AccountController@getRename');
    $router->put('/rename', 'AccountController@putRename');

    $router->get('/terminate', 'AccountController@getTerminate');
    $router->delete('/terminate', 'AccountController@deleteTerminate');
});

$router->group(['prefix' => '/account/character', 'namespace' => 'Apolune\Account\Http\Controllers'], function ($router) {
    $router->get('/', 'CharacterController@create');
    $router->post('/', 'CharacterController@store');

    $router->get('/{id}/edit', 'CharacterController@edit');
    $router->put('/{id}', 'CharacterController@update');

    $router->get('/{id}/delete', 'CharacterController@delete');
    $router->delete('/{id}', 'CharacterController@destroy');

    $router->get('/{id}/name', 'CharacterController@changeName');
    $router->put('/{id}/name', 'CharacterController@storeName');

    $router->get('/{id}/world', 'CharacterController@changeWorld');
    $router->put('/{id}/world', 'CharacterController@storeWorld');

    $router->get('/{id}/sex', 'CharacterController@changeSex');
    $router->put('/{id}/sex', 'CharacterController@storeSex');
});
