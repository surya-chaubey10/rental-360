<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class FleetModel extends Model
{
     use HasApiTokens, HasFactory, SoftDeletes;

     protected $fillable = [
        'uuid', 'model_name', 'brand_id','organisation_id', 'status','created_user','updated_user'
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
