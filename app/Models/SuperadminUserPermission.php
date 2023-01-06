<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SuperadminUserPermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid','id', 'role_id','user_id','menu_id','sub_menu_id','view_url','edit_url','create_url','delete_url'
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

}
