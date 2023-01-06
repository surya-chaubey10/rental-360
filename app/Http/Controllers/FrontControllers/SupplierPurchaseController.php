<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;

use App\Models\SupplierPurchase;
use Illuminate\Http\Request;

class SupplierPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.payments.supplier.purchase.list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.payments.supplier.purchase.add');  

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
     * @param  \App\Models\SupplierPurchase  $supplierPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierPurchase $supplierPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierPurchase  $supplierPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierPurchase $supplierPurchase)
    {
      return view('accounts.payments.supplier.purchase.edit');     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierPurchase  $supplierPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierPurchase $supplierPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierPurchase  $supplierPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierPurchase $supplierPurchase)
    {
        //
    }
}
