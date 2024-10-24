<?php

use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::controller(usersController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'createUpdate')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('profile/{user?}', 'profile')->name('profile');
    Route::get('{user:id}', 'createUpdate')->name('edit');
    Route::put('{user:id}', 'edit')->name('edit');
    Route::delete('delete-multiple', 'deleteMultiple')->name('delete-multiple');
    Route::delete('{user:id}', 'destroy')->name('destroy');
    Route::patch('{type}/{user}', 'locked')->name('locked');
});
