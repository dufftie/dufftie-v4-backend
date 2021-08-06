<?php

use Laravel\Lumen\Routing\Router;
/** @var Router $router */

//All requests must be under auth validation
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', function () use ($router){
        return 'Hello authorized user! ' . $router->app->version();
    });

    /**
     * Returns information about user that is going to be used on the personal page
     * @uses \App\Http\Controllers\UserController::getUserPageInfo()
     */
    $router->get('user/{username}', ['uses' => 'UserController@getUserPageInfo']);
});
