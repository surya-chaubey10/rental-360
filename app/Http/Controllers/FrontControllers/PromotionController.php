<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\ReserveFleet;
use Illuminate\Support\Facades\DB;                                              
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use App\Models\Promotion;
use App\Models\CompanyActivity;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
   
     public function index()
    {
        $pageConfigs = ['pageHeader' => false]; 

        $path = public_path() . '/data/promotion-list';
      
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
       
        if (file_exists($path . '/' . getUser()->organisation_id . '_promotion.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_promotion.json');
        }
        
        if (!file_exists($path . '/' . getUser()->organisation_id . '_promotion.json')) {
            $user = $this->jsonpromotionList();
            $data = array('data' => $user); 
            \File::put($path . '/' . getUser()->organisation_id . '_promotion.json', collect($data));
            return view('booking.promotion.list');

        }
    }
    private function jsonpromotionList()
    {
            return Promotion::select('promotions.*')  
           ->orderBy('promotions.id', 'desc')
           ->get();
           
            }
  
    public function create()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return view('booking.promotion.create',compact('code'));
    }

    public function store(Request $request)
    {
         DB::beginTransaction();
        try{ 
            $data = new Promotion;
            $data->from_date = $request->from_date;
            $data->to_date = $request->to_date;
            $data->promotion_code = $request->promotion_code;
            $data->promotion_type = $request->promotion_type;
            $data->promotion_value = $request->promotion_value;
            $data->status = $request->status; 
           
            $data->save();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Promotion created by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

           DB::commit();
           return ajax_response(true, $data, [], "Promotion Saved Successfully", $this->success);
        }
        catch(\Exception $e){
            DB::rollback();
           $message = $e->getMessage();
           return ajax_response(false,[],  $message , "Promotion Saved UnSuccessfully",$this->internal_server_error);
        }
    }

   
    public function show(Promotion $promotion)
    {
        //
    }

    
    public function update($uuid)
    {
        $data = Promotion::where('uuid',$uuid)->first(); 
        // dd($data);
        return view('booking.promotion.edit',compact('data'));  
    }
    public function edit(Request $request)
    {
        DB::beginTransaction();
        try{ 
           
            $data = Promotion::find($request->updated_id);  
            $data->from_date = $request->from_date;
            $data->to_date = $request->to_date;
            $data->promotion_code = $request->promotion_code;
            $data->promotion_type = $request->promotion_type;
            $data->promotion_value = $request->promotion_value;
            $data->status = $request->status; 
        //    dd($data);
            $data->save();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Promotion updated by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

            DB::commit();
            return ajax_response(true, $data, [], "Promotion Updated Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[],  $message , "Promotion Updated UnSuccessfully",$this->internal_server_error);
         }
    }

    public function destroy($uuid)
    {
        $promotion = Promotion::where('uuid', $uuid)->first();
 
        if (is_object($promotion)) {
         
            $promotion->delete();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Promotion deleted by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
