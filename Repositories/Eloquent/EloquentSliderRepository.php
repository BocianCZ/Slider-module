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
     * Get all online menus
     * @return object
     */
    public function allOnline()
    {
        $locale = App::getLocale();

        return $this->model->whereHas('translations', function (Builder $q) use ($locale) {
            $q->where('locale', "$locale");
            $q->where('status', 1);
        })->with('translations')->orderBy('created_at', 'DESC')->get();
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
