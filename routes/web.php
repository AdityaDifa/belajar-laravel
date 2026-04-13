<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CreateNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\RegisterController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/create-note', [CreateNoteController::class, 'index'])->name('createNote');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::resource('moments', MomentController::class);
