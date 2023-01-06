<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\FleetController;
use App\Http\Controllers\ApiControllers\BookingController;
use App\Http\Controllers\ApiControllers\LeadsController;
use App\Http\Controllers\ApiControllers\TransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/payment-callback' ,[\App\Http\Controllers\ApiControllers\GeneratePayamentLinkController::class, 'callback']);
Route::post('/callback/{string}' ,[\App\Http\Controllers\ApiControllers\GeneratePayamentLinkController::class, 'return_callback']);

Route::group([
    'prefix' => 'auth'
], function () {

    Route::post('login', [\App\Http\Controllers\ApiControllers\AuthController::class, 'login'])->name('mobile.login');
    Route::post('signup', [\App\Http\Controllers\ApiControllers\AuthController::class, 'signup'])->name('mobile.signup');
    Route::post('forgot-password', [\App\Http\Controllers\ApiControllers\ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('reset-password', [\App\Http\Controllers\ApiControllers\ResetPasswordController::class, 'resetPassword']);
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    // Fleet Route
    Route::controller(FleetController::class)->group(function () {
        Route::get('fleet/list', 'index')->name('fleet/list');
        Route::post('fleet-market', 'marketFleet')->name('fleet/market');

        //new
        Route::post('fleet-search', 'advancedSearch')->name('fleet/search');
     
    });

    Route::controller(BookingController::class)->group(function () {
        Route::get('booking-lists', 'index')->name('booking-lists');
    
    });

    Route::controller(LeadsController::class)->group(function () {
        Route::get('leads-lists', 'index')->name('leads-lists');
        Route::post('leads-save', 'store')->name('leads-save');
    
    });

    Route::controller(LeadsController::class)->group(function () {
        Route::get('leads-lists', 'index')->name('leads-lists');
        Route::post('leads-save', 'store')->name('leads-save');
    
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('transaction-lists', 'index')->name('transaction-lists');
    
    });
    

});