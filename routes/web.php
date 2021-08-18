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
     * @uses UserController::getUserPageInfo()
     */
    $router->get('user/{username}', ['uses' => 'UserController@getUserPageInfo']);

    /**
     * Returns information about user that is going to be used on the personal page
     * @uses ArtworkController::getPageInfo()
     */
    $router->get('artwork/{artwork}', ['uses' => 'ArtworkController@getPageInfo']);
});
