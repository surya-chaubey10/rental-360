<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;  
use App\Models\Organisation;
use App\Models\AdminSubMenu;
use App\Models\Company;
use App\Models\OrganisationMenu;
use Illuminate\Support\Str;

class OrganisationSubMenu extends Model
{
    use HasFactory, SoftDeletes, Organisationid;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'organisation_menu_id',
        'admin_sub_menu_id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class,  'organisation_id', 'id');
    }

    public function admin_sub_menu()
    {
        return $this->belongsTo(AdminSubMenu::class,  'admin_sub_menu_id', 'id');
    }


}
