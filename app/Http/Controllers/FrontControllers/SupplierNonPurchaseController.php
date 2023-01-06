<?php

namespace App\Http\Controllers\FrontControllers;


use App\Models\SupplierNonPurchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SupplierNonPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.payments.supplier.non_purchase.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.payments.supplier.non_purchase.add');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('invoice-list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierNonPurchase  $supplierNonPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierNonPurchase $supplierNonPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierNonPurchase  $supplierNonPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierNonPurchase $supplierNonPurchase)
    {
      return view('accounts.payments.supplier.non_purchase.edit');    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierNonPurchase  $supplierNonPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierNonPurchase $supplierNonPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierNonPurchase  $supplierNonPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierNonPurchase $supplierNonPurchase)
    {
        //
    }
}
