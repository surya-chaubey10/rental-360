<?php

use App\Http\Controllers\AdminControllers\AuthenticationController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\ForgotPasswordController;
use App\Http\Controllers\AdminControllers\InventoryController;
use App\Http\Controllers\AdminControllers\ResetPasswordController;
use App\Http\Controllers\AdminControllers\UserController;   
use App\Http\Controllers\AdminControllers\CustomersController;
use App\Http\Controllers\AdminControllers\CompanyGLController;
use App\Http\Controllers\AdminControllers\CompanyController;    
use App\Http\Controllers\AdminControllers\VendorVisibilityController;    
use App\Http\Controllers\AdminControllers\FleetVisibilityController;    
use App\Http\Controllers\AdminControllers\CommunicationController;      
use App\Http\Controllers\AdminControllers\SubscriptionPlansController;    
use App\Http\Controllers\AdminControllers\LocalizationController;    
use App\Http\Controllers\AdminControllers\MiscController; 
use App\Http\Controllers\AdminControllers\GeneralSettingController; 
use App\Http\Controllers\AdminControllers\CronJobsController;
use App\Http\Controllers\AdminControllers\PaymentGatewayController;  
use App\Http\Controllers\AdminControllers\BookingController; 
use App\Http\Controllers\AdminControllers\FinanceReleaseController;  
use App\Http\Controllers\AdminControllers\FinanceRequestController;     
use App\Http\Controllers\AdminControllers\SummaryController;     
use App\Http\Controllers\AdminControllers\AuditController;   
use App\Http\Controllers\AdminControllers\BackupController;   
use App\Http\Controllers\AdminControllers\SuperadminRoleController;
use App\Http\Controllers\AdminControllers\SuperadminUserController;
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
        Route::post('notification-change', [DashboardController::class, 'readablechange'])->name('notification-change');
        //new-----------------
        //Route::get('dashboard', [DashboardController::class, 'oneday'])->name('super.dashboard');

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('user.list'); 
        });
 
        Route::controller(InventoryController::class)->group(function () {
            Route::get('/inventory-list', 'index')->name('inventory-list');
            Route::get('/showinventry', 'showinventry')->name('showinventry');
            Route::get('/create_inventory/{brand_id}/{model_id}', 'add')->name('create_inventory');
            Route::get('data/inventory-list-json', 'json_list')->name('data/inventory-list-json');
            Route::get('/inventoryimagejson1/{id}', 'inventoryjson')->name('inventoryimagejsonn1');
            Route::get('/ajax-brandmodel1/{brand_id}/{model_id}', 'get_brandmodel1')->name('ajax-brandmodel1');
            Route::post('/store-model', 'save_model1')->name('store-model');
            Route::post('/store-brand', 'save_brand1')->name('store-brand');
            Route::get('/nextadd-inventry/{brand}/{model}', 'ajax_add')->name('nextadd-inventry');
            Route::post('/inventory-save', 'store')->name('inventory-save');
            Route::post('/inventory-add', 'save')->name('inventory-add');
            Route::get('/inventory_edit/{uuid}',  'edit')->name('inventory_edit');
            Route::post('/inventory_update',  'update')->name('inventory_update');
            Route::get('/inventory_delete/{uuid}', 'delete')->name('inventory_delete');
        });


        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('super.logout');
        Route::get('/change-password', [AuthenticationController::class, 'showChangePassword'])->name('super.change.password.show');
        Route::post('/change-password', [AuthenticationController::class, 'changePassword'])->name('super.change.password.update');



        Route::controller(VendorVisibilityController::class)->group(function () {
            Route::get('/vender-visibility', 'vendorApp')->name('vender-visibility');   
        });
    
        Route::controller(CompanyController::class)->group(function () { 
            Route::get('/company-list', 'index')->name('company-list');     
            Route::get('/create-company', 'create')->name('create-company'); 
            Route::get('/edit-company/{id}', 'edit')->name('edit-company'); 
            Route::get('/company_invoice_details/{id}', 'company_invoice_details')->name('company_invoice_details'); 
            Route::get('/company_transaction_details/{id}', 'company_transaction_details')->name('company_transaction_details'); 
            Route::get('/view-company/{id}', 'view')->name('view-company'); 
             Route::get('/transaction_details/{id}', 'transaction_details')->name('transaction_details'); 
            Route::get('/invoice_details_data/{id}', 'invoice_details_data')->name('invoice_details_data'); 
            Route::get('/add-bank', 'create_bank')->name('admin.companies.manage-companies.add-bank'); 
            Route::post('/check-unique-bank-numbers' ,'check_unique_bank_numbers')->name('check-unique-bank-numbers');
            Route::post('/create-process' ,'create_process')->name('create-process');
            Route::post('/edit-process' ,'edit_process')->name('edit-process');
            Route::post('/documents/delete', 'documentDelete')->name('document/delete');
            Route::get('/company-delete/{uuid}', 'delete')->name('company-delete');
            Route::post('/update-bank' ,'update_bank')->name('update-bank');
            Route::post('/delete-bank' ,'delete_bank')->name('delete-bank');
            Route::get('/aprroved_store/{data_id}/{checked}/{id}/{value}/{date}' ,'aprroved_store')->name('aprroved_store');
            Route::get('/rejected_store/{data_id}/{checked}/{id}/{value}/{date}' ,'rejected_store')->name('rejected_store');
            Route::get('/aprrov_store/{data_id}/{checked}/{id}/{value}/{date}' ,'aprrov_store')->name('aprrov_store');
            Route::get('/subscription_plan_details/{plan_id}' ,'subscription_plan_details')->name('subscription_plan_details');
            //Route::get('/edit/{plan_id}' ,'edit')->name('edit');
   
            Route::get('/virtual-contract/{company_id}', 'virtual_contract')->name('virtual-contract');     
            Route::post('/virtual-contract-store', 'virtual_contract_store')->name('virtual-contract-store');                                                                                                                              
            Route::get('/verify-otp/{company_id}', 'verify_otp')->name('verify-otp');                                                                                                                              
            Route::get('/send-otp/{company_id}', 'otpsend')->name('send-otp');                                                                                                                              
            Route::post('/verify-otp-store', 'verify_otp_store')->name('verify-otp-store');     
            Route::get('/reason_mail/{data_id}/{checked}/{id}/{reason}', 'reason_mail')->name('reason_mail');     
            Route::get('/reason_mail1/{data_id}/{checked}/{id}/{reason}', 'reason_mail1')->name('reason_mail1');     
            Route::get('/reason_mail2/{data_id}/{checked}/{id}/{reason}', 'reason_mail2')->name('reason_mail2');     
            Route::get('/bank_check_store/{bank}/{id}', 'bank_check_store')->name('bank_check_store');     
            Route::get('/bank_check_store_reason/{bank}/{id}/{reason}', 'bank_check_store_reason')->name('bank_check_store_reason');     
            
            //aggrement mail send url
            Route::get('/company-aggrement-mail/{uuid}', 'aggrement_mail')->name('company-aggrement-mail');


        });


        // Communication 
        Route::controller(CommunicationController::class)->group(function () {
            Route::get('/communication-list', 'index')->name('communication-list');
            Route::get('data/communication-list-json', 'json_list')->name('data/communication-list-json');
            Route::get('/add-communication', 'create')->name('add-communication');
            Route::get('/communication-save', 'store')->name('communication-save');
            Route::get('/communication_edit/{uuid}',  'edit')->name('communication_edit');
            Route::get('/communication_update',  'update')->name('communication_update');
            Route::get('/communication_delete/{uuid}', 'delete')->name('communication_delete');
        });


        Route::controller(SubscriptionPlansController::class)->group(function () {
            Route::get('/subscription-list', 'index')->name('subscription-list');
            Route::get('/subscription-add', 'create')->name('subscription-add');
            Route::get('/subscription_delete/{uuid}', 'destroy')->name('subscription_delete');


            
        });

        Route::controller(SummaryController::class)->group(function () {
            Route::get('/summery-list', 'index')->name('summery-list');
          
        });

        Route::controller(CompanyGLController::class)->group(function () {
            Route::get('/company-general-leader', 'index')->name('company-general-leader');
            Route::get('/companyfilter_gl' ,'companyfilter_gl')->name('companyfilter_gl');
            Route::get('/gltransaction_details/{id}', 'gltransaction_details')->name('gltransaction_details');
            Route::get('/glinvoice_details_data/{id}', 'glinvoice_details_data')->name('glinvoice_details_data');
          
        });

        Route::controller(LocalizationController::class)->group(function () {
            Route::get('/localization-add', 'index')->name('localization-add');
        });
		
        Route::controller(MiscController::class)->group(function () {
            Route::get('/misc-add', 'index')->name('misc-add');
        });
		
		  Route::controller(GeneralSettingController::class)->group(function () {
            Route::get('/general', 'create')->name('general'); 
        });


        Route::controller(VendorVisibilityController::class)->group(function () {
            Route::get('/vender-visibility', 'vendorApp')->name('vender-visibility');   

        });
            Route::controller(FleetVisibilityController::class)->group(function () {
                Route::get('/fleet-visibility', 'fleetApp')->name('fleet-visibility');  
        });
		
		Route::controller(CustomersController::class)->group(function () {
            Route::get('/customers', 'CustomersApp')->name('customers'); 
        });
		 Route::controller(CronJobsController::class)->group(function () {
            Route::get('cron_jobs', 'create')->name('cron_jobs');   
        });
		
		 Route::controller(PaymentGatewayController::class)->group(function () {
            Route::get('payment_gateway', 'create')->name('payment_gateway');    
        });
		
		 Route::controller(FinanceReleaseController::class)->group(function () {
            Route::get('release-add', 'add')->name('release-add');
            Route::get('release-list', 'index')->name('release-list'); 
            Route::get('/store_gl/{id}/{checked}', 'store_gl')->name('store_gl');			
        });
         Route::controller(FinanceRequestController::class)->group(function () {
            Route::get('request-add', 'add')->name('request-add');  
			Route::get('/request-list', 'index')->name('request-list');  
			Route::post('/request_save', 'store')->name('request_save');  
			Route::post('/reject_save', 'save')->name('reject_save');  
			Route::get('/store_release/{id}/{checked}', 'store_release')->name('store_release');  
			Route::get('/comapany_details/{id}/{value}', 'comapany_details')->name('comapany_details');  
            Route::get('data/request-datatable-json', 'json_request_list')->name('data/request-datatable-json');
        });
		
		
		  Route::controller(AuditController::class)->group(function () {
            Route::get('audit-list', 'index')->name('audit-list');      
        });




        //superadminrole
            Route::controller(SuperadminRoleController::class)->group(function () {
            Route::get('/superadminrole-list', 'index')->name('superadminrole-list');
            Route::get('/superadmin-role-toggle/{id}', 'roleStatus')->name('superadmin-role-toggle');
            Route::get('create-role', 'create')->name('create-role');
            Route::post('/save_superadminrole', 'store')->name('save_superadminrole');
            Route::get('/superadmin-role-delete/{uuid}', 'delete')->name('superadmin-role-delete');
            Route::get('update-superadmin-role/{uuid}', 'update')->name('update-superadmin-role');
            Route::post('/superadmin-edit-role', 'edit')->name('superadmin-edit-role');

         	
        });



        //superadminUser
        Route::controller(SuperadminUserController::class)->group(function () {
            Route::get('/superadminuser-list', 'index')->name('superadminuser-list');
            Route::get('/superadmin-user-toggle/{id}', 'userStatus')->name('superadmin-user-toggle');
            Route::get('create-user', 'create')->name('create-user');
            Route::post('/save_superadminuser', 'store')->name('save_superadminuser');
            Route::get('/superadmin-user-delete/{uuid}', 'destroy')->name('superadmin-user-delete');
            Route::get('superadmin-user-edit/{uuid}', 'edit')->name('edit-superadmin-user');
            Route::post('/superadmin-update-user', 'update')->name('superadmin-update-user');
            Route::get('/superadmin-users-view/{uuid}', 'viewuser')->name('superadmin-users-view');
            Route::get('/ajax_all_adminsubmenu/{role_id}','all_submenu')->name('ajax_all_submenu');
            Route::get('/ajax_fetchall_submenu/{role_id}/{user_id}',  'fetchall_submenu')->name('ajax_fetchall_submenu');
        });



        // Booking 
        Route::controller(BookingController::class)->group(function () {
            Route::get('/booking-list', 'index')->name('booking-list');
            // Route::get('data/booking-list-json', 'json_list')->name('data/booking-list-json');
            Route::get('/add-booking', 'create')->name('add-booking');
            Route::get('tabinvoice/{uuid}', 'tabinvoice')->name('tabinvoice'); 
            Route::post('/booking-save', 'store')->name('booking-save');
            Route::get('create_booking_invoice/{uuid}', 'createInvoice')->name('create_booking_invoice'); 
            Route::get('/booking_edit/{uuid}',  'edit')->name('booking_edit');
            Route::get('/booking_update',  'update')->name('booking_update');
            Route::get('/booking_delete/{uuid}', 'delete')->name('booking_delete');
            Route::get('/customer-data/{org_id}', 'customer_details')->name('customer-data');
            Route::get('customer_auto_suggestion', 'customer_auto_suggestion')->name('customer_auto_suggestion');
            Route::post('/save_bookings_invoice', 'storeInvoice')->name('save_bookings_invoice');
            Route::get('/invoices-preview/{uuid}', 'preview')->name('invoices-preview/{uuid}');
            Route::post('inv_notes_store/{uuid}', 'inv_note_store')->name('inv_notes_store'); 
            Route::get('/brandmodel/{brand_id}/{model_id}', 'get_model')->name('brandmodel');
            Route::get('/marchantbrandmodel/{brand_id}/{model_id}', 'get_marchantmodel')->name('marchantbrandmodel');
            Route::get('/get_available_fleet/{model_id}/{fleet_id}/{from_date}/{to_date}', 'get_available_fleet')->name('brandmodel');
            Route::get('/fleetvehicle/{model_ids}/{vehicle_id}', 'get_vehicles')->name('fleetvehicle');




        });

        // Backup 
        Route::controller(BackupController::class)->group(function () {
            Route::get('/backup-list', 'index')->name('backup-list');
            Route::get('data/backup-list-json', 'json_list')->name('data/backup-list-json');

        });
       Route::controller(SubscriptionPlansController::class)->group(function () {
      Route::get('/subscriptions-list', 'index')->name('subscriptions-list');
      Route::get('data/superadmin/subscription/subscription-data-list.json', 'json_list')->name('data/superadmin/subscription/subscription-data-list.json');
       Route::get('/add-subscriptions', 'create')->name('add-subscriptions');
   //  Route::get('/manage-booking-edit/{uuid}', 'edit')->name('manage-booking-edit');
       Route::post('/subscription-edit', 'edit')->name('subscription-edit');
       Route::get('/subscription-update/{uuid}', 'update')->name('subscription-update');
      Route::post('/subscriptions-save', 'store')->name('subscriptions-save');
      Route::get('/subscription_delete/{uuid}', 'delete')->name('subscription_delete');

    
 });
 


    });



});
