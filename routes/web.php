<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CreateNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/notes/{id}', [MomentController::class, 'detailNote'])->name('detailNote');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::view('/logs', 'pages.logs')->name('logs');

Route::view('/rules', 'pages.rules')->name('rules');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile/{name}',[ProfileController::class,'index'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/create-note', [MomentController::class, 'index'])->name('createNote');
    Route::post('/create-note', [MomentController::class, 'store'])->name('createNote.create');
    Route::delete('/delete-note/{id}', [MomentController::class, 'deleteNote'])->name('note.delete');
    Route::get('/edit-note/{id}', [MomentController::class, 'editNote'])->name('note.edit');
    Route::put('/edit-note/{id}', [MomentController::class, 'putNote'])->name('note.editNote');

    Route::get('/profile/edit/{name}',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile/edit/{name}',[ProfileController::class,'editProfile'])->name('profile.submitEdit');

    // Semua route di dalam sini otomatis terjaga oleh satpam 'auth'
});
