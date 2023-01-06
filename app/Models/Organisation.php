<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use App\Models\User;
use App\Models\CompanyBank;
use App\Models\CompanyKYC;
use App\Models\CompanyMoreInformation;  
use App\Models\CompanySubscription;
use App\Models\CountryMaster;
use App\Models\OrganisationSubMenu;    
use App\Models\Document;    
use App\Models\ManageBookings;
use App\Models\OrganisationMenu;



class Organisation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'org_name',
        'org_company_id',
        'org_tax_id',
        'org_street1',
        'org_street2',
        'org_city',
        'org_state',
        'org_country_id',
        'org_postal',
        'org_phone',
        'org_contact_person',
        'org_contact_person_number',
        'org_currency',
        'org_fasical_year',
        'is_batch_enabled',
        'is_credit_limit_enabled',
        'org_logo',
        'is_auto_approval_set',
        'org_status',
        'is_trial_period',
        'agreement_status',
        'agreement_otp',
        'is_mobile_verified',
        'mobile_otp',
        'signature',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


    public function banks()
    {
        return $this->hasMany(CompanyBank::class, 'organisation_id','id');

    }   

    public function kycDetail()
    {
        return $this->hasOne(CompanyKYC::class, 'organisation_id','id');

    }   

    public function kycDetailStatus()
    {
        return $this->hasOne(Document::class, 'organisation_id','id');

    }   

    public function moreInfo()
    {
        return $this->hasOne(CompanyMoreInformation::class,  'organisation_id', 'id');

    }   

    public function subscription()
    {
        return $this->hasOne(CompanySubscription::class,  'organisation_id', 'id');

    }   

    public function user()
    {
        return $this->hasOne(User::class,  'organisation_id', 'id');

    }

    public function customerUser()
    {
        return $this->hasMany(User::class,  'organisation_id', 'id')->where('usertype',4);

    }

    public function booking()
    {
        return $this->hasMany(ManageBookings::class,  'organisation_id', 'id');
    }

    public function adminUser()
    {
        return $this->hasOne(User::class,  'organisation_id', 'id')->where('usertype',1);

    }
    public function countrymaster()
    {
        return $this->hasOne(CountryMaster::class,  'id', 'org_country_id');
    }

    public function org_menu()
    {
        return $this->hasMany(OrganisationMenu::class,  'organisation_id', 'id');
    }

    public function org_sub_menu()
    {
        return $this->hasMany(OrganisationSubMenu::class,  'organisation_id', 'id');
    }

    
}
