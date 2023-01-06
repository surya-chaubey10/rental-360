<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use Illuminate\Support\Str;
class OpeningBalance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'start_date',
        'end_date',
        'amount',
        'account_type',
        'status',
         
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
