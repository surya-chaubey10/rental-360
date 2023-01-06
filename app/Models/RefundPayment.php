<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use App\Models\Organisation;
use Illuminate\Support\Str;

class RefundPayment extends Model
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
        'refund_amount',
        'total_amount',
        'cart_currency',
        'reason_description',
        'token',
        'full_name',
        'email',
        'supporting_document',
        'transection_id'
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
}
