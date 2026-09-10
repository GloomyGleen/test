<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController as ControllersTagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ControllersPostController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ControllersPostController::class, 'show'])->name('posts.single');
Route::get('/category/{slug}', [ControllersCategoryController::class, 'show'])->name('categories.single');
Route::get('/tag/{slug}', [ControllersTagController::class, 'show'])->name('tags.single');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', PostController::class);
});

Route::group(['middleware' => 'quest'], function() {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});