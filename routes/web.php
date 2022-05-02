<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\URL;

// use App\Models\Build;
// use App\Models\Category;
// use App\Models\Favorite;
// use App\Models\Feature;
// use App\Models\Theme;
// use App\Models\User;

use Illuminate\Http\Request;

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

Route::middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/builds/new', [BuildController::class, 'create'])->name('build.create');
    Route::post('/', [BuildController::class, 'store'])->name('build.store');
    Route::get('/{id}/edit', [BuildController::class, 'edit'])->name('build.edit');
    Route::post('/builds/{id}', [BuildController::class, 'update'])->name('build.update');
    Route::post('/builds/delete/{id}', [BuildController::class, 'delete'])->name('build.delete');

    Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comments/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/comments/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorites/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::post('/favorites/delete/{id}', [FavoriteController::class, 'delete'])->name('favorite.delete');
});

Route::get('/profile/{id}', [ProfileController::class, 'other'])->name('profile.other');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.create');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', [BuildController::class, 'index'])->name('build.index');
Route::get('/search', [BuildController::class, 'search'])->name('build.search');
Route::get('/results', [BuildController::class, 'result'])->name('build.result');

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}