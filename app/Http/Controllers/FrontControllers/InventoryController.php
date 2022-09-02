<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Collection;

class InventoryController extends Controller
{
    public function index(){
       
        //$customer = Customer::paginate(10);
        return view('contact.inventory.list', ['customer' => '']); 
    }
    public function json_list(){

        $inventory = Inventory::select('id','img','brand_name','model_name','inventory_type','status')->get();
        $details = new Collection();
        
        foreach ($inventory as $key => $date) {
            if($date->status==1){
                $status='Enable';
            }else{
                $status='Disable';
            }
           $details->push([
               "id"             => $date->id,
               "image"          => $date->img,
               "brandname"      => $date->brand_name,
               "modelname"      => $date->model_name,
               "inventory_type" => $date->inventory_type,
               "status"         => ucfirst($status),
           ]);
           
        }
       
       return array('data' => $details);
       
   }
}
