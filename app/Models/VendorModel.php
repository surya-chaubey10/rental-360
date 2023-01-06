<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\CustomerType;
class VendorModel extends Model
{
   
    use HasFactory;
    /**
     * The attributes that are mass assignable. 
     *
     * @var array<int, string>
     */
    protected $table='vendors';
    protected $fillable = [
        'uuid', 'organisation_id', 'company', 'customer_type', 'user_id', 'status','website','image', 'language', 'gender', 'contact_option', 'address1', 'address2', 'postcode', 'city', 'state','twitter','facebook', 'instagram', 'github', 'codepen', 'stack' 
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function customer_typee()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type', 'id');
        
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
