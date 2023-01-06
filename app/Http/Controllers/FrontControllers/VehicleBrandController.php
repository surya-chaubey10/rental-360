<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
 
use App\Models\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Collection;

class VehicleBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/vehicle_brand-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true); 
        } 
        if (file_exists($path . '/' . getUser()->organisation_id . '_vehicle_brand-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_vehicle_brand-list.json');
        } 
        if (!file_exists($path . '/' . getUser()->organisation_id . '_vehicle_brand-list.json')) {
            $user = $this->jsonVehicleBrandList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_vehicle_brand-list.json', collect($data));
        } 
        return view('fleet.vehicle_brand.list', ['pageConfigs' => $pageConfigs]); 
    }

    private function jsonVehicleBrandList()
    {
       return VehicleBrand::select('vehicle_brands.id','vehicle_brands.uuid','vehicle_brands.organisation_id','vehicle_brands.brand_name','vehicle_brands.service_type','vehicle_brands.brand_image','vehicle_brands.status') 
            ->withoutGlobalScope('organisation_id')  
            ->where('vehicle_brands.organisation_id', getUser()->organisation_id)
            ->get(); 
             
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fleet.vehicle_brand.create');

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
             
                $data = new VehicleBrand;
                $image=$request->file('brand_image');
                
                if($image)
                {  
         
                  $filenameWithExt = $request->file('brand_image')->getClientOriginalName();
                   // Get just filename
                   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                  // Get just ext
                   $extension = $request->file('brand_image')->getClientOriginalExtension();
                   //Filename to store
                   $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                 // Upload Image
                   $path = $request->file('brand_image')->storeAs('public/vehicle_brand', $fileNameToStore);
                } 
             else  
               {
                   $path = '';
               } 
              
                $data->brand_name                   = $request->brand_name;
                $data->service_type                 = $request->service_type;
                $data->brand_image                  = $path;
                $data->status                       = $request->status; 
                $data->description                  = $request->description; 
                $data->save();
 
            DB::commit();
            return ajax_response(true, $data, [], "Brand Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[], [], $message , $this->internal_server_error);
         }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleBrand $vehicleBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response 
     */
    public function edit($uuid)
    { 
    $data = VehicleBrand::where('uuid',$uuid)->first(); 
        return view('fleet.vehicle_brand.edit',compact('data')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        DB::beginTransaction();
         try{ 
            $data = VehicleBrand::where('uuid',$request->updated_id)->first();
           
                $image=$request->file('brand_image');
                
                if($image)
                {   
         
                  $filenameWithExt = $request->file('brand_image')->getClientOriginalName();
                   // Get just filename
                   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                  // Get just ext
                   $extension = $request->file('brand_image')->getClientOriginalExtension();
                   //Filename to store
                   $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                 // Upload Image
                   $path = $request->file('brand_image')->storeAs('public/vehicle_brand', $fileNameToStore);
                } 
             else  
               {
                $old_path = VehicleBrand::where('uuid',$request->updated_id)->first();
                $path= $old_path->brand_image;
               }  

                $data->brand_name                   = $request->brand_name;
                $data->service_type                 = $request->service_type;
                $data->brand_image                  = $path;
                $data->status                       = $request->status; 
                $data->description                       = $request->description; 

                $data->save();
 
            DB::commit();
            return ajax_response(true, $data, [], "Brand Updated Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[], [], $message , $this->internal_server_error);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $VehicleBrand = VehicleBrand::where('uuid', $uuid)->first();
 
        if (is_object($VehicleBrand)) {
            
            $VehicleBrand->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
