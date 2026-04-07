<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// CRUD routes
Route::resource('posts', PostController::class);

// Restore soft deleted post
Route::post('/posts/{id}/restore', [PostController::class, 'restore']);

// Store new comment for a post
Route::post('/posts/{id}/comments', [PostController::class, 'storeComment']);