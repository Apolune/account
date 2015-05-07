<?php

$router->group(['prefix' => '/account'], function($router)
{
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
