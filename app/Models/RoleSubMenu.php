<?php

namespace App\Models;
use App\Models\SubmenuAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid; 
use App\Models\AdminSubMenu;


class RoleSubMenu extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    public function user_submenuaction()
    {
        return $this->hasMany(SubmenuAction::class, 'submenu_id', 'admin_sub_menu_id')
                           ->select('submenu_actions.*','sub_menus.name')
                           ->leftJoin('admin_sub_menus as  sub_menus', function ($join) {
                               $join->on('sub_menus.id', '=', 'submenu_actions.submenu_id');
                             })->where('submenu_actions.order','!=','0');
                       
    }

    public function admin_sub_menu()
    {
        return $this->belongsTo(AdminSubMenu::class,  'admin_sub_menu_id', 'id');
    }
}
