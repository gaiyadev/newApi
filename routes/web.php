<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version() . "<br/>" .  "<br/>" . "Developed by Gaiyadev";
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post("register", 'UserController@register');
    $router->post("login", 'UserController@login');
    $router->post("add", 'NewsController@store');
    $router->get("{id}", 'NewsController@show');
    $router->get("", 'NewsController@index');
    $router->put("{id}", 'NewsController@update');
    $router->delete("{id}", 'NewsController@destroy');
    $router->get("user/{id}", 'ProfileController@index');
   // $router->get("auth", 'ProfileController@userNews');
});
