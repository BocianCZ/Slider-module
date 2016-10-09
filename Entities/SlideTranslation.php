<?php namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
    public $fillable = ['title', 'uri', 'url', 'status'];
    protected $table = 'slider__slide_translations';
}
