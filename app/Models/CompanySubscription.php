<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;  
use App\Models\Organisation; 
use App\Models\Company;
use Illuminate\Support\Str;



class CompanySubscription extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'organisation_id',

        'billing_plan',
        'add_on_charge',
        'diposit',
        'convenience_type',
        'convenience_amount',
        'commission_type',
        'commission_amount',

        'withdrawal_type',
        'withdrawal_amount',
        'payment_gateway',
        'payement_gateway_amount',
        'first_billing_date',
        'end_billing_date',
        'auto_renewal',
        'description',
        'include_description',
        'currency',
        'vat',

        'other',
        'term_condition',

        'payout_setup',
        'time_cycle',
        'payout_day',


    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class,  'organisation_id', 'id');
    }


    public function country()
    {
        return $this->belongsTo(CountryMaster::class,  'country_id', 'id');
    }

}
