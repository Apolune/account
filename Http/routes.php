<?php

$router->group(['prefix' => '/account'], function() use($router)
{
	$router->get('/', 'AccountController@getIndex');

	$router->get('/login', 'AuthController@getLogin');
	$router->post('/login', 'AuthController@postLogin');

	$router->get('/logout', 'AuthController@getLogout');

	$router->get('/create', 'AuthController@getRegister');
	$router->post('/create', 'AuthController@postRegister');
});
