<?php

return [
    'name' => 'Sliders',

    /*
    |--------------------------------------------------------------------------
    | Array of middleware that will be applied on the page module front end routes
    |--------------------------------------------------------------------------
    */
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Slider template
    |--------------------------------------------------------------------------
    | You can define your own slider frontend for this module.
    | Set this to valid blade view. Default is bootstrap 3:
    | 'template' => 'slider::frontend.bootstrap.slider'
    */
    'template' => 'slider::frontend.bootstrap4.slider',
];
