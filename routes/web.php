<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/register', [RegisterController::class, 'index'])->name('registration.index');
Route::post('/register', [RegisterController::class, 'register'])->name('registration.create');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/', [BuildController::class, 'index'])->name('build.index');
Route::get('/{id}', [BuildController::class, 'show'])->name('build.show');

Route::get('/new', [BuildController::class, 'create'])->name('build.create');
Route::post('/', [BuildController::class, 'store'])->name('build.store');
Route::get('/{id}/edit', [BuildController::class, 'edit'])->name('build.edit');
Route::post('/{id}', [BuildController::class, 'update'])->name('build.update');

Route::get('/profile/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/profile', [FavoriteController::class, 'delete'])->name('favorite.delete');

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}