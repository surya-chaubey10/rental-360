<?php

use App\Http\Controllers\AdminControllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('admin.login.process');