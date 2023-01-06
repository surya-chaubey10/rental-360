<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str; 
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\VehicleBrand;
use App\Models\Customer;
use App\Models\Fleet;
use App\Models\Transaction;
use App\Models\BookingInvoice;


class ManageBookings extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'short_link', 'select_customer','pickup_date_time','drop_off_date_time','select_vehicle','select_driver','no_of_traveller','pickup_address','dropoff_address','note','add_field_name','added_field_data','select_model','extend_date'
    ]; 

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function customerInfo()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'user_id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(VehicleBrand::class, 'vehicle_id', 'id');
    }
    public function invoice()
    {
        return $this->belongsTo(BookingInvoice::class, 'id', 'booking_id');
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'vehicle_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'booking_id', 'id');
    }
    public function get_model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id', 'id');
    }
}
