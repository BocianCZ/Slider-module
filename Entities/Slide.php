<?php

namespace Modules\Slider\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Page\Entities\Page;

/**
 * Class Slide
 * @package Modules\Slider\Entities
 * @property int $id
 * @property int $slider_id
 * @property int $page_id
 * @property int $position
 * @property string $target
 * @property string $title
 * @property string $caption
 * @property string $uri
 * @property string $url
 * @property bool $active
 * @property string $external_image_url
 * @property string $youtube_video_url
 * @property string $custom_html
 * @property File[]|Collection $files
 */
class Slide extends Model
{
    use Translatable, MediaRelation;

    const YOUTUBE_THUMBNAIL_QUALITY_DEFAULT = 'default';
    const YOUTUBE_THUMBNAIL_QUALITY_STANDARD = 'sddefault';
    const YOUTUBE_THUMBNAIL_QUALITY_MEDIUM = 'mqdefault';
    const YOUTUBE_THUMBNAIL_QUALITY_HIGH = 'hqdefault';
    const YOUTUBE_THUMBNAIL_QUALITY_MAX = 'maxresdefault';

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
        'name',
        'title',
        'caption',
        'uri',
        'url',
        'active',
        'external_image_url',
        'youtube_video_url',
        'custom_html',
    ];

    protected $table = 'slider__slides';

    /**
     * @var string
     */
    private $linkUrl;

    /**
     * @var array
     */
    private $imageUrl = [];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    /**
     * Check if page_id is empty and returning null instead empty string
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
     *
     * @param int $imageNumber
     * @return string|null full image path if image exists or null if no image is set
     */
    public function getImageUrl(int $imageNumber = 0)
    {
        if (!isset($this->imageUrl[$imageNumber])) {
            if (!empty($this->external_image_url)) {
                $this->imageUrl[$imageNumber] = $this->external_image_url;
            } elseif (isset($this->files[$imageNumber]) && !empty($this->files[$imageNumber]->path)) {
                $this->imageUrl[$imageNumber] = $this->files[$imageNumber]->path;
            }
        }

        return $this->imageUrl[$imageNumber] ?? null;
    }

    /**
     * return actual File object of an image
     * @param int $imageNumber
     * @return mixed|File
     */
    public function getImage(int $imageNumber = 0)
    {
        if (isset($this->files[$imageNumber])) {
            return $this->files[$imageNumber];
        }
    }

    /**
     * return actual File object of an image by zone name
     * @param string $zone
     * @return mixed|File
     */
    public function getImageByZone(string $zone)
    {
        return $this->filesByZone($zone)->first();
    }

    /**
     * return actual File object of an image by zone name
     * @param string $zone
     * @return mixed|File
     */
    public function getImageUrlByZone(string $zone)
    {
        $file = $this->getImageByZone($zone);
        if ($file) {
            return $file->path;
        }
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

    /**
     * @return bool
     */
    public function isYoutubeVideo()
    {
        return !empty($this->youtube_video_url);
    }

    /**
     * @return string|null
     */
    public function getYoutubeVideoId()
    {
        preg_match("/https:\/\/www\.youtube\.com\/watch\?v=([a-z0-9].*)/i", $this->youtube_video_url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    public function getYoutubeVideoThumbnail($quality = self::YOUTUBE_THUMBNAIL_QUALITY_DEFAULT)
    {
        return 'https://img.youtube.com/vi/' . $this->getYoutubeVideoId() . '/' . $quality . '.jpg';
    }


}
