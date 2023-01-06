<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Organisationid;
use Illuminate\Support\Str; 

class CompanyActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'messages',
    ]; 
}
