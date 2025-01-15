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

Route::get('/login', [JWTAuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [JWTAuthController::class, 'login'])->name('login');
Route::get('/register', [JWTAuthController::class, 'registerPage'])->name('register.page');
Route::post('/register', [JWTAuthController::class, 'register'])->name('register');
