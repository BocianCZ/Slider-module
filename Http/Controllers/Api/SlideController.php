<?php

namespace Modules\Slider\Http\Controllers\Api;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Services\SlideOrderer;

class SlideController extends Controller
{
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @var SlideOrderer
     */
    private $slideOrderer;

    /**
     * @var SlideRepository
     */
    private $slide;

    public function __construct(SlideOrderer $slideOrderer, Repository $cache, SlideRepository $slide)
    {
        $this->cache = $cache;
        $this->slideOrderer = $slideOrderer;
        $this->slide = $slide;
    }

    /**
     * Update all slides
     * @param Request $request
     */
    public function update(Request $request)
    {
        $this->cache->tags('slides')->flush();

        $this->slideOrderer->handle($request->get('slider'));
    }

    /**
     * Delete a slide
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $slide = $this->slide->find($request->get('slide'));

        if (!$slide) {
            return Response::json(['errors' => true]);
        }

        $this->slide->destroy($slide);

        return Response::json(['errors' => false]);
    }
}
