<?php

namespace Modules\Slider\Presenters;

use Modules\Slider\Entities\Slider;

interface SliderPresenterInterface
{
    public function render(Slider|string $slider): string;
}
