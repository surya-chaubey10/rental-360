<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;
class OfferCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_name','status','uuid','organisation_id',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
}
