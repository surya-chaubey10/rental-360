<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use App\Traits\Organisationid;
use Laravel\Sanctum\HasApiTokens;
class SuperadminRoleSubMenu extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $fillable = [
        'uuid','id','admin_sub_menu_id','role_menu_id','role_id','admin_submenu_name',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function user_submenuaction()
    {
        return $this->hasMany(Superadmin_submenu_actions::class, 'submenu_id', 'admin_sub_menu_id')
                           ->select('superadmin_submenu_actions.*','sub_menus.name')
                           ->leftJoin('superadmin_sub_menus as  sub_menus', function ($join) {
                               $join->on('sub_menus.id', '=', 'superadmin_submenu_actions.submenu_id');
                             })->where('superadmin_submenu_actions.order','!=','0');

    }
    public function role()
    {
        return $this->belongsTo(SuperadminRole::class, 'role_id', 'id');
    }


    public function admin_sub_menu()
    {
        return $this->belongsTo(SuperadminSubMenu::class, 'admin_sub_menu_id', 'id');
    }
}
