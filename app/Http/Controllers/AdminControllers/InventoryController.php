<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Features; 
use App\Models\InventoryFeatures; 
use App\Models\InventoryImages;  
use App\Models\VehicleBrand; 
use App\Models\VehicleModel; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\Fleet;
use App\Models\Fleetdetails;
class InventoryController extends Controller
{
    public function index()
    {
    
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/inventry-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/_inventry-list.json')) {
            \File::delete($path . '/_inventry-list.json');
        }

        if (!file_exists($path . '/_inventry-list.json')) {
            $user = $this->json_list();
            $data = array('data' => $user);
            \File::put($path . '/_inventry-list.json', collect($data));
        }
        return view('inventory.list');
    }

   private function json_list()
    {
        return Inventory::select('inventories.id','inventories.uuid','inventories.img','inventories.brand_id','inventories.model_id', 'inventories.inventory_type','vehicle_models.model_name','vehicle_brands.brand_name',
                   DB::raw('(case when (inventories.status = 1) then "Enable" else "Disable" end) as status')
        )  

        ->leftjoin('vehicle_brands', function ($join) {
            $join->on('vehicle_brands.id', '=', 'inventories.brand_id',);
        })->leftjoin('vehicle_models', function ($join) {
            $join->on('vehicle_models.id', '=', 'inventories.model_id');
        })     
          ->orderBy('inventories.id', 'desc')      
            ->get();
 
        
        return array('data' => $inventory);
    }

    public function add($brand,$model)
    {  
        $features=Features::where('status','1')->get();
        return view('inventory.add_inventry',compact('features','brand','model'));
    }
    public function showinventry()
    { 
        
        $vehicle_brand = VehicleBrand::select('id', 'brand_name')->get();
        return view('inventory.showinventry',compact('vehicle_brand'));
    }

    public function get_brandmodel1($brand,$model)
	{
        
        $return=array();
		$getdata =VehicleModel::select('model_name','id')->where('brand_id','=',$brand)->where('status', '=', '1')
        ->where('deleted_at', '=', null )->get();
      
        $return['status']=false;
        $return['html']='';
        if(count($getdata) > 0) {
           
            foreach($getdata as $model_name) {
                $select="";
                if($model_name->id==$model){
                    $select="selected";
                }
                $return['html'] .= '<option class="opt_v1"  '.$select.' value="' . $model_name->id . '">'. $model_name->model_name;
                $return['html'] .= "</option>";
            }
            
            $return['status']=true;
	    }
         return response()->json($return);
	   }

        public function save_model1(Request $request)
        { 

         DB::beginTransaction();
         try {
            $data=new VehicleModel;
            $data->model_name      =  $request->model_name;
            $data->brand_id        =  $request->brand_id;
            $data->save();
              
         DB::commit();
         return ajax_response(true, $data, [], "Model Saved Successfully", $this->success);
         }catch (\Exception $e) {
           DB::rollback();
           $message = $e->getMessage();
          return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
        
	}
    
    public function save_brand1(Request $request)
        { 

         DB::beginTransaction();
         try {
                $data = new VehicleBrand;
                $data->brand_name                   = $request->brand_name;
                $data->service_type                 = $request->service_type;
                $data->brand_image                  = '';
                $data->status                       = $request->status; 
                $data->description                  = $request->description; 
                $data->save();
 
              
         DB::commit();
         return ajax_response(true, $data, [], "Brand Saved Successfully", $this->success);
         }catch (\Exception $e) {
           DB::rollback();
           $message = $e->getMessage();
          return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
        
	}

    public function ajax_update($brand,$model,$uuid)
    {
        $get_data=Fleet::where('uuid',$uuid)->get()->first();
        $features=Features::where('status','1')->get();
        $feature = explode(",", $get_data->features);
        $get_data_details=Fleetdetails::where('fleet_id',$get_data->id)->get();

        return view('fleet.fleet-source.update',compact('features','brand','model','get_data','feature','get_data_details'));
       
    }


    public function ajax_add($brand,$model)
    {
        $features=Features::where('status','1')->get();

        $inventory_data=Inventory::select('inventories.*','feature.feature_id') 
  
                ->leftjoin('inventory_features as feature', function ($join) {
                    $join->on('feature.header_id', '=', 'inventories.id');
                })
                ->where('brand_id',$brand)->where('model_id',$model)->get();
    
                // dd($inventory_data);
        $result = DB::table('fleets')->select('fleets.*')->get()->sortByDesc('id')->first();
        if($result=='')
        {
             $last_code = 'FL0001';
        }
        else
        {
                $getcode = $result->car_SKU; 
                $last_code = ++$getcode;
        }
       
        return view('fleet.fleet-source.add_new',compact('features','brand','model','last_code','inventory_data'));       
    }


    public function store(Request $request)
    {
        $created_user=getUser();
        // \DB::beginTransaction();
		// try{
            $features = array( "0" => 1,"1" => 2, "2" => 3,"3" => 4,"4" => 5,"5" => 6,"6" => 7,"7" => 8,"8" => 9,"9" => 10,"10" => 11,"11" => 12,"12" => 13,"13" => 14,"14" => 15,"15" => 16,"16" => 17,);
             
         $files = $_FILES['inventory_details']['tmp_name'];
         $file = $_FILES['inventory_details']['name'];
        
          $chk_ext = explode(".", $file);
       
         if ($chk_ext[1] != 'csv') {

            return redirect(route('inventory-list'))->with('successMessage', "something went wrong, please try again");
         }else{ 
           
            if ($_FILES["inventory_details"]["size"] > 0) { 
            $handle = fopen($files, "r");
             $i = 0;
            while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
                 
                if ($i > 84) { 
                   
                    $vehicle_brand = VehicleBrand::select('id')->where('brand_name', '=', $data[0])->first();
                  
                    if(isset($vehicle_brand)){
                         $brand=$vehicle_brand->id;
                        
                    }else{
                        $brand='0';
                    }
                    $vehicle_model = DB::table('vehicle_models')->select('id')->where('model_name','=', $data[1])->first();
                    if(isset($vehicle_model)){
                        $model=$vehicle_model->id;
                       
                   }else{
                       $model='0';
                   }
                  
                    $url = array();
                    if($data[3]){
                        $url[]="$data[3]";
                     }
                     if($data[4]){
                        $url[]="$data[4]";
                     }
                     if($data[5]){
                        $url[]="$data[5]";
                     }
                     if($data[6]){
                        $url[]="$data[6]";
                     }
                     if($data[7]){
                        $url[]="$data[7]";
                     }
                       //dd($url);  
                    $finalimage=array();
                    if($url){
                        foreach($url as $image){
                            $info = pathinfo($image);
                            $contents = file_get_contents($image);
                            $filess = "../public/images/inventory_images/" . $info['basename'];
                            file_put_contents($filess, $contents); 
                            $finalimage[]=$info['basename'];
                        }  
                    }
                   if(empty($finalimage)){
                      $finalimage[0]='';
                   }
                    
                    $Inventory = new Inventory;
                    $Inventory->brand_id        =  $brand;
                    $Inventory->model_id        =  $vehicle_model->id;
                    $Inventory->inventory_type  =  $data[2];
                    $Inventory->img             =  $finalimage[0];
                    $Inventory->status          =  1;
                    $Inventory->save();  

                    if(!empty($finalimage)){
                        $inventory_image = new InventoryImages;
                        $inventory_image->header_id     =  $Inventory->id;
                        $inventory_image->images        =  implode(',',$finalimage);
                        $inventory_image->save();
                     }

                    $inventory_feature = new InventoryFeatures;
                    $inventory_feature->header_id        =  $Inventory->id;
                    $inventory_feature->feature_id       = implode(",",$features);
                    $inventory_feature->save(); 
                }  
                $i++;
                   
            }
           
            }
          } 
        //          DB::commit();    
        //          return redirect(route('inventory-list'));
        //  } catch (\Exception $e) {
        //      DB::rollback();
             
                  return redirect(route('inventory-list'));
         // }
           
    }

    public function delete($uuid)
    {
        $inventory_data = Inventory::where('uuid', $uuid)->first();
       
        if (is_object($inventory_data)) {
            $oldfeature = InventoryFeatures::where('header_id', $inventory_data->id)->first();
            $oldimage = InventoryImages::where('header_id', $inventory_data->id)->first();
            if (is_object($oldfeature)) {
                $oldfeature->delete();
            }
            if (is_object($oldimage)) {
                $oldimage->delete();
            }
            $inventory_data->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }

    public function edit($uuid)
    {
        $model =VehicleModel::select('model_name','id')->get();
        $brand = VehicleBrand::select('id', 'brand_name')->get();
        $features=Features::where('status','1')->get();
        $inventory = Inventory::where('uuid', $uuid)->get();
        $selfeature = InventoryFeatures::where('header_id', $inventory[0]->id)->first();
        $selected_feat = explode(',',$selfeature->feature_id);
        
        return view('inventory.edit', compact('inventory','features','selected_feat','model','brand'));
    }

    public function update(Request $request)
    {
        
            $oldimage = InventoryImages::where('header_id', $request->update_id)->first();
            $file = $request->file('inventory_details');
            $path = public_path('../public/images/inventory_images/');
            $feature='';
            if($file){
              foreach($file as  $file){  
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $images[]=$fileName;
              }
                $final_img=implode(',',$images);
                $inventoyimg=$images[0];
            }else{
                $final_img=$oldimage->images;
                $new=explode(',',$oldimage->images);
                $inventoyimg=$new[0];
                
            }

            if($request->chechbox){
                  $feature=implode(',',$request->chechbox);
            }
  
         DB::beginTransaction();
        try {
            $Inventory = Inventory::find($request->update_id);
            $Inventory->brand_id      = $request->brand_id;
            $Inventory->model_id      = $request->model_id;
            $Inventory->inventory_type  = $request->inventory_type;
            $Inventory->img             = $inventoyimg;
            $Inventory->status          = $request->status;
            $Inventory->meta_description = $request->description;
            $Inventory->save();

            if (is_object($oldimage)) {
                $oldimage->delete();
            }
            $inventory_image = new InventoryImages;
            $inventory_image->header_id     =  $Inventory->id;
            $inventory_image->images        =  $final_img;
            $inventory_image->save();
                
            $oldfeature = InventoryFeatures::where('header_id', $request->update_id)->first();
            if (is_object($oldfeature)) {
                $oldfeature->delete();
            }
            $inventory_feature = new InventoryFeatures;
            $inventory_feature->header_id        =  $Inventory->id;
            $inventory_feature->feature_id       =  $feature;
            $inventory_feature->save(); 

        DB::commit();
        return ajax_response(true, $Inventory, [], "Inventory Update Successfully", $this->success);

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

    public function save(Request $request)
    {
            $file = $request->file('inventory_details');
            $path = public_path('../public/images/inventory_images/');
            $final_img='';
            $inventoyimg='';
            $feature='';
            if($file){
              foreach($file as  $file){  
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $images[]=$fileName;
              }
                $final_img=implode(',',$images);
                $inventoyimg=$images[0];
            }
            if($request->chechbox){
                  $feature=implode(',',$request->chechbox);
            }
  
         DB::beginTransaction();
        try {
            $Inventory = new Inventory;
            $Inventory->brand_id      = $request->brand_id;
            $Inventory->model_id      = $request->model_id;
            $Inventory->inventory_type  = $request->inventory_type;
            $Inventory->img             = $inventoyimg;
            $Inventory->status          = $request->status;
            $Inventory->meta_description = $request->description;
           
            $Inventory->save();

            $inventory_image = new InventoryImages;
            $inventory_image->header_id     =  $Inventory->id;
            $inventory_image->images        =  $final_img;
            $inventory_image->save();
                
            $inventory_feature = new InventoryFeatures;
            $inventory_feature->header_id        =  $Inventory->id;
            $inventory_feature->feature_id       =  $feature;
            $inventory_feature->save(); 

        DB::commit();
        return ajax_response(true, $Inventory, [], "Inventory saved successfully!", $this->success);

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
    public function inventoryjson($id)
    {
        $getdata=InventoryImages::select('inventory_images.id','inventory_images.images')->where('header_id',$id)->first();
         $image=$getdata->images;
         $data2 = [];
        if($image){
         $image_data=explode(',',$image);
         $i=1;
         foreach($image_data as $key => $image_data){
            $data2[] = [
                'id' => $i,
                'src' => url("/public/images/inventory_images/".$image_data)
            ];
             $i++;
          } 
        }
          return json_encode($data2);
     }
}
