<?php

namespace Modules\Slider\Tests;

class SliderRepositoryTest extends BaseSliderTest
{
    /**
     * @test
     */
    public function can_create_slider()
    {
        $slider = $this->createSlider('Homepage Slider', 'homepage');

        $this->assertEquals(1, $this->sliderRepository->find($slider->id)->count());
        $this->assertEquals($slider->name, $this->sliderRepository->find($slider->id)->name);
        $this->assertEquals($slider->system_name, $this->sliderRepository->find($slider->id)->system_name);
    }

    /**
     * @test
     */
    public function can_delete_slider()
    {
        $slider = $this->createSlider('Homepage Slider', 'homepage');
        $this->assertEquals(1, $this->sliderRepository->find($slider->id)->count());
        $this->sliderRepository->destroy($slider);
        $this->assertNull($this->sliderRepository->find($slider->id));
    }
}
