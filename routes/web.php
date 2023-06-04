<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LikeDislikeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArticleController::class, 'index']);
Route::post('articles/{article}/like', [LikeDislikeController::class, 'like'])->name('like');
Route::post('articles/{article}/dislike', [LikeDislikeController::class, 'dislike'])->name('dislike');
