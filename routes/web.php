<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::delete('posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');
    Route::post('follow/{user}', [FollowerController::class, 'store'])->name('follow');
    Route::delete('unfollow/{user}', [FollowerController::class, 'destroy'])->name('unfollow');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
});


require __DIR__.'/auth.php';
