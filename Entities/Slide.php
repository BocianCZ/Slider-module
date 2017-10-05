<?php

namespace Modules\Slider\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Page\Entities\Page;

class Slide extends Model
{
    use Translatable, MediaRelation;

    public $translatedAttributes = [
        'title',
        'caption',
        'uri',
        'url',
        'active',
        'custom_html',
    ];

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
        'external_image_url',
        'custom_html',
    ];
    protected $table = 'slider__slides';

    /**
     * @var string
     */
    private $linkUrl;

    /**
     * @var string
     */
    private $imageUrl;

    public function slider()
    {
        return $this->belongsTo(Slider::class);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * returns slider image src
     * @return string|null full image path if image exists or null if no image is set
     */
    public function getImageUrl()
    {
        if ($this->imageUrl === null) {
            if (!empty($this->external_image_url)) {
                $this->imageUrl = $this->external_image_url;
            } elseif (isset($this->files[0]) && !empty($this->files[0]->path)) {
                $this->imageUrl = $this->files[0]->path;
            }
        }

        return $this->imageUrl;
    }

    /**
     * returns slider link URL
     * @return string|null
     */
    public function getLinkUrl()
    {
        if ($this->linkUrl === null) {
            if (!empty($this->url)) {
                $this->linkUrl = $this->url;
            } elseif (!empty($this->uri)) {
                $this->linkUrl = '/' . app()->getLocale() . '/' . $this->uri;
            } elseif (!empty($this->page)) {
                $this->linkUrl = route('page', ['uri' => $this->page->slug]);
            }
        }

        return $this->linkUrl;
    }
}
