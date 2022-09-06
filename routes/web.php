<?php

use App\Http\Controllers\FrontControllers\AuthController;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\DashboardController;
use App\Http\Controllers\FrontControllers\UserController;
use App\Http\Controllers\FrontControllers\CustomerController;
use App\Http\Controllers\FrontControllers\InventoryController;

use App\Http\Controllers\FrontControllers\ForgotPasswordController;
use App\Http\Controllers\FrontControllers\VendorController;
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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.view');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.forget');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset.pass.view');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.change');

Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventory-list', 'index')->name('inventory-list');
    Route::get('data/inventory-list-json', 'json_list')->name('data/inventory-list-json');
    Route::post('/inventory-save', 'store')->name('inventory-save');
    Route::get('/inventory_delete/{uuid}', 'delete')->name('inventory_delete');
    Route::get('/inventory_edit/{uuid}',  'edit')->name('inventory_edit'); 
    Route::post('/inventory_update',  'update')->name('inventory_update');  
});

Route::group(['middleware' => ['auth']], function () {

    // Route::resource('roles', RoleController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('org.dashboard');
    Route::resource('users', UserController::class);  
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/password-change', 'showChangePasswordForm')->name('change.password.show');
        Route::post('/password-change', 'changePassword')->name('change.password.update');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.list');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer-list', 'index')->name('ustomer-list');
        Route::get('data/customer-list-json', 'json_list')->name('data/customer-list.json');
        Route::get('customer-view/{id}', 'view')->name('customer-view');
        Route::get('customer-delete/{id}', 'delete')->name('customer-delete');
        Route::post('/customer-save', 'store')->name('customer-save');
        Route::get('/customer-edit/{id}',  'customerEdit')->name('customer-edit');  
        Route::post('/customer-update',  'update')->name('customer-update');  
    });

    Route::controller(VendorController::class)->group(function () {
        Route::get('/vendor-list', 'vendorList')->name('contact.vendor-list'); 
        Route::get('/data/vendor-list-data.json', 'ajax_list_data')->name('data.vendor-list-data.json');  
        Route::post('/vendor-save', 'store')->name('vendor-save'); 
        Route::get('/vendor-edit/{uuid}', 'vendorEdit')->name('vendor-edit');   
        Route::post('/vendor-update', 'update')->name('vendor-update');  
        Route::get('/vendor-delete/{uuid}', 'destroy')->name('vendor-delete');  
        Route::get('/vendor-view/{uuid}', 'view')->name('vendor-view');   
        Route::get('/app/customer/view/account', 'view')->name('app/customer/view/account');
        Route::post('/customer-save', 'store')->name('customer-save');
    });
    
});
