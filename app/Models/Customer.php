<?php

namespace App\Models;

use App\Traits\Organisationid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Organisationid;

    protected $fillable = [
        'user_id',
        'organisation_id',
        'company',
        'customer_type',
        'dob',
        'gender',
        'website',
        'language',
        'address1',
        'address2',
        'postcode',
        'city',
        'state',
        'twitter',
        'facebook',
        'instagram',
        'github',
        'codepen',
        'stack',
        'contact_option',
        'approval_status',
        'status',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
