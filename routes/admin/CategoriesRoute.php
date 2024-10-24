<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoriesController::class)->group(function () {
    Route::get('create', 'createUpdate')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('edit/{categories}', 'createUpdate')->name('edit');
    Route::put('edit/{categories}', 'edit')->name('edit');
    Route::get('{categories?}', 'index')->name('index');
    Route::delete('delete-multiple', 'deleteMultiple')->name('delete-multiple');
    Route::delete('delete/{categories:id}', 'destroy')->name('destroy');
    Route::patch('{status}/{categories:id?}', 'status')->name('status');
});
