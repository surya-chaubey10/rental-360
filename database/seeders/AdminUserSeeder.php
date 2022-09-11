<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminUser = new AdminUser();
        $superAdminUser->fullname               = 'Super Admin';
        $superAdminUser->email                  = 'superadmin@admin.com';
        $superAdminUser->password               = \Hash::make('123456');
        $superAdminUser->mobile                 = '9033777859';
        $superAdminUser->save();
    }
}
