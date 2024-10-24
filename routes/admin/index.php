<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('authAdmin')->group(function () {
    Route::prefix('/')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    Route::name('users.')->prefix('users')->group(base_path('routes/admin/UserRouter.php'));
    Route::name('brands.')->prefix('brands')->group(base_path('routes/admin/BrandsRoute.php'));
    Route::name('categories.')->prefix('{type}/categories')->group(base_path('routes/admin/CategoriesRoute.php'))->where('type', '^(products|blogs)$');
});


Route::get('login', function () {
    return view('auth.login-admin');
})->name('login');
