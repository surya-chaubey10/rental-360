<?php

namespace App\Http\Controllers\FrontControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManageBookings;
use App\Models\Transaction;
use App\Models\AcountsPayment;
use App\Models\AmountTransaction;
use App\Models\BookingInvoice;
use App\Models\BookingInvoicedetails;
use App\Models\CountryMaster;
use App\Models\VehicleModel;
use App\Models\VehicleBrand;
use App\Models\User;
use App\Models\Promotion;
use App\Models\GeneralLedger;
use App\Models\Fleet;
use App\Models\ChargeAmount;
use App\Models\RefundPayment;
use App\Models\Notifications;
use App\Models\CompanyActivity;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Validator;
use App\Models\ReserveFleet;
use Illuminate\Support\Facades\DB;                                              
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
 
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()   
    {
       
        $pageConfigs = ['pageHeader' => false];   

        $path = public_path() . '/data/account_invoice-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_account-invoice.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_account-invoice.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_account-invoice.json')) {
            $user = $this->jsonInvoiceList();
            
             $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_account-invoice.json', collect($data));
        }

        return view('account_invoice.list');  
    }
    private function jsonInvoiceList()  
    {
         return BookingInvoice::select('booking_invoices.*','manage_bookings.uuid as booking_uuid','transactions.id as tran_id','transactions.cart_id','transactions.tran_ref','transactions.tran_type','transactions.payment_method','transactions.cart_amount','transactions.payment_status','transactions.cart_currency')
        ->leftJoin('transactions', function ($join) {
            $join->on('transactions.tran_ref', '=', 'booking_invoices.trans_ref')->where('from_invoice','1')->where('transactions.organisation_id', getUser()->organisation_id);
        }) 
        ->leftJoin('manage_bookings', function ($join) {
            $join->on('manage_bookings.id', '=', 'booking_invoices.booking_id');
        })   
        ->where('booking_invoices.organisation_id', getUser()->organisation_id) 
        ->orderBy('booking_invoices.id','desc') 
        ->get();           
    }
    public function invoice_details($id) 
    {
         $transaction_details = BookingInvoice::select('transactions.*','booking_invoices.booking_id as booking','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','booking_invoices.name','booking_invoices.id as invoiceid','booking_invoices.email','booking_invoices.country','booking_invoices.city','booking_invoices.street','transactions.invoice_id','booking_invoices.phone','booking_invoices.created_at as invoicedate')
        ->leftjoin('transactions as transactions', function ($join) {
            $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
        }) 
         ->where('booking_invoices.id', '=', $id)
         ->where('booking_invoices.organisation_id', getUser()->organisation_id) 
         ->first();
         
       return json_encode($transaction_details);
         
    }

    public function get_invoice_details_data($id)  
    {
        
        $invoice_detail=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref')
        ->leftjoin('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'booking_invoicedetails.invoice_id');
        }) 
        ->leftjoin('transactions as transactions', function ($join) {
            $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        }) 
        ->leftjoin('fleets as fleets', function ($join) {
            $join->on('fleets.id', '=', 'booking_invoicedetails.sku');
        }) 
        ->where('booking_invoices.id','=',$id) 
        ->get();
      
        foreach($invoice_detail as $key=>$invoice){  
            if($key==0){
               
                $html = "<tr>
                <td class='font-weight-bold  text-left'>".$invoice->car_SKU."</td>
                <td class='font-weight-bold  text-left'>".$invoice->description."</td>
                <td class='font-weight-bold  text-left'>".$invoice->price."</td>
                <td class='font-weight-bold  text-left'>".$invoice->period."</td>
                <td class='font-weight-bold  text-left'>".$invoice->discount."</td>
                <td class='font-weight-bold  text-left'>".$invoice->tax."</td>
                <td class='font-weight-bold  text-left'>".$invoice->total."</td>
                <tr>";
            }else{
                $html .= "<tr>
                <td class='font-weight-bold  text-left'>".$invoice->car_SKU."</td>
                <td class='font-weight-bold  text-left'>".$invoice->description."</td>
                <td class='font-weight-bold  text-left'>".$invoice->price."</td>
                <td class='font-weight-bold  text-left'>".$invoice->period."</td>
                <td class='font-weight-bold  text-left'>".$invoice->discount."</td>
                <td class='font-weight-bold  text-left'>".$invoice->tax."</td>
                <td class='font-weight-bold  text-left'>".$invoice->total."</td>
                <tr>";
            }
           
          }
      
         $return['html'] = $html;

         echo json_encode($return); die;

    }

    /**  
     * Show the form for creating a new resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function create()     
    {
        $booking = ManageBookings::select('*')->with('customer','fleet:id,car_number')
                  ->where('payment_status', '=', 'H')->orWhere('payment_status', '=', 'A')
                  ->Where('booking_status', '!=', '3') 
                  ->Where('organisation_id' , getUser()->organisation_id)
                  ->Where('deleted_at', '=', null)
                  ->get();

        $country      = CountryMaster::select('id', 'name')->get();
        $bookingdata='';
        return view('account_invoice.create',['booking' => $booking,'bookingdata'=>$bookingdata,'country'=>$country ]);
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
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)  
    {
        return view('accounts.payments.clients.invoice.detail');
        
    }

    /**
     * Show the form for editing the specified resource.   
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)   
    {
        $booking = ManageBookings::all();  

        $country           = CountryMaster::select('id', 'name')->get();

        $invoice_data      = BookingInvoice::with('invoicedetails','invoicedetails.fleet:id,car_SKU','booking:id,dropoff_date_time,dropoff_time,extend_date,extend_time')->where('uuid',$uuid)->first();
       
        $promotion_code    = Promotion::select('id', 'promotion_code')->where('id',$invoice_data->promotion_id)->first();
       
        $bookingdata=ManageBookings::with('customer','customerInfo','vehicle','invoice','invoice.invoicedetails')->where('id',$invoice_data->booking_id)->get()->first();

        $sku               = Fleet::where('id', '=', $bookingdata->vehicle_id)->first();

        return view('account_invoice.edit',['invoice_data'=>$invoice_data,'country'=>$country,'booking'=>$booking,'bookingdata'=>$bookingdata,'sku'=>$sku,'promotion_code'=>$promotion_code ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)     
    {                                   
        $type = "Invoice";
        $created_user = getUser();
        $booking_id  = ManageBookings::select('*')->where('id',$request->bookingid)->first();    

          $input = $request->all();
          $validate = $this->validationsInvoice($input, "update");
      
          if ($validate["error"]) {
              
              return prepareResult(false, [], $validate['errors']->first(), "Error while validating Invoice", $this->unprocessableEntity);
          }

      DB::beginTransaction();
      try {
        // if ($request->transaction_type==1 || $request->transaction_type==2 || $request->transaction_type==3) {
          $booking = BookingInvoice::find($request->invoice_id);  

          $booking->booking_id             = $booking_id->id;
          $booking->name                   =  $request->full_name;
          $booking->email                  =  $request->email;
          $booking->currency_type          =  $request->currency_type;
          $booking->transaction_type       =  $request->transaction_type;
          $booking->customer_ref           =  $request->customer_refrence;
          $booking->invoice_ref            =  $request->invoice_refrence;
          $booking->phone                  =  $request->phone;
          $booking->street                 =  $request->street;
          $booking->city                   =  $request->city;
          $booking->country                =  $request->country;
          $booking->state                  =  $request->state;
        //   $booking->zip                    =  $request->zip;
          $booking->inv_description        =  $request->inv_description;
          $booking->subtotal               =  $request->subTotal;
          $booking->subtotal_discount      =  $request->footer_discount;
          $booking->promotion_id           =  $request->promotion_id;
          $booking->promotion_value        =  $request->footer_promotion;
          $booking->delivery_charge        =  $request->deliveryCharge;
          $booking->grand_total            =  $request->grandTotal;
          $booking->updated_user            = getUser()->id;
          $booking->document_type           = $request->document_type;
          $invoice_saved = $booking->save();

    //     }else 
    //     {
    //         $booking = BookingInvoice::find($request->invoice_id);  

    //       $booking->booking_id             =  $booking_id->id;
    //       $booking->name                   =  $request->full_name;
    //       $booking->email                  =  $request->email;
    //       $booking->currency_type          =  $request->currency_type;
    //       $booking->transaction_type       =  $request->transaction_type;
    //       $booking->customer_ref           =  $request->customer_refrence;
    //       $booking->invoice_ref            =  $request->invoice_refrence;
    //       $booking->phone                  =  $request->phone;
    //       $booking->street                 =  $request->street;
    //       $booking->city                   =  $request->city;
    //       $booking->country                =  $request->country;
    //       $booking->state                  =  $request->state;
    //       $booking->zip                    =  $request->zip;
    //       $booking->inv_description        =  $request->inv_description;
    //       $booking->subtotal               =  $request->subTotal;
    //       $booking->subtotal_discount      =  $request->footer_discount;
    //       $booking->promotion_id           =  $request->promotion_id;
    //       $booking->promotion_value        =  $request->footer_promotion;
    //       $booking->delivery_charge        =  $request->deliveryCharge;
    //       $booking->grand_total            =  $request->grandTotal;
    //       $booking->updated_user            = getUser()->id;
    //       $booking->document_type           = $request->document_type;
    //       $invoice_saved = $booking->save();
         
    //       $mb = ManageBookings::where('id', $booking->booking_id)->first();
    //       $current_timestamp = Carbon::now()->timestamp;
          
    //       $trans = new Transaction;

    //   if ($type == "Invoice")
    //    {
    //       $trans->booking_id			= ($booking_id->id ) ? $booking_id->id  : 0;
    //       $trans->invoice_id 			= $booking->id;
    //       $trans->user_id				= ($booking_id->customer_id) ? $booking_id->customer_id : 0;
    //    }
    //   else
    //    {
    //       $trans->invoice_id 			= $booking->id;
    //       $trans->user_id				= auth()->guard('web')->user()->id;
          
    //    }
    //   if($request->transaction_type)
    //    {
    //       $tt='Cash';
    //    }

    //       $trans->tran_type			= $tt;
    //       $trans->cart_id				= 'CART';
    //       $trans->cart_amount			= $request->grandTotal;
    //       $trans->tran_ref			    = 'CA'.''.$current_timestamp;
    //       $trans->cart_currency		= $request->currency_type;
    //       $trans->payment_status		= 'A';
    //       $trans->response_code 		= '';
    //       $trans->transferable_amount = 0;
    //       $trans->account_type  		= 1;
    //       $trans->transaction_time 	= now();
    //       $trans->organisation_id     = getUser()->organisation_id;
    //       $trans->save();
      
    //   if ($mb)
    //    {
    //       $mb->payment_status = $trans->payment_status;
    //       $mb->save();
    //    }
       
    //    $commissionCharges=0;
    //    $vat=5;
    //    $note=NULL;
    //    $fcredit=$booking->grand_total;
    //    $org= org_details();
    //    $subription=$org->subscription;
    //  if($subription){
         
    //     $credit=$booking->grand_total;
        
    // if($subription->commission_type==1)
    //  {
    //     $commissionCharges=$subription->commission_amount;

    //  }
    // else if($subription->commission_type==2)
    //  {
    //     $commissionCharges=$credit*$subription->commission_amount/100;

    //  }
    // else
    //  {
    //     $commissionCharges=0;

    //  }
    //     $fees=$commissionCharges;
    //     $total_vat= ($commissionCharges)*$vat/100;
    //     $fcredit=$credit-($commissionCharges+$total_vat);
    //     $note='Credit '.$credit.', Fees '.$fees.', Tax '.$total_vat.', Net '.$fcredit;
    //     $notes='Debit '.$credit.', Fees '.$fees.', Tax '.$total_vat.', Net '.$fcredit;

    //  }
    //    //creadit store 
    //     $general_ledger = new GeneralLedger;
    //     $general_ledger->organisation_id         = getUser()->organisation_id ;
    //     $general_ledger->credit                  = $fcredit;
    //     $general_ledger->amount                  = $booking->grand_total;
    //     $general_ledger->trans_ref              = $trans->tran_ref;
    //   /* Need to add calculation from company */
    
    //     $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
    
    // if (is_object($general))
    //  {
    //     $general_ledger->Balance = $general->Balance + $fcredit;
    //  }
    // else
    //  {
    //     $general_ledger->Balance  = $fcredit;
    //  }
    //     $general_ledger->note           = $note;
    //     $general_ledger->save();

    //   //debit store
    //     $general_ledgers = new GeneralLedger;
    //     $general_ledgers->organisation_id         = getUser()->organisation_id ;
    //     $general_ledgers->debit                  = $fcredit;
    //     $general_ledgers->amount                  = $booking->grand_total;
    //     $general_ledgers->trans_ref              = $trans->tran_ref;
    //   /* Need to add calculation from company */
    
    //     $generals = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
    
    // if (is_object($generals))
    //  {
    //     $general_ledgers->Balance = $generals->Balance - $fcredit;
    //  }
    // else
    //  {
    //     $general_ledgers->Balance  = $fcredit;
    //  }
    //     $general_ledgers->note           = $notes;
    //     $general_ledgers->save();
      
      
    //   if($mb->id)
    //    {
    //          Fleet::where('id', $mb->vehicle_id)
    //             ->update([
    //               'is_reserved' => '1',
    //            ]);
    //            if ($booking->document_type=='account') { 

    //             $Bookingss =  ManageBookings::find($booking->booking_id); 
    //             $reversed =   ReserveFleet::where('booking_id',$booking->booking_id)->first(); 
    //             if(isset($reversed)){
    //                 $reversed->to_date                      = $Bookingss ->extend_date;
    //                 $reversed->save();
    //             } else{
    //                 $reversed = new ReserveFleet;
    //                 $reversed->from_date                    = $mb->pickup_date_time;
    //                 $reversed->to_date                      = $mb->dropoff_date_time;
    //             if ($mb->dispatch_type == '2')
    //              {
    //                 $reversed->fleet_id                     = $mb->vehicle_id;
    //                 $reversed->brand_id                     = $mb->brand_id;
    //                 $reversed->model_id                     = $mb->model_id;
    //                 $reversed->car_SKU                      = $mb->merchant_sku;
    //              }
    //             else
    //              {  
    //                 $reversed->fleet_id                     = $mb->vehicle_id;
    //                 $reversed->brand_id                     = $mb->brand_id;
    //                 $reversed->model_id                     = $mb->model_id;
    //                 $reversed->car_SKU                      = $mb->merchant_sku;
    //              }
    //                 $reversed->booking_id                   = $mb->id;
    //                 $reversed->created_user                 = $created_user->id;
    //                 $reversed->save();
    //             }
    //             // $reversed->to_date                      = $Bookingss ->extend_date;
    //             // $reversed->save();

    //         }else{
    //           $reversed = new ReserveFleet;
    //           $reversed->from_date                    = $mb->pickup_date_time;
    //           $reversed->to_date                      = $mb->dropoff_date_time;
    //       if ($mb->dispatch_type == '2')
    //        {
    //           $reversed->fleet_id                     = $mb->vehicle_id;
    //           $reversed->brand_id                     = $mb->brand_id;
    //           $reversed->model_id                     = $mb->model_id;
    //           $reversed->car_SKU                      = $mb->merchant_sku;
    //        }
    //       else
    //        {  
    //           $reversed->fleet_id                     = $mb->vehicle_id;
    //           $reversed->brand_id                     = $mb->brand_id;
    //           $reversed->model_id                     = $mb->model_id;
    //           $reversed->car_SKU                      = $mb->merchant_sku;
    //        }
    //           $reversed->booking_id                   = $mb->id;
    //           $reversed->created_user                 = $created_user->id;
    //           $reversed->save();
    //        }
    //       }

    //     }
          if ($request->grandTotal) {
              ManageBookings::where('id', $booking_id->id)->update(array('amount' => $request->grandTotal));
          }


        //   $mb = BookingInvoice::where('booking_id', $booking_id->id)->orderBy('id', 'DESC')->first();
         
        //   $short_link = new ShortLink;
        //   $short_link->user_id    = ($mb) ? $mb->customer_id : null;
        //   $short_link->other_id   = $booking->id;
        //   $short_link->short_code = (string) \Str::random(8);
        //   $short_link->type       = "Invoice";
        //   $short_link->save();

        //   if ($mb) {
        //       $mb->short_link = url('/', $short_link->short_code);
        //       $mb->save();
        //   }
         
    //     $booked = BookingInvoice::where('booking_id', $booking_id->id)->first();
    //    if ($request->transaction_type==2 || $request->transaction_type==3) {
    //         $short_link = new ShortLink();
    //         $short_link->user_id    =  ($booked) ? $booked->customer_id : null;
    //         $short_link->other_id   = $booking->id;
    //         $short_link->short_code = (string) \Str::random(8);
    //         $short_link->type       = "Invoice";
    //         $short_link->save();
    //         if ($booked) {
    //             $booked->short_link = url('/', $short_link->short_code);
    //             $booked->save();
    //         }
    //     }
        //   if ($request->document_type=='account') { 
              
        //       $reversed = ReserveFleet::where('booking_id',$request->bookingid)->first(); 

        //       $reversed->from_date                    = $request->pickup_date_time;
        //       $reversed->to_date                      = $request->extend_date_time; 
        //       $reversed->fleet_id                     = $request->fleet_id; 
        //       $reversed->brand_id                     = $request->brand_id;
        //       $reversed->model_id                     = $request->model_id;
        //       $reversed->car_SKU                      = $request->car_sku; 
        //       $reversed->booking_id                   = $request->bookingid;
        //       $reversed->updated_user                 = getUser()->id;
        //       $reversed->save();

        //       $reversed =  ManageBookings::find($request->bookingid); 
        //       $booking_id->extend_date = $request->extend_date_time;
        //       $booking_id->save();
        //   }

        if ($request->document_type == 'account') {

            $booking_id =  ManageBookings::find($request->bookingid);
            $booking_id->extend_date = $request->extend_date_time;
            $booking_id->extend_time = $request->extend_time;
            $booking_id->save();
        }

          if (count($request->sku) > 0) {

        BookingInvoicedetails::where('invoice_id',$booking->id)->delete();


              foreach ($request['sku'] as $key => $n) {
                  
                  $bookingDetails = new BookingInvoicedetails;
                  $bookingDetails->sku            = $request->sku[$key];
                  $bookingDetails->invoice_id     = $booking->id;
                  $bookingDetails->description    = $request->description[$key];
                  $bookingDetails->price          = $request->unit_price[$key];
                  $bookingDetails->period         = $request->quantity[$key];
                  $bookingDetails->discount       = $request->discount[$key];
                  $bookingDetails->tax            = $request->tax[$key];
                  $bookingDetails->total          = $request->total[$key];
                  $bookingDetails->updated_user    = getUser()->id;
                  $bookingDetails->save();
              }
          }

          if ($invoice_saved) {
              ManageBookings::where('id', $booking_id->id)->update(array('is_created_invoice' => 1));
          }

          $adminactivity = new CompanyActivity;
          $adminactivity->messages          = 'Invoice updated by '.getUser()->fullname; 
          $adminactivity->created_user      = getUser()->id;
          $adminactivity->organisation_id   = getUser()->organisation_id;
          $adminactivity->save();

          $datas =ManageBookings::select('manage_bookings.*', 'booking_invoices.grand_total', 'booking_invoices.short_link', 'booking_invoices.email')
             ->leftjoin('booking_invoices', 'manage_bookings.id', '=', 'booking_invoices.booking_id')
             ->where('manage_bookings.id', $booking->booking_id)->first();
         
             if($datas->email!=""){
                
             $get_customer = User::where('id', $datas->customer_id)->first();
              
             $data = array(
                 'dear'         => 'Dear',
                 'msg'          => 'Please find below your payment link:',
                 'amount_msg'   => 'Total Amount is :',
                 'name'      =>  $get_customer->fullname,
                 'email'      =>  $get_customer->email,
                 'mobile'      =>  $get_customer->mobile,
                 'amount'      =>  $datas->grand_total,
                 'short_link'      =>  $datas->short_link,
             );
             
             //  Mail::mailer('smtp')->to($get_customer->email)->send(new SendMail($data));
             Mail::mailer('smtp1')->to($get_customer->email)->send(new SendMail($data));  
            //  Mail::mailer('smtp2')->to($get_customer->email)->send(new SendMail($data));
             }

          DB::commit();
          return ajax_response(true, $booking, [], "Invoice Updated Successfully", $this->success);
      } catch (\Exception $e) {
          DB::rollback();
          $message = $e->getMessage();
          return ajax_response(false, [], [], $message, $this->internal_server_error);
      }
  }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)  
    {
            $invoice = BookingInvoice::where('uuid', $uuid)->first();
            if(is_object($invoice)) {

                  $invoice_details = BookingInvoicedetails::where('invoice_id', $invoice->id)->delete();
                  $invoice->delete();

                  $adminactivity = new CompanyActivity;
                  $adminactivity->messages          = 'Invoice deleted by '.getUser()->fullname;
                  $adminactivity->created_user      = getUser()->id;
                  $adminactivity->organisation_id   = getUser()->organisation_id;
                  $adminactivity->save();


                } 
        return ajax_response(true, [], [], "Invoice Deleted Successfully", $this->success);
    }
    public function bookingdata($uuid)
    {
        $booking = ManageBookings::where('deleted_at', '=', null)->where('organisation_id' , getUser()->organisation_id)->get();
        $country      = CountryMaster::select('id', 'name')->get();
        $bookingdata=ManageBookings::with('customer','customerInfo','vehicle','invoice','invoice.invoicedetails')->where('uuid',$uuid)->get()->first();
        $sku               = Fleet::where('id', '=', $bookingdata->vehicle_id)->first();

        return view('account_invoice.create',['booking' => $booking, 'bookingdata' => $bookingdata,'country'=>$country,'sku'=>$sku]);
    }
    
    public function adddetail($uuid,$dropdate)
     {
        $booked             = ManageBookings::select('*')->where('uuid', $uuid)->first();
        $brand              = VehicleBrand::select('*')->where('id', $booked->brand_id)->first();
     /* coded by arun */
        $sku               = Fleet::with('fleetDetails')->where('id', '=', $booked->vehicle_id)->get();
       
        $fleet_pricing = array();
        $fleet_pricing['hourly'] = 0;
        $fleet_pricing['daily'] = 0;
        $fleet_pricing['weekly'] = 0;
        $fleet_pricing['monthly'] = 0;
        $fleet_pricing['custom'] = 0;
        $fleet_vat['hourly'] = 0;
        $fleet_vat['daily'] = 0;
        $fleet_vat['weekly'] = 0;
        $fleet_vat['monthly'] = 0;
        $fleet_vat['custom'] = 0;
        foreach($sku as $key=>$sku_details){
                if($sku_details->fleetDetails){
                    foreach($sku_details->fleetDetails as $key=>$details){

                        if($details->material==1){
                            $fleet_pricing['hourly']=$details->unit_price;
                            $fleet_vat['hourly'] = $details->vat;
                        }

                        if($details->material==2){
                            $fleet_pricing['daily']=$details->unit_price;
                            $fleet_vat['daily'] = $details->vat;
                        }

                        if($details->material==3){
                            $fleet_pricing['weekly']=$details->unit_price;
                            $fleet_vat['weekly'] = $details->vat;
                        }

                        if($details->material==4){
                            $fleet_pricing['monthly']=$details->unit_price;
                            $fleet_vat['monthly'] = $details->vat;
                        }
                        if($details->material==5){
                            $fleet_pricing['custom']=$details->unit_price;
                            $fleet_vat['custom'] = $details->vat;
                        }
                        
                }
          }
        }
     
        $price=0;
        $unitprice=0;
        $total=0;
        $vat=0;
        $period=0;
     
        $diffHour = (Carbon::parse($dropdate))->diffInHours(Carbon::parse($booked->dropoff_date_time));

        if ($diffHour > 24) {
            $diffDays = (int)($diffHour / 24);
            $diffHour = ($diffHour % 24);
        
            
             if($diffDays>=30){
                        $month = (int)($diffDays / 30);
                        $remaining= ($diffDays % 30);
                        if($remaining>0)
                        {
                            $month_price  =  $fleet_pricing['monthly']*$month;
                            $price  = $fleet_pricing['monthly'] + $month_price;
                            $period=$month+1;
                        }else{
                            $price  = $fleet_pricing['monthly']*$month;
                            $period=$month;
                        }
                        $total = $price + ($price * $fleet_vat['monthly']) / 100;
                        $vat = $fleet_vat['monthly'];
                        $unitprice=$fleet_pricing['monthly'];

                }else if($diffDays>=7){

                    $week = (int)($diffDays / 7);
                    $remaining = ($diffDays % 7);
                    if($remaining > 0)
                    {
                        $week_price  =  $fleet_pricing['weekly']*$week;
                       // $day         =  $fleet_pricing['daily']*$remaining;
                        $price       = $week_price+$fleet_pricing['weekly'];
                        $period=$week+1;

                    }else{
                        $price  = $fleet_pricing['weekly']*$week;
                        $period=$week;
                    }
                    $total = $price + ($price * $fleet_vat['weekly']) / 100;
                    $vat = $fleet_vat['weekly'];
                    $unitprice=$fleet_pricing['weekly'];

                }else if($diffDays>=1){

                    if($diffHour>0)
                    {
                        $day    =  $fleet_pricing['daily']*$diffDays;
                        $price  =  $day+$fleet_pricing['daily'];
                        $period=$diffDays+1;
                    }else{
                        $price  = $fleet_pricing['daily']*$diffDays;
                        $period=$diffDays;
                    }
                    $total = $price + ($price * $fleet_vat['daily']) / 100;
                    $vat = $fleet_vat['daily'];
                    $unitprice=$fleet_pricing['daily'];
                }

            }else{
                $diffDays = 1; 
                $period=1;
                $price    =  $fleet_pricing['daily']*$period;
                $unitprice=$fleet_pricing['daily'];

                $total = $price + ($price * $fleet_vat['daily']) / 100;
                $vat = $fleet_vat['daily'];
            }

        /* End coded by arun */
        
        if($booked->vehicle_id){
            return response()->json([
                'period' => $period,
                'description' => $brand->brand_name.' '.$sku[0]->car_SKU .'-'.$diffDays.' day rental',
                'price' => $total,
                'vat' => $vat,
                'unitprice' => $unitprice,
                'sku'   => $sku[0]->car_SKU,
                'sku_id'   => $sku[0]->id,
            ]);
        }else{
            return response()->json([
                'period' => $period,
                'description' => $brand->brand_name.'-'.$diffDays.' day rental',
                'price' => $total,
                'vat' => $vat,
                'unitprice' => $unitprice,
                'sku'   => '',
                'sku_id'   => '0',
            ]);
        }
        
        
    }

    private function validationsInvoice($input,$type)
     {
        $validator = [];
        $errors = [];
        $error = false;
        if ($type == "update") {
            $validator = Validator::make($input, [
                 'full_name'                    => 'required|string', 
                 'currency_type'                => 'required|string', 
                 'transaction_type'             => 'required|string'  
                    
             ]);
 
        }
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }
         
        return ["error" => $error, "errors" => $errors];   
    }  


    public function refund_payment(Request $request)
    {
        
        $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
         if($request->amount>$general->Balance){
            return ajax_response(false, [], [], "Unable To Refund Requested Amount, You Have Only ".$general->Balance." Funds In Your Statements.", $this->success);
         }

         if($request->amount>$request->total_amount){
            return ajax_response(false, [], [], "Unable To Refund Requested Amount, You Have Entered Maximum Amount Your Amount is ".$request->total_amount." For This Transaction .", $this->success);
         }
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'description' => 'required'
        ]);

    if($validator->fails()) return 'Cyber';

     
                $refund_payment = new RefundPayment;
                $refund_payment->user_id = getUser()->id;
                $refund_payment->organisation_id  = getUser()->organisation_id;
                $refund_payment->transection_id = $request->id;
                $refund_payment->booking_id = $request->booking_id;
                $refund_payment->invoice_id = $request->invoice_id;
                $refund_payment->full_name = $request->name;
                $refund_payment->email = $request->email;
                $refund_payment->tran_type = $request->type;
                $refund_payment->tran_ref = $request->tran_ref;
                $refund_payment->cart_id = $request->cart_id;
                $refund_payment->currency = $request->currency;
                $refund_payment->refund_amount = $request->amount;
                $refund_payment->total_amount = $request->total_amount;
                $refund_payment->reason_description = $request->description;
                $refund_payment->status = '0';
                 $refund_payment->save();  

               $server_key="S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL";

               if(getUser()->organisation_id){
	  
                $org_details=org_branded_logo(getUser()->organisation_id);
                $paytabs_info=$org_details->moreInfo;
    
                 if($paytabs_info->profile_id && $paytabs_info->server_key){
    
                        $data = $request->except('id', '_token');
                        $data['profile_id'] = $paytabs_info->profile_id;
                        $data['tran_type'] = "refund";
                        $data['tran_class'] = "ecom";
                        $data['cart_id'] = $request->cart_id;
                        $data['cart_currency'] = $request->currency;
                        $data['cart_amount'] = $request->amount;
                        $data['cart_description'] = $request->description;
    
                       $server_key=$paytabs_info->server_key;		
                        
                 }else{
    
                        $data = $request->except('id', '_token');
                        $data['profile_id'] = "58348";
                        $data['tran_type'] = "refund";
                        $data['tran_class'] = "ecom";
                        $data['cart_id'] = $request->cart_id;
                        $data['cart_currency'] = $request->currency;
                        $data['cart_amount'] = $request->amount;
                        $data['cart_description'] = $request->description;
                    }
                    
    
          }else{
    
                $data = $request->except('id', '_token');
                $data['profile_id'] = "58348";
                $data['tran_type'] = "refund";
                $data['tran_class'] = "ecom";
                $data['cart_id'] = $request->cart_id;
                $data['cart_currency'] = $request->currency;
                $data['cart_amount'] = $request->amount;
                $data['cart_description'] = $request->description;
          }
                //TODO: Sending Array to Paytabs for creating new user and payment link
                

            if($request->tran_type!='Cash'){
               
                $response = refund_payment($data, $server_key);
                
            }else{
                
                $response['payment_result']['response_status']='Cash';

                Transaction::where('id', $request->id)->update(['refund_resp' =>  "A"]);
            //TODO: Array To Create New Transaction
                $current_timestamp = Carbon::now()->timestamp;

                $trans = new Transaction;	
                $trans->user_id				= auth()->guard('web')->user()->id;
                $trans->tran_ref			= 'CA'.''.$current_timestamp;
                $trans->tran_type			= "refund";
                $trans->cart_id				= $request->cart_id;
                $trans->booking_id          = $request->booking_id;
                $trans->invoice_id          = $request->invoice_id;
                $trans->cart_amount			= $request->amount;
                $trans->cart_currency		= $request->currency;
                $trans->payment_status		= "A";
                $trans->payment_code		=  NULL;
                $trans->transaction_time 	= now();
                $trans->payment_method  	= "Cash";
                $trans->card_type			=  NULL;
                $trans->payment_description =  NULL;
                $trans->token				=  NULL;
                $trans->response_message 	=  NULL;
                $trans->response_code 		=  NULL;
                $trans->refund_resp 		= null;
                $trans->organisation_id     = getUser()->organisation_id;
                $trans->conversion_rate 	= 0;
                $trans->conversion_amount 	= 0;
                $trans->transferable_amount = 0;
                $trans->account_type  		= 1;
                $trans->expiry_month  		= 0;
                $trans->expiry_year  		= 0;
                $trans->save();

                   $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
            
                        if($general){
                            $balance = $general->Balance - $request->amount;
                        }else{
                            $balance = $request->amount;
                        }

                        $note='Debit '.$request->amount.', AED ( Refund Taken Against '.$request->tran_ref.',  Net '.$request->amount. ')';

                         $general_ledger = new GeneralLedger;
                         $general_ledger->trans_ref                = 'CA'.''.$current_timestamp;
                         $general_ledger->transaction_id           = $trans->id;
                         $general_ledger->organisation_id          = getUser()->organisation_id;
                         $general_ledger->Balance                  = $balance;
                         $general_ledger->debit                    = $request->amount;
                         $general_ledger->note                     = $note;
                         $general_ledger->type                     = 5;
                         $general_ledger->is_transfer              = 2;
                         $general_ledger->withdrawal_fee           = 0;
                         $general_ledger->amount                   = $request->amount;
                         $general_ledger->save(); 

                        $notifications = new Notifications;
                        $notifications->messages          = $request->name."'s Refund has been successful With Amount, ".$request->amount; 
                        $notifications->read              = '0';
                        $notifications->unread            = '1';
                        $notifications->user_id           = getUser()->id;
                        $notifications->organisation_id   = getUser()->organisation_id;
                        $notifications->save();
                            
                        $adminactivity = new CompanyActivity;
                        $adminactivity->messages          = $request->name."'s Refund has been successful With Amount, ".$request->amount;
                        $adminactivity->created_user           = getUser()->id;
                        $adminactivity->organisation_id   = getUser()->organisation_id;
                        $adminactivity->save();

                        return ajax_response(true, [], [], "Amount Refunded Successfully", $this->success);


            }
              
         
                //Returnning Error if api response is not valid
                if(!isset($response['tran_ref']))
                {
                    return json_encode($response);
                }
       
        //TODO: Saving Transaction Reponse

        if($response['payment_result']['response_status'] == 'A') {
            //TODO: Updating Tran_Count

            Transaction::where('id', $request->id)->update(['refund_resp' => $response['payment_result']['response_status']]);
            //TODO: Array To Create New Transaction

            $trans = new Transaction;	
            $trans->user_id				= auth()->guard('web')->user()->id;
            $trans->tran_ref			= $response['tran_ref'];
            $trans->tran_type			= strtolower($response['tran_type']);
            $trans->cart_id				= $response['cart_id'];
            $trans->booking_id          = $request->booking_id;
            $trans->invoice_id          = $request->invoice_id;
            $trans->cart_amount			= $response['cart_amount'];
            $trans->cart_currency		= $response['cart_currency'];
            $trans->payment_status		= ($response['payment_result']) ? $response['payment_result']['response_status'] : "D";
            $trans->payment_code		= ($response['payment_result']) ? $response['payment_result']['response_code'] : NULL;
            $trans->transaction_time 	= now();
            $trans->payment_method  	= ($response['payment_info']) ? $response['payment_info']['card_scheme'] : NULL;
            $trans->card_type			= ($response['payment_info']) ? $response['payment_info']['card_type'] : NULL;
            $trans->payment_description = ($response['payment_info']) ? $response['payment_info']['payment_description'] : NULL;
            $trans->token				=  NULL;
            $trans->response_message 	= ($response['payment_result']) ? $response['payment_result']['response_message'] : NULL;
            $trans->response_code 		= ($response['payment_result']) ? $response['payment_result']['response_code'] : NULL;
            $trans->refund_resp 		= null;
            $trans->organisation_id     = getUser()->organisation_id;
            $trans->conversion_rate 	= 0;
            $trans->conversion_amount 	= 0;
            $trans->transferable_amount = 0;
            $trans->account_type  		= 1;
            $trans->expiry_month  		= ($response['payment_info']) ? $response['payment_info']['expiryMonth'] : 0;
            $trans->expiry_year  		= ($response['payment_info']) ? $response['payment_info']['expiryYear'] : 0;
            $trans->save();

            $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
            
                        if($general){
                            $balance = $general->Balance - $response['cart_amount'];
                        }else{
                            $balance = $response['cart_amount'];
                        }

                        $note='Debit '.$response['cart_amount'].', AED ( Refund Taken Against '.$response['previous_tran_ref'].',  Net '.$response['cart_amount']. ')';

                         $general_ledger = new GeneralLedger;
                         $general_ledger->trans_ref                = $response['tran_ref'];
                         $general_ledger->transaction_id           = $trans->id;
                         $general_ledger->organisation_id          = getUser()->organisation_id;
                         $general_ledger->Balance                  = $balance;
                         $general_ledger->debit                    = $response['cart_amount'];
                         $general_ledger->note                     = $note;
                         $general_ledger->type                     = 5;
                         $general_ledger->is_transfer              = 2;
                         $general_ledger->withdrawal_fee           = 0;
                         $general_ledger->amount                   = $response['cart_amount'];
                         $general_ledger->save(); 

                        $notifications = new Notifications;
                        $notifications->messages          = $request->name."'s Refund has been successful With Amount, ".$response['cart_amount']; 
                        $notifications->read              = '0';
                        $notifications->unread            = '1';
                        $notifications->user_id           = getUser()->id;
                        $notifications->organisation_id   = getUser()->organisation_id;
                        $notifications->save();
                            
                        $adminactivity = new CompanyActivity;
                        $adminactivity->messages          = $request->name."'s Refund has been successful With Amount, ".$response['cart_amount'];
                        $adminactivity->created_user           = getUser()->id;
                        $adminactivity->organisation_id   = getUser()->organisation_id;
                        $adminactivity->save();

                        return ajax_response(true, [], [], "Amount Refunded Successfully", $this->success);
        } else {
            
            return ajax_response(false, [], [], "Amount Not Refunded Due To ".$response['payment_result']['response_message'], $this->success);
        }
   

  
 }

     //TODO: Charging the amount from the customer
    public function charge_payment(Request $request)
       {
        
        $booked = BookingInvoice::where('booking_id', $request->booking_id)->first();
       
        if($request->amount>$booked->grand_total){
            return ajax_response(false, [], [], "Unable To Charged Requested Amount, You Have Entered Maximum Amount Your Amount is ".$request->amount." For This Transaction .", $this->success);
         }
         // TODO: Validating the rquest params for better security
         $validator = Validator::make($request->all(), [
             'amount' => 'required',
             'description' => 'required'
         ]);
        //  dd($request);
        
             $charge_amount = new ChargeAmount;
             $charge_amount->user_id = getUser()->id;
             $charge_amount->organisation_id  = getUser()->organisation_id;
             $charge_amount->transection_id = $request->id;
             $charge_amount->booking_id = $request->booking_id;
             $charge_amount->invoice_id = ($booked) ? $booked->id :'0';
             $charge_amount->full_name = $request->name;
             $charge_amount->email = $request->email;
             $charge_amount->tran_type = $request->type;
             $charge_amount->tran_ref = $request->tran_ref;
             $charge_amount->cart_id = $request->cart_id;
             $charge_amount->currency = $request->currency;
             $charge_amount->charge_amount = $request->amount;
             $charge_amount->total_amount = $request->tran_count;
             $charge_amount->reason_description = $request->description;
            //  $charge_amount->supporting_document = $request->id;
             $charge_amount->status = '0';
             $charge_amount->save();

 
			$server_key="S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL";
            $data = $request->except('id', '_token');
			if(getUser()->organisation_id){
	  
				  $org_details=org_branded_logo(getUser()->organisation_id);
				  $paytabs_info=$org_details->moreInfo;
	  
				   if($paytabs_info->profile_id && $paytabs_info->server_key){
	  
                       $data['profile_id'] = $paytabs_info->profile_id;
	  
					   $server_key=$paytabs_info->server_key;		
						  
				   }else{
	  
                        $data['profile_id'] = "58348";
					  }
					  
	  
			}else{
	  
                $data['profile_id'] = "58348";
			}

         //TODO: Sending Array to Paytabs for creating new user and payment link
        
       
         if($request->type == 'sale')
         {
             $data['tran_type'] = "sale";
             $data['tran_class'] = "recurring";
         }
         else
         {
             $data['tran_type'] = "capture";
             $data['tran_class'] = "ecom";
         }
         $data['cart_id'] = $request->cart_id;
         $data['cart_currency'] = $request->currency;
         $data['cart_amount'] = $request->amount;
         $data['cart_description'] = $request->description;

         $response = generate_link($data, 'S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL'); 
       
         //Returnning Error if api response is not valid
         if(!isset($response['tran_ref']))
         {
             return json_encode($response);
         }
  
         //TODO: Saving Transaction Reponse
        
 
         //Getting User ID Here
         //TODO: Updating Tran_Count
         $latest_transaction = Transaction::where('organisation_id', getUser()->organisation_id)->orderBy('id', 'DESC')->first();
         if(is_null($latest_transaction))
         {
             $tran_id = 1;
         }
         else
         {
             $tran_id = $latest_transaction->tran_id + 1;
         }
         //TODO: Array To Create New Transaction
         Transaction::where('id', $request->id)->update(['tran_count' => $request->tran_count]);
         $trans = new Transaction;	
         $trans->user_id				= auth()->guard('web')->user()->id;
         $trans->tran_ref			= $response['tran_ref'];
           if($request->type == 'sale')
         {
             $transaction['tran_type'] = strtolower("capture");
         }
         else
         {
             $transaction['tran_type'] = strtolower("capture");
         }
         $trans->cart_id			= $response['cart_id'];
         $trans->booking_id          = $request->booking_id;
         $trans->invoice_id          =  ($booked) ? $booked->id :'0';
         $trans->cart_amount			= $response['cart_amount'];
         $trans->cart_currency		= $response['cart_currency'];
         $trans->payment_status		= ($response['payment_result']) ? $response['payment_result']['response_status'] : "D";
         $trans->payment_code		= ($response['payment_result']) ? $response['payment_result']['response_code'] : NULL;
         $trans->transaction_time 	= now();
         $trans->payment_method  	= ($response['payment_info']) ? $response['payment_info']['card_scheme'] : NULL;
         $trans->card_type			= ($response['payment_info']) ? $response['payment_info']['card_type'] : NULL;
         $trans->payment_description = ($response['payment_info']) ? $response['payment_info']['payment_description'] : NULL;
         $trans->token				=  NULL;
         $trans->response_message 	= ($response['payment_result']) ? $response['payment_result']['response_message'] : NULL;
         $trans->response_code 		= ($response['payment_result']) ? $response['payment_result']['response_code'] : NULL;
         $trans->refund_resp 		= NULL;
         $trans->charged_resp 		= 'A';
         $trans->organisation_id     = getUser()->organisation_id;
         $trans->conversion_rate 	= 0;
         $trans->conversion_amount 	= 0;
         $trans->transferable_amount = 0;
         $trans->account_type  		= 1;
         $trans->expiry_month  		= ($response['payment_info']) ? $response['payment_info']['expiryMonth'] : 0;
         $trans->expiry_year  		= ($response['payment_info']) ? $response['payment_info']['expiryYear'] : 0;
         $trans->payment_date = date('Y-m-d');
         $trans->tran_time = date(' H:i');
         $trans->tran_id = $tran_id;
         $trans->description  = $request->description;
         $trans->save();

         $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
            
         if($general){
             $balance = $general->Balance + $response['cart_amount'];
         }else{
             $balance = $response['cart_amount'];
         }

         $note='Credit '.$response['cart_amount'].', AED ( Charged Taken Against '.$response['previous_tran_ref'].',  Net '.$response['cart_amount']. ')';

          $general_ledger = new GeneralLedger;
          $general_ledger->trans_ref                = $response['tran_ref'];
          $general_ledger->transaction_id           = $trans->id;
          $general_ledger->organisation_id          = getUser()->organisation_id;
          $general_ledger->Balance                  = $balance;
          $general_ledger->credit                    = $response['cart_amount'];
          $general_ledger->note                     = $note;
          $general_ledger->type                     = 6;
          $general_ledger->is_transfer              = 1;
          $general_ledger->withdrawal_fee           = 0;
          $general_ledger->amount                   = $response['cart_amount'];
          $general_ledger->save(); 

         $notifications = new Notifications;
         $notifications->messages          = $request->name."'s Charged has been successful With Amount, ".$response['cart_amount']; 
         $notifications->read              = '0';
         $notifications->unread            = '1';
         $notifications->user_id           = getUser()->id;
         $notifications->organisation_id   = getUser()->organisation_id;
         $notifications->save();
          
         $adminactivity = new CompanyActivity;
         $adminactivity->messages          = $request->name."'s Charged has been successful With Amount, ".$response['cart_amount'];
         $adminactivity->created_user           = getUser()->id;
         $adminactivity->organisation_id   = getUser()->organisation_id;
         $adminactivity->save();


         return ajax_response(true, [], [], "Amount Charged Successfully", $this->success);

         
 
     }   

     public function check_transaction_number($tn_number, $tn_uuid,$invoice_id) 
     {
   
         $get_booking_id = ManageBookings::where('uuid', $tn_uuid)->where('deleted_at', '=', null)->first();
         $get_invoice_id = BookingInvoice::where('uuid', $invoice_id)->where('deleted_at', '=', null)->first();
         $get_tn_number = AcountsPayment::where('transaction_ref', $tn_number)->where('booking_id',$get_booking_id->id)->where('deleted_at', '=', null)->first();

         if ($get_tn_number != null && ($get_invoice_id->grand_total == $get_tn_number->amount))
          {
             $get_inv_id = BookingInvoice::where('id', $get_invoice_id->id)->where('document_type', 'account')->where('deleted_at', '=', null)->first();
 
             $final = AcountsPayment::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));
 
             AmountTransaction::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id));
 
             Transaction::where('tran_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));
 
             BookingInvoice::where('id', $get_inv_id->id)->limit(1)->update(array('is_adjust_invoice' => '1','trans_ref' => $tn_number));;

            if($get_booking_id->extend_date){

                $reversed = ReserveFleet::where('booking_id',$get_inv_id->booking_id)->first(); 
                $reversed->to_date                      = $get_booking_id->extend_date;
                $reversed->save(); 
            }

          }
          else
           {
             $final = null;
          }
         echo json_encode($final);
         die;
     }


}
