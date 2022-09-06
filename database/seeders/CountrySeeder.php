<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        $Country = new Country();
        
        $Country->name                 = 'India';
        $Country->save();

        $Country = new Country();
        
        $Country->name                 = 'Germany';
        $Country->save();

        $Country = new Country();
        
        $Country->name                 = 'Belarus';
        $Country->save();

        $Country = new Country();
        
        $Country->name                 = 'Brazil';
        $Country->save();

        $Country = new Country();
        
        $Country->name                 = 'France';
        $Country->save();

    }
}
