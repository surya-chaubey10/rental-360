<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\FinanceRequestModel;  
use Illuminate\Http\Request;
use App\Models\Requests; 
use App\Models\Release; 
use App\Models\GeneralLedger;
use Illuminate\Support\Facades\DB;

class FinanceRequestController extends Controller   
{
   
   public function add() 
    {
        return view('finance.request.add');                   
    }
    
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/superadmin/request/request-datatable-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/'. '_request-list.json')) {
            \File::delete($path . '/'. '_request-list.json');
        }

        if (!file_exists($path . '/'. '_request-list.json')) {
            $user = $this->json_list();
             $data = array('data' => $user);
            \File::put($path . '/'. '_request-list.json', collect($data));
        }
 
        return view('finance.request.list', ['pageConfigs' => $pageConfigs]);
       
    }

    private function json_list()
    {
        
       return Requests::select('requests.*') 
                ->orderBy('requests.id', 'desc') 
                ->get();
           
    }

    public function store_release($id,$checked){
  
       
        $created_user=getUser();
         
        DB::beginTransaction();
        try {

            $request_data=Requests::where('id','=',$id)->first();
    
            if($checked==1){
                $request_data->status=$checked ;

                $request_data->save(); 
                
                $release = new Release;
                $release->request_id                   =  $request_data->id;
                $release->company_name                 =  $request_data->vendor_name;
                $release->withdraw_amount              =  $request_data->amount_request;
                //$release->withdrawl_fees               =  0;
                $release->request_on                   =  $request_data->request_date;
                $release->last_approval_date           =  $request_data->created_at;
                $release->status                       =  $request_data->status;
                //$release->created_user                 =  $created_user->id;
                $release->save();  
            }else{
                 $request_data->status=$checked;
                 $request_data->save(); 
            }
              
           
               
            
            DB::commit();
            if($checked==1){
              return ajax_response(true, $release, [], "Release Saved Successfully", $this->success);
            }else{
             return ajax_response(true, $request_data, [], "Request Update Successfully", $this->success);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
       
        
        
    }

    public function comapany_details($id,$value)
    {
       
          $request= Requests::select('requests.id','requests.uuid','requests.vendor_name','requests.current_balance','requests.amount_request',
                'requests.balance_after_request','requests.request_date','requests.status','requests.organisation_id','requests.message','requests.accepted') 
                 ->whereNull('requests.deleted_at')
                 ->where('requests.id','=',$id)
                 ->first();
         
          return json_encode($request);
         
    }

    public function save(Request $request)
    {
           
        DB::beginTransaction();
        try {
                    $reject = Requests::find($request->id);
                   
                    $reject->message  =$request->message;
                    $reject->accepted =$request->accepted;
                    $reject->save();

                    DB::commit();
                   
                      return ajax_response(true, $reject, [], "Saved Successfully", $this->success);
                   
                } catch (\Exception $e) {
                    DB::rollback();
                    $message = $e->getMessage();
                    return ajax_response(false, [], [], $message, $this->internal_server_error);
                } catch (\Throwable $e) {
                    DB::rollback();
                    $message = $e->getMessage();
                    return ajax_response(false, [], [], $message, $this->internal_server_error);
                }     
					 
            
    }

    public function store(Request $request)
    {
        /* $available_amt = GeneralLedger::select('id','credit','Balance','partial_amount','type')->where('organisation_id', $request->org_id)->where('is_transfer', 1)->where('credit','>', 0) ->get();
       dd($available_amt); */
        if($request->file('image')){

            $file  = $request->file('image');
            $bu_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document1);

        }

        DB::beginTransaction();
        try {
                    $commissionCharges=0;
					$vat=5;
					$note=NULL;
                    $net_total=0;
                    $withdrawl_fees = Requests::select('withdrawl_fees')->orderBy('id', 'DESC')->where('organisation_id', $request->org_id)->where('id', $request->id)->first();
                    
						
                        $net_total = $request->amount;
						
						$note='Debit '.$net_total.', AED ( Withdrawal Fee '.$withdrawl_fees->withdrawl_fees.', Net '.$net_total+ $withdrawl_fees->withdrawl_fees. ')';
					
					 
                    if($request->debit_id==1){
                         $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', $request->org_id) ->first();
                        if($general){
                            $balance = $general->Balance - ($request->amount + $withdrawl_fees->withdrawl_fees);
                        }else{
                            $balance = $request->balance_id;
                        }
                        
                         $general_ledger = new GeneralLedger;
                         $general_ledger->organisation_id          = $request->org_id;
                         $general_ledger->Balance                  = $balance;
                         $general_ledger->debit                    = $request->amount + $withdrawl_fees->withdrawl_fees;
                         $general_ledger->note                     = $note;
                         $general_ledger->type                     = 2;
                         $general_ledger->is_transfer              = 2;
                         $general_ledger->withdrawal_fee           = $withdrawl_fees->withdrawl_fees;
                         $general_ledger->amount                   = $request->amount + $withdrawl_fees->withdrawl_fees;
                        
                         if($request->file('image')){
                            $general_ledger->image                 = $file;
                         }
                         $general_ledger->save(); 


                         /* payment status and partial payment logic */
                         $finamt= $request->amount + $withdrawl_fees->withdrawl_fees;
                         $available_amt = GeneralLedger::select('id','credit','Balance','partial_amount','type')->where('organisation_id', $request->org_id)->where('is_transfer', 1)->where('credit','>', 0) ->get();
                       
                         foreach($available_amt as $available){
                                if($finamt>0){
                                    
                                           if($available->type!=3){
                                                     if($finamt>=$available->credit){
                                                             $temp= $finamt-$available->credit;
                                                         
                                                             $gl =  GeneralLedger::find($available->id);
                                                             $gl->is_transfer                  = 2;
                                                             $gl->type                         = 2;
                                                             $gl->save(); 
                                                     }else{
                 
                                                         $temp = $available->credit-$finamt;
                                                         
                                                                 $gl =  GeneralLedger::find($available->id);
                                                                 $gl->partial_amount               = $temp;
                                                                 $gl->type                         = 3;
                                                                 $gl->save(); 
                 
                                                                 break;
                 
                                                         }
                                                 }else{
                                                           if($finamt>=$available->partial_amount){
                                                                     $temp= $finamt-$available->partial_amount;
                                                                 
                                                                     $gl =  GeneralLedger::find($available->id);
                                                                     $gl->is_transfer                  = 2;
                                                                     $gl->type                         = 2;
                                                                     $gl->partial_amount               = null;
                                                                     $gl->save(); 
                                                             }else{
                 
                                                                 $temp = $available->partial_amount-$finamt;
                                                                 
                                                                         $gl =  GeneralLedger::find($available->id);
                                                                         $gl->partial_amount               = $temp;
                                                                         $gl->type                         = 3;
                                                                         $gl->save(); 
                 
                                                                         break;
                 
                                                                 }
                 
                                                  }
                                   }
                 
                                  $finamt= $temp;
                         }
                     /* payment status and partial payment logic  End */  
                     

                    }
                   else{
                       $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', $request->org_id) ->first();
                       
                         $balance = $request->amount + $general->Balance;
                          
                         $general_ledger = new GeneralLedger;
                         $general_ledger->organisation_id          = $request->org_id;
                         $general_ledger->Balance                  = $balance;
                         $general_ledger->credit                   = $request->amount;
                         $general_ledger->note                     = $request->description;

                         if($request->file('image')){
                               $general_ledger->image                    = $file;
                         }
                        
                        $general_ledger->save(); 
                    }
                   
                    if($general_ledger){
                        $reject = Requests::find($request->id); 
                        $reject->accepted  =1;
                        $reject->save();
                    }
                    DB::commit();
                   
                      return ajax_response(true, $general_ledger, [], "Saved Successfully", $this->success);
                   
                } catch (\Exception $e) {
                    DB::rollback();
                    $message = $e->getMessage();
                    return ajax_response(false, [], [], $message, $this->internal_server_error);
                } catch (\Throwable $e) {
                    DB::rollback();
                    $message = $e->getMessage();
                    return ajax_response(false, [], [], $message, $this->internal_server_error);
                }     
					 
         
    }
   
}
