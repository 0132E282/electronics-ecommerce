<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\User;
use App\Observers\CategoriesObserver;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Categories::observe(CategoriesObserver::class);

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
