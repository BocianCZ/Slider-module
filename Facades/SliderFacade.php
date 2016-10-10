<?php

namespace Modules\Slider\Facades;

use Illuminate\Support\Facades\Facade;


class SliderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Modules\Slider\Presenters\Bootstrap\SliderPresenter';
    }

}