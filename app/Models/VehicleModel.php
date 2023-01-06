<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\ManageBookings;


class VehicleModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid',
        'organisation_id','user_id','organisation_id','model_name','brand_id','status'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


    public function Bookings()
    {
        return $this->hasMany(ManageBookings::class, 'model_id', 'id')->where('payment_status','A');
    }
}
