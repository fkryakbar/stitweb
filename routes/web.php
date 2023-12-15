<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostsController;
use App\Livewire\Admin\Comment;
use App\Livewire\Category;
use App\Livewire\Home;
use App\Livewire\ReadPost;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/category/{key}', Category::class)->name('category');
Route::get('/read/{slug}', ReadPost::class);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::post('/posts', [PostsController::class, 'store']);
    Route::get('/posts/{slug}', [PostsController::class, 'edit']);
    Route::post('/posts/{slug}', [PostsController::class, 'update']);
    Route::get('/posts/{slug}/delete', [PostsController::class, 'delete']);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'edit']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::get('/categories/{id}/delete', [CategoryController::class, 'delete']);


    Route::get('/comments', Comment::class)->name('comments');

    Route::get('/media', [MediaController::class, 'index'])->name('media');
    Route::post('/media', [MediaController::class, 'store']);
    Route::get('/media/{id}/delete', [MediaController::class, 'delete']);
});
