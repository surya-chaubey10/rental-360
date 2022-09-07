<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use App\Models\OfferCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('offer.offercategory.list');
    }
    public function json_list(){
        $customer = OfferCategory::get();
    //    dd(count($customer));
        $details = new Collection();
        $num = 1;
        foreach ($customer as $key => $date) {
     
           $details->push([
               "num"            => $num++,
               "id"             => $date->id,
               "category_name"      => $date->category_name, 
               "status"         => $date->status, 
           ]); 
        }
         
       return array('data' => $details);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offer.offercategory.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
;        DB::beginTransaction();
         try{
              
                $data = new OfferCategory;
                $data->category_name       = $request->category_name;
                $data->status = $request->status; 
                $data->save();

            DB::commit();
            return ajax_response(true, $data, [], "Category Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[],  $message , "Category Saved UnSuccessfully",$this->internal_server_error);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(OfferCategory $offerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
    $data = OfferCategory::where('id',$uuid)->first();

       
       return view('offer.offercategory.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        DB::beginTransaction();
        try{
             
               $data = OfferCategory::find($request->updated_id); 
               $data->category_name       = $request->category_name;
               $data->status = $request->status; 
               $data->save();

           DB::commit();
           return ajax_response(true, $data, [], "Category Updated Successfully", $this->success);
        }
        catch(\Exception $e){
            DB::rollback();
           $message = $e->getMessage();
           return ajax_response(false,[],  $message , "Category Updated UnSuccessfully",$this->internal_server_error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $Offercategory = OfferCategory::where('id', $uuid)->first();
 
        if (is_object($Offercategory)) {
         
            $Offercategory->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
