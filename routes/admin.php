<?php

use App\Http\Controllers\AdminControllers\AuthenticationController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\ForgotPasswordController;
use App\Http\Controllers\AdminControllers\InventoryController;
use App\Http\Controllers\AdminControllers\ResetPasswordController;
use App\Http\Controllers\AdminControllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/storeadmin', function () {
    // return view('welcome');
    return redirect(route('admin.login'));
});

Route::group(['prefix' => 'storeadmin'], function () {
    Route::get('login', [AuthenticationController::class, 'showLoginFormAdmin'])->name('admin.login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('admin.login.process');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.forgot.view');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.forget');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.reset.pass.view');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.change');

    Route::group(['middleware' => ['admin_user']], function () {
        Route::get('dashboard', [DashboardController::class, 'view'])->name('super.dashboard');

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('user.list');
        });

        Route::controller(InventoryController::class)->group(function () {
            Route::get('/inventory-list', 'index')->name('inventory-list');
            Route::get('data/inventory-list-json', 'json_list')->name('data/inventory-list-json');
            Route::post('/inventory-save', 'store')->name('inventory-save');
            Route::get('/inventory_edit/{uuid}',  'edit')->name('inventory_edit');
            Route::post('/inventory_update',  'update')->name('inventory_update');
            Route::get('/inventory_delete/{uuid}', 'delete')->name('inventory_delete');
        });

        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('super.logout');
        Route::get('/change-password', [AuthenticationController::class, 'showChangePassword'])->name('super.change.password.show');
        Route::post('/change-password', [AuthenticationController::class, 'changePassword'])->name('super.change.password.update');
    });
});
