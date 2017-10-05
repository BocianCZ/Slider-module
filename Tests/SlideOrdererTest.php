<?php

namespace Modules\Slider\Tests;

class SlideOrdererTest extends BaseSliderTest
{
    /**
     * @var \Modules\Slider\Services\SlideOrderer
     */
    protected $slideOrderer;

    public function setUp()
    {
        parent::setUp();
        $this->slideOrderer = app('Modules\Slider\Services\SlideOrderer');
    }

    /**
     * @test
     */
    public function sorts_slides()
    {
        $slider = $this->createSliderWithSlides('Sorting Test Slider', 'sorting_slider', 10);

        $newOrderArray = [];
        foreach ($slider->slides->shuffle() as $newOrder => $slide) {
            $newOrderArray[] = ['id' => $slide->id];
        }

        $this->slideOrderer->handle(json_encode($newOrderArray));

        $reloadedSlider = $this->sliderRepository->find($slider->id);
        $newOrderCheckArray = [];
        foreach ($reloadedSlider->slides as $slide) {
            $newOrderCheckArray[] = ['id' => $slide->id];
        }

        $this->assertEquals($newOrderArray, $newOrderCheckArray);
    }
}
