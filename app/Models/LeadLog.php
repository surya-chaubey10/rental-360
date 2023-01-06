<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Organisationid;
use Illuminate\Database\Eloquent\SoftDeletes;   
use App\Models\User;
use App\Models\LeadsModel;
use Illuminate\Support\Str;



class LeadLog extends Model
{
    use HasFactory, Organisationid, SoftDeletes;
    

    protected $fillable = [
        'uuid',
        'organisation_id',
        'user_id',
        'lead_id',
        'created_user',
        'log',

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
        return $this->belongsTo (User::class, 'user_id', 'id');
    }

    public function lead()
    {
        return $this->belongsTo (LeadsModel::class, 'lead_id', 'id');
    }

}
