<?php

namespace Modules\Slider\Presenters\Bootstrap;
use Illuminate\Support\Facades\View;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Presenters\SliderPresenterInterface;
use Modules\Slider\Presenters\AbstractSliderPresenter;

class SliderPresenter extends AbstractSliderPresenter implements SliderPresenterInterface
{

    /**
     * @param string|Slider $slider
     * @return string
     */
    public function render($slider)
    {
        if (!$slider instanceof Slider) {
            $slider = $this->getSliderFromRepository($slider);
            if (!$slider) {
                return '';
            }
        }


        $view = View::make('slider::frontend.bootstrap.slider')
            ->with([
                'slider' => $slider
            ]);

        return $view->render();
    }


    private function getSliderFromRepository($systemName)
    {
        return $this->sliderRepository->findBySystemName($systemName);
    }
}