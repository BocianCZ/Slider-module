<?php namespace Modules\Slider\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Repositories\SliderRepository;

class EloquentSliderRepository extends EloquentBaseRepository implements SliderRepository
{
    public function create($data)
    {
        $menu = $this->model->create($data);

        return $menu;
    }

    public function update($menu, $data)
    {
        $menu->update($data);

        return $menu;
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * Get all available sliders
     * @return object
     */
    public function allOnline()
    {
        return $this->model->where('active', '=', true)
            ->orderBy('created_at', 'DESC')
            ->get();
    }


    /**
     * @param string $systemName
     * @return Slider
     */
    public function findBySystemName($systemName)
    {
        return $this->model->where('system_name', '=', $systemName)->first();
    }
}
