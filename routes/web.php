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
    return $router->app->version();
});
$router->group(['prefix'=>'api/v1'],function () use ($router){
    $router->post('createclient','GestionCuentas@createclient');
    $router->get('listclients','GestionCuentas@listclients');
    $router->post('createaccount','GestionCuentas@createaccount');
    $router->get('listaccounts','GestionCuentas@listaccounts');
    $router->get('checkbalance/{number_account}','GestionCuentas@checkbalance');
    $router->post('updateamount','GestionCuentas@updateamount');
});
