<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/departments', 'DepartmentsController');
    $router->resource('/users', 'UsersController');
    $router->resource('/stationeries', 'StationeriesController');
    $router->get('/express', 'ExpressController@index');
    $router->get('/express/info', 'ExpressController@getExpressInfo');

});
