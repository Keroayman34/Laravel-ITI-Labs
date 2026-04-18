<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


// Web Routes


// Home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Breeze default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Routes that require authentication
Route::middleware('auth')->group(function () {

    // User profile routes (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts CRUD routes
    Route::resource('posts', PostController::class);

    // Restore soft-deleted post
    Route::post('/posts/{id}/restore', [PostController::class, 'restore'])
        ->name('posts.restore');

    // Store comment for a post
    Route::post('/posts/{id}/comments', [PostController::class, 'storeComment'])
        ->name('posts.comments.store');
});


// Authentication routes (login, register, logout)
require __DIR__.'/auth.php';