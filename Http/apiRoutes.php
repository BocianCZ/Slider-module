<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/slide'], function (Router $router) {
    $router->post('/update', 'SlideController@update')
        ->name('api.slide.update')
        ->middleware('token-can:slider.slides.update');

    $router->post('/delete', 'SlideController@delete')
        ->name('api.slide.delete')
        ->middleware('token-can:slider.slides.destroy');
});
