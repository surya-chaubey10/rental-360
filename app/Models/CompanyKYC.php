<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;  
use App\Models\Organisation;
use Illuminate\Support\Str;


class CompanyKYC extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'ow_owner_id',
        'ow_doc_type',
        'ow_vat_document',
        'ow_vat_doc_type',
        'ow_other',
        'ow_other_doc_type',
        'bu_owner_id',
        'bu_doc_type',

        'bu_vat_document',
        'bu_vat_doc_type',
        'bu_other',
        'bu_other_doc_type',
        'ot_owner_id',
        'ot_doc_type',
        'ot_vat_document',
        'ot_vat_doc_type',

        'ot_other',
        'ot_other_doc_type',

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
