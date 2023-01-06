<?php
namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\AcountsPayment;
use App\Models\ShortLink;
use App\Models\User;
use App\Models\GeneralLedger;
use App\Models\ManageBookings;
use App\Models\Transaction;
use App\Models\AmountTransaction;
use App\Models\BookingInvoicedetails;
use Illuminate\Http\Request;
use App\Models\BookingInvoice;
use App\Models\CountryMaster;
use App\Models\VehicleModel;    
use App\Models\Fleet;
use App\Models\Organisation;
use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\ReserveFleet;
use Illuminate\Support\Facades\DB;                                              
use Illuminate\Support\Collection;
use Illuminate\Http\Response;


class DashboardController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false]; 

        $path = public_path() . '/data/dashboard1-invoice-json';
      
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
       
        if (file_exists($path . '/' . getUser()->organisation_id . '_transaction2.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_transaction2.json');
        }
        
        if (!file_exists($path . '/' . getUser()->organisation_id . '_transaction2.json')) {
            $user = $this->jsonInvoiceList();
            $data = array('data' => $user); 
            \File::put($path . '/' . getUser()->organisation_id . '_transaction2.json', collect($data));
            
        }
        


//transaction//


$path1 = public_path() . '/data/dashboard-transaction2-json';

if (!file_exists($path1)) {
    \File::makeDirectory($path1, 0777, true, true);
}

if (file_exists($path1 . '/' . getUser()->organisation_id . '_invoice.json')) {
    \File::delete($path1 . '/' . getUser()->organisation_id . '_invoice.json');
}

if (!file_exists($path1 . '/' . getUser()->organisation_id . '_invoice.json')) {
    $user1 = $this->account_transactionList();
      
    $data1 = array('data' => $user1);
    \File::put($path1 . '/' . getUser()->organisation_id . '_invoice.json', collect($data1));
}
//end//



//booking//

$path3 = public_path() . '/data/dashboard-booking-json';

if (!file_exists($path3)) {
    \File::makeDirectory($path1, 0777, true, true);
}

if (file_exists($path3 . '/' . getUser()->organisation_id . '_manage-booking-list1.json')) {
    \File::delete($path3 . '/' . getUser()->organisation_id . '_manage-booking-list1.json');
}

if (!file_exists($path3 . '/' . getUser()->organisation_id . '_manage-booking-list1.json')) {
    $user3 = $this->jsonCustomerList();
    $data3 = array('data' => $user3);
    \File::put($path3 . '/' . getUser()->organisation_id . '_manage-booking-list1.json', collect($data3));
    
}


//end// 

/*  direct payment  */

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

/* direct payment  */

/* Fleet Show */
        $path = public_path() .  '/data/fleetshow';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_fleetshow.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_fleetshow.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_fleetshow.json')) {
            $user = $this->fleetshowrList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_fleetshow.json', collect($data));
        }

 /* Fleet Show */
    /* Reserve Fleet Show */ 
    $path = public_path() .  '/data/reservefleetshow';

    if (!file_exists($path)) {
        \File::makeDirectory($path, 0777, true, true);
    }

    if (file_exists($path . '/' . getUser()->organisation_id . '_reservefleetshow.json')) {
        \File::delete($path . '/' . getUser()->organisation_id . '_reservefleetshow.json');
    }

    if (!file_exists($path . '/' . getUser()->organisation_id . '_reservefleetshow.json')) {
        $reservedata = $this->reservefleetshowrList();
        $data = array('data' => $reservedata);
        \File::put($path . '/' . getUser()->organisation_id . '_reservefleetshow.json', collect($data));
    }

    /*Reserve Fleet Show */

        $transaction_no = Transaction::whereDate('created_at', date('Y-m-d'))->where('organisation_id',getUser()->organisation_id)->count();
       
        $sales_today = Transaction::whereDate('created_at', date('Y-m-d'))->where('organisation_id',getUser()->organisation_id)->sum('cart_amount');
         
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now(); 
        $sales_of_month = Transaction::whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->where('organisation_id',getUser()->organisation_id)->sum('cart_amount');
        $currency = Organisation::select('org_currency')->where('id',getUser()->organisation_id)->first();
        $liability = GeneralLedger::select('Balance')->where('organisation_id',getUser()->organisation_id)->orderBy('id','DESC')->first();
        $org= org_details();  
        $bookinglist= ManageBookings::select('manage_bookings.*','users.fullname','brand.brand_name','users.image',DB::raw("(SELECT SUM(cart_amount) FROM transactions WHERE transactions.booking_id=manage_bookings.id) as totalDeductions") )
        ->leftjoin('users as users', function ($join) {
            $join->on('users.id', '=', 'manage_bookings.customer_id');
          })
          ->leftjoin('vehicle_brands as brand', function ($join) {
            $join->on('brand.id', '=', 'manage_bookings.brand_id');
          })
          ->where('usertype', 2)
         ->where('manage_bookings.organisation_id', getUser()->organisation_id)
       ->get();
    //   dd($bookinglist);

    return view('dashboard', ['pageConfigs' => $pageConfigs,'transanction_no'=>$transaction_no, 'sales_today'=>$sales_today, 'sales_of_month'=>$sales_of_month,'currency'=>$currency, 'liability'=>$liability,'bookinglist'=>$bookinglist, 'org'=>$org ]);

    }
   
    private function reservefleetshowrList()
    {
      return ReserveFleet::select('reserve_fleets.id','fleets.id as fleetid','manage_bookings.id as booked','reserve_fleets.from_date','reserve_fleets.to_date','fleets.car_SKU','brand.brand_name','model.model_name','fleets.car_service_type','users.fullname') 
         ->leftjoin('vehicle_brands as brand', function ($join) {
            $join->on('brand.id', '=', 'reserve_fleets.brand_id');
          })
          ->leftjoin('manage_bookings as manage_bookings', function ($join) {
            $join->on('manage_bookings.id', '=', 'reserve_fleets.booking_id');
          })
          ->leftjoin('users as users', function ($join) {
            $join->on('users.id', '=', 'manage_bookings.customer_id');
          })
          ->leftjoin('fleets as fleets', function ($join) {
            $join->on('reserve_fleets.fleet_id', '=', 'fleets.id');
          })
         ->leftjoin('vehicle_models as model', function ($join) {
            $join->on('model.id', '=', 'fleets.model_id');
          })
        ->withoutGlobalScope('organisation_id')
        ->where('manage_bookings.organisation_id', getUser()->organisation_id) 
        ->orderBy('manage_bookings.id', 'desc')              
        ->get();
        
    }
    private function fleetshowrList()
    {
      return Fleet::select('fleets.id', 'fleets.uuid','fleets.image','brand.brand_image','brand.brand_name','model.model_name','fleets.car_service_type','fleets.status') 
         ->leftjoin('vehicle_brands as brand', function ($join) {
            $join->on('brand.id', '=', 'fleets.brand_id');
          })
         ->leftjoin('vehicle_models as model', function ($join) {
            $join->on('model.id', '=', 'fleets.model_id');
          })
        ->withoutGlobalScope('organisation_id')
        ->where('fleets.organisation_id', getUser()->organisation_id) 

        ->where('fleets.is_deleted','=',0)
        
        ->orderBy('fleets.id', 'desc')              
        ->get();
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

      private function jsonInvoiceList()  
      {
        return BookingInvoice::select('booking_invoices.*','transaction.id as tran_id','transaction.tran_ref','transaction.tran_type','transaction.payment_method','transaction.cart_amount','transaction.transaction_time','transaction.payment_status','transaction.cart_currency')
            ->leftJoin('transactions as transaction', function ($join) {
                $join->on('transaction.invoice_id', '=', 'booking_invoices.id')->where('from_invoice',1)->where('transaction.organisation_id', getUser()->organisation_id);
            }) 
            ->where('booking_invoices.organisation_id', getUser()->organisation_id)  
            ->orderBy('booking_invoices.id','desc')   
            ->get();  
        }

        private function account_transactionList()
        {
                return Transaction::select('transactions.*','booking_invoices.name')
                  ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                      $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
                })
                ->where('transactions.organisation_id', getUser()->organisation_id)
                ->orderBy('transactions.id', 'desc')
                ->get();
        
        }



private function jsonCustomerList()
{

   return ManageBookings::select(
        'manage_bookings.id',
        'manage_bookings.is_created_invoice',
        'manage_bookings.is_send_invoice',
        'manage_bookings.booking_code',
        'manage_bookings.driver_id',
        'manage_bookings.pickup_date_time',
        'manage_bookings.dropoff_date_time',
        'manage_bookings.pickup_address', 
        'manage_bookings.dropoff_address',
        'manage_bookings.uuid',
        'manage_bookings.payment_status  as  pay_status', 
        'manage_bookings.booking_status',
        'manage_bookings.payment_mode',
        'manage_bookings.amount',
        'manage_bookings.number_of_tavellers',
        'user.fullname as name',
        'user.mobile as mobile',
        'vehicle_brands.brand_name as vehicle',
    )
        ->join('users as user', function ($join) {
            $join->on('user.id', '=', 'manage_bookings.customer_id');
        })
        ->leftjoin('vehicle_brands', function ($join) {
            $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
        })
     
        ->where('user.usertype', 2)
        ->orderBy('manage_bookings.id', 'desc')
        ->where('manage_bookings.organisation_id', getUser()->organisation_id)
        ->groupBy('manage_bookings.id')  
        // ->orwhere('booking_invoices.document_type', 'booking') 

        ->get();
        // dd($return);
        
   }

  public function invoice_details1($id)
    {
        
         $transaction_details = Transaction::select('transactions.*','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','booking_invoices.name','booking_invoices.email','booking_invoices.country','booking_invoices.city','booking_invoices.street','transactions.invoice_id')
        ->join('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
        })
         ->where('transactions.id', '=', $id)
         ->first();
        
       return  json_encode($transaction_details);
         
    }

    public function get_invoice_details_data1($id)
    {
        $invoice_detail=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref')
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
        ->withoutGlobalScope('organisation_id')
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
            }
            else
            {
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

    public function transaction_data1_details1($id)
    {
        
         $transaction_details = Transaction::select('transactions.*','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','booking_invoices.name','booking_invoices.email','booking_invoices.country','booking_invoices.city','booking_invoices.street','transactions.invoice_id')
        ->join('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
        })
         ->where('transactions.id', '=', $id)
         ->first();
        
       return  json_encode($transaction_details);
         
    }

    public function get_transaction_data1_details_data1($id)
    {
        
        $invoice_detail=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref')
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

         echo json_encode($return);die;

    }

    public function readablechange(Request $request)
    {  
          
            DB::beginTransaction();
            try {
                   $last_ids=$request->readable_id;
                   $data1=0;
                   if($last_ids){
                    foreach($last_ids as $last_ids){
                        
                        $data_changed = Notifications::find($last_ids);
                        $data_changed->read = '1';
                        $data_changed->unread = '0';
                        $data_changed->save();
                    }
                    
                    $startdate = Carbon::now()->toDateTimeString();
                    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
                    $data= Notifications::select('notifications.*')
                            ->where('read', '0') 
                            ->where('user_id', getUser()->id) 
                            ->where('organisation_id', getUser()->organisation_id) 
                            ->whereDate('created_at', '<=', $startdate)
                            ->whereDate('created_at', '>=', $lastdate)
                            ->orderBy('id', 'DESC') 
                            ->get();
                     $data1=count($data);
                  }    
                DB::commit();
                return ajax_response(true, $data1, [], "Notifications readable Successfully", $this->success);
            } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }
        
    }
   
    public function return_fleet($reserveid)
    {  
   
    DB::beginTransaction();
     try {
       $reserve=ReserveFleet::find($reserveid);
       if($reserve){
          $fleet = Fleet::find($reserve->fleet_id);
            if($fleet){
                $fleet->is_reserved = '0';
                $fleet->save();
            }
            $managebooking = ManageBookings::find($reserve->booking_id);
            if($managebooking){
                $managebooking->booking_status = '3';
                $managebooking->save();
            }
            $reserve->delete();
        }
        DB::commit();
        return ajax_response(true, $fleet, [], "Fleet Return Successfully", $this->success);
    } catch (\Exception $e) {
        DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false, [], [], $message, $this->internal_server_error);
    }    
  }

}


