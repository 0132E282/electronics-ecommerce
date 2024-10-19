<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});
Route::prefix('/users')->group(base_path('routes/admin/UserRouter.php'))->name('users.');
