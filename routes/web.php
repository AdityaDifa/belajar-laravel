<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CreateNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\RegisterController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/notes/{id}', [MomentController::class, 'detailNote'])->name('detailNote');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::view('/rules', 'pages.rules')->name('rules');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/create-note', [MomentController::class, 'index'])->name('createNote');
    Route::post('/create-note', [MomentController::class, 'store'])->name('createNote.create');
    Route::delete('/delete-note/{id}', [MomentController::class, 'deleteNote'])->name('note.delete');
    Route::get('/edit-note/{id}', [MomentController::class, 'editNote'])->name('note.edit');
    Route::put('/edit-note/{id}', [MomentController::class, 'putNote'])->name('note.editNote');
    // Semua route di dalam sini otomatis terjaga oleh satpam 'auth'
});
