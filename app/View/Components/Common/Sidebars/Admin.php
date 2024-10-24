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
                'route' => '',
                'children' => [
                    [
                        'name' => 'Analytical',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',

                    ],
                    [
                        'name' => 'E-commerce',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ]
                ]
            ],
            [
                'name' => 'e-commerce',
                'route' => '',
                'children' => [
                    [
                        'name' => 'Sản phẩm',
                        'route' => 'admin.dashboard.submenu1',
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Danh mục',
                        'route' => route('admin.categories.index', ['type' => 'products']),
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Thương hiệu',
                        'route' => route('admin.brands.index'),
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
                'route' => '',
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
                'route' => '',
                'children' => [
                    [
                        'name' => 'Tấ cả',
                        'route' => route('admin.users.index'),
                        'icon' => 'fas fa-box',
                    ],
                    [
                        'name' => 'Hồ sơ',
                        'route' =>  route('admin.users.profile'),
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
                'route' => '',
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
