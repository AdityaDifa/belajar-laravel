<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;

Route::get('/', [DashboardController::class, 'index']);

Route::resource('moments', MomentController::class);
