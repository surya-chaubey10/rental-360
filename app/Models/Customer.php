<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class Customer extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'uuid', 'organisation_id', 'company', 'customer_type', 'user_id', 'status','website', 'language', 'gender', 'contact_option', 'address1', 'address2', 'postcode', 'city', 'state','twitter','facebook', 'instagram', 'github', 'codepen', 'stack'
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
