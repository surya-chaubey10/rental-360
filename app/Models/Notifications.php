<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use Illuminate\Support\Str; 

class Notifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'messages',
        'read',
        'unread',
    ]; 
    
    // public function user()
    // {
    //     return $this->belogsTo(User::class,  'user_id', 'id');
    // }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

   
}
