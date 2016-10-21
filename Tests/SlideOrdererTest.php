<?php namespace Modules\Slider\Tests;

class SlideOrdererTest extends BaseSliderTest
{
    /**
     * @var \Modules\Slider\Services\SlideOrderer
     */
    protected $slideOrderer;

    public function setUp()
    {
        parent::setUp();
        $this->slideOrderer = app('Modules\Slider\Services\SlideOrderer');
    }

    /**
     * @test
     */
    public function sorts_slides()
    {
        $this->assertTrue(false);
    }

}
