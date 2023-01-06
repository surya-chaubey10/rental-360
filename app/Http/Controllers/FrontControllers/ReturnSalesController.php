<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\ReturnSales;
use Illuminate\Http\Request;

class ReturnSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('purchasesales.return.list'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('purchasesales.return.add'); 
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
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnSales $returnSales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnSales $returnSales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnSales $returnSales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnSales  $returnSales
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnSales $returnSales)
    {
        //
    }
}
