<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrganisationRoleHasPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'organisation_role_id', 'permission_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function organisationRole()
    {
        return $this->belongsTo(OrganisationRole::class,  'organisation_role_id', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(PermissionExt::class,  'permission_id', 'id');
    }
}
