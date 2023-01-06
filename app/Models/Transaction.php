<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use App\Models\Organisation;
use App\Models\BookingInvoice;
use App\Models\BookingInvoicedetails;

use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'uuid',
        'user_id',
        'booking_id',
        'invoice_id',
        'tran_ref',
        'tran_type',
        'cart_id',
        'cart_amount',
        'cart_currency',
        'payment_status',
        'payment_code',
        'transaction_time',
        'payment_method',
        'card_type',
        'payment_description',
        'token',
        'response_message',
        'response_code',
        'refund_resp',
        'conversion_rate',
        'conversion_amount',
        'transferable_amount',
        'account_type'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class,  'organisation_id', 'id');
    }
    public function invoicetran()
    {
        return $this->belongsTo(BookingInvoice::class,  'tran_ref', 'trans_ref')->where('booking_invoices.is_adjust_invoice','1');
    }
    public function invoicedetaistran()
    {
        return $this->belongsTo(BookingInvoicedetails::class,  'invoice_id', 'invoice_id');
    }
}
