<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel UI)
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

/*
|--------------------------------------------------------------------------
| Books Routes
|--------------------------------------------------------------------------
*/
Route::get('/books', [BookController::class, 'index'])->name('books.index');

/*
|--------------------------------------------------------------------------
| Authenticated Users Only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Books CRUD
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // تغيير حالة الكتاب    
    Route::post('/books/{book}/status', [BookController::class, 'changeStatus'])->name('books.status');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Google Authentication Routes
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])
    ->name('auth.google');
    
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');

// Link/Unlink Google Account (للمستخدمين المسجلين)
Route::middleware(['auth'])->group(function () {
    Route::post('/auth/google/link', [App\Http\Controllers\Auth\GoogleController::class, 'linkGoogleAccount'])
        ->name('auth.google.link');
        
    Route::post('/auth/google/unlink', [App\Http\Controllers\Auth\GoogleController::class, 'unlinkGoogleAccount'])
        ->name('auth.google.unlink');
});

// Show book (ALWAYS LAST)
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');