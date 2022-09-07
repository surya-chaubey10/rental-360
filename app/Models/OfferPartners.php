<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class OfferPartners extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'partner_name','status'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function offerpartners()
    {
        return $this->hasMany(OfferPartners::class,  'organisation_id', 'id');
    }
}
