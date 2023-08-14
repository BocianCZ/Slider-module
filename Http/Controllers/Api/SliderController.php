<?php

namespace Modules\Slider\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Slider\Repositories\SliderRepository;

class SliderController extends Controller
{
    public function __construct (
        private SliderRepository $sliderRepository,
    ){}

    public function index()
    {
        return $this->sliderRepository->allOnline();
    }
}