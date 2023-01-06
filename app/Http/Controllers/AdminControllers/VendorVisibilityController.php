<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\VendorVisibility;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VendorVisibilityController extends Controller
{
    public function vendorApp()
    {
        return view('marketing.list');
    }
}
