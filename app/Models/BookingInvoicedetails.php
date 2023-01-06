<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;

class BookingInvoicedetails extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [

        'invoice_id','sku','description','price','period','discount','tax','total'
    ];
   
    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'sku', 'id');
    }

}
