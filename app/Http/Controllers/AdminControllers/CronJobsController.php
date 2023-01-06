<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\CronJobsModel; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronJobsController extends Controller
{
    public function create()
    {
        return view('setting.general.cron_jobs');         
    }
}
