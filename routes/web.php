<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//* Game
Route::resource('game', GameController::class);

//* Leaderboard
Route::resource('leaderboard', LeaderboardController::class);

//* Home & Profile
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);

        Route::get('admin/profile', [AdminController::class, 'edit'])->name('admin.profile');
    });

    Route::middleware(['user'])->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('user');

        Route::get('profile', [StudentController::class, 'edit'])->name('profile');

        Route::get('playing-history', [StudentController::class, 'show'])->name('playing-history');
    });
});
