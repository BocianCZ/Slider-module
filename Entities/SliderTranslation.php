<?php namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    protected $fillable = ['title', 'status'];
    protected $table = 'slider__slider_translations';
}
