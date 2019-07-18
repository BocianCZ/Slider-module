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

    /*
    |--------------------------------------------------------------------------
    | Slide Images
    |--------------------------------------------------------------------------
    | By default, there is a single image per slider. But sometimes it is useful
    | to have multiple different images for slide, for example different image
    | on hover effect, etc.
    | this is just an array / list of different media zones that will be used
    */
    'slide-images' => [
        'slideImage',
    ]
];
