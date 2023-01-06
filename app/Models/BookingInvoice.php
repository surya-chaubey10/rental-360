<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;   
use App\Models\BookingInvoicedetails;
use App\Models\ManageBookings;
use App\Models\Organisation;    
use App\Models\Transaction; 
use App\Models\CompanyMoreInformation; 

class BookingInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [

        'booking_id','name','email','currency_type','transaction_type','customer_ref','invoice_ref','phone','street','city','country','state','zip','inv_description'
    ];
   
    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id','id');
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function invoicedetails()
    {
        return $this->hasMany(BookingInvoicedetails::class, 'invoice_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(ManageBookings::class, 'booking_id', 'id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id', 'invoice_id');
    }

    public function moreInfo()
    {
        return $this->hasOne(CompanyMoreInformation::class, 'organisation_id','organisation_id');
    }
}
