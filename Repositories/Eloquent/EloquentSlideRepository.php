<?php

namespace Modules\Slider\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Events\SlideWasCreatedOrUpdated;
use Modules\Slider\Repositories\SlideRepository;

class EloquentSlideRepository extends EloquentBaseRepository implements SlideRepository
{
    /**
     * Override for add the event on create and link media file
     *
     * @param mixed $data Data from POST request form
     *
     * @return object The created entity
     */
    public function create($data)
    {
        $slide = parent::create($data);

        event(new SlideWasCreatedOrUpdated($slide, $data));

        return $slide;
    }

    public function update($slide, $data)
    {
        parent::update($slide, $data);

        event(new SlideWasCreatedOrUpdated($slide, $data));

        return $slide;
    }
}
