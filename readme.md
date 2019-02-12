# Slider Module

## IMPORTANT: Slider Module for AsgardCMS v1 and v2 is no longer maintained
For Asgard v1, use `0.x` tagged releases, for Asgard v2 use `2.x` tagged releases.
Please upgrade Asgard to v3 if you wish to use the latest features (see [changelog in releases](https://github.com/BocianCZ/slider-module/releases) for details)

## Special Thanks
to Nicolas Widart for [AsgardCMS](https://github.com/AsgardCms) and his [Menu Module](https://github.com/AsgardCms/Menu), that was used as a foundation for the Slider Module.
All other contributors to this module

## Installation
You can install Slider module using composer:
`composer require bociancz/slider-module`

After the module is installed, you have to install Slider migrations `php artisan module:migrate Slider`
and give yourself access in AsgardCMS (using Roles/Permissions). 
New Slider item will appear in the Sidebar

## Usage

### Prerequisites
By default, Slider module is created using [Bootstrap Carousel](https://getbootstrap.com/docs/4.0/components/carousel/)
so make sure you have all prerequisites loaded for standard Bootstrap carousel (Bootstrap Carousel CSS and JS)

### Basic Usage
You can create basic Slider using the AsgardCMS admin interface - you can create and name your slider
(pay attention to the **System Name** field here, it is used later for rendering), and create individual
slides. Slides can be linked to images in the Media module, or have URL pointing to external image.
They can also contain hyperlink to any page on the site, fixed URI or URL.

When the slider is created, you can render it in your template using `{!! Slider::render('slider_system_name') !}}`
 
### Advanced Usage

#### Use your own slider template
If you want to change rendering of your slider, use custom HTML, CSS classes, etc, you can pass a Blade template
name as a second parameter to the `render()` method, i.e.
`{!! Slider::render('slider_system_name', 'slider/my-own-slider') !}}`

Template may look like this:
```php
{-- Themes/MyTheme/views/slider/my-own-slider.blade.php --}
<div id="{{ $slider->system_name }}" class="my-own-slider-class">

    @foreach($slider->slides as $index => $slide)
        <div class="slide">
            <a href="{{ $slide->getLinkUrl() }}">
                <img src="{{ $slide->getImageUrl() }}" />
            </a>
        </div>
    @endforeach
    
</div>
```
You will have `Modules\Slider\Entities\Slider` instance available in the `$slider` variable

#### Provide your own Slider instance
You can also pass a `Modules\Slider\Entities\Slider` instance as a first parameter instead of the
slider `system_name` to render dynamically created slider.

First, create instance of your slider and add slides in your controller and pass it to the view
```php
<?php
...
// import classes needed to create your own instance
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\Slide;

class HomepageController {
    ...
    /**
     * controller method
     */
    public function displayHomepage()
    {
        // make a new Slider instance
        $mySlider = new Slider;
        $mySlider ->system_name = 'custom_slider';
        
        // create slide 1
        $slide1 = new Slide;
        $slide1->title = 'First Slide';
        $slide1->caption = 'First slide text';
        $slide1->external_image_url = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=Slide1&w=800&h=300';
        
        // create slide 2
        $slide2 = new Slide;
        $slide2->title = 'Second Slide';
        $slide2->caption = 'Second slide text';
        $slide2->external_image_url = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=Slide2&w=800&h=300';
        
        // add slides to slider
        $mySlider->slides->add($slide1);
        $mySlider->slides->add($slide2);
        
        // render view
        return View::make('homepage')
            ->with('mySlider', $mySlider);
    }
    
```

then, inside of the `homepage.blade.php` template, you can render slider using `{!! Slider::render($mySlider) !!}`

#### Using Youtube video on a slide background (Bootstrap4 only supported)
You have the option to provide a Youtube video link for each slide. When using a default Bootstrap 4 template, this
video will play on a background.

If image is provided at the same time, it will be displayed as a slide background before the video player loads (delay
is set to 2 seconds by default)

All styles and javascripts are contained in the blade template (youtube-video-slide.blade.php)
see https://www.powderkegwebdesign.com/implementing-youtube-background-videos/ for the original solution

**!!! When using a video on the background, you can currently only use it on a single slide. Videos on more than one
slide will not play !!!**

## Resources

- [License](LICENSE.md)
- [Asgard Documentation](http://asgardcms.com/docs/)
