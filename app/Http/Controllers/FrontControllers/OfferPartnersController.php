<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\OfferPartners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferPartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/partner-json';

        if (!file_exists($path)) { 
            \File::makeDirectory($path, 0777, true, true);
        }
       
        if (file_exists($path . '/' . getUser()->organisation_id . '_partner-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_partner-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_partner-list.json')) {
            $user = $this->jsonPartnerList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_partner-list.json', collect($data));
        }

        return view('offer.partners.list', ['pageConfigs' => $pageConfigs]);
    }

    private function jsonPartnerList()
    { 
        return OfferPartners::select('id','uuid','partner_name', 'status', 'created_at') 
            ->withoutGlobalScope('organisation_id')
            // ->where('usertype', 4)
            ->where('organisation_id', getUser()->organisation_id)
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offer.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{ 
            $data = new OfferPartners;
            $data->partner_name       = $request->partner_name;
            $data->status = $request->status; 
            $data->save();

           DB::commit();
           return ajax_response(true, $data, [], "Partner Saved Successfully", $this->success);
        }
        catch(\Exception $e){
            DB::rollback();
           $message = $e->getMessage();
           return ajax_response(false,[],  $message , "Partner Saved UnSuccessfully",$this->internal_server_error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferPartners  $offerPartners
     * @return \Illuminate\Http\Response
     */
    public function show(OfferPartners $offerPartners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferPartners  $offerPartners
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data = OfferPartners::where('uuid',$uuid)->first(); 
       
        return view('offer.partners.edit',compact('data'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferPartners  $offerPartners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferPartners $offerPartners)
    {
        DB::beginTransaction();
        try{
             
               $data = OfferPartners::find($request->updated_id); 
               $data->partner_name       = $request->partner_name;
               $data->status = $request->status; 
               $data->save();

           DB::commit();
           return ajax_response(true, $data, [], "Partner Updated Successfully", $this->success);
        }
        catch(\Exception $e){
            DB::rollback();
           $message = $e->getMessage();
           return ajax_response(false,[],  $message , "Partner Updated UnSuccessfully",$this->internal_server_error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferPartners  $offerPartners
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $OfferPartners = OfferPartners::where('uuid', $uuid)->first();
 
        if (is_object($OfferPartners)) {
         
            $OfferPartners->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
