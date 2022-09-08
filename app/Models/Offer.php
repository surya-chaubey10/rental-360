<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid', 'offer_category_id', 'offer_image', 'vehicle_id', 'startdate','enddate','starttime','endtime','discount_type','minimun_value','maximum_value','organisation_id', 'status','created_user','updated_user'
    ];
    protected $dates = ['deleted_at'];
    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
