<?php

namespace Modules\Slider\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Slider\Repositories\SlideRepository;

class CacheMSlideDecorator extends BaseCacheDecorator implements SlideRepository
{
    /**
     * @var SlideRepository
     */
    protected $repository;

    public function __construct(SlideRepository $slide)
    {
        parent::__construct();
        $this->entityName = 'slider.slides';
        $this->repository = $slide;
    }
}
