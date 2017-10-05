<?php

namespace Modules\Slider\Presenters;

interface SliderPresenterInterface
{
    /**
     * @param string $sliderName
     * @return string rendered slider
     */
    public function render($sliderName);
}
