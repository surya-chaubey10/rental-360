<?php

use App\Http\Controllers\FrontControllers\AuthController;
use App\Http\Controllers\FrontControllers\BookingController;
use App\Http\Controllers\FrontControllers\DashboardController;
use App\Http\Controllers\FrontControllers\UserController;
use App\Http\Controllers\FrontControllers\CustomerController;
use App\Http\Controllers\FrontControllers\InventoryController;
use App\Http\Controllers\FrontControllers\OfferPackagesController;
use App\Http\Controllers\FrontControllers\ForgotPasswordController;
use App\Http\Controllers\FrontControllers\VendorController;
use App\Http\Controllers\FrontControllers\OfferController;
use App\Http\Controllers\FrontControllers\ResetPasswordController;
use App\Http\Controllers\FrontControllers\BookingCalenderController;
use App\Http\Controllers\FrontControllers\OfferCategoryController;
use App\Http\Controllers\FrontControllers\OfferPartnersController;
use App\Http\Controllers\FrontControllers\ManageBookingsController;
use App\Http\Controllers\FrontControllers\VehicleBrandController;
use App\Http\Controllers\FrontControllers\VehicleTypeController;
use App\Http\Controllers\FrontControllers\VehicleController;


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
    // Route::resource('users', UserController::class);

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
        Route::get('customer-view/{id}', 'show')->name('customer-view');
        Route::get('customer-delete/{id}', 'destroy')->name('customer-delete');
        Route::post('/customer-save', 'store')->name('customer-save');
        Route::get('/customer-edit/{id}',  'edit')->name('customer-edit');
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
    });

    Route::controller(BookingCalenderController::class)->group(function () {
        Route::get('/booking-calender', 'index')->name('booking-calender');
        Route::get('/get-calender', 'get_calender')->name('get-calender');
    });

    Route::controller(InventoryController::class)->group(function () {
        Route::get('/inventory-list', 'index')->name('inventory-list');
        Route::get('data/inventory-list-json', 'json_list')->name('data/inventory-list-json');
        Route::post('/inventory-save', 'store')->name('inventory-save');
        Route::get('/inventory_delete/{uuid}', 'delete')->name('inventory_delete');
        Route::get('/inventory_edit/{uuid}',  'edit')->name('inventory_edit');
        Route::post('/inventory_update',  'update')->name('inventory_update');
    });

    Route::controller(OfferPackagesController::class)->group(function () {
        Route::get('/offerpackages-list', 'index')->name('offerpackages-list');
    });

    Route::controller(OfferController::class)->group(function () {
        Route::get('/offer-list', 'index')->name('offer-list');
        Route::get('/add-list', 'add')->name('add-list');
        Route::post('/offer-save', 'store')->name('offer-save');
        Route::post('/offer-update', 'update')->name('offer-update');
        Route::get('/offer-delete/{uuid}', 'delete')->name('offer-delete');
        Route::get('/offer-edit/{uuid}',  'edit')->name('offer-edit');
        Route::get('/offer-copy/{uuid}',  'copy')->name('offer-copy');
    });

    Route::controller(OfferCategoryController::class)->group(function () {
        Route::get('/offer-category-list', 'index')->name('offer-category-list');
        Route::get('data/offer-category-json', 'json_list')->name('data/offer-category-json');
        Route::get('/offer-category', 'create')->name('offer-category');
        Route::post('/offer-category-save', 'store')->name('offer-category-save');
        Route::get('/update-offer-category/{uuid}', 'edit')->name('update-offer-category');
        Route::get('/offer-category-delete/{uuid}', 'destroy')->name('offer-category-delete');
        Route::post('/offer-category-update', 'update')->name('offer-category-update');
    });

    Route::controller(OfferPartnersController::class)->group(function () {
        Route::get('/offer-partner-list', 'index')->name('offer-partner-list');
        Route::get('/offer-partner', 'create')->name('offer-partner');
        Route::post('/offer-partner-save', 'store')->name('offer-partner-save');
        Route::get('/update-offer-partner/{uuid}', 'edit')->name('update-offer-partner');
        Route::get('/offer-partner-delete/{uuid}', 'destroy')->name('offer-partner-delete');
        Route::post('/offer-partner-update', 'update')->name('offer-partner-update');
    });

    Route::controller(ManageBookingsController::class)->group(function () {
        Route::get('/manage-booking-list', 'index')->name('manage-booking-list');
        Route::get('/manage-booking', 'create')->name('manage-booking');
    });

    Route::controller(VehicleBrandController::class)->group(function () {
        Route::get('/vehicle-brand-list', 'index')->name('vehicle-brand-list');
        Route::get('/add-vehicle-brand', 'create')->name('add-vehicle-brand');
        Route::post('/store-vehicle-brand', 'store')->name('store-vehicle-brand');
        Route::get('/data/vehicle_brand.json', 'ajax_list_data')->name('data.vehicle_brand.json');
        Route::get('/edit-vehicle-brand/{uuid}', 'edit')->name('edit-vehicle-brand');
        Route::get('/vehicle-brand-delete/{uuid}', 'destroy')->name('vehicle-brand-delete');
        Route::post('/vehicle-brand-update', 'update')->name('vehicle-brand-update');
    });

    Route::controller(VehicleTypeController::class)->group(function () {
        Route::get('/vehicle-type-list', 'index')->name('vehicle-type-list');
        Route::get('/add-vehicle-type', 'create')->name('add-vehicle-type');
        Route::post('/store-vehicle-type', 'store')->name('store-vehicle-type');
        Route::get('/data/vehicle_type.json', 'ajax_list_data')->name('data.vehicle_type.json');
        Route::get('/edit-vehicle-type/{uuid}', 'edit')->name('edit-vehicle-type');
        Route::get('/vehicle-type-delete/{uuid}', 'destroy')->name('vehicle-type-delete');
        Route::post('/vehicle-type-update', 'update')->name('vehicle-type-update');
    });

    Route::controller(VehicleController::class)->group(function () {
     
        Route::get('/vehicle-create', 'create')->name('vehicle-create');
        Route::get('/get_vehicle_autoseggestion', 'vehicleNameSeggestion')->name('get-vehicle_name-seggestion');
      
    });
    
});
