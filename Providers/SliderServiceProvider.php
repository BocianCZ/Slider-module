<?php namespace Modules\Slider\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Presenters\SliderPresenter;
use Modules\Slider\Repositories\Cache\CacheSliderDecorator;
use Modules\Slider\Repositories\Cache\CacheSlideDecorator;
use Modules\Slider\Repositories\Eloquent\EloquentSliderRepository;
use Modules\Slider\Repositories\Eloquent\EloquentSlideRepository;
use Modules\Core\Traits\CanPublishConfiguration;

class SliderServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;

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
     * Register all online sliders on the Pingpong/Menu package
     */
    public function boot()
    {
        $this->publishConfig('slider', 'config');
        $this->publishConfig('slider', 'permissions');

        $this->registerSliders();
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'slider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('sliders');
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

        $this->app->bind('Modules\Slider\Presenters\SliderPresenter');
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
