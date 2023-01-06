<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use App\Model\Request;  
use Illuminate\Support\Str;
class Release extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'request_id',
        'company_name',
        'withdraw_amount',
        'withdraw_fees',
        'request_on',
        'last_approval_date',
        'status',
         
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function request()
    {
        return $this->hasOne(Request::class,  'request_id', 'id');
    }


}
