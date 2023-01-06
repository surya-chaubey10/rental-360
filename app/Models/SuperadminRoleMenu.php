<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;

class SuperadminRoleMenu extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'uuid','id','admin_menu_id','role_id','admin_menu_name',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    
    public function role()
    {
        return $this->belongsTo(SuperadminRole::class, 'role_id', 'id');
    }


    public function admin_menu()
    {
        return $this->belongsTo(SuperadminMenu::class,  'admin_menu_id', 'id');
    }

    public function role_sub_menu()
    {
        return $this->hasMany(SuperadminRoleSubMenu::class,  'role_menu_id', 'admin_menu_id');
    }


}
