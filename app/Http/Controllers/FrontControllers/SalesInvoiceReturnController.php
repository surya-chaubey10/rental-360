<?php

namespace App\Http\Controllers\FrontControllers;  
use App\Http\Controllers\Controller;

use App\Models\SalesInvoiceReturn;
use Illuminate\Http\Request;

class SalesInvoiceReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.return.list');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('sales.return.add');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesInvoiceReturn  $salesInvoiceReturn
     * @return \Illuminate\Http\Response
     */
    public function show(SalesInvoiceReturn $salesInvoiceReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesInvoiceReturn  $salesInvoiceReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesInvoiceReturn $salesInvoiceReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesInvoiceReturn  $salesInvoiceReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesInvoiceReturn $salesInvoiceReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesInvoiceReturn  $salesInvoiceReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesInvoiceReturn $salesInvoiceReturn)
    {
        //
    }
}
