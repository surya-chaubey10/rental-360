<?php

use App\Http\Controllers\FrontControllers\AuthController;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\DashboardController;
use App\Http\Controllers\FrontControllers\UserController;
use App\Http\Controllers\FrontControllers\CustomerController;
use App\Http\Controllers\FrontControllers\ForgotPasswordController;
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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.view');
Route::post('/forgot-password', [ForgotPasswordController::class, 'login'])->name('password.reset');

Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

Route::get('/customer-list', [CustomerController::class, 'index'])->name('ustomer-list');
Route::get('data/customer-list-json', [CustomerController::class, 'json_list'])->name('data/customer-list.json');
Route::get('/app/customer/view/account', [CustomerController::class, 'view'])->name('app/customer/view/account');
Route::post('/customer-save', [CustomerController::class, 'store'])->name('customer-save');

Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('org.dashboard');
    Route::resource('users', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
