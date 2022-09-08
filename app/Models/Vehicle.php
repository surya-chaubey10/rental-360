<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid', 'vehicle_name','organisation_id', 'status'
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
