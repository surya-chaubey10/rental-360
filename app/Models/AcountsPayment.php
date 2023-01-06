<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;
use App\Models\VehicleBrand;
use App\Models\CompanyMoreInformation;

class AcountsPayment extends Model
{
  
    use HasFactory,SoftDeletes;
    protected $fillable = ['id','uuid','organisation_id','booking_id','invoice_id','full_name','transaction_type','phone','email','amount','agent_id','description','comment'
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

    public function moreInfo()
    {
        return $this->hasOne(CompanyMoreInformation::class, 'organisation_id','organisation_id');
    }

}
