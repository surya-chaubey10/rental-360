<?php

namespace App\Models;
use App\Traits\Organisationid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReserveFleet extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [ 'organisation_id', 'booking_id','fleet_id','model_id','brand_id','car_SKU','from_date','to_date'];
    protected $dates = ['deleted_at'];
    
   
    
}
