<?php

namespace Modules\Slider\Tests;

use Modules\Slider\Presenters\SliderPresenter;

class SliderPresenterTest extends BaseSliderTest
{
    /**
     * @var SliderPresenter
     */
    private $sliderPresenter;

    public function setUp()
    {
        parent::setUp();
        $this->sliderPresenter = app('Modules\Slider\Presenters\SliderPresenter');
    }

    /**
     * @test
     */
    public function renders_output_for_stored_slider()
    {
        $systemName = 'homepage_slider';
        $this->createSliderWithSlides('Homepage Slider', $systemName, 5);
        $renderedHtml = $this->sliderPresenter->render($systemName);
        $this->assertStringStartsWith(sprintf('<div id="%s"', $systemName), $renderedHtml);
    }

    /**
     * @test
     */
    public function renders_output_for_given_slider()
    {
        $systemName = 'homepage_slider_instance';
        $slider = $this->createSliderWithSlides('Homepage Slider', $systemName, 5);
        $renderedHtml = $this->sliderPresenter->render($slider);
        $this->assertStringStartsWith(sprintf('<div id="%s"', $systemName), $renderedHtml);
    }
}
