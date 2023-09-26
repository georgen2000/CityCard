<?php

use App\Http\Controllers\ProfileController;
use App\Models\Card;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Helpers\Common;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, ['ua', 'en'])) {
//         app()->setLocale($locale);
//     }

//     return view('welcome');
// });

Route::prefix(Common::getLocale())->middleware('localized')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::middleware('auth.user')->group(function () {
            Route::get('dashboard', [CardController::class, 'index'])->name('dashboard');
            Route::post('dashboard', [CardController::class, 'store'])->name('cards.store');
            Route::delete('cards/{card}', [CardController::class, 'destroy'])->name('cards.destroy');
            Route::get('history/{card}', [CardController::class, 'history'])->name('history');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
    require __DIR__ . '/admin.php';
});
