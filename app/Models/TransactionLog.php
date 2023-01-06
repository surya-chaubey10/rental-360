<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Organisationid;
use Illuminate\Support\Str;

class TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'name',
        'payment_method',
        'amount'

    ]; 


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


}
