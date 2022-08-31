<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'organisation_id',
        'customer_id',
        'vehicle_id',
        'driver_id',
        'picking_date_time',
        'drop_off_date_time',
        'no_of_travellers',
        'pickup_address',
        'drop_off_address',
        'note'
    ];
}
