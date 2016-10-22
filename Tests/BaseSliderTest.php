<?php namespace Modules\Slider\Tests;

use Faker\Factory;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Maatwebsite\Sidebar\SidebarServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider;
use Modules\Core\Providers\CoreServiceProvider;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Providers\SliderServiceProvider;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Repositories\SliderRepository;
use Orchestra\Testbench\TestCase;
use Pingpong\Modules\ModulesServiceProvider;

abstract class BaseSliderTest extends TestCase
{
    /**
     * @var SliderRepository
     */
    protected $sliderRepository;

    /**
     * @var SlideRepository
     */
    protected $slideRepository;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->resetDatabase();

        $this->sliderRepository = app(SliderRepository::class);
        $this->slideRepository = app(SlideRepository::class);
        $this->faker = Factory::create();
    }

    protected function getPackageProviders($app)
    {
        return [
            ModulesServiceProvider::class,
            CoreServiceProvider::class,
            SliderServiceProvider::class,
            LaravelLocalizationServiceProvider::class,
            SidebarServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Eloquent' => Model::class,
            'LaravelLocalization' => LaravelLocalization::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__ . '/..';
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ));
        $app['config']->set('translatable.locales', ['en', 'fr']);
    }

    private function resetDatabase()
    {
        // Relative to the testbench app folder: vendors/orchestra/testbench/src/fixture
        $migrationsPath = 'Database/Migrations';
        $artisan = $this->app->make(Kernel::class);
        // Makes sure the migrations table is created
        $artisan->call('migrate', [
            '--database' => 'sqlite',
            '--path'     => $migrationsPath,
        ]);
        // We empty all tables
        $artisan->call('migrate:reset', [
            '--database' => 'sqlite',
        ]);
        // Migrate
        $artisan->call('migrate', [
            '--database' => 'sqlite',
            '--path'     => $migrationsPath,
        ]);
    }

    /**
     * @param string $name
     * @param string $systemName
     * @return Slider
     */
    public function createSlider($name = 'Homepage Slider', $systemName = 'homepage')
    {
        $data = [
            'name' => $name,
            'system_name' => $systemName,
            'active' => true
        ];

        return $this->sliderRepository->create($data);
    }

    /**
     * @param string $name
     * @param string $systemName
     * @param int $slides number of slides to be created
     * @return Slider
     */
    public function createSliderWithSlides($name = 'Homepage Slider', $systemName = 'homepage', $slides = 2)
    {
        $slider = $this->createSlider($name, $systemName);

        for ($i = 1; $i <= $slides; $i++) {
            $this->createSlideForSlider($slider->id, $i);
        }

        return $this->sliderRepository->find($slider->id);
    }

    /**
     * Create a slide for the given Slider and position
     *
     * @param int $sliderId
     * @param int $position
     * @return Slide
     */
    protected function createSlideForSlider($sliderId, $position)
    {
        return $this->slideRepository->create($this->getSlideData($sliderId, $position));
    }

    /**
     * @param int|null $sliderId
     * @param int $position
     * @return array
     */
    protected function getSlideData($sliderId = null, $position = 1)
    {
        $title = implode(' ', $this->faker->words(3));
        $caption = implode(' ', $this->faker->words(10));
        $slug = Str::slug($title);

        return [
            'slider_id' => $sliderId,
            'position' => $position,
            'external_image_url' => sprintf("https://placeholdit.imgix.net/~text?txtsize=50&txt=%s&w=800&h=200", $title),
            'en' => [
                'title' => $title,
                'caption' => $caption,
                'uri' => $slug,
            ],
        ];
    }
}
