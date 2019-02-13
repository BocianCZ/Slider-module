<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/slide'], function (Router $router) {
    $router->post('/update', 'SlideController@update')
        ->name('api.slider.slide.update')
        ->middleware('token-can:slider.slides.edit');

    $router->post('/delete', 'SlideController@delete')
        ->name('api.slider.slide.delete')
        ->middleware('token-can:slider.slides.destroy');
});
