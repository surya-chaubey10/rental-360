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
use App\Http\Controllers\FrontControllers\ReceiptController;
use App\Http\Controllers\FrontControllers\GenerateInvoiceController;
use App\Http\Controllers\FrontControllers\LeadsModelController;
use App\Http\Controllers\FrontControllers\ExpensesController;
use App\Http\Controllers\FrontControllers\ExpenseCategoryController;
use App\Http\Controllers\FrontControllers\GroupBuyingController;
use App\Http\Controllers\FrontControllers\ExpenseSubCategoryController;
use App\Http\Controllers\FrontControllers\PurchaseController;
use App\Http\Controllers\FrontControllers\AccountController;
use App\Http\Controllers\FrontControllers\MyListController;
use App\Http\Controllers\FrontControllers\EmailController;
use App\Http\Controllers\FrontControllers\AudienceSegmentsController;
use App\Http\Controllers\FrontControllers\ReturnSalesController;
use App\Http\Controllers\FrontControllers\InvoiceController;
use App\Http\Controllers\FrontControllers\AudienceSubscribersController;
use App\Http\Controllers\FrontControllers\NonInvoiceController;
use App\Http\Controllers\FrontControllers\SupplierPurchaseController;
use App\Http\Controllers\FrontControllers\SupplierNonPurchaseController;
use App\Http\Controllers\FrontControllers\GeneralMarketingController;
use App\Http\Controllers\FrontControllers\SalesquotationController;
use App\Http\Controllers\FrontControllers\BalanceAdjustmentController;
use App\Http\Controllers\FrontControllers\BalanceTransferController;
use App\Http\Controllers\FrontControllers\TransactionHistoryController;
use App\Http\Controllers\FrontControllers\SalesInvoiceController;
use App\Http\Controllers\FrontControllers\SalesInvoiceReturnController;
use App\Http\Controllers\FrontControllers\CampaignsController;
use App\Http\Controllers\FrontControllers\EmployeePayrollController;
use App\Http\Controllers\FrontControllers\CouponsController;
use App\Http\Controllers\FrontControllers\FleetController;
use App\Http\Controllers\FrontControllers\TransactionAmountController;
use App\Http\Controllers\FrontControllers\AcountsPaymentController;
use App\Http\Controllers\FrontControllers\RequestController;    
use App\Http\Controllers\FrontControllers\PromotionController;  
use App\Http\Controllers\AdminControllers\CompanyController;  
use App\Http\Controllers\FrontControllers\RoleController;  
use App\Http\Controllers\FrontControllers\RolePermisionController;  
use App\Http\Middleware\LoginRolePermisson;

use Illuminate\Http\Request;
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

// Route::get('/api/callback/{slug}', function ($slug) {
//     return 'not authorized to access';
// });

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('login'));
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
    Route::group(['middleware' => ['permissions']], function () {

    // Route::resource('roles', RoleController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('org.dashboard');
    Route::post('/notification-change-status', [DashboardController::class, 'readablechange'])->name('notification-change-status');
    Route::get('/invoice_details1/{id}', [DashboardController::class, 'invoice_details1'])->name('invoice_details1');
    Route::get('/get_invoice_details_data1/{id}', [DashboardController::class, 'get_invoice_details_data1'])->name('get_invoice_details_data1');
    Route::get('/transaction_data1_details1/{id}', [DashboardController::class, 'transaction_data1_details1'])->name('transaction_data1_details1');
    Route::get('/return_fleet_toadmin/{reservefleet}', [DashboardController::class, 'return_fleet'])->name('return_fleet_toadmin');

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/password-change', 'showChangePasswordForm')->name('change.password.show');
        Route::post('/password-change', 'changePassword')->name('change.password.update');
    });

        Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user-list');
        Route::get('/user-edit/{uuid}', 'edit')->name('users-edit');
        Route::get('/user-create', 'create')->name('user-create');
        Route::get('/users-view/{uuid}', 'viewuser')->name('users-view');

        Route::post('/user-save', 'store')->name('user-save');
        Route::get('/user-delete/{uuid}', 'destroy')->name('user-delete'); 
        Route::post('/user-update',  'update')->name('user-update'); 
        Route::get('/ajax_all_submenu/{role_id}',  'all_submenu')->name('ajax_all_submenu');
        Route::get('/ajax_fetchall_submenu/{role_id}/{user_id}',  'fetchall_submenu')->name('ajax_fetchall_submenu');

        Route::get('/users-toggle/{id}','userStatus')->name('users-toggle');
    });

    Route::controller(ReceiptController::class)->group(function () {
        Route::get('/receipt', 'index')->name('receipt.list');
        Route::get('/receipt-print', 'print')->name('receipt.receipt-print');
    });

    Route::controller(GenerateInvoiceController::class)->group(function () {
        Route::get('/generate-invoice', 'index')->name('generateInvoice.add');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer-list', 'index')->name('customer-list');
        Route::get('data/customer-list-json', 'json_list')->name('data/customer-list.json');
        Route::get('customer-view/{id}', 'show')->name('customer-view');
        Route::get('customer-delete/{id}', 'destroy')->name('customer-delete');
        Route::post('/customer-save', 'store')->name('customer-save');
        Route::get('/customer-edit/{id}',  'edit')->name('customer-edit');
        Route::get('/customer-create',  'create')->name('customer-create');
        Route::post('/customer-update',  'update')->name('customer-update');
        Route::post('/importcustomers', 'importcustomers')->name('importcustomers');
        Route::get('/customer-toggle/{id}','customertStatus');
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
        Route::get('/createInvoice_calender/{uuid}', 'createInvoice_calender')->name('createInvoice_calender');
        Route::get('/bookingcalendarpreview/{uuid}', 'bookingcalendarpreview')->name('bookingcalendarpreview');
        //Route::get('full-calender', [FullCalenderController::class, 'index']);
        Route::get('/clear/route', 'clearRoute');
        Route::post('/full-calender/action', 'action');  
        Route::post('/fetchCalenderEvent', 'fetch')->name('fetchCalenderEvent');
        Route::get('/get_filter_model_fleet/{model_id}', 'get_filter_fleet')->name('get_filter_model_fleet');

        Route::get('fleets_auto_suggestion', 'fleets_auto_suggestion')->name('fleets_auto_suggestion');
          
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
        // Route::get('data/offer-category-json', 'json_list')->name('data/offer-category-json');
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
        // Route::get('/manage-booking', 'create')->name('manage-booking');
        Route::get('/add-manage-booking', 'create')->name('add-manage-booking');
        Route::get('/manage-booking-edit/{uuid}', 'edit')->name('manage-booking-edit');
        Route::post('/save_manage_booking', 'store')->name('save_manage_booking');
        Route::post('/update_manage_booking', 'update')->name('update_manage_booking');
        Route::get('/manage-booking-cancel/{uuid}', 'cancel_booking')->name('manage-booking-cancel');
        Route::get('bookings-delete/{id}', 'destroy')->name('bookings-delete');
        Route::post('inv_note_store/{uuid}', 'inv_note_store')->name('inv_note_store');
        Route::get('popupmail_trigger/{uuid}', 'popupmail_trigger')->name('popupmail_trigger');
        Route::get('tabinvoice/{uuid}', 'tabinvoice')->name('tabinvoice');
        Route::get('getting_merchant_sku/{merchant_sku}', 'getting_merchant_sku')->name('getting_merchant_sku');
        Route::get('check_tn_number/{tn_number}/{tn_uuid}', 'check_tn_number')->name('check_tn_number');
        Route::get('customer_auto_suggestion', 'customer_auto_suggestion')->name('customer_auto_suggestion');
        Route::get('marchantsku_auto_suggestion', 'marchantsku_auto_suggestion')->name('marchantsku_auto_suggestion');
        Route::get('description_auto_suggestion', 'description_auto_suggestion')->name('description_auto_suggestion');
        Route::get('description_price/{fleet}/{id}', 'description_price')->name('description_price');  
        Route::get('popupsms_trigger/{uuid}', 'popupsms_trigger')->name('popupsms_trigger');
        Route::get('popupsms_trigger_for_quick/{id}', 'popupsms_trigger_for_quick')->name('popupsms_trigger_for_quick');
        Route::get('popupmail_trigger_mail_for_quick/{id}', 'popupmail_trigger_mail_for_quick')->name('popupmail_trigger_mail_for_quick');




        Route::get('create_invoice/{uuid}', 'createInvoice')->name('create_invoice');
        Route::get('edit_invoice/{uuid}', 'editInvoice')->name('edit_invoice');

        Route::post('/save_booking_invoice', 'storeInvoice')->name('save_booking_invoice');
        Route::post('/save_booking_invoice_update', 'updateInvoice')->name('save_booking_invoice_update');
        Route::get('/brandmodel/{brand_id}/{model_id}', 'get_model')->name('brandmodel');
        Route::get('/marchantbrandmodel/{brand_id}/{model_id}', 'get_marchantmodel')->name('marchantbrandmodel');
        Route::get('/get_available_fleet/{model_id}/{fleet_id}/{from_date}/{to_date}', 'get_available_fleet')->name('brandmodel');
        Route::get('/fleetvehicle/{model_ids}/{vehicle_id}', 'get_vehicles')->name('fleetvehicle');
        Route::get('/customer_data/{id}', 'customer_data')->name('customer_data');
        Route::get('/invoice-preview/{uuid}', 'preview')->name('invoice-preview/{uuid}');
        Route::get('/popupinvoice', 'popup')->name('popupinvoice');
        Route::get('/get-promotion/{code}', 'getpromotion')->name('get-promotion');
        Route::get('/quick_payment_data/{id}', 'quick_payment_data')->name('quick_payment_data');
        Route::get('/bookingdata_get/{uuid}', 'bookingdata_get')->name('bookingdata_get');
        Route::post('/booking_addquick_payment', 'quick_payment_store')->name('booking_addquick_payment');
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

    Route::controller(LeadsModelController::class)->group(function () {
        Route::get('/leads-list', 'leads_list')->name('leads-list');
        Route::get('/leads-create', 'create')->name('leads-create');
        Route::get('/leads-edit/{uuid}', 'edit')->name('leads-edit');
        Route::get('/leads-gride', 'leadsGride')->name('leads-gride');
        Route::post('/leads-store', 'store')->name('leads-store');
        Route::post('/change-status', 'updatestatus')->name('change-status');
        Route::post('/update-comment', 'updatecomment')->name('update-comment');
        Route::post('/leads-update', 'update')->name('leads-update');

        Route::get('/leads-view/{uuid}', 'view')->name('leads-view');
        Route::get('/leads-delete/{uuid}', 'delete')->name('leads-delete');
        Route::post('/importleads', 'importleads')->name('importleads');
        Route::get('/get-comment/{user_id}', 'getcomments')->name('get-comment');
    });


    Route::controller(ExpenseCategoryController::class)->group(function () {
        Route::get('/expense-category-list', 'index')->name('expense-category-list');
        Route::get('/add-expense-category', 'create')->name('add-expense-category');
        Route::post('/store-expense-category', 'store')->name('store-expense-category');
        // acounts-payment-list

    });
    Route::controller(ExpenseSubCategoryController::class)->group(function () {
        Route::get('/expense-subcategory-list', 'index')->name('expense-subcategory-list');
        Route::get('/add-expense-subcategory', 'create')->name('add-expense-subcategory');
        Route::post('/store-expense-subcategory', 'store')->name('store-expense-subcategory');
        //  Route::get('/data/vehicle_brand.json', 'ajax_list_data')->name('data.vehicle_brand.json');

    });

    Route::controller(ExpensesController::class)->group(function () {
        Route::get('/expenses-list', 'index')->name('expenses-list');
        Route::get('/add-expenses', 'create')->name('add-expenses');
        Route::post('/store-expenses', 'store')->name('store-expenses');
        // Route::get('/data/vehicle_brand.json', 'ajax_list_data')->name('data.vehicle_brand.json');

    });

    Route::controller(AccountController::class)->group(function () {
        Route::get('/account-list', 'index')->name('account-list');
        Route::get('/add-account', 'create')->name('add-account');
        Route::get('/edit-account', 'edit')->name('edit-account');
        Route::get('/view-account', 'show')->name('view-account');
        //Route::post('/store-account', 'store')->name('store-account');

    });

    Route::controller(BalanceAdjustmentController::class)->group(function () {
        Route::get('/balance-adjustment-list', 'index')->name('balance-adjustment-list');
        Route::get('/balance-adjustment-add', 'create')->name('balance-adjustment-add');
        Route::get('/balance-adjustment-edit', 'edit')->name('balance-adjustment-edit');
        //Route::post('/store-account', 'store')->name('store-account');

    });

    Route::controller(BalanceTransferController::class)->group(function () {
        Route::get('/balance-transfer-list', 'index')->name('balance-transfer-list');
        Route::get('/add-balance-transfer', 'create')->name('add-balance-transfer');
        Route::get('/edit-balance-transfer', 'edit')->name('edit-balance-transfer');
        Route::get('/view-balance-transfer', 'show')->name('view-balance-transfer');
        //Route::post('/store-account', 'store')->name('store-account');

    });

    Route::controller(TransactionHistoryController::class)->group(function () {
        Route::get('/transaction-history-list', 'index')->name('transaction-history-list');
        // Route::get('/add-account', 'create')->name('add-account');
        //Route::post('/store-account', 'store')->name('store-account');

    });

    Route::controller(MyListController::class)->group(function () {
        Route::get('/mylist', 'Mylist')->name('mylist');
        //    Route::get('/add-expense-subcategory', 'create')->name('add-expense-subcategory');
        //    Route::post('/store-expense-subcategory', 'store')->name('store-expense-subcategory');
        //  Route::get('/data/vehicle_brand.json', 'ajax_list_data')->name('data.vehicle_brand.json');

    });


    Route::controller(EmailController::class)->group(function () {
        Route::get('/email', 'index')->name('email');
        Route::get('/testmail/{uuid}', 'send_message')->name('testmail');
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase-list', 'index')->name('purchase-list');
        Route::get('/purchase-add', 'create')->name('purchase-add');
    });


    Route::controller(ReturnSalesController::class)->group(function () {
        Route::get('/return-list', 'index')->name('return-list');
        Route::get('/return-add', 'create')->name('return-add');
    });



    Route::controller(SalesquotationController::class)->group(function () {
        Route::get('/quotation-list', 'index')->name('quotation-list');
        Route::get('/quotation-add', 'create')->name('quotation-add');
    });


    Route::controller(SalesInvoiceController::class)->group(function () {
        Route::get('/salesinvoice-list', 'index')->name('salesinvoice-list');
        Route::get('/salesinvoice-add', 'create')->name('salesinvoice-add');
    });

    Route::controller(SalesInvoiceReturnController::class)->group(function () {
        Route::get('/invoicereturn-list', 'index')->name('invoicereturn-list');
        Route::get('/invoicereturn-add', 'create')->name('invoicereturn-add');
    });


    Route::controller(EmployeePayrollController::class)->group(function () {
        Route::get('/payroll-add', 'create')->name('payroll-add');
        Route::get('/payroll-list', 'index')->name('payroll-list');
        Route::get('//payroll-edit', 'edit')->name('/payroll-edit');
        Route::get('/payroll-view', 'show')->name('payroll-view');
    });


    Route::controller(CampaignsController::class)->group(function () {
        Route::get('/campaigns', 'index')->name('campaigns');
        Route::get('/create-Campaigns', 'create')->name('create-Campaigns');
    });


    Route::controller(CouponsController::class)->group(function () {
        Route::get('/coupons-add', 'create')->name('coupons-add');
        Route::get('/coupons-list', 'index')->name('coupons-list');
        Route::get('data/couppons-json', 'json_list')->name('data/couppons-json');
    });

//promotion//
    Route::controller(PromotionController::class)->group(function () {
    Route::get('/create-promotion', 'create')->name('create-promotion');
    Route::get('promotion-list', 'index')->name('promotion-list'); 
    Route::post('/promotion-save', 'store')->name('promotion-save');
    Route::get('/promotion-delete/{uuid}', 'destroy')->name('promotion-delete');
    Route::get('/update-promotion/{uuid}', 'update')->name('update-promotion');
    Route::post('/edit-promotion', 'edit')->name('edit-promotion');


 
});


    // Invoice 
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice-list', 'index')->name('invoice-list');
        Route::get('/get-bookingdata/{bookingId}', 'bookingdata')->name('get-bookingdata');
        Route::get('/ajax-invoicedetails/{uuid}/{dropdate}', 'adddetail')->name('ajax-invoicedetails');
        Route::get('/invoice-delete/{uuid}', 'destroy')->name('invoice-delete');
        Route::get('/invoice-edit/{uuid}',  'edit')->name('invoice-edit');
        Route::get('/invoice_details/{id}',  'invoice_details')->name('invoice_details');
        Route::get('/get_invoice_details_data/{id}',  'get_invoice_details_data')->name('get_invoice_details_data');
        Route::post('/update_booking_invoice', 'update')->name('update_booking_invoice');
        Route::post('/refund-payment', 'refund_payment')->name('refund-payment');
        Route::post('/charge-payment', 'charge_payment')->name('charge-payment');
        Route::get('check_invoicetn_number/{tn_number}/{tn_uuid}/{tn_invoiceid}', 'check_transaction_number')->name('check_invoicetn_number');
        Route::get('data/invoice-list-json', 'json_list')->name('data/invoice-list-json');
        Route::get('/add-invoice', 'create')->name('add-invoice');
        Route::get('/invoice-save', 'store')->name('invoice-save');
        Route::get('/invoice-edit',  'edit')->name('invoice-edit');
        Route::get('/invoice-update',  'update')->name('invoice-update');
        Route::get('/invoice-show', 'show')->name('invoice-show');
    });

    // Non-Invoice 
    Route::controller(NonInvoiceController::class)->group(function () {
        Route::get('/non-invoice-list', 'index')->name('non-invoice-list');
        Route::get('data/non-invoice-list-json', 'json_list')->name('data/non-invoice-list-json');
        Route::get('/add-non-invoice', 'create')->name('add-non-invoice');
        Route::get('/non-invoice-save', 'store')->name('non-invoice-save');
        Route::get('/non-invoice-edit',  'edit')->name('non-invoice-edit');
        Route::get('/non-invoice-update',  'update')->name('non-invoice-update');
        Route::get('/non-invoice-delete', 'delete')->name('non-invoice-delete');
    });


    // Payment-Supplier-Purchase 
    Route::controller(SupplierPurchaseController::class)->group(function () {
        Route::get('/supplier-purchase-list', 'index')->name('supplier-purchase-list');
        Route::get('data/supplier-purchase-list-json', 'json_list')->name('data/supplier-purchase-list-json');
        Route::get('/supplier-add-purchase', 'create')->name('supplier-add-purchase');
        Route::get('/supplier-purchase-save', 'store')->name('supplier-purchase-save');
        Route::get('/supplier-purchase-edit',  'edit')->name('supplier-purchase-edit');
        Route::get('/supplier-purchase-update',  'update')->name('supplier-purchase-update');
        Route::get('/supplier-purchase-delete', 'delete')->name('supplier-purchase-delete');
        Route::get('/supplier-purchase-show', 'show')->name('supplier-purchase-show');
    });


    // Payment-Supplier-Non-Purchase 
    Route::controller(SupplierNonPurchaseController::class)->group(function () {
        Route::get('/supplier-non-purchase-list', 'index')->name('supplier-non-purchase-list');
        Route::get('data/supplier-non-purchase-list-json', 'json_list')->name('data/supplier-non-purchase-list-json');
        Route::get('/supplier-add-non-purchase', 'create')->name('supplier-add-non-purchase');
        Route::get('/supplier-non-purchase-save', 'store')->name('supplier-non-purchase-save');
        Route::get('/supplier-non-purchase-edit',  'edit')->name('supplier-non-purchase-edit');
        Route::get('/supplier-non-purchase-update',  'update')->name('supplier-non-purchase-update');
        Route::get('/supplier-non-purchase-delete', 'delete')->name('supplier-non-purchase-delete');
    });

    //General Marketing
    Route::controller(GeneralMarketingController::class)->group(function () {
        Route::get('/general_marketing', 'index')->name('general_marketing');
    });


    Route::controller(AudienceSubscribersController::class)->group(function () {
        Route::get('/subscribers', 'audienceApp')->name('subscribers');
    });
    Route::controller(AudienceSubscribersController::class)->group(function () {
        Route::get('/add-subscribers', 'subscribers1')->name('add-subscribers');
    });
    Route::controller(AudienceSegmentsController::class)->group(function () {
        Route::get('/segments', 'segmentApp')->name('segments');
        Route::get('/create-segments', 'createApp')->name('create-segments');
    });

    Route::controller(FleetController::class)->group(function () {
        Route::get('/fleet-list', 'index')->name('fleet-list');
        Route::get('/fleetshow', 'fleetshow')->name('fleetshow');
        Route::get('/toggle/{id}','fleetStatus');
        Route::get('/ajax-brandmodel/{brand_id}/{model_id}', 'get_brandmodel')->name('ajax-brandmodel');
        Route::post('/store-model', 'save_model')->name('store-model');
        Route::post('/fleet-store', 'store')->name('fleet-store');
        Route::post('/fleet-update', 'update')->name('fleet-update');
        Route::get('/add-fleet', 'add')->name('add-fleet');
        Route::get('/fleet-edit/{uuid}', 'edit')->name('fleet-edit');
        Route::get('/fleet-delete/{uuid}', 'delete')->name('fleet-edit');
        Route::get('/image-json/{id}', 'imagejson')->name('image-json');
        Route::get('/inventoryimagejson/{id}', 'inventoryjson')->name('inventoryimagejsonn');
        Route::get('/update-fleet/{brand}/{model}/{uuid}', 'ajax_update')->name('update-fleet');
        Route::get('/nextadd-fleet/{brand}/{model}', 'ajax_add')->name('nextadd-fleet');
        Route::get('/checksku_name/{sku}', 'checksku')->name('checksku_name');
        Route::get('/fleet-calendar/{uuid}', 'calendar')->name('fleet-calendar');
        Route::get('/fetchFleetCalenderEvent/{uuid}', 'fetch')->name('fetchFleetCalenderEvent');
        Route::post('/importfleets', 'importfleets')->name('importfleets');
        Route::any('profile', 'profile')->name('profile');
        Route::get('docs', 'docs')->name('docs');
        Route::post('docs_post', 'docs_post')->name('docs_post');

    });

    Route::controller(GroupBuyingController::class)->group(function () {
        Route::get('/group-buying', 'index')->name('group-buying');
        Route::get('/preview-invoice', 'store')->name('preview-invoice');
        Route::get('/manage-booking-receipt', 'receipt')->name('manage-booking-receipt');
    });
});
});
// Auth and permission middleware close here

Route::controller(TransactionAmountController::class)->group(function () {
    Route::post('/transaction_amount_save', 'store')->name('transaction_amount_save');
});
 
Route::controller(AcountsPaymentController::class)->group(function () {
    Route::get('/acounts-payment-list', 'index')->name('acounts-payment-list');
    Route::post('/addquick-payment', 'store')->name('addquick-payment');
    Route::get('/transaction_details/{id}', 'transaction_details')->name('transaction_details');
    Route::get('/transaction_details_for_payment/{trans_ref}', 'transaction_details_for_payment')->name('transaction_details_for_payment');
    Route::get('/invoice_details_data_payments/{trans_ref}', 'invoice_details_data_payments')->name('invoice_details_data_payments');
    Route::get('/invoice_details_data/{id}', 'invoice_details_data')->name('invoice_details_data');
    Route::get('/statement_data/{trans_ref}', 'statement_data')->name('statement_data');
    Route::get('/statement_details/{trans_ref}', 'statement_details')->name('statement_details');
    Route::get('sms_for_quick_list/{id}', 'sms_for_quick_list')->name('sms_for_quick_list');
    Route::get('mail_for_quick_list/{id}', 'mail_for_quick_list')->name('mail_for_quick_list');
});  

Route::controller(RequestController::class)->group(function () {
    Route::get('/withdraw-list', 'index')->name('withdraw-list-list');
    Route::post('/withdraw_save', 'store')->name('withdraw_save');

});  
//role
Route::controller(RoleController::class)->group(function () {
    Route::get('/role-list', 'index')->name('role-list');
    Route::get('/role-create', 'create')->name('role-create');
    Route::post('/role-store', 'store')->name('role-store');
    Route::get('/role-delete/{uuid}', 'destroy')->name('role-delete'); 
    Route::get('/update-role/{uuid}', 'update')->name('update-role');
    Route::post('/edit-role', 'edit')->name('edit-role');
    Route::get('/role-toggle/{id}','roleStatus')->name('role-toggle');
 
});  

Route::controller(RolePermisionController::class)->group(function () {
   
    Route::get('/permision-create', 'create')->name('permision-create');
    Route::get('/permision-edit/{id}', 'edit')->name('permision-edit');
    Route::get('/get_role_base_data/{id}/{madul}/{submadul}', 'get_role_base_data')->name('get_role_base_data');
    Route::post('/permision-store', 'store')->name('permision-store');
    Route::post('/permision-update', 'update')->name('permision-update');
}); 


// paymnet link 
Route::get('{code}', [\App\Http\Controllers\FrontControllers\PaymentController::class, 'showShortLink'])->name('shorten.link');
Route::get('choose-payment/{uuid}', [\App\Http\Controllers\FrontControllers\PaymentController::class, 'choosePaymnet'])->name('choose.payment');

Route::get('/payment-callback/{string}', [\App\Http\Controllers\FrontControllers\GeneratePayamentLinkController::class, 'callback']);
Route::get('/callback/{string}', [\App\Http\Controllers\FrontControllers\GeneratePayamentLinkController::class, 'return_callback']);
Route::get('/short-callback/{string}', [\App\Http\Controllers\FrontControllers\GeneratePayamentLinkController::class, 'return_short_callback']);

Route::controller(CompanyController::class)->group(function () { 
    Route::get('/mail-aggrement/{uuid}', 'mail_aggrement_link')->name('mail-aggrement');
    Route::post('/virtual-contract-store', 'virtual_contract_store')->name('virtual-contract-store');                                                                                                                              
    Route::get('/verify-otp/{company_id}', 'verify_otp')->name('verify-otp');                                                                                                                              
    Route::get('/send-otp/{company_id}', 'otpsend')->name('send-otp');                                                                                                                              
    Route::post('/verify-otp-store', 'verify_otp_store')->name('verify-otp-store');    
}); 

// Route::post('/callback/{string}', function(Request $request){
//     dd($request);
// });
