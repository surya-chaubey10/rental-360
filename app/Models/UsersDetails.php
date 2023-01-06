<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\SoftDeletes;


class UsersDetails extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'uuid', 
        'user_id',  
        'dob',
        'gender',
        'website',
        'image',
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
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
