<?php

use Laravel\Lumen\Routing\Router;

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

$router->get('upload-image/{id}', [
    'as' => 'application.upload-image.show',
    'uses' => 'UploadImageController@show'
]);

$router->group(['middleware' => ['auth:customer', 'throttle:api']], function (Router $router) {
    $router->get('/', 'HomeController@index');

    $router->post('upload-image/', 'UploadImageController@store');
});