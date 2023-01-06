<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Organisationid;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadsModel extends Model
{ 
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'source',
        'assigned',
        'status',
        'tags',
        'type',
        'vehicle',
        'model',
        'from',
        'to',
        'note',
        'twitter',
        'facebook',
        'instagram',
        'github',
        'codepen',
        'slack',

    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


}
