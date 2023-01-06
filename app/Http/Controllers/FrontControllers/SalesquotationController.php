<?php

namespace App\Http\Controllers\FrontControllers; 
use App\Http\Controllers\Controller;
use App\Models\Salesquotation;
use Illuminate\Http\Request;

class SalesquotationController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.quotation.list');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('sales.quotation.add');    
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
     * @param  \App\Models\Salesquotation  $salesquotation
     * @return \Illuminate\Http\Response
     */
    public function show(Salesquotation $salesquotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salesquotation  $salesquotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesquotation $salesquotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salesquotation  $salesquotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesquotation $salesquotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salesquotation  $salesquotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesquotation $salesquotation)
    {
        //
    }
}
