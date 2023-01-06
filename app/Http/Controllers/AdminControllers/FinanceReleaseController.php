<?php
namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\FinanceReleaseModel; 
use App\Models\Release; 
use App\Models\GeneralLedger;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceReleaseController extends Controller
{
	
	
    public function index()
    {

        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/superadmin/request/FinanceRelease-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/'. '_release-list.json')) {
            \File::delete($path . '/'. '_release-list.json');
        }

        if (!file_exists($path . '/'. '_release-list.json')) {
            $user = $this->releaseList();
            $data = array('data' => $user);
            \File::put($path . '/'. '_release-list.json', collect($data));
        }
        return view('finance.release.list');
    }


    private function releaseList()
    {
        return  Release::select('releases.last_approval_date','releases.status','releases.request_on','releases.company_name','releases.withdraw_amount','releases.withdraw_fees','organisations.org_name','releases.created_at','releases.id')
        ->join('organisations', function ($join) {
            $join->on('organisations.id', '=', 'releases.organisation_id');
        })
             ->whereNull('releases.deleted_at')
             ->orderBy('releases.id', 'desc') 
             ->get();
           
    }
    public function add() 
    {
        
        return view('finance.release.add');                 
    }

    public function store_gl($id,$checked){

         $release=Release::select('releases.withdraw_amount','releases.organisation_id')->where('id','=',$id)->first();
  
         DB::beginTransaction();
        try {
                
                $request_data=Release::where('id','=',$id)->first();
                 
                if($checked==1){
                    $general_ledger=new GeneralLedger;
                    $general_ledger->organisation_id        = $release->organisation_id;
                    $general_ledger->amount                 = $release->withdraw_amount;
                    $general_ledger->debit                  = $release->withdraw_amount;
                    $general=GeneralLedger::select('Balance')->orderBy('id','DESC')->first();
    
                    if(isset($general->Balance)){
                        $balance=$general->Balance-$general_ledger->debit;
                    }else{
                        $balance=0;
                     }
                    $general_ledger->Balance                = $balance;
                    $general_ledger->save();
                  }else{
                     $request_data->status=$checked;
                     $request_data->save();
                  }
                
            
            DB::commit();
            if($checked==1){

            return ajax_response(true, $general_ledger, [], "General Save Successfully", $this->success);

           }else{

            return ajax_response(true, $request_data, [], "Status Update Successfully", $this->success);
           }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }
}
