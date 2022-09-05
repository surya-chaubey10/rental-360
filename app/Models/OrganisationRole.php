<?php

namespace App\Models;

use App\Traits\Organisationid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrganisationRole extends Model
{
    use HasFactory, Organisationid;

    protected $fillable = [
        'uuid', 'organisation_id', 'name', 'description', 'parent_id', 'is_last_entity', 'status'
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

    public function organisationRoleHasPermissions()
    {
        return $this->hasMany(OrganisationRoleHasPermission::class,  'organisation_role_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->with('parent');
    }
}
