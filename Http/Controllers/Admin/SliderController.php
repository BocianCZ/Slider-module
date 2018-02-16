<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Http\Requests\CreateSliderRequest;
use Modules\Slider\Http\Requests\UpdateSliderRequest;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Repositories\SliderRepository;
use Modules\Slider\Services\SliderRenderer;

class SliderController extends AdminBaseController
{
    /**
     * @var SliderRepository
     */
    private $slider;

    /**
     * @var SlideRepository
     */
    private $slide;

    /**
     * @var SliderRenderer
     */
    private $sliderRenderer;

    public function __construct(
        SliderRepository $slider,
        SlideRepository $slide,
        SliderRenderer $sliderRenderer
    ) {
        parent::__construct();
        $this->slider = $slider;
        $this->slide = $slide;
        $this->sliderRenderer = $sliderRenderer;
    }

    public function index()
    {
        $sliders = $this->slider->all();

        return view('slider::admin.sliders.index')
            ->with([
                'sliders' => $sliders,
            ]);
    }

    public function create()
    {
        return view('slider::admin.sliders.create');
    }

    public function store(CreateSliderRequest $request)
    {
        $this->slider->create($request->all());

        return redirect()->route('admin.slider.slider.index')->withSuccess(trans('slider::messages.slider created'));
    }

    public function edit(Slider $slider)
    {
        $slides = $slider->slides;
        $sliderStructure = $this->sliderRenderer->renderForSlider($slider, $slides);

        return view('slider::admin.sliders.edit')
            ->with([
                'slider' => $slider,
                'slides' => $sliderStructure,
            ]);
    }

    public function update(Slider $slider, UpdateSliderRequest $request)
    {
        $this->slider->update($slider, $request->all());

        return redirect()->route('admin.slider.slider.index')->withSuccess(trans('slider::messages.slider updated'));
    }

    public function destroy(Slider $slider)
    {
        $this->slider->destroy($slider);

        return redirect()->route('admin.slider.slider.index')->withSuccess(trans('slider::messages.slider deleted'));
    }
}
