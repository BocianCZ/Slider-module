<?php

namespace Modules\Slider\Presenters;

use Illuminate\Support\Facades\View;
use Modules\Slider\Entities\Slider;

class SliderPresenter extends AbstractSliderPresenter implements SliderPresenterInterface
{
    /**
     * renders slider.
     * @param string|Slider $slider
     * pass Slider instance to render specific slider
     * pass string to automatically retrieve slider from repository
     * @param string $template blade template to render slider
     * @return string rendered slider HTML
     */
    public function render($slider, $template = null)
    {
        if ($template === null) {
            $template = config('asgard.slider.config.template');
        }

        if (!$slider instanceof Slider) {
            $slider = $this->getSliderFromRepository($slider);
            if ($slider && $slider->active == false) {    // inactive slider must not render
                return '';
            }
        }
        if (!$slider) {
            return '';
        }

        $view = View::make($template)
            ->with([
                'slider' => $slider,
            ]);

        return $view->render();
    }

    /**
     * @param $systemName
     * @return Slider
     */
    private function getSliderFromRepository($systemName)
    {
        return $this->sliderRepository->findBySystemName($systemName);
    }
}
