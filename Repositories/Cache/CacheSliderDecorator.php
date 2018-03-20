<?php

namespace Modules\Slider\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Slider\Repositories\SliderRepository;

class CacheSliderDecorator extends BaseCacheDecorator implements SliderRepository
{
    /**
     * @var SliderRepository
     */
    protected $repository;

    public function __construct(SliderRepository $slider)
    {
        parent::__construct();
        $this->entityName = 'slider.sliders';
        $this->repository = $slider;
    }

    /**
     * Get all online sliders
     * @return object
     */
    public function allOnline()
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember(
                "{$this->locale}.{$this->entityName}.allOnline",
                $this->cacheTime,
                function () {
                    return $this->repository->allOnline();
                }
            );
    }
}
