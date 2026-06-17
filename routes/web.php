<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CreateNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\NoteReactionController;


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

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendLink'])->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/profile/{name}',[ProfileController::class,'index'])->name('profile');
Route::get('/profile/notes/{name}',[ProfileController::class,'notes'])->name('profile.notes');

Route::get('api/notes/comment/{id}',[MomentController::class,'getComments']);

Route::middleware(['auth'])->group(function () {
    Route::get('/create-note', [MomentController::class, 'index'])->name('createNote');
    Route::post('/create-note', [MomentController::class, 'store'])->name('createNote.create');
    Route::delete('/delete-note/{id}', [MomentController::class, 'deleteNote'])->name('note.delete');
    Route::get('/edit-note/{id}', [MomentController::class, 'editNote'])->name('note.edit');
    Route::put('/edit-note/{id}', [MomentController::class, 'putNote'])->name('note.editNote');

    Route::get('/profile/edit/{name}',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile/edit/{name}',[ProfileController::class,'editProfile'])->name('profile.submitEdit');

    Route::post('api/notes/{id}/like', [NoteReactionController::class, 'like']);
    Route::post('api/notes/{id}/dislike', [NoteReactionController::class, 'dislike']);

    Route::delete('api/notes/comment/delete/{id}', [MomentController::class,'deleteComment']);
    Route::post('api/note/comment/post/{id}', [MomentController::class, 'postComment']);

    // Semua route di dalam sini otomatis terjaga oleh satpam 'auth'
});
