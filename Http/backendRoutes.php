<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->bind('slider', function ($id) {
    return app(\Modules\Slider\Repositories\SliderRepository::class)->find($id);
});
$router->bind('slide', function ($id) {
    return app(\Modules\Slider\Repositories\SlideRepository::class)->find($id);
});

$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->get('sliders', ['as' => 'admin.slider.slider.index', 'uses' => 'SliderController@index']);
    $router->get('sliders/create', ['as' => 'admin.slider.slider.create', 'uses' => 'SliderController@create']);
    $router->post('sliders', ['as' => 'admin.slider.slider.store', 'uses' => 'SliderController@store']);
    $router->get('sliders/{slider}/edit', ['as' => 'admin.slider.slider.edit', 'uses' => 'SliderController@edit']);
    $router->put('sliders/{slider}', ['as' => 'admin.slider.slider.update', 'uses' => 'SliderController@update']);
    $router->delete('sliders/{slider}', ['as' => 'admin.slider.slider.destroy', 'uses' => 'SliderController@destroy']);

    $router->get('sliders/{slider}/slide', ['as' => 'dashboard.slide.index', 'uses' => 'SlideController@index']);
    $router->get('sliders/{slider}/slide/create', ['as' => 'dashboard.slide.create', 'uses' => 'SlideController@create']);
    $router->post('sliders/{slider}/slide', ['as' => 'dashboard.slide.store', 'uses' => 'SlideController@store']);
    $router->get('sliders/{slider}/slide/{slide}/edit', ['as' => 'dashboard.slide.edit', 'uses' => 'SlideController@edit']);
    $router->put('sliders/{slider}/slide/{slide}', ['as' => 'dashboard.slide.update', 'uses' => 'SlideController@update']);
    $router->delete('sliders/{slider}/slide/{slide}', ['as' => 'dashboard.slide.destroy', 'uses' => 'SlideController@destroy']);
});
