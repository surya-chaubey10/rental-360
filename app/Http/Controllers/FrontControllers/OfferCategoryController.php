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
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/offer-category';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_offercatagory.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_offercatagory.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_offercatagory.json')) {
            $user = $this->jsonCustomerList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_offercatagory.json', collect($data));
        }
        return view('offer.offercategory.list');
    }

        private function jsonCustomerList()
        {
            return OfferCategory::select('offer_categories.id', 'offer_categories.category_name' ,'offer_categories.status',   'offer_categories.uuid') 
                ->withoutGlobalScope('organisation_id')
                ->where('offer_categories.organisation_id', getUser()->organisation_id)              
                ->get();
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
