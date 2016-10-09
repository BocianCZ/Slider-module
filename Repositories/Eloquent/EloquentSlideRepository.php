<?php namespace Modules\Slider\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Repositories\SlideRepository;

class EloquentSlideRepository extends EloquentBaseRepository implements SlideRepository
{
    public function create($data)
    {
        $slide = $this->model->create($data);

        return $slide;
    }

    public function update($menuItem, $data)
    {
        $menuItem->update($data);

        return $menuItem;
    }

}
