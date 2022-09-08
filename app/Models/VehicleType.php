<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class VehicleType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid','organisation_id','type_name','service_type','type_image','status','description'
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
