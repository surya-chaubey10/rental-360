<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function view()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('dashboard', ['pageConfigs' => $pageConfigs]);
    }
}
