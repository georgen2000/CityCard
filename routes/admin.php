<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CardTypeController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\UserCategoryController;

Route::middleware('auth.admin')->prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin');

        Route::resource('cities', CityController::class)->except(['show']);
        Route::resource('transports', TransportController::class)->except(['show']);
        Route::resource('user_categories', UserCategoryController::class)->except(['show']);
        Route::resource('card_types', CardTypeController::class)->except(['show']);
    }
);
