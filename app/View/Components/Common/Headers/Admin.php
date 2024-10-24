<?php

namespace App\View\Components\Common\Headers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $account = Auth::user() ?? null;
        return view('components.common.headers.admin', ['account' => $account]);
    }
}
