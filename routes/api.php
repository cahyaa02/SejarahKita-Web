<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\LeaderboardController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\PlayingHistoryController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login']);
Route::post('refresh', [LoginController::class, 'refresh']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('playinghistories', PlayingHistoryController::class);
    Route::apiResource('leaderboards', LeaderboardController::class);
    Route::apiResource('levels', LevelController::class);
    Route::apiResource('questions', QuestionController::class);
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
