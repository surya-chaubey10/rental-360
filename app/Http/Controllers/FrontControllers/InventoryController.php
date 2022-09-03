<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Collection;
use Storage;

class InventoryController extends Controller
{
    public function index(){
       
        //$customer = Customer::paginate(10);
        return view('contact.inventory.list', ['customer' => '']); 
    }
    public function json_list(){

        $inventory = Inventory::select('id','uuid','img','brand_name','model_name','inventory_type','status')->get();
        $details = new Collection();
        
        foreach ($inventory as $key => $date) {
            if($date->status==1){
                $status='Enable';
            }else{
                $status='Disable';
            }
           $details->push([
               "id"             => $date->id,
               "uuid"           => $date->uuid,
               "image"          => $date->img,
               "brandname"      => $date->brand_name,
               "modelname"      => $date->model_name,
               "inventory_type" => $date->inventory_type,
               "status"         => ucfirst($status),
           ]);
           
        }
       
       return array('data' => $details);
       
   }
   public function store(Request $request)
   {

        $file = $_FILES['inventory_details']['name'];
        $chk_ext = explode(".",$file);
        if($chk_ext[1] != 'csv'){
            $_SESSION['message'] = ' <div class="alert alert-danger">
            Only csv file allowed!!!
            </div>';
            header("Refresh:0");
            exit;
        }
        $target_path = "../public/images/inventory_import_file/" . $_FILES["inventory_details"]["name"];
		move_uploaded_file($_FILES["inventory_details"]["tmp_name"], $target_path);
		 
		if(strtolower($chk_ext[1]) == "csv")
            {
                
            $filename = $_FILES['inventory_details']['tmp_name'];
            $handle = fopen($target_path, "r");
            $i = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             { 
                
                if($i>0)
                {
                    $url = "$data[3]";
                    $info = pathinfo($url);
                    $contents = file_get_contents($url);
                    $file = "../public/images/inventory_images/" . $info['basename'];
                    file_put_contents($file, $contents);
                   
                   $inventory = new Inventory;
                   $inventory->brand_name      = "$data[0]";
                   $inventory->model_name      = "$data[1]";
                   $inventory->inventory_type  = "$data[2]";
                   $inventory->img             = $info['basename'];
                   $inventory->status          = "$data[4]";
                  
                   $inventory->save();
                }
                $i++;
	        }
            return redirect()->route('inventory-list');
	   } 
      
   }

}
