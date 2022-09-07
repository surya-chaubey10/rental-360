<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;

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
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function users()
    {
        return $this->hasMany(User::class,  'organisation_id', 'id');
    }
    
}
