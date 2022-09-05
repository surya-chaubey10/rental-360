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
        $superAdminUser = new User();
        $superAdminUser->usertype               = 0;
        $superAdminUser->fullname               = 'Super Admin';
        $superAdminUser->email                  = 'superadmin@admin.com';
        $superAdminUser->email_verified_at      = date('Y-m-d H:i:s');
        $superAdminUser->password               = \Hash::make('123456');
        $superAdminUser->country_id             = 1;
        $superAdminUser->mobile                 = '9874563210';
        $superAdminUser->api_token              = Str::random(35);
        $superAdminUser->role_id                = 1;
        $superAdminUser->save();

        $orgAdminUser = new User();
        $orgAdminUser->usertype           = 1;
        $orgAdminUser->organisation_id    = 1;
        $orgAdminUser->fullname           = 'Demo';
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
            'booking-edit',
            'booking-delete',
            'customer-list',
            'customer-view',
            'customer-edit',
            'customer-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdminRole = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);

        $permissions = Permission::pluck('id', 'id')->all();

        $superAdminRole->syncPermissions($permissions);

        $superAdminUser->assignRole([$superAdminRole->id]);

        // create admin and assign permissions
        $orgAdminRole = Role::create(['name' => 'org-admin', 'guard_name' => 'web']);

        $permissions = Permission::pluck('id', 'id')->all();

        $orgAdminRole->syncPermissions($permissions);

        $orgAdminUser->assignRole([$orgAdminRole->id]);
    }
}
