<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCustomer implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([

            'username' => $row['username'],
            'fullname' => $row['fullname'],
            'customer_type' => $row['customer_type'],
            'company' => $row['company'],
            'birth_date' => $row['birth_date'],
            'website' => $row['website'],
            'language' => $row['language'],
            'email' => $row['email'],
            'password' => $row['password'],
            'address1' => $row['address1'],
            'address2' => $row['address2'],
            'city' => $row['city'],
            'postal_code' => $row['postal_code'],
            'country' => $row['country'],
            'state' => $row['state'],
            'facebook'  => $row['facebook'],
            'twitter'  => $row['twitter'],
            'instagram'  => $row['instagram'],
            'github'  => $row['github'],
            'codepen'  => $row['codepen'],

        ]);
    }
}
