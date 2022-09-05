<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_types')->delete();

        $customerType = new CustomerType();
        
        $customerType->type_name            = 'Subscriber';
        $customerType->user_id              = 1;
        $customerType->status               = '1';
        $customerType->save();

        $customerType = new CustomerType();
        $customerType->type_name            = 'Editor';
        $customerType->user_id              = 1;
        $customerType->status               = '1';
        $customerType->save();

        $customerType = new CustomerType();
        $customerType->type_name            = 'Maintainer';
        $customerType->user_id              = 1;
        $customerType->status               = '1';
        $customerType->save();

        $customerType = new CustomerType();
        $customerType->type_name            = 'Author';
        $customerType->user_id              = 1;
        $customerType->status               = '1';
        $customerType->save();

        $customerType = new CustomerType();
        $customerType->type_name            = 'Admin';
        $customerType->user_id              = 1;
        $customerType->status               = '1';
        $customerType->save();

    }
}
