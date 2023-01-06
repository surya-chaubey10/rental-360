<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuperadminSubMenu;


class SuperadminMenu extends Model
{
    use HasFactory;



    public function sub_menu()
    {
        return $this->hasMany(SuperadminSubMenu::class,  'superadmin_menu_id', 'id')->where('status','=',1);
    }
}
