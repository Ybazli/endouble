<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'] , function()use ($router){
    $router->get('/' ,['as' => 'api.home', 'uses' => 'ApiController@home'] );

    //another api route here...
});
