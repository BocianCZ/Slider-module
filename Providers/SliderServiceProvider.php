<?php namespace Modules\Slider\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Repositories\Cache\CacheSliderDecorator;
use Modules\Slider\Repositories\Cache\CacheSlideDecorator;
use Modules\Slider\Repositories\Eloquent\EloquentSliderRepository;
use Modules\Slider\Repositories\Eloquent\EloquentSlideRepository;

class SliderServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Register all online menus on the Pingpong/Menu package
     */
    public function boot()
    {
        $this->registerSliders();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * Register class binding
     */
    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Slider\Repositories\SliderRepository',
            function () {
                $repository = new EloquentSliderRepository(new Slider());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheSliderDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\Slider\Repositories\SlideRepository',
            function () {
                $repository = new EloquentSlideRepository(new Slide());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheSlideDecorator($repository);
            }
        );
    }

    /**
     * Register the active sliders
     */
    private function registerSliders()
    {
        if (! $this->app['asgard.isInstalled']) {
            return;
        }

    }
}
