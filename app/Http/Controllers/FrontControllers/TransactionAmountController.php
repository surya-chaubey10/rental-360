<?php

namespace App\Http\Controllers\FrontControllers;

use App\Models\AmountTransaction;
use App\Models\BookingInvoice;
use App\Models\AcountsPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use stdClass;

class TransactionAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == "Short Payment") {
            $store = AmountTransaction::select('id')
                ->where('acounts_payment_id', '=', $request->invoice_id)
                ->where('transaction_status', '=', '1')
                ->first();
            $bi = AcountsPayment::find($request->invoice_id);
        } else {
            $store = AmountTransaction::select('id')
                ->where('invoice_id', '=', $request->invoice_id)
                ->where('transaction_status', '=', '1')
                ->first();
            $bi = BookingInvoice::find($request->invoice_id);
        }

        if ($store) {
            $store->transaction_count = $store->transaction_count + 1;
            $store->save();

            if ($request->type == "Short Payment") {
                $c_details = new stdClass;
                $c_details->name    = $bi->full_name;
                $c_details->email   = $bi->email;
                $c_details->phone   = $bi->phone;
                $c_details->street1 = "";
                $c_details->city    = "";
                $c_details->state   = "";
                $c_details->country = "AE";
                $c_details->zip     = "";
            } else {
                $c_details = new stdClass;
                $c_details->name    = $bi->name;
                $c_details->email   = $bi->email;
                $c_details->phone   = $bi->phone;
                $c_details->street1 = $bi->street;
                $c_details->city    = $bi->city;
                $c_details->state   = $bi->state;
                $c_details->country = "AE";
                $c_details->zip     = $bi->zip;
            }
        }


        if ($bi) {
            if (!$store) {
                if ($request->type == "Short Payment") {
                    $store = new AmountTransaction;
                    $store->name                = $bi->full_name;
                    $store->amount              = $bi->amount;
                    $store->acounts_payment_id  = $request->invoice_id;
                    $store->transaction_status  = '1';
                    $store->created_user        = 1;
                    $store->transaction_count   = 1;
                    $store->save();

                    $c_details = new stdClass;
                    $c_details->name    = $bi->full_name;
                    $c_details->email   = $bi->email;
                    $c_details->phone   = $bi->phone;
                    $c_details->street1 = "";
                    $c_details->city    = "";
                    $c_details->state   = "";
                    $c_details->country = "AE";
                    $c_details->zip     = "";
                } else {
                    $store = new AmountTransaction;
                    $store->name                = $bi->name;
                    $store->amount              = $bi->grand_total;
                    $store->invoice_id          = $request->invoice_id;
                    $store->transaction_status  = '1';
                    $store->created_user        = 1;
                    $store->transaction_count   = 1;
                    $store->save();

                    $c_details = new stdClass;
                    $c_details->name    = $bi->name;
                    $c_details->email   = $bi->email;
                    $c_details->phone   = $bi->phone;
                    $c_details->street1 = $bi->street;
                    $c_details->city    = $bi->city;
                    $c_details->state   = $bi->state;
                    $c_details->country = "AE";
                    $c_details->zip     = $bi->zip;
                }
            }

            // payment process
            $data = array();
            $data['profile_id']         = '58348';
            $data['tran_type']          = "sale";
            $data['tran_class']         = "ecom";
            $data['tokenise']           = "2";
            $data['cart_id']            = "CART_" . $bi->id;
            $data['cart_currency']      = $bi->currency_type ?? "AED";
            $data['cart_amount']        = $bi->grand_total ?? $bi->amount;
            $data['cart_description']   = $bi->inv_description ?? "This is desctription";
            $data['paypage_lang']       = "en";
            $data['show_save_card']     = false;
            $data['customer_details']   = $c_details;
            if ($request->type == "Short Payment") {
                $data['callback']           = url('/public/api/payment-callback') . '/' . base64_encode($bi->id);
                $data['return']             = url('/short-callback') . '/' .  base64_encode($bi->id);
            } else {
                $data['callback']           = url('/public/api/payment-callback') . '/' . base64_encode($bi->id);
                $data['return']             = url('/callback') . '/' .  base64_encode($bi->id);
            }
            $data['hide_shipping']      = true;
            $data['hide_billing']       = true;

            $response = Curl::to('https://secure.paytabs.com/payment/request')
                ->withData($data)
                ->withHeader('Authorization: S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL')
                ->asJson()
                ->post();

            if (isset($response->tran_ref)) {
                $store->transaction_ref = $response->tran_ref;
                $store->save();
                if ($request->type == "Short Payment") {
                    $bi->transaction_ref = $response->tran_ref;
                    $bi->save();
                }
                return array('redirect' => $response->redirect_url);
            } else {
                return array('error' => json_encode($response));
            }
        }

        return array('error' => "Record not found.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
