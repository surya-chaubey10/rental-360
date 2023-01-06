<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\BookingInvoice;
use App\Models\Invoice;
use App\Models\ShortLink;
use App\Models\AcountsPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showShortLink($code)
    {
        $find = ShortLink::where('short_code', $code)->first();

        if (!$find) {
            return redirect(route('login'));
        }

        return redirect(route('choose.payment', $find->uuid));
    }

    public function choosePaymnet($uuid)
    {
        if (!$uuid) {
            return redirect(route('login'));
        }

        $find = ShortLink::where('uuid', $uuid)->first();

        if (!$find) {
            // link expired
            return redirect(route('login'));
        }

        $type = $find->type;
        $invoice = '';

        if ($type == "Invoice") {
            $invoice = BookingInvoice::find($find->other_id);
        }
        
        if ($type == "Short Payment") {
            $invoice = AcountsPayment::find($find->payment_id);
        }
        
        return view('payments.view', compact('invoice','type'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
