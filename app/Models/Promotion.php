<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;

class Promotion extends Model
{

    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'uuid','organisation_id','from_date','to_date','promotion_code','status','promotion_type','promotion_value',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
}
