<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return redirect()->route('post.index');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::resource('comment', CommentController::class)->except(['index', 'show', 'edit', 'create']);
});

Route::middleware(['auth', 'role:author'])->group(function () {
    Route::resource('post', PostController::class)->except(['index', 'show']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('category', CategoryController::class)->except(['index', 'show']);
    Route::resource('user', UserController::class)->except(['show', 'edit', 'update']);
});


Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
