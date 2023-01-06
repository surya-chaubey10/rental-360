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

    public function store(Request $request)
    {
        $created_user=getUser();
        DB::beginTransaction();

		try{
          
         $files = $_FILES['inventory_details']['tmp_name'];
         $file = $_FILES['inventory_details']['name'];
      
          $chk_ext = explode(".", $file);
       
        if ($chk_ext[1] != 'csv') {

            return redirect(route('inventory-list'))->with('successMessage', "something went wrong, please try again");
        }else{ 
       
        
            if ($_FILES["inventory_details"]["size"] > 0) {
              
            $handle = fopen($files, "r");
             $i = 0;
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                 
                if ($i > 0) { 

                    $vehicle_brand = VehicleBrand::select('id')->where('brand_name', '=', $data[0])->first();
                  
                    if(isset($vehicle_brand->id)){
                         $brand=$vehicle_brand->id;
                        
                    }else{
                        $brand='0';
                    }
                    $vehicle_model = DB::table('vehicle_models')->select('id')->where('model_name','=', $data[1])->first();
                   
                    $dat=explode(",", $data[5]);
                    $rata=array();
                    if(!empty($dat)){
                            foreach($dat as $feature){
                                 $vehicle_feature = Features::select('id')->where('feature_name', $feature)->first();
                                if($vehicle_feature){
                                    $rata[]=$vehicle_feature->id;
                                }    
                            }
                     }
                    
                    $url = "$data[3]";
                    $info = pathinfo($url);
                    $contents = file_get_contents($url);
                    $filess = "../public/images/inventory_import_file/" . $info['basename'];
                    file_put_contents($filess, $contents); 
                     
                    $inventory = new Inventory;
                    $inventory->brand_id        =  $brand;
                    $inventory->model_id        =  $vehicle_model->id;
                    $inventory->inventory_type  = $data[2];
                    $inventory->img             = $info['basename'];
                    $inventory->status          = $data[4];
                    $inventory->created_user          = $created_user->id;
                    
                    $inventory->save();  
                   
                    $inventory_image = new InventoryImages;
                    $inventory_image->header_id        =  $inventory->id;
                    $inventory_image->images        =  $data[3];
                    $inventory_image->created_user          = $created_user->id;
                    $inventory_image->save();
                     
                    $inventory_feature = new InventoryFeatures;
                    $inventory_feature->header_id        =  $inventory->id;
                    $inventory_feature->feature_id        = implode(",",$rata);
                    $inventory_feature->created_user          = $created_user->id;
                    $inventory_feature->save();
                    
                }  
                $i++;
                 
            }
           
            }
        } 
            DB::commit();
                      
                 return redirect(route('inventory-list'));
         } catch (\Exception $e) {
             DB::rollback();
             
                  return redirect(route('inventory-list'));
          }
           
    }

    public function delete($uuid)
    {
        $inventory_data = Inventory::where('uuid', $uuid)->first();

        if (is_object($inventory_data)) {
            $inventory_data->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }

    public function edit($uuid)
    {
        $inventory = Inventory::where('uuid', $uuid)->get();
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request)
    {
        $created_user=getUser();
        $path = public_path('../public/images/inventory_images/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('img_path');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);

        \DB::beginTransaction();
        try {
            $Inventory_updated = Inventory::find($request->inventory_updated_id);
            $Inventory_updated->brand_name      = $request->brand_name;
            $Inventory_updated->model_name      = $request->model_name;
            $Inventory_updated->inventory_type  = $request->inventory_type;
            $Inventory_updated->img             = $fileName;
            $Inventory_updated->status          = $request->status;
            $inventory->updated_user            = $created_user->id;
            dd($Inventory_updated);

            $Inventory_updated->save();
            \DB::commit();
            return ajax_response(true, $Inventory_updated, [], "Inventory Update Successfully", $this->success);
        } catch (\Exception $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Inventory Update Unsuccessfully", $this->internal_server_error);
        } catch (\Throwable $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Inventory Update Unsuccessfully", $this->internal_server_error);
        }
    }
}
