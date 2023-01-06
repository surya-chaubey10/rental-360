<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use App\Models\Fleetdetails;
use App\Models\VehicleModel;
use Laravel\Sanctum\HasApiTokens;   
use App\Models\VehicleBrand;
use App\Models\ManageBookings;

class Fleet extends Model
{
    use HasFactory;
     //use SoftDeletes ;
    protected $fillable = [
        'organisation_id','uuid','image','mega_discription','features','booking_conditions','documents','documents2','documents3','documents4','type','car_SKU','car_year','car_service_type','car_color','car_number','car_chasis_number','fleet_size','allowed_distance','unit','child_seat','insurence','additional_distance','owner_name','phone','email','billing_email','brand_id','model_id','is_deleted'
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


    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class, 'brand_id', 'id');
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id', 'id');
    }


    public function fleetDetails()
    {
        return $this->hasMany(Fleetdetails::class, 'fleet_id', 'id');
    }

    public function fleetsbooking()
    {
        return $this->hasMany(ManageBookings::class, 'vehicle_id', 'id');
    }
}
