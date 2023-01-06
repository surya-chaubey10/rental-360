<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronJobsModel extends Model
{
    use HasFactory;
	
	 protected $table='cron_jobs'; 
}
