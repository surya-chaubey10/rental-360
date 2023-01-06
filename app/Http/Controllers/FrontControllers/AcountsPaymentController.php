<?php

namespace App\Http\Controllers\FrontControllers;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\AcountsPayment;
use App\Models\ShortLink;
use App\Models\User;
use App\Models\GeneralLedger;
use App\Models\CompanyBank;
use App\Models\ManageBookings;
use App\Models\Transaction;
use App\Models\Requests; 
use App\Models\Notifications;
use App\Models\CompanyActivity;
use App\Models\AmountTransaction;
use App\Models\BookingInvoicedetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
class AcountsPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now()->toDateString();
        $withdrawl_fees=0;
        $org= org_details();
        $subscription=$org->subscription;
        
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() .  '/data/directpayment';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_directpayment.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_directpayment.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_directpayment.json')) {
            $user = $this->directpaymentrList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_directpayment.json', collect($data));
        }

        $path1 = public_path() . '/data/transaction2-json';

        if (!file_exists($path1)) {
            \File::makeDirectory($path1, 0777, true, true);
        }

        if (file_exists($path1 . '/' . getUser()->organisation_id . '_transaction2.json')) {
            \File::delete($path1 . '/' . getUser()->organisation_id . '_transaction2.json');
        }

        if (!file_exists($path1 . '/' . getUser()->organisation_id . '_transaction2.json')) {
            $user1 = $this->account_transactionList();
            $data1 = array('data' => $user1);
            \File::put($path1 . '/' . getUser()->organisation_id . '_transaction2.json', collect($data1));
        }

        
        $pending = GeneralLedger::select('Balance')->orderBy('id', 'DESC')->where('organisation_id', getUser()->organisation_id)->first();
        $last_payout = GeneralLedger::select('debit','Balance')->orderBy('id', 'DESC')->where('organisation_id', getUser()->organisation_id)->first();
        $gl= GeneralLedger::select('general_ledgers.*','transactions.acounts_payment_id','transactions.invoice_id as inv_id','transactions.tran_type')
          ->leftjoin('transactions as transactions', function ($join) {
            $join->on('general_ledgers.transaction_id', '=', 'transactions.id');
          })
          ->where('general_ledgers.organisation_id', getUser()->organisation_id)
          ->get();
       
        $get_bank= CompanyBank::select('company_banks.*') 
        ->where('organisation_id', getUser()->organisation_id)
        ->where('status' , '1')
        ->get();
        $get_bank_first= CompanyBank::select('company_banks.*') 
        ->where('organisation_id', getUser()->organisation_id)
        ->where('status' , '1')
        ->get()->first();
           // dd($$gl);
    
        return view('accounts.payment.acount_payment_list', compact('date','pending','last_payout','gl','subscription','get_bank_first','get_bank'));
    }

    private function directpaymentrList()
    {
        return AcountsPayment::select('acounts_payments.*', 'user.fullname as agentname')
            ->join('users as user', function ($join) {
                $join->on('user.id', '=', 'acounts_payments.created_user');   
            })
            ->withoutGlobalScope('organisation_id')
            ->where('acounts_payments.organisation_id', getUser()->organisation_id)
            ->orderBy('acounts_payments.id', 'desc')      
            ->get();
          }

    private function account_transactionList()
    {
        return Transaction::select('booking_invoices.name','transactions.*')
            ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
            })
            ->withoutGlobalScope('organisation_id')
            ->where('transactions.organisation_id', getUser()->organisation_id)
            ->orderBy('transactions.id', 'desc')
            ->get();

            // return AmountTransaction::select('amount_transactions.name','transaction.*')
            // ->join('transactions as transaction', function ($join) {
            //     $join->on('transaction.tran_ref', '=', 'amount_transactions.transaction_ref');
            // })
            // ->withoutGlobalScope('organisation_id')
            // ->orderBy('amount_transactions.id', 'desc')
            // ->get();
    }

   
    public function transaction_details($id)
    {
           
        $transaction_details = Transaction::select('transactions.*','organisations.org_name','booking_invoices.booking_id as booking','booking_invoices.phone','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','booking_invoices.name','booking_invoices.email','booking_invoices.country','booking_invoices.city','booking_invoices.street','acounts_payments.full_name','acounts_payments.email','acounts_payments.phone','acounts_payments.comment')
            ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
            })
            ->leftjoin('organisations as organisations', function ($join) {
                $join->on('transactions.organisation_id', '=', 'organisations.id');
            })
            ->leftjoin('acounts_payments as acounts_payments', function ($join) {
                $join->on('transactions.acounts_payment_id', '=', 'acounts_payments.id');
            })
             ->where('transactions.id', '=', $id)
             ->first();
             
           return  json_encode($transaction_details);
           
    }

    public function transaction_details_for_payment($trans_ref)
    {
         
        $transaction_details = Transaction::select('transactions.*','organisations.org_name','booking_invoices.booking_id as booking','booking_invoices.phone','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','booking_invoices.name','booking_invoices.email','booking_invoices.country','booking_invoices.city','booking_invoices.street','acounts_payments.full_name','acounts_payments.email','acounts_payments.phone','acounts_payments.comment')
            ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
            })
            ->leftjoin('organisations as organisations', function ($join) {
                $join->on('transactions.organisation_id', '=', 'organisations.id');
            })
            ->leftjoin('acounts_payments as acounts_payments', function ($join) {
                $join->on('transactions.acounts_payment_id', '=', 'acounts_payments.id');
            })
             ->where('transactions.tran_ref', '=', $trans_ref)
             ->first();
             
           return  json_encode($transaction_details);
           
    }


        public function invoice_details_data($id){
        $invoice_details=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref','transactions.tran_type')
        ->join('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'booking_invoicedetails.invoice_id');
        }) 
        ->join('transactions as transactions', function ($join) {
            $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        }) 
        ->join('fleets as fleets', function ($join) {
            $join->on('fleets.id', '=', 'booking_invoicedetails.sku');
        }) 
        ->where('transactions.id','=',$id) 
        ->get();
 
        foreach($invoice_details as $key=>$invoice){
          
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
         echo json_encode($return);die;

    }

    public function invoice_details_data_payments($trans_ref){
        $invoice_details=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref','transactions.tran_type')
        ->join('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'booking_invoicedetails.invoice_id');
        }) 
        ->join('transactions as transactions', function ($join) {
            $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        }) 
        ->join('fleets as fleets', function ($join) {
            $join->on('fleets.id', '=', 'booking_invoicedetails.sku');
        }) 
        ->where('transactions.tran_ref','=',$trans_ref) 
        ->get();
 
        foreach($invoice_details as $key=>$invoice){
          
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
         echo json_encode($return);die;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('accounts.payment.acount_payment_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        $current_timestamp = Carbon::now()->timestamp; 
        DB::beginTransaction();
        try {

            if($request->transaction_type==4){
                
                $data = new AcountsPayment;
                $data->full_name               = $request->full_name;
                $data->transaction_type        = $request->transaction_type;
                $data->organisation_id         = getUser()->organisation_id;
                $data->phone                   = $request->phone;
                $data->email                   = $request->email;
                $data->amount                  = $request->amount;
                $data->agent                   = $request->agent;
                $data->description             = $request->description;
                $data->comment                 = $request->comment;
                $data->created_user            = getUser()->id;
                $data->status                  = '1';
                $data->save();
                
                $trans = new Transaction;
 
                if($data->transaction_type)
                {
                    $tt='Cash';
                }

                $trans->tran_type			= $tt;
                $trans->acounts_payment_id  = $data->id;
                $trans->cart_id				= 'CART';
                $trans->cart_amount			= $request->amount;
                $trans->tran_ref		    = 'CA'.''.$current_timestamp;
                $trans->cart_currency		= 'AED';
                $trans->description		    = 'Cash Payment';
                $trans->payment_status		= 'A';
                $trans->response_code 		= '';
                $trans->transferable_amount = 0;
                $trans->account_type  		= 1;
                $trans->transaction_time 	= now();
                $trans->organisation_id     = getUser()->organisation_id;
                $trans->user_id				= auth()->guard('web')->user()->id;
                $trans->save();
 
               
                 //Creadit Store
                $general_ledger = new GeneralLedger;
                $general_ledger->organisation_id            = getUser()->organisation_id ;
                $general_ledger->credit                     =  $data->amount;
                $general_ledger->amount                     =  $trans->cart_amount;
                $general_ledger->trans_ref                  =  $trans->tran_ref;
                $general_ledger->account_payment_id         = $data->id;

                $general_ledger->transaction_id             = $trans->id;
                $general_ledger->is_transfer                =  2 ;
                $general_ledger->cash_collected             =  1 ;
                $general_ledger->type                       =  4 ;
                  /* Need to add calculation from company */
               
                $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
                
                if (is_object($general)) {
                      $general_ledger->Balance = $general->Balance + $data->amount;
                    
                } else {
                      $general_ledger->Balance  = $data->amount;
                }
                     
                     $general_ledger->save();

                      //Debit Store
                     $general_ledgers = new GeneralLedger;
                     $general_ledgers->organisation_id           = getUser()->organisation_id ;
                     $general_ledgers->debit                     =  $data->amount;
                     $general_ledgers->amount                    =  $trans->cart_amount;
                     $general_ledgers->trans_ref                 =  $trans->tran_ref;
                     $general_ledgers->account_payment_id         = $data->id;

                     $general_ledgers->transaction_id            = $trans->id;
                     $general_ledgers->is_transfer               =  2 ;
                     $general_ledgers->cash_collected            =  1 ;
                     $general_ledgers->type                      =  4 ;
                       /* Need to add calculation from company */
                     
                     $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
                     
                     if (is_object($general)) {
                           $general_ledgers->Balance = $general->Balance - $data->amount;
                          
                     } else {
                           $general_ledgers->Balance  = $data->amount;
                     }
                         
                          $general_ledgers->save();

                     $mb = AcountsPayment::where('id', '=', $data->id)->first();
     
                     if ($mb) {
                         $mb->transaction_ref = $trans->tran_ref;
                         $mb->payment_status = $trans->payment_status; 
                         $mb->save();
                     }
                     

            }else{
            $data = new AcountsPayment;
            $data->full_name               = $request->full_name;
            $data->transaction_type        = $request->transaction_type;
            $data->organisation_id         = getUser()->organisation_id;
            $data->phone                   = $request->phone;
            $data->email                   = $request->email;
            $data->amount                  = $request->amount;
            $data->agent                   = $request->agent;
            $data->description             = $request->description;
            $data->comment                 = $request->comment;
            $data->created_user            = getUser()->id;
            $data->status                  = '0';
            $data->save();

            $mb = AcountsPayment::where('id', '=', $data->id)->first();

            $short_link = new ShortLink;
            $short_link->user_id    = ($mb) ? $mb->agent : null;
            $short_link->other_id   = 0;
            $short_link->payment_id = $mb->id;
            $short_link->short_code = (string) \Str::random(8);
            $short_link->type       = "Short Payment";
            $short_link->save();

            if ($mb) {
                $mb->short_link = url('/', $short_link->short_code);
                $mb->save();
            }
        }
            $popup_data = AcountsPayment::select('acounts_payments.*', 'user.fullname as agentname', 'company.org_street1 as address1', 'company.org_street2 as address2', 'company.org_city as city', 'company.org_state as state')
                ->join('users as user', function ($join) {
                    $join->on('user.id', '=', 'acounts_payments.agent');
                })
                ->join('organisations as company', function ($join) {
                    $join->on('user.organisation_id', '=', 'company.id');
                })
                ->withoutGlobalScope('organisation_id')
                ->where('acounts_payments.organisation_id', getUser()->organisation_id)
                ->where('acounts_payments.id', $data->id)
                ->first();

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Quick payment done successfully by '.$data->full_name; 
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();

            DB::commit();
            return ajax_response(true, $popup_data, [], "Quick Payment Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcountsPayment  $acountsPayment
     * @return \Illuminate\Http\Response
     */
    public function show(AcountsPayment $acountsPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcountsPayment  $acountsPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(AcountsPayment $acountsPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcountsPayment  $acountsPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcountsPayment $acountsPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcountsPayment  $acountsPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcountsPayment $acountsPayment)
    {
        //
    }

    public function sms_for_quick_list($id)
    {
        
        $get_data = AcountsPayment::with('moreInfo')
        ->where('acounts_payments.id', $id)
        ->first();
          
        $phone = $get_data->phone;

        if(str_contains($get_data->phone, ' ')){

            $phone = str_replace(' ', '', $get_data->phone);

        }


        $messageText = "Your payment link for Rental360 is: " . $get_data->short_link;
       
        $smsApiKey = $get_data->moreInfo->api_key;
      
        $data=Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone&senderid=MyRide&msg=$messageText");
      
        return 'true';

    }
    public function mail_for_quick_list($id)
    {


        $datas = AcountsPayment::with('moreInfo')
        ->where('acounts_payments.id', $id)
        ->first();

        // $get_customer = User::where('fullname', $datas->full_name)->first();
         
        $data = array(

            'dear'         => 'Dear',
            'msg'          => 'Please find below your payment link:',
            'amount_msg'   => 'Total Amount is :',
            'name'         =>  $datas->fullname,
            'email'        =>  $datas->email,
            'mobile'       =>  $datas->mobile,
            'amount'       =>  $datas->amount,
            'short_link'   =>  $datas->short_link,

        );
          
          Mail::mailer('smtp')->to($datas->email)->send(new SendMail($data));
        //  Mail::mailer('smtp1')->to($datas->email)->send(new SendMail($data));  
         //  Mail::mailer('smtp2')->to($datas->email)->send(new SendMail($data));

        return 'true';
    }
    
}
