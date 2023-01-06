<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
use App\Models\Requests; 
use App\Models\OpeningBalance; 
use App\Models\GeneralLedger;  
use App\Models\Notifications;
use App\Models\CompanyActivity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RequestController extends Controller
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
       // dd($request);
        $date = Carbon::now()->toDateString();
       
        $pending=GeneralLedger::select('Balance')->orderBy('id','DESC')->where('organisation_id', getUser()->organisation_id)->first();
 
        $withdrawl_fees=0;
        $org= org_details();
    
        $subscription=$org->subscription;
    
        DB::beginTransaction();
        try {
             
            $withdraw = new Requests;
            $withdraw->vendor_name                  = $org->org_name;
            $withdraw->amount_request               = $request->amount_request;
            $withdraw->request_date                 = $request->request_date;
            $withdraw->bank                         = $request->bank;
            $withdraw->current_balance              = $pending->Balance ;
            $withdraw->balance_after_request        = $pending->Balance-($request->amount_request+$request->withdrawl_fees);
            $withdraw->withdrawl_fees               = $request->withdrawl_fees;
            $withdraw->created_user	                = getUser()->id;
            $withdraw->save();
         
            if($withdraw){
                $notifications = new Notifications;
                $notifications->messages          = "A Withdraw request has been created by ".getUser()->fullname." with ".$withdraw->amount_request." amount"; 
                $notifications->read              = '0';
                $notifications->unread            = '1';
                $notifications->user_id           = getUser()->id;
                $notifications->organisation_id   = getUser()->organisation_id;
                $notifications->superadmin_notification   = '1';
                $notifications->save();

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = "A Withdraw request has been created by ".getUser()->fullname." with ".$withdraw->amount_request." amount";
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();

           }
            DB::commit();
             return ajax_response(true, $withdraw, [], "Withdraw Save successfully", $this->success);
             
        } catch (\Exception $e) {
            DB::rollback();
            
            return ajax_response(false, [], [], "Withdraw Save Unsuccessfully", $this->internal_server_error);
        }
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
