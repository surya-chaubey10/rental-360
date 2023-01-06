<?php

namespace App\Imports;

use App\Models\Fleet;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFleet implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Fleet([
            'email' =>  $row['email'],
            'organisation_id' =>$row['organisation_id'],
            'mega_discription' =>  $row['mega_discription'],
            'brand_id' =>  $row['brand_id'],
            'is_reserved'  => $row['is_reserved'],
            'features' => $row['features'],
            'booking_conditions'   => $row['booking_conditions'],
            'insurance_provider' => $row['insurance_provider'],
            'documents3' =>  $row['documents3'],
            'type' => $row['type'],
            'car_SKU' => $row['car_SKU'],
            'insurance_Expire_date' =>  $row['insurance_Expire_date'],
            'model_id' =>  $row['model_id'],
            'documents' => $row['documents'],
            'documents2'  =>  $row['documents2'],
            'car_year' =>  $row['car_year'],
            'car_service_type' =>  $row['car_service_type'],
            'car_number'  => $row['car_number'],
            'car_chasis_number'  => $row['car_chasis_number'],
            'fleet_size'  =>  $row['fleet_size'],
            'allowed_distance' =>$row['allowed_distance'],
            'unit' =>$row['unit'],
            'insurence' =>$row['insurence'],
            'child_seat' =>$row['child_seat'],
            'additional_distance' =>$row['additional_distance'],
            'owner_name' =>$row['owner_name'],
            'phone' =>$row['phone'],
            'billing_email' =>$row['billing_email'],
        ]);
    }
}
