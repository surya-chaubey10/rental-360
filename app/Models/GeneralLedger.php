<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid; 
use Illuminate\Support\Str;
use App\Model\Customer;
use App\Model\ManageBookings;
use App\Model\Organisation;
class GeneralLedger extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'amount',
        'credit',
        'debit',
        'customer_id',
        'booking_id',
        
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,  'customer_id', 'id');
    }

    public function manage_booking()
    {
        return $this->belongsTo(ManageBookings::class,  'booking_id', 'id');
    }


}
