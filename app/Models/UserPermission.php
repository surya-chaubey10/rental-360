<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;

class UserPermission extends Model
{
    use HasFactory,HasApiTokens, SoftDeletes;
    protected $fillable = [
        'uuid','id', 'role_id','user_id','organisation_id','menu_id','sub_menu_id','view_url','edit_url','create','delete'
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

  
}
