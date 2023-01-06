<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;

class SubscriptionPlans extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;

   
    protected $fillable = [
        'uuid',
        'organisation_id','plan_name','add_on_charge','deposit','convenience_fees_type','convenience_fees_amount','commission_fees_type','commission_fees_amount','withdrawal_charges_add','withdrawal_charges_amuont','visa_master_card','binance_pay','spotii','note'
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
