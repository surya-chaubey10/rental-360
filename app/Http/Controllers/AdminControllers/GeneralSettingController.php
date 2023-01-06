<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use App\Models\GeneralSettingModel; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralSettingController extends Controller
{
	
	public function create()
    {
        return view('setting.general.general');     
    }
	
    
}
