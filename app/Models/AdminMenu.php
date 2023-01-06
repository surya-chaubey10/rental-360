<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminSubMenu;


class AdminMenu extends Model
{
    use HasFactory;



    public function sub_menu()
    {
        return $this->hasMany(AdminSubMenu::class,  'admin_menu_id', 'id')->where('status','=',1);
    }



}




