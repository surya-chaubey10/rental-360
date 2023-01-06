<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Organisationid;
class Document extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
}
