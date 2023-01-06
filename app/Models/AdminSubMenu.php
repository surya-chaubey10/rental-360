<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;


class AdminSubMenu extends Model
{
    use HasFactory;



    public function menu()
    {
        return $this->belogsTo(AdminMenu::class,  'admin_menu_id', 'id');
    }


}
