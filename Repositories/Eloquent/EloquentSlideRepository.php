<?php namespace Modules\Slider\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Events\SlideWasCreated;

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

        event(new SlideWasCreated($slide, $data));

        return $slide;
    }


    public function update($menuItem, $data)
    {
        $menuItem->update($data);

        return $menuItem;
    }

}
