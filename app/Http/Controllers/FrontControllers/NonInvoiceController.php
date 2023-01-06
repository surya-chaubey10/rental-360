<?php

namespace App\Http\Controllers\FrontControllers;


use App\Models\NonInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NonInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.payments.clients.non_invoice.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.payments.clients.non_invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('non-invoice-list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NonInvoice  $nonInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(NonInvoice $nonInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NonInvoice  $nonInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(NonInvoice $nonInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NonInvoice  $nonInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NonInvoice $nonInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NonInvoice  $nonInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(NonInvoice $nonInvoice)
    {
        //
    }
}
