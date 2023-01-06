<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateInvoiceController extends Controller
{
    public function index()
    {
        return view('booking.generateInvoice.add');
    }
}
