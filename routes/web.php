<?php

use Laravel\Lumen\Routing\Router;
/** @var Router $router */

$router->get('/', ['middleware' => 'auth', function () use ($router){
    return 'Hello authorized user! ' . $router->app->version();
}]);
