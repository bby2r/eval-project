<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\UserViewedPostMiddleware;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::middleware(UserViewedPostMiddleware::class)->get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

//Route::group([])
//Route::post('/login', [JWTAuthController::class, 'login'])->name('login');
//Route::post('/register', [JWTAuthController::class, 'register'])->name('register');

Route::get('/stats', [PostController::class, 'stats'])->name('posts.stats');
