<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'system_name',
        'active',
    ];

    protected $table = 'slider__sliders';

    public function slides()
    {
        return $this->hasMany(Slide::class)->orderBy('position', 'asc');
    }
}
