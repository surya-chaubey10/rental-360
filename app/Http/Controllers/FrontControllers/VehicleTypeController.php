<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/vehicle_type-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true); 
        } 
        if (file_exists($path . '/' . getUser()->organisation_id . '_vehicle_type-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_vehicle_type-list.json');
        } 
        if (!file_exists($path . '/' . getUser()->organisation_id . '_vehicle_type-list.json')) {
            $user = $this->jsonVehicleTypeList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_vehicle_type-list.json', collect($data));
        } 
        return view('fleet.vehicle_type.list', ['pageConfigs' => $pageConfigs]); 
    }

    private function jsonVehicleTypeList()
    {
       return VehicleType::select('vehicle_types.id','vehicle_types.uuid','vehicle_types.organisation_id','vehicle_types.type_name','vehicle_types.service_type','vehicle_types.type_image','vehicle_types.status') 
            ->withoutGlobalScope('organisation_id')  
            ->where('vehicle_types.organisation_id', getUser()->organisation_id)
            ->get(); 
             
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fleet.vehicle_type.create');
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
             
                $data = new VehicleType;
                $image=$request->file('type_image');
                
                if($image)
                {  
         
                  $filenameWithExt = $request->file('type_image')->getClientOriginalName();
                   // Get just filename
                   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                  // Get just ext
                   $extension = $request->file('type_image')->getClientOriginalExtension();
                   //Filename to store
                   $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                 // Upload Image
                   $path = $request->file('type_image')->storeAs('public/vehicle_type', $fileNameToStore);
                } 
             else  
               {
                   $path = '';
               } 
 
                $data->type_name                   = $request->type_name;
                $data->service_type                 = $request->service_type;
                $data->type_image                  = $path;
                $data->status                       = $request->status; 
                $data->description                       = $request->description; 
                $data->save();
 
            DB::commit();
            return ajax_response(true, $data, [], "Type Saved Successfully", $this->success);
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
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data = VehicleType::where('uuid',$uuid)->first(); 
        return view('fleet.vehicle_type.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
         try{ 
            $data = VehicleType::where('uuid',$request->updated_id)->first();
           
                $image=$request->file('type_image');
                
                if($image)
                {   
         
                  $filenameWithExt = $request->file('type_image')->getClientOriginalName();
                   // Get just filename
                   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                  // Get just ext
                   $extension = $request->file('type_image')->getClientOriginalExtension();
                   //Filename to store
                   $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                 // Upload Image
                   $path = $request->file('type_image')->storeAs('public/vehicle_type', $fileNameToStore);
                } 
             else  
               {
                $old_path = VehicleType::where('uuid',$request->updated_id)->first();
                $path= $old_path->type_image;
               }  

                $data->type_name                   = $request->type_name;
                $data->service_type                 = $request->service_type;
                $data->type_image                  = $path;
                $data->status                       = $request->status; 
                $data->description                       = $request->description; 

                $data->save();
 
            DB::commit();
            return ajax_response(true, $data, [], "Type Updated Successfully", $this->success);
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
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $VehicleType = VehicleType::where('uuid', $uuid)->first();
 
        if (is_object($VehicleType)) {
            
            $VehicleType->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
