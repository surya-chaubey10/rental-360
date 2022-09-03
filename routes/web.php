<?php

use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\DashboardController;
use App\Http\Controllers\FrontControllers\UserController;
use App\Http\Controllers\FrontControllers\CustomerController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard1', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

Route::get('/customer-list', [CustomerController::class, 'index'])->name('ustomer-list');
Route::get('data/customer-list-json', [CustomerController::class, 'json_list'])->name('data/customer-list.json');
Route::get('/customer-view/{id}', [CustomerController::class, 'view'])->name('customer-view');
Route::post('/customer-save', [CustomerController::class, 'store'])->name('customer-save');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
