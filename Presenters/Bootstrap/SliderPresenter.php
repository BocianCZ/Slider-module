<?php

namespace Modules\Slider\Presenters\Bootstrap;
use Illuminate\Support\Facades\View;
use Modules\Slider\Presenters\SliderPresenterInterface;
use Modules\Slider\Presenters\AbstractSliderPresenter;

class SliderPresenter extends AbstractSliderPresenter implements SliderPresenterInterface
{

    public function render($systemName)
    {
        $slider = $this->sliderRepository->findBySystemName($systemName);
        if (!$slider) {
            return '';
        }

        $view = View::make('slider::frontend.bootstrap.slider')
            ->with([
                'slider' => $slider
            ]);

        return $view->render();
    }

}