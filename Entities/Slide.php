<?php namespace Modules\Slider\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Slide extends Model
{
    use Translatable, MediaRelation;

    public $translatedAttributes = ['title', 'uri', 'url', 'status'];
    protected $fillable = [
        'slider_id',
        'page_id',
        'position',
        'target',
        'title',
        'caption',
        'uri',
        'url',
        'active',
        'external_image_url'
    ];
    protected $table = 'slider__slides';

    public function slider()
    {
        return $this->belongsTo('Modules\Slider\Entities\Slider');
    }

    /**
     * Check if page_id is empty and returning null instead empty string
     * @return number
     */
    public function setPageIdAttribute($value)
    {
        $this->attributes['page_id'] = !empty($value) ? $value : null;
    }

    /**
     * returns slider image src
     * @return string|null full image path if image exists or null if no image is set
     */
    public function getImageUrl()
    {
        if (!empty($this->external_image_url)) {
            return $this->external_image_url;
        } elseif (isset($this->files[0]) && !empty($this->files[0]->path)) {
            return $this->files[0]->path;
        } else {
            return null;
        }
    }
}
