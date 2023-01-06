<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;
class Fleetdetails extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'fleet_id','material','deposit','unit_price','discount','vat','minimum','subtotal'
    ];
   
    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id', 'id');
    }
}
