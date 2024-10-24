<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::name('site.')->prefix('/')->group(function () {

    // trang thông báo
    Route::name('alert')->get('{any}/alert', function (Request $request) {
        return view('pages.site.alert', ['type' => $request->type]);
    })->where('any', '.*');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::name('admin.')->prefix('admin')->group(base_path('routes/admin/index.php'));
Auth::routes();
