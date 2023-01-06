<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;  
use App\Models\Organisation; 
use App\Models\CountryMaster;
use Illuminate\Support\Str;


class CompanyMoreInformation extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'organisation_id',

        'trn_number',
        'office_address',
        'city',
        'country_id',
        'state',
        'zip',
        'profile_image',

        'profile_id',
        'server_key',
        'company_prefix',
        'account_type_id',
        'currency_id',
        'company_profile',
        'packages_id',
        'branded_pay_1',
        'branded_pay_2',

        'sender_id',
        'api_key',
        'sms_limit',

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
