<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\AcountsPayment;
use App\Models\Transaction;
use App\Models\ShortLink;
use App\Models\Organisation;
use App\Models\User;
use App\Models\GeneralLedger;
use App\Models\Requests; 
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CompanyBank;
use App\Models\CompanyActivity;
use App\Models\AmountTransaction;
use App\Models\BookingInvoicedetails;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CompanyGLController extends Controller
{
    public function index(Request $request)
   {

    if($request->select_company)
    {
        $orgid = Organisation::find($request->select_company);
        $gl= GeneralLedger::select('general_ledgers.*','organisations.org_name')
        ->leftjoin('organisations as organisations', function ($join) {
            $join->on('general_ledgers.organisation_id', '=', 'organisations.id');
        })
        ->where('general_ledgers.organisation_id', $request->select_company )->get();
        $tran=Transaction::select('transactions.tran_type')->where('organisation_id', $request->select_company )->get();
          $allcompanies = Organisation::select('*')->where('id','!=',0)->get();

        return view('finance.companygl.list',compact('gl','orgid','tran','allcompanies'));

    }
        $orgid=null;
        $gl= GeneralLedger::select('general_ledgers.*','organisations.org_name')
        ->leftjoin('organisations as organisations', function ($join) {
            $join->on('general_ledgers.organisation_id', '=', 'organisations.id');
        })
        ->get();
        $tran=Transaction::select('transactions.tran_type')->get();
          $allcompanies = Organisation::select('*')->where('id','!=',0)->get();
     
       return view('finance.companygl.list',compact('gl','orgid','tran','allcompanies'));
   }
   public function companyfilter_gl(Request $request)
   {
   
        $orgid = Organisation::find($request->select_company);
        $gl= GeneralLedger::select('general_ledgers.*','organisations.org_name')
        ->leftjoin('organisations as organisations', function ($join) {
            $join->on('general_ledgers.organisation_id', '=', 'organisations.id');
        })
        ->where('general_ledgers.organisation_id', $request->select_company )->get();
        $tran=Transaction::select('transactions.tran_type')->where('organisation_id', $request->select_company )->get();
        $alluser = User::select('users.*')->where('usertype', '1')->where('deleted_at',null)->get();
       return view('finance.companygl.list',compact('gl','orgid','tran','alluser'));
   }



   
   
}
