<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Inventory extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'uuid', 'brand_name', 'model_name', 'inventory_type', 'user_id', 'organisation_id', 'status'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}