<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::name('api.')->group(function () {
    Route::name('genres.')->group(function () {
        Route::get('genres', [GenreController::class, 'getGenreList'])->name('list');
    });

    Route::name('movies.')->group(function () {
        Route::get('movies', [MovieController::class, 'getMovieList'])->name('list');
        Route::get('movies/{id}', [MovieController::class, 'getMovie'])->name('get');
    });
    Route::name('AUTH.')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });
});
