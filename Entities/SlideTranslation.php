<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
    public $fillable = [
        'title',
        'caption',
        'uri',
        'url',
        'link_text',
        'active',
        'custom_html',
    ];

    protected $table = 'slider__slide_translations';
}
