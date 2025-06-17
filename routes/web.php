<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::prefix('tasks')->name('task.')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/', [TodoController::class, 'store'])->name('store');
    Route::put('/{id}', [TodoController::class, 'update'])->name('update');
    Route::patch('/{id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/{id}', [TodoController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';