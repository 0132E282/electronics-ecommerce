<?php

use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

Route::controller(BrandsController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'createUpdate')->name('create');
    Route::post('create', 'store')->name('create');
    Route::get('edit/{brands}', 'createUpdate')->name('edit');
    Route::put('edit/{brands}', 'edit')->name('edit');
    Route::delete('delete/{brands:id}', 'destroy')->name('destroy');
    Route::delete('delete-multiple', 'deleteMultiple')->name('delete-multiple');
    Route::patch('status/{status}/{brands:id}', 'status')->name('status');
});
