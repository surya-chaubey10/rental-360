<?php

use App\Http\Controllers\FrontControllers\AuthController;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\DashboardController;
use App\Http\Controllers\FrontControllers\UserController;
use App\Http\Controllers\FrontControllers\CustomerController;
use App\Http\Controllers\FrontControllers\ForgotPasswordController;
use App\Http\Controllers\FrontControllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.view');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.forget');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset.pass.view');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.change');


Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('org.dashboard');
    Route::resource('users', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/password-change', [AuthController::class, 'showChangePasswordForm'])->name('change.password.show');
    Route::post('/password-change', [AuthController::class, 'changePassword'])->name('change.password.update');

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer-list', 'index')->name('ustomer-list');
        Route::get('data/customer-list-json', 'json_list')->name('data/customer-list.json');
        Route::get('/app/customer/view/account', 'view')->name('app/customer/view/account');
        Route::post('/customer-save', 'store')->name('customer-save');
    });
});
