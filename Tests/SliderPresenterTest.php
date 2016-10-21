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
        $slider = $this->createSliderWithSlides('Homepage Slider', $systemName, 5);
        $renderedHtml = $this->sliderPresenter->render($systemName);

        dump($renderedHtml);
        exit;
        $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function renders_output_for_given_slider()
    {
        $this->assertTrue(false);
    }
}