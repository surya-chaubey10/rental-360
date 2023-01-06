<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryImages extends Model
{
    use HasFactory;

    public static function boot()
{
    parent::boot();
    
    static::creating(function ($model) {
        $model->uuid = Str::uuid();
    });
}
}
