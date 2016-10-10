<?php

namespace Modules\Slider\Presenters\Bootstrap;
use Illuminate\Support\Facades\View;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Presenters\SliderPresenterInterface;

class SliderPresenter implements SliderPresenterInterface
{

    public function render()
    {
        $slider = new Slider();
        $slider->system_name = 'hp_main_slider';

        $slider->slides = self::getSlides();

        $view = View::make('slider::frontend.bootstrap.slider')
        ->with([
            'slider' => $slider
        ]);

        return $view->render();
    }

    public static function getSlides()
    {
        $slide1 = new Slide;
        $slide1->title = 'Elektrokola';
        $slide1->caption = '2016';
        $slide1->image = 'http://s23.postimg.org/z2mezg04r/bikers_group.jpg';

        $slide2 = new Slide;
        $slide2->title = 'Extreme Sports';
        $slide2->caption = '2016';
        $slide2->image = 'http://s22.postimg.org/uskzeplkh/bikers_group_2.jpg';

        $slide3 = new Slide;
        $slide3->title = 'Beautiful Scenery';
        $slide3->caption = '2016';
        $slide3->image = 'http://s15.postimg.org/9wxopckd7/slide_img_3.jpg';

        $slide4 = new Slide;
        $slide4->title = 'Sports Machine !';
        $slide4->caption = '2016';
        $slide4->image = 'http://s21.postimg.org/4iul1d8af/slide_img_4.jpg';




        return [$slide1, $slide2, $slide3, $slide4];
    }

}