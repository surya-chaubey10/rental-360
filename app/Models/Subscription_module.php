<?php

namespace App\Models;

use App\Traits\Organisationid;
use Illuminate\Support\Str;
use App\Models\AdminMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription_module extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'subcription_id',
        'admin_menu_id',
        'created_user',
        'updated_user',
        // 'dashboard',
        // 'leads',
        // 'contacts',
        // 'fleet',
        // 'bookings',
        // 'accounts',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function subscription()
    {
        return $this->belongsTo(SubscriptionPlans::class, 'subcription_id', 'id');
    }


    public function admin_menu()
    {
        return $this->belongsTo(AdminMenu::class, 'admin_menu_id', 'id');
    }

    public function subcription_sub_menu()
    {
        return $this->hasMany(Subscription_submodule::class, 'subscription_menu_id', 'admin_menu_id');
    }





}
