<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ManageBookings;
use App\Models\InvoiceDetails;

class Invoice extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = ['uuid','organisation_id','user_id','full_name','email','currency','transaction_type','customer_ref','invoice_ref', 'phone','street','city','country','state','zip','discription','sub_total','discount','extra_charge','shipping_charge','grand_total','status'
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

    public function booking()
    {
        return $this->belongsTo(ManageBookings::class, 'booking_id', 'id');
    }
    public function invoicedetails()
    {
        return $this->belongsTo(InvoiceDetails::class, 'id', 'invoice_id');
    }
    
}
