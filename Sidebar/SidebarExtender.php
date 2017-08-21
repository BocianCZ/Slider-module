<?php namespace Modules\Slider\Sidebar;

use Maatwebsite\Sidebar\Badge;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;
use Modules\Slider\Repositories\SliderRepository;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('slider::slider.title'), function (Item $item) {
                $item->weight(3);
                $item->icon('fa fa-bars');
                $item->route('admin.slider.slider.index');
                $item->badge(function (Badge $badge, SliderRepository $sliderRepository) {
                    $badge->setClass('bg-green');
                    $badge->setValue($sliderRepository->countAll());
                });
                $item->authorize(
                    $this->auth->hasAccess('slider.sliders.index')
                );
            });
        });

        return $menu;
    }
}
