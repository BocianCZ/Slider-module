<?php

namespace Modules\Slider\Tests;

use Modules\Slider\Entities\Slide;

class SlideRepositoryTest extends BaseSliderTest
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function can_create_slide()
    {
        $numberOfSlides = rand(1, 10);
        $slider = $this->createSliderWithSlides('Homepage Slider', 'homepage', $numberOfSlides);
        $this->assertEquals($numberOfSlides, count($slider->slides));
    }

    /**
     * this is more of a Collection test, rather than Slider
     * @test
     */
    public function can_associate_slide()
    {
        $slider = $this->createSlider();

        $slide = new Slide;
        $slide->title = $this->faker->words(3);
        $slide->caption = $this->faker->words(10);

        $slide->slider()->associate($slider);

        $this->assertEquals($slider->id, $slide->slider_id);
    }

    /**
     * @test
     */
    public function can_delete_slide()
    {
        $slideCount = rand(1, 5);
        $slider = $this->createSliderWithSlides('Homepage Slider', 'homepage_slider', $slideCount);
        $this->assertEquals($slideCount, count($slider->slides));

        foreach ($slider->slides as $slide) {
            $this->slideRepository->destroy($slide);
        }

        $sliderRetrievedAgain = $this->sliderRepository->find($slider->id);
        $this->assertEquals(0, count($sliderRetrievedAgain->slides));
    }
}
