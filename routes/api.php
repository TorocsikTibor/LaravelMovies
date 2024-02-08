<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/watchlist/create', [WatchlistController::class, 'create'])->name('createWatchlist');
Route::get('/watchlist/show/{id}', [WatchlistController::class, 'show']);
Route::post('/watchlist/movie/add', [WatchlistController::class, 'addMovie']);
Route::get('/watchlist/movie/list', [WatchlistController::class, 'getWatchlist']);
Route::post('/watchlist/member/add', [WatchlistController::class, 'addMember']);
Route::get('/movie', [MovieController::class, 'getAllMovie']);
