<?php

$route = config('pandaac.account.route', '/account');

$router->group(['prefix' => $route], function() use($router)
{
	$router->get('/', 'AuthController@getLogin');
	$router->post('/', 'AuthController@postLogin');

	$router->get('/logout', 'AuthController@getLogout');

	$router->get('/create', 'AuthController@getRegister');
	$router->post('/create', 'AuthController@postRegister');
});
