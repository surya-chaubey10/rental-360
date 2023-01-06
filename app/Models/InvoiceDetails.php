<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Fleet;

class InvoiceDetails extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
     
    protected $fillable = ['header_id','sku','description','unit_price','quantity','discount','tax','total'];

        public function fleet()
        {
            return $this->belongsTo(Fleet::class, 'sku', 'id');
        }
}
