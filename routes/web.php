<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FavoriteController;

use Illuminate\Support\Facades\URL;

use App\Models\Build;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Feature;
use App\Models\Theme;
use App\Models\User;

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
});

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register.create');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', [BuildController::class, 'index'])->name('build.index');
Route::get('/search', [BuildController::class, 'search'])->name('build.search');
Route::get('/results', [BuildController::class, 'result'])->name('build.result');
// Route::get('/{id}', [BuildController::class, 'show'])->name('build.show');

Route::get('/builds/new', [BuildController::class, 'create'])->name('build.create');
Route::post('/', [BuildController::class, 'store'])->name('build.store');
Route::get('/{id}/edit', [BuildController::class, 'edit'])->name('build.edit');
Route::post('/{id}', [BuildController::class, 'update'])->name('build.update');

Route::post('/profile/favorites', [FavoriteController::class, 'store'])->name('favorite.store');
Route::get('/profile/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
// Route::post('/profile', [FavoriteController::class, 'delete'])->name('favorite.delete');

// Route::post('/profile', [CommentController::class])

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}