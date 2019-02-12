<?php

namespace Modules\Slider\Events;

use Modules\Media\Contracts\StoringMedia;
use Modules\Slider\Entities\Slide;

class SlideWasCreatedOrUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;

    /**
     * @var Slide
     */
    public $slide;

    public function __construct($slide, array $data)
    {
        $this->data = $data;
        $this->slide = $slide;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->slide;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
