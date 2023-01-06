<?php

namespace App\Models;

use App\Traits\Organisationid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription_submodule extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'subcription_id',
        'subscription_menu_id',
        'admin_sub_menu_id',
        // 'dashboard',
        // 'leads',
        // 'contacts',
        // 'fleet',
        // 'bookings',
        // 'accounts',
        // 'module_id',
        // 'customers',
        // 'users',
        // 'role',
        // 'role_permission',
        // 'vendor',
        // 'manage_bookings',
        // 'bookings_calander',
        // 'promotion',
        // 'invoice',
        // 'payment',,
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function subcription()
    {
        return $this->belongsTo(SubscriptionPlans::class, 'subcription_id', 'id');
    }

    public function admin_sub_menu()
    {
        return $this->belongsTo(AdminSubMenu::class, 'admin_sub_menu_id', 'id');
    }

}
