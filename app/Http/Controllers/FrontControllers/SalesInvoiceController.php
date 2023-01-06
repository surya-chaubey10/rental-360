<?php
namespace App\Http\Controllers\FrontControllers;  
use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.invoice.list'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('sales.invoice.add');     
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
     * @param  \App\Models\SalesInvoice  $salesInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SalesInvoice $salesInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesInvoice  $salesInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesInvoice $salesInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesInvoice  $salesInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesInvoice $salesInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesInvoice  $salesInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesInvoice $salesInvoice)
    {
        //
    }
}
