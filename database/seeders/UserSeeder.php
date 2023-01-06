<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $orgAdminUser = new User();
        $orgAdminUser->usertype           = 1;
        $orgAdminUser->organisation_id    = 1;
        $orgAdminUser->fullname           = 'Demo';
        $orgAdminUser->username           = 'Admin';
        $orgAdminUser->email              = 'demo@gmail.com';
        $orgAdminUser->email_verified_at  = date('Y-m-d H:i:s');
        $orgAdminUser->password           = \Hash::make('123456');
        $orgAdminUser->country_id         = 1;
        $orgAdminUser->mobile             = '9999999999';
        $orgAdminUser->api_token          = Str::random(35);
        $orgAdminUser->role_id            = 2;
        $orgAdminUser->save();

        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
            'dashboard-list',
            'booking-list',
            'booking-create',
            'booking-add',
            'booking-edit',
            'booking-delete',
            'customer-list',
            'customer-view',
            'customer-add',
            'customer-edit',
            'customer-delete',
			'inventory-list',
			'inventory-save',
			'inventory_edit',
			'inventory_delete',
			'offerpackages-list',
			'vendor-list',
			'vendor-save',
			'vendor-edit',
			'vendor-view',
			'vendor-delete',
			'offer-list',
			'offer-save',
			'offer-edit',
			'offer-delete',
			'booking-calender',
			'offer-category-list',
			'offer-category',
			'update-offer-category',
			'offer-category-delete',
			'offer-partner-list',
			'offer-partner',
			'update-offer-partner',
			'offer-partner-delete',
			'manage-booking-list',
			'add-manage-booking', 
			'manage-booking-edit',
			'bookings-delete',
			'vehicle-brand-list',
            'add-vehicle-brand',			
			'edit-vehicle-brand',
			'vehicle-brand-delete',
            'vehicle-type-list',
			'add-vehicle-type', 
			'edit-vehicle-type',
			'vehicle-type-delete',
			'vehicle-create',
			'receipt',
			'generate-invoice', 
            'leads-list', 
            'leads-create',
            'leads-edit',
			'leads-view',
			'leads-delete',
			'expenses-list',
			'add-expenses',
			'expense-category-list',
			'add-expense-category',
			'group-buying',
			'expense-subcategory-list',
			'add-expense-subcategory',
            'purchase-list',
            'purchase-add',	
            'account-list',
			'add-account',
			'edit-account',
			'view-account',
            'mylist',
            'email',
            'create-segments',
            'return-list',
            'return-add',
            'invoice-list',
            'invoice-edit',
            'invoice-delete',
            'non-invoice-list',
            'add-non-invoice',
			'non-invoice-edit',
			'non-invoice-delete',
			'supplier-purchase-list',
			'supplier-add-purchase',
			'supplier-purchase-edit',
			'supplier-purchase-delete',
			'supplier-purchase-show',
			'supplier-non-purchase-list',
			'supplier-add-non-purchase',
			'supplier-non-purchase-edit',
			'supplier-non-purchase-delete',
			'general_marketing',
			'quotation-list',
			'quotation-add',
			'balance-adjustment-list',
			'balance-adjustment-add',
			'balance-adjustment-edit',
			'balance-transfer-list',
			'add-balance-transfer',
			'edit-balance-transfer',
			'view-balance-transfer',
			'transaction-history-list', 
			'salesinvoice-list',
			'salesinvoice-add',
			'invoicereturn-list',
			'invoicereturn-add',
			'campaigns',
			'create-Campaigns',
			'payroll-add',
			'payroll-list',
			'payroll-edit',
			'payroll-view',
			'coupons-add', 
			'coupons-list',
			'fleet-list',
			'add-fleet',
			'fleet-edit',
			'fleet-delete',
			'transaction_amount_save',
			'acounts-payment-list',
			'addquick-payment',
            'withdraw-list',	
            'withdraw_save',       		   
			
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create admin and assign permissions
        $orgAdminRole = Role::create(['name' => 'org-admin', 'guard_name' => 'web']);

        $permissions = Permission::pluck('id', 'id')->all();

        $orgAdminRole->syncPermissions($permissions);

        $orgAdminUser->assignRole([$orgAdminRole->id]);
    }
}
