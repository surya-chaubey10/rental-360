<?php

use App\Http\Controllers\AdminControllers\AuthenticationController;
use App\Http\Controllers\AdminControllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/storeadmin', function () {
    // return view('welcome');
    return redirect(route('admin.login'));
});

Route::group(['prefix' => 'storeadmin'], function () {
    Route::get('login', [AuthenticationController::class, 'showLoginFormAdmin'])->name('admin.login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('admin.login.process');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.forgot.view');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.forget');

    Route::group(['middleware' => ['admin_user']], function () {
        Route::get('dashboard', [DashboardController::class, 'view'])->name('super.dashboard');

        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('super.logout');
        Route::get('/change-password', [AuthenticationController::class, 'showChangePassword'])->name('super.change.password.show');
        Route::post('/change-password', [AuthenticationController::class, 'changePassword'])->name('super.change.password.update');
    });
});
