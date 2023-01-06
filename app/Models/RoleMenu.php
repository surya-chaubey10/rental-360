<?php

namespace App\Models;
use App\Models\RoleSubMenu;
use App\Models\AdminMenu;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid; 

class RoleMenu extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function role_sub_menu(){
        return $this->hasMany(RoleSubMenu::class,  'role_menu_id', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class,  'role_id', 'id');
    }

    public function admin_menu()
    {
        return $this->belongsTo(AdminMenu::class,  'admin_menu_id', 'id');
    }

}
