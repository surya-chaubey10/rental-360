<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;


class ManageBookings extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'select_customer','pickup_date_time','drop_off_date_time','select_vehicle','select_driver','no_of_traveller','pickup_address','dropoff_address','note','add_field_name','added_field_data'
    ]; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
