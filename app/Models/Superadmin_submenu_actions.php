<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superadmin_submenu_actions extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'menu_id',
        'submenu_id',
        'action_name',
        'action_url',
        'updated_user',
        'created_user'
    ];
}
