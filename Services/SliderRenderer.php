<?php

namespace Modules\Slider\Services;

use Illuminate\Support\Facades\URL;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Entities\Slider;

class SliderRenderer
{
    /**
     * @var int Id of the slider to render
     */
    protected $sliderId;
    /**
     * @var string
     */
    private $startTag = '<div class="dd">';
    /**
     * @var string
     */
    private $endTag = '</div>';
    /**
     * @var string
     */
    private $slides = '';

    /**
     * @param Slider $slider
     * @param $slides
     * @return string
     */
    public function renderForSlider(Slider $slider, $slides)
    {
        $this->sliderId = $slider->id;

        $this->slides .= $this->startTag;
        $this->generateHtmlFor($slides);
        $this->slides .= $this->endTag;

        return $this->slides;
    }

    /**
     * Generate the html for the given items
     * @param $slides
     */
    private function generateHtmlFor($slides)
    {
        $this->slides .= '<ol class="dd-list">';
        /** @var Slide $slide */
        foreach ($slides as $slide) {
            $this->slides .= "<li class='dd-item' data-id='{$slide->id}'>";
            $editLink = route('admin.slider.slide.edit', [$this->sliderId, $slide->id]);
            $activeSlideCLass = $slide->active ? 'text-success' : 'text-red';
            $this->slides .= <<<HTML
                <div class="btn-group" role="group" aria-label="Action buttons" style="display: inline">
                    <a class="btn btn-sm btn-info" style="float:left;" href="{$editLink}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a class="btn btn-sm btn-danger jsDeleteSlide" style="float:left; margin-right: 15px;" data-item-id="{$slide->id}">
                       <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="pull-right">
                    <i class="fas fa-circle {$activeSlideCLass}" style="font-size: 20px;margin-top: 5px; margin-right: 5px;"></i>
                </div>
HTML;
            $this->slides .= "<div class='dd-handle'>{$slide->name}" . ($slide->isYoutubeVideo() ? "<i class='pull-right fa fa-youtube'></i>" : ""). "</div>";
            $this->slides .= "<div><img class='img-responsive' src='" . ($slide->getImageUrl() ?? $slide->getYoutubeVideoThumbnail($slide::YOUTUBE_THUMBNAIL_QUALITY_MEDIUM)) . "' /></div>";
            $this->slides .= '</li>';
        }
        $this->slides .= '</ol>';
    }
}
