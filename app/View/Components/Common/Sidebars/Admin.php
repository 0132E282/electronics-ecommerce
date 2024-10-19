<?php

namespace App\View\Components\Common\Sidebars;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Admin extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
    protected function menus()
    {
        return [
            [
                'name' => 'Dashboard',
                'children' => [
                    [
                        'name' => 'Analytical'

                    ],
                    [
                        'name' => 'E-commerce'
                    ]
                ]
            ],
            [
                'name' => 'e-commerce',
                'children' => [
                    [
                        'name' => 'Tất cả',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Danh mục',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Tags',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Thuột Tính',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'đánh giá ',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'nhản dáng ',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                ]
            ],
            [
                'name' => 'Mã giảm giá',
                'children' => [
                    [
                        'name' => 'Tấ cả',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],

                ]
            ],
            [
                'name' => 'Người dùng',
                'children' => [
                    [
                        'name' => 'Tấ cả',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Hồ sơ',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Phân quyền',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                ]
            ],
            [
                'name' => 'Dao diện',
                'children' => [
                    [
                        'name' => 'Menus',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Sliders',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Banners',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                ]
            ],
            [
                'name' => 'Cài đặt',

                'children' => [
                    [
                        'name' => 'Website',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Thanh toán',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'vai trò',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                ]
            ],
        ];
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.sidebars.admin', ['menus' => $this->menus()]);
    }
}
