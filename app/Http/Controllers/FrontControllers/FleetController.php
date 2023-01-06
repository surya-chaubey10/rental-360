<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Imports\ImportFleet;
use Illuminate\Http\Request;
use App\Models\VehicleBrand;
use App\Models\Features;
use App\Models\Fleet;
use App\Models\Fleetdetails;
use App\Models\Inventory;
use App\Models\VehicleModel;
use App\Models\Notifications;
use App\Models\CompanyActivity;
use App\Models\ManageBookings;
use Illuminate\Support\Collection;
use App\Models\CompanyBank;
use App\Models\Document;
use App\Models\CompanyKYC;




use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class FleetController extends Controller
{
    public function index()   
    {
        
        $vehicle_brand = VehicleBrand::select('id', 'brand_name')->get();
        $pageConfigs = ['pageHeader' => false];
        
        return view('fleet.fleet-source.list', ['pageConfigs' => $pageConfigs, 'vehicle_brand' => $vehicle_brand]);
    }
   
    public function get_brandmodel($brand,$model)
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

    public function save_model(Request $request)
	{ 

         DB::beginTransaction();
         try {
            $data=new VehicleModel;
         
            $data->model_name      =  $request->model_name;
            $data->brand_id        =  $request->brand_id;
            $data->save();
            
            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Model created by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

         DB::commit();
         return ajax_response(true, $data, [], "Model Saved Successfully", $this->success);
         }catch (\Exception $e) {
           DB::rollback();
           $message = $e->getMessage();
          return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
	}
    
    private function validations($input, $type)
    {
        $errors = [];
        $error = false;
        if ($type == "add") {
            $validator = \Validator::make($input, [

                'brand_id' => 'required',
                'model_id' => 'required',

            ]);
        }
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }

        return ["error" => $error, "errors" => $errors];
    }

    public function store(Request $request)
    {
    
        $created_user=getUser();
              
        $input = $request->all();
        $validate = $this->validations($input, "add");
        if ($validate["error"]) {
            return prepareResult(false, [], ["error" => $validate['errors']->first()], "Error while validating order.", $this->unprocessableEntity);
        }
            $path = public_path('images/fleet_images/');
            if (! file_exists($path) ) {
                mkdir($path, 0777, true);
            }
            $path2 = public_path('images/fleet_documents/');
            if (! file_exists($path2) ) {
                mkdir($path2, 0777, true);
            }
            $file1 = $request->file('inventory_details');
            $images='';
              if($file1){
                $array1=array();
                foreach($file1 as $file){
                    $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                    $file->move($path, $fileName);
                    $array1[]= $fileName;
                }
                $images=implode(',',$array1);
                
              }
            //   else{

            //     $getdata=Inventory::select('inventories.id','inventories.img','inventory_images.images')
            //     ->leftJoin('inventory_images','inventory_images.header_id','=','inventories.id')
            //     ->where('inventories.brand_id',$request->brand_id)->where('inventories.model_id',$request->model_id)->get()->first();
            //     if($getdata){

            //         $image= explode(',',$getdata->images);

            //         $array1=array();
            //         foreach($image as $file){

            //             $image_data = url("/images/inventory_images/".$file);

            //             $fileName = uniqid() . '_' .trim($image_data->getClientOriginalName());

            //             $file->copy($path, $fileName);

            //             // move(public_path($path),$fileName);
            //             $array1[]= $fileName;
            //         }
            //         $images=implode(',',$array1);

            //     }
                
                
            //   }

              $documents=$request->file('document');
              $documents1=$request->file('document1');
              $documents2=$request->file('document2');
              $documents3=$request->file('document3');
              
                $fileName1='';
                if($documents){
                    $fileName1 = uniqid() . '_' . trim($documents->getClientOriginalName());
                    $documents->move($path2, $fileName1);
                }

                $fileName2='';
                if($documents1){
                    $fileName2 = uniqid() . '_' . trim($documents1->getClientOriginalName());
                    $documents1->move($path2, $fileName2);
                }

                $fileName3='';
                if($documents2){
                    $fileName3 = uniqid() . '_' . trim($documents2->getClientOriginalName());
                    $documents2->move($path2, $fileName3);
                }

                $fileName4='';
                if($documents3){
                    $fileName4 = uniqid() . '_' . trim($documents3->getClientOriginalName());
                    $documents3->move($path2, $fileName4);
                }

                $features='';
                $get_features = $request->chechbox;
                if($get_features!=''){
                    $features=implode(',',$get_features);
                }
 
                $material = $request->material;
                $unit_price = $request->unit_price;
                $deposite  = $request->deposite;              
                $vat = $request->vat;
                $sub_total = $request->sub_total;


            DB::beginTransaction();  
            try {
				 

                    $fleet = new Fleet;
                    $fleet->brand_id                 = $request->brand_id;
                    $fleet->model_id                 = $request->model_id;
                    $fleet->mega_discription         = $request->description;
                    $fleet->booking_conditions       = $request->bookingconditions;
					$fleet->insurance_provider       = $request->insurance_provider;  
					$fleet->insurance_Expire_date    = $request->insurance_Expire_date;
                    $fleet->type                     = $request->RadioOptions;
                    $fleet->car_SKU                  = $request->sku;
                    $fleet->car_year                 = $request->year;
                    $fleet->car_service_type         = $request->service_type;
                    $fleet->car_color                = $request->color;
                    $fleet->car_number               =$request->prefix .''.$request->number_plate;
                    $fleet->car_chasis_number        = $request->chasis;
                    $fleet->allowed_distance         = $request->allowed;
                    $fleet->unit                     = $request->unit;
                    $fleet->child_seat               = $request->child_sheet;
                    $fleet->insurence                = $request->insurance;
                    $fleet->additional_distance      = $request->additional;
                    $fleet->owner_name               = $request->owner_name;
                    $fleet->phone                    = $request->phone_number;
                    $fleet->email                    = $request->email;
                    $fleet->billing_email            = $request->billing_email;
                    $fleet->features                 = $features;
                    $fleet->documents                = $fileName1;
                    $fleet->documents2               = $fileName2;
                    $fleet->documents3               = $fileName3;
                    $fleet->documents4               = $fileName4;
                    $fleet->image                    = $images;
                    $fleet->status                   = $request->Status; 
                    $fleet->created_user             = $created_user->id;  
                    $fleet->organisation_id          =$created_user->organisation_id;  
                    $fleet->save();
                   if(!empty($material)){

                        foreach($material as $key => $data){
                        
                            $fleet_details = new Fleetdetails;

                            $fleet_details->material         = $data;
                            $fleet_details->fleet_id         = $fleet->id;
                            $fleet_details->deposit          = $deposite[$key]; 
                            $fleet_details->unit_price       = $unit_price[$key];
                            $fleet_details->vat              = $vat[$key];
                            $fleet_details->subtotal         = $sub_total[$key];

                            $fleet_details->save();
                        }
                }
               if($fleet){
                            $notifications = new Notifications;
                            $notifications->messages          = "Fleet created by ".getUser()->fullname; 
                            $notifications->read              = '0';
                            $notifications->unread            = '1';
                            $notifications->user_id           = getUser()->id;
                            $notifications->organisation_id   = getUser()->organisation_id;
                            $notifications->url               = 'javascript:void(0)';
                            $notifications->save();

                            $adminactivity = new CompanyActivity;
                            $adminactivity->messages          = 'Fleet created by '.getUser()->fullname;
                            $adminactivity->created_user           = getUser()->id;
                            $adminactivity->organisation_id   = getUser()->organisation_id;
                            $adminactivity->save();
                       }
 
                DB::commit();
                return ajax_response(true, $fleet, [], "Fleet Saved Successfully", $this->success);
             } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }

    }

    public function ajax_add($brand,$model)
    {
        $features=Features::where('status','1')->get();

        $inventory_data=Inventory::select('inventories.*','feature.feature_id') 
                ->leftjoin('inventory_features as feature', function ($join) {
                    $join->on('feature.header_id', '=', 'inventories.id');
                })
                ->where('brand_id',$brand)->where('model_id',$model)->get();
    
        $result = DB::table('fleets')->select('fleets.*')->get()->sortByDesc('id')->first();
        $vehicle_brand = VehicleBrand::select('id', 'brand_name')->where('id',$brand)->first();
        $vehicle_model = VehicleModel::select('id', 'model_name')->where('id',$model)->first();
    
        $last_code = $vehicle_brand->brand_name.'-'.$vehicle_model->model_name;
       
        return view('fleet.fleet-source.add_new',compact('features','brand','model','last_code','inventory_data','vehicle_brand','vehicle_model'));       
    }

    public function ajax_update($brand,$model,$uuid)
    {
        $get_data=Fleet::where('uuid',$uuid)->get()->first();
        $features=Features::where('status','1')->get();
        $feature = explode(",", $get_data->features);
        $get_data_details=Fleetdetails::where('fleet_id',$get_data->id)->get();
         $ss=$get_data->car_number;
         $numbers = preg_replace('/[^0-9]/', '', $ss);
         $letters = preg_replace('/[^a-zA-Z]/', '', $ss);
         $vehicle_brand = VehicleBrand::select('id', 'brand_name')->where('id',$brand)->first();
         $vehicle_model = VehicleModel::select('id', 'model_name')->where('id',$model)->first();
     
         $last_code = $vehicle_brand->brand_name.'-'.$vehicle_model->model_name;
          
        return view('fleet.fleet-source.update',compact('features','brand','model','get_data','feature','get_data_details','numbers','letters','ss','last_code'));
       
    }

    public function edit($uuid)
    {
        $get_data=Fleet::where('uuid',$uuid)->get()->first();
        $vehicle_brand = VehicleBrand::select('id', 'brand_name')->get();
        return view('fleet.fleet-source.list',['vehicle_brand' => $vehicle_brand,'get_data' =>$get_data]);
    
    }

    public function fleetshow()
    {
        
      /*   if(!Auth::user())
        {
          return redirect(route('org.dashboard')); // add your desire URL in redirect function
        } */
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() .  '/data/fleetshow';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_fleetshow.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_fleetshow.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_fleetshow.json')) {
            $user = $this->fleetshowrList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_fleetshow.json', collect($data));
        }
        
        return view('fleet.fleet-source.fleet-show');

        }
        private function fleetshowrList()
        {
        

            /* $commissionCharges=0;
            $vat=5;
            $org= org_details();
            $subription=$org->subscription;
            $credit=5000;
            $payment_getway=1;
            $getwayName= explode(",",$subription->payment_gateway);
            $getwayAmount= explode(",",$subription->payement_gateway_amount);

            $key = array_search( $payment_getway,$getwayName);
            $getwayCharge= $getwayAmount[$key];

            $PGcharges=$credit*$getwayCharge/100;
            if($subription->commission_type==1){

                $commissionCharges=$subription->commission_amount;

            }else if($subription->commission_type==2){

                $commissionCharges=$credit*$subription->commission_amount/100;

            }else{

                $commissionCharges=0;

            }
            $fees=$PGcharges+$commissionCharges;
            $total_vat= ($commissionCharges+$PGcharges)*$vat/100;
            $fcredit=$credit-($PGcharges+$commissionCharges+$total_vat);
            $note='Credit '.$credit.', Fees '.$fees.', Tax '.$total_vat.', Net '.$fcredit;
                dd($commissionCharges,$PGcharges,$total_vat,$fcredit,$note); */ 
        
        return Fleet::select('fleets.id', 'fleets.uuid','fleets.image','brand.brand_image','brand.brand_name','model.model_name','fleets.car_service_type','fleets.status') 
             ->leftjoin('vehicle_brands as brand', function ($join) {
                $join->on('brand.id', '=', 'fleets.brand_id');
              })
             ->leftjoin('vehicle_models as model', function ($join) {
                $join->on('model.id', '=', 'fleets.model_id');
              })
            ->withoutGlobalScope('organisation_id')
            ->where('fleets.organisation_id', getUser()->organisation_id) 

            ->where('fleets.is_deleted','=',0)
            
            ->orderBy('fleets.id', 'desc')              
            ->get();
    }
    public function update(Request $request)
    {
        $created_user=getUser();
            $path = public_path('images/fleet_images/');
            
            if (! file_exists($path) ) {
                mkdir($path, 0777, true);
            }
            $path2 = public_path('images/fleet_documents/');
            if (! file_exists($path2) ) {
                mkdir($path2, 0777, true);
            }
            $file1 = $request->file('inventory_details');
            $file2 = $request->file('document');
            
            $previous_image=Fleet::select('image')->where('id',$request->updated_id)->get();
            $privious=array();
            if($previous_image)
            { 
               $newdata=explode(',',$previous_image[0]->image);
                foreach($newdata as $image )
                {
                     $privious[]=$image;
                }
            }

              if($file1){
                $array1=array();
                foreach($file1 as $file){
                    $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                    $file->move($path, $fileName);
                    $array1[]= $fileName;
                }
                $merged = array_merge($privious , $array1);
                $images=implode(',',$merged);

              }else{
                $images=implode(',',$privious);
              }
              
              $documents=$request->file('document');
              $documents1=$request->file('document1');
              $documents2=$request->file('document2');
              $documents3=$request->file('document3');
              
                $fileName1='';
                if($documents){
                    $fileName1 = uniqid() . '_' . trim($documents->getClientOriginalName());
                    $documents->move($path2, $fileName1);
                }
                else{
                    $fileName1=$request->file('select1');
                }

                $fileName2='';
                if($documents1){
                    $fileName2 = uniqid() . '_' . trim($documents1->getClientOriginalName());
                    $documents1->move($path2, $fileName2);
                }
                else{
                    $fileName2=$request->file('select2');
                }
                $fileName3='';
                if($documents2){
                    $fileName3 = uniqid() . '_' . trim($documents2->getClientOriginalName());
                    $documents2->move($path2, $fileName3);
                }
                else{
                    $fileName3=$request->file('select3');
                }
                $fileName4='';
                if($documents3){
                    $fileName4 = uniqid() . '_' . trim($documents3->getClientOriginalName());
                    $documents3->move($path2, $fileName4);
                }
                else{
                    $fileName4=$request->file('select4');
                }
                $features='';
                $get_features = $request->chechbox;
                if($get_features!=''){
                    $features=implode(',',$get_features);
                }

                $material = $request->material;
                $unit_price = $request->unit_price;
                $deposite  = $request->deposite;              
                $vat = $request->vat;
                $sub_total = $request->sub_total;

              
            DB::beginTransaction();
            try {
                    $fleet = Fleet::find($request->updated_id); 
                
                    $fleet->brand_id                 = $request->brand_id;
                    $fleet->model_id                 = $request->model_id;
                    $fleet->mega_discription         = $request->description;
                    $fleet->booking_conditions       = $request->bookingconditions;
					$fleet->insurance_provider       = $request->insurance_provider;
					$fleet->insurance_Expire_date    = $request->insurance_Expire_date;
                    $fleet->type                     = $request->RadioOptions;  
                    $fleet->car_SKU                  = $request->sku;
                    $fleet->car_year                 = $request->year;
                    $fleet->car_service_type         = $request->service_type;
                    $fleet->car_color                = $request->color;
                    $fleet->car_number               =$request->prefix .''.$request->number_plate;
                    $fleet->car_chasis_number        = $request->chasis;
                    $fleet->allowed_distance         = $request->allowed;
                    $fleet->unit                     = $request->unit;
                    $fleet->child_seat               = $request->child_sheet;
                    $fleet->insurence                = $request->insurance;
                    $fleet->additional_distance      = $request->additional;
                    $fleet->owner_name               = $request->owner_name;
                    $fleet->phone                    = $request->phone_number;
                    $fleet->email                    = $request->email;
                    $fleet->billing_email            = $request->billing_email;
                    $fleet->features                 = $features;
                    $fleet->documents                = $fileName1;
                    $fleet->documents2               = $fileName2;
                    $fleet->documents3               = $fileName3;
                    $fleet->documents4               = $fileName4;
                    $fleet->image                    = $images;
                    $fleet->status                   = $request->status;
                    $fleet->updated_user             =$created_user->id; 
                    $fleet->organisation_id          =$created_user->organisation_id;  

                    $fleet->save();

               if(!empty($material)){
                                          
                         foreach($material as $key => $data){
                        
                            $fleet_details = Fleetdetails::where('fleetdetails.material',$data)
                                            ->where('fleetdetails.fleet_id',$request->updated_id)
                                            ->first();
                            $fleet_details->material         = $data;
                            $fleet_details->fleet_id         = $request->updated_id;
                            $fleet_details->deposit          = $deposite[$key]; 
                            $fleet_details->unit_price       = $unit_price[$key];
                            $fleet_details->vat              = $vat[$key];
                            $fleet_details->subtotal         = $sub_total[$key];
                            $fleet_details->save();
                        }
                }

                if($fleet){

                    $notifications = new Notifications;
                    $notifications->messages          = "Fleet updated by ".getUser()->fullname; 
                    $notifications->read              = '0';
                    $notifications->unread            = '1';
                    $notifications->user_id           = getUser()->id;
                    $notifications->organisation_id   = getUser()->organisation_id;
                    $notifications->url               = 'javascript:void(0)';
                    $notifications->save();

                    $adminactivity = new CompanyActivity;
                    $adminactivity->messages          = 'Fleet updated by '.getUser()->fullname;
                    $adminactivity->created_user           = getUser()->id;
                    $adminactivity->organisation_id   = getUser()->organisation_id;
                    $adminactivity->save(); 
               }

                DB::commit();
                return ajax_response(true, $fleet, [], "Fleet Update Successfully", $this->success);
             } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }

    }
    public function imagejson($id)
    {
         $getdata =Fleet::select('fleets.id', 'fleets.uuid','fleets.image')->where('id',$id)->get()->first();
         $image=$getdata->image;
         $data2 = [];
        if($image){

         $image_data=explode(',',$image);
         $i=1;
         foreach($image_data as $key => $image_data){
            $data2[] = [
                'id' => $i,
                'src' => url("images/fleet_images/".$image_data)
            ];
             $i++;
          } 
        }
          return json_encode($data2);
    }
    public function checksku($sku)
    {
        $data='';
         $getdata =Fleet::select('fleets.car_SKU')->where('car_SKU',$sku)->first();  
          if(!empty($getdata)){
            $data=$getdata->car_SKU;
          }
          return json_encode($data);
    }
    
    public function inventoryjson($id)
    {
        $getdata=Inventory::select('inventories.id','inventories.img','inventory_images.images')
        ->leftJoin('inventory_images','inventory_images.header_id','=','inventories.id')
        ->where('inventories.id',$id)->get()->first();
         $image=$getdata->images;
         $data2 = [];
        if($image){

         $image_data=explode(',',$image);
         $i=1;
         foreach($image_data as $key => $image_data){
            $data2[] = [
                'id' => $i,
                'src' => url("/images/inventory_images/".$image_data)
            ];
             $i++;
          } 
        }
          return json_encode($data2);
     }
    public function delete($id)
    {
         //$fleet = Fleet::find($id);

            $ff=Fleet::find($id);
            $ff->is_deleted    ='1';
            $ff->save();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Fleet deleted by '.getUser()->fullname;
            $adminactivity->created_user      = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();
        // if (is_object($fleet)) {

        //    // $details = DB::table('fleetdetails')->where('fleetdetails.fleet_id',$fleet->id)->delete();
        //     $fleet->delete();
        //     $ff=Fleet::find($id);
        //     $ff->is_deleted    ='1';
        //     $ff->save();
        //     dd($ff);  
            
        // }
        return ajax_response(true, [], [], "Fleet Deleted Successfully", $this->success);
    }

    public function calendar($uuid){


        return view('fleet.fleet-source.calendar',compact('uuid')); 

    }


    public function fetch($uuid)
    {
 
        $events = ManageBookings::select(
            'manage_bookings.id',
            'manage_bookings.is_created_invoice',
            'manage_bookings.is_send_invoice',
            'manage_bookings.booking_code',
            'manage_bookings.driver_id',
            'manage_bookings.pickup_date_time',
            'manage_bookings.pickup_time',
            'manage_bookings.dropoff_date_time',
            'manage_bookings.dropoff_time',
            'manage_bookings.pickup_address', 
            'manage_bookings.dropoff_address',
            'manage_bookings.uuid',
            'manage_bookings.payment_status  as  pay_status', 
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount',
            'manage_bookings.number_of_tavellers',
            'user.fullname as name',
            'user.mobile as mobile',
            'fleets.car_SKU',
            // 'vehicle_brands.brand_name as vehicle',
            //'booking_invoices.uuid as invoice_uuid',
            // 'booking_invoices.short_link as short_link'
        )
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('fleets', function ($join) {
                $join->on('fleets.id', '=', 'manage_bookings.vehicle_id');
            })
            // ->leftjoin('vehicle_brands', function ($join) {
            //     $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
            // })
            // ->leftjoin('booking_invoices', function ($join) {
            //     $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id')->where('booking_invoices.document_type', '=', 'booking');
            // })
            ->where('manage_bookings.organisation_id', getUser()->organisation_id)
            ->where('user.usertype', 2)
            ->where('fleets.uuid',$uuid)
            ->orderBy('manage_bookings.id', 'desc')
            ->get();
    
            $eventCollection = new Collection();
                foreach ($events as $key => $data) {    
                    $color = null;
    
    
          
                    if($data->is_created_invoice == 1){
                        $color = 'grey';
    
                        if($data->pay_status == 'A'){
                            $color = 'blue';
                        }
                        
                    }else{
                        $color = 'orange';
                    }
    
                    $eventCollection->push([
    
                        "id"                 => $data->id,
                        "url"                => '../tabinvoice/'.$data->id,
                        "title"              => $data->name .' ,  1000'.$data->id .' , '.$data->car_SKU ,
                        "start"              => ($data->pickup_date_time." ".substr($data->pickup_time,0,-3)),
                        "end"                => ($data->dropoff_date_time." ".substr($data->dropoff_time,0,-3)),
                        "color"              => $color,
    
                    ]);
            }
    
    
    
            return response()->json($eventCollection);
         
 
    }

        ///toggle menu controller

     public function fleetStatus($id) {


        $value = Fleet::find($id);
        if($value->status== 1) {
            $value->status = 2;
        } else
        {
            $value->status=1;
        }
       if($value->save()){
        echo json_encode("success");
       }else {
        echo json_encode("failed");
       }



    }

    
    public function importfleets(Request $request)
    {

        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx,excel',
        ]);

        if ($request->hasfile('file')) {
            $extensions = array("xls", "xlsx", "csv");

            $excel_headers = array();
            $result = array($request->file('file')->getClientOriginalExtension());

            if (in_array($result[0], $extensions)) {
                $excel_data = Excel::toArray(new ImportFleet, $request->file('file'));

                $data = $excel_data[0];

                $header_reader = (new HeadingRowImport())->toArray($request->file('file'));
                // dd($header_reader);
                if (count($header_reader[0][0]) > 0) {
                    $aHeaderRow = $header_reader[0][0];
                    // dd($aHeaderRow);
                    foreach ($aHeaderRow as $vHeaderRow) {
                        $excel_headers[] = strtolower($vHeaderRow);
                    }
                    $aheadeError = [];
                    if (!empty($excel_headers) && (!in_array('mega_discription', $excel_headers, true))) {
                        $head_err = 'Mega Discription name header is missing.';
                        $aheadeError[]['mega_discription'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('brand_id', $excel_headers, true))) {
                        $head_err = 'Brand Id header is missing.';
                        $aheadeError[]['brand_id'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('email', $excel_headers, true))) {
                        $head_err = 'Model Id header is missing.';
                        $aheadeError[]['email'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('is_reserved', $excel_headers, true))) {
                        $head_err = 'Is Reserved header is missing.';
                        $aheadeError[]['is_reserved'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('features', $excel_headers, true))) {
                        $head_err = 'Features header is missing.';
                        $aheadeError[]['features'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('booking_conditions', $excel_headers, true))) {
                        $head_err = 'Booking Conditions header is missing.';
                        $aheadeError[]['booking_conditions'] = $head_err;
                    }

                    if (!empty($excel_headers) && (!in_array('insurance_provider', $excel_headers, true))) {
                        $head_err = 'Insurance Provider header is missing.';
                        $aheadeError[]['insurance_provider'] = $head_err;
                    }


                    if (!empty($excel_headers) && (!in_array('documents', $excel_headers, true))) {
                        $head_err = 'Documents header is missing.';
                        $aheadeError[]['documents'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('documents2', $excel_headers, true))) {
                        $head_err = 'Documents2 header is missing.';
                        $aheadeError[]['documents2'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('documents3', $excel_headers, true))) {
                        $head_err = 'Documents3 header is missing.';
                        $aheadeError[]['documents3'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('type', $excel_headers, true))) {
                        $head_err = 'Type header is missing.';
                        $aheadeError[]['type'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('car_year', $excel_headers, true))) {
                        $head_err = 'car_year header is missing.';
                        $aheadeError[]['car_year'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('car_service_type', $excel_headers, true))) {
                        $head_err = 'car_service_type header is missing.';
                        $aheadeError[]['car_service_type'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('car_color', $excel_headers, true))) {
                        $head_err = 'car_color header is missing.';
                        $aheadeError[]['car_color'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('car_number', $excel_headers, true))) {
                        $head_err = 'car_number header is missing.';
                        $aheadeError[]['car_number'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('car_chasis_number', $excel_headers, true))) {
                        $head_err = 'car_chasis_number header is missing.';
                        $aheadeError[]['car_chasis_number'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('fleet_size', $excel_headers, true))) {
                        $head_err = 'fleet_size header is missing.';
                        $aheadeError[]['fleet_size'] = $head_err;
                    }


                    if (count($aheadeError)) {
                        return redirect()->back()->withErrors($aheadeError);
                    }
                    if (isset($excel_data) && !empty($excel_data)) {
                        $data = array_filter($data, 'array_filter');
                        // dd($data);
                        $fleet_details = [];

                        $i = 0;
                        foreach ($data as $temp_key => $temp_value) {

                            if($i > 0){
                            // dd$temp_value[1]));
                            $organisation_id = isset($temp_value[0]) ? $temp_value[0] : '0';
                            $mega_discription = isset($temp_value[1]) ? $temp_value[1] : '';

                            $brand_id = isset($temp_value[2]) ? $temp_value[2] : '0';
                            // $brand_id = VehicleBrand::select('id')->where('brand_name', '=', $brand_name)->first();

                            $is_reserved = isset($temp_value[4]) ? $temp_value[4] : '0';
                            $features = isset($temp_value[5]) ? $temp_value[5] : '0';
                        //         // dd($is_reserved);
                        //     $features = array();
                        //     if($temp_value[5]){
                        //         $features_names = explode(',',$temp_value[5]);
                        //     }

                        //     if($features_names){
                        //         foreach($features_names as $features_name){
                        //                 $features1 = Features::select('id')->where('feature_name', '=', $features_name)->first();
                        //                 $features[] =$features1->id;
                        //             }
                        //     }
                        //    if(empty($features)){
                        //       $features[0] ='';
                        //    }

                           $finalimage=array();


                           if($temp_value[30]){
                            $url = explode(',',$temp_value[30]);
                           }
                           if($url){
                               foreach($url as $image){
                                   $info = pathinfo($image);
                                   $contents = file_get_contents($image);
                                   $filess = "images/fleet_images/" . $info['basename'];
                                   file_put_contents($filess, $contents);
                                   $finalimage[]=$info['basename'];
                               }
                           }
                          if(empty($finalimage)){
                             $finalimage[0]='';
                          }

                            $booking_conditions = isset($temp_value[6]) ? $temp_value[6] : '';
                            $insurance_provider = isset($temp_value[7]) ? $temp_value[7] : '';
                            $type = isset($temp_value[11]) ? $temp_value[11] : '1';
                            $car_SKU = isset($temp_value[19]) ? $temp_value[19] : '0';
                            $insurance_Expire_date = isset($temp_value[29]) ? $temp_value[29] : '';
                            $model_id = isset($temp_value[18]) ? $temp_value[18] : '0';
                            $email = isset($temp_value[3]) ? $temp_value[3] : '';
                            $documents = isset($temp_value[8]) ? $temp_value[8] : '';
                            $documents2 = isset($temp_value[9]) ? $temp_value[9] : '';
                            $documents3 = isset($temp_value[10]) ? $temp_value[10] : '';
                            $car_year = isset($temp_value[12]) ? $temp_value[12] : '';
                            $car_service_type = isset($temp_value[13]) ? $temp_value[13] : '';
                            $car_color = isset($temp_value[14]) ? $temp_value[14] : '';
                            $car_number = isset($temp_value[15]) ? $temp_value[15] : '';
                            $car_chasis_number = isset($temp_value[16]) ? $temp_value[16] : '';
                            $fleet_size = isset($temp_value[17]) ? $temp_value[17] : '';
                            $allowed_distance = isset($temp_value[20]) ? $temp_value[20] : '';
                            $unit = isset($temp_value[21]) ? $temp_value[21] : '';
                            $child_seat = isset($temp_value[22]) ? $temp_value[22] : '';
                            $insurence = isset($temp_value[23]) ? $temp_value[23] : '';
                            $additional_distance = isset($temp_value[24]) ? $temp_value[24] : '';
                            $owner_name = isset($temp_value[26]) ? $temp_value[26] : '';
                            $phone = isset($temp_value[26]) ? $temp_value[26] : '';
                            $billing_email = isset($temp_value[27]) ? $temp_value[27] : '';

                            // $errorMsg = $this->checkEmptyValueValidation($mega_discription, $brand_id,$features, $booking_conditions, $documents3, $is_reserved,$fleet_size,$insurance_provider,$car_year,$car_SKU, $insurance_Expire_date,$documents, $documents2,$car_service_type, $car_color,$car_chasis_number);

                            $emailError = $this->checkEmailUniqValidation($email);
                            // if (count($errorMsg)) {
                            //     return redirect()->back()->withErrors($errorMsg);
                            // }
                            if (count($emailError)) {
                                return redirect()->back()->withErrors($emailError);
                            }


                            $fleet                           = new Fleet;
                            $fleet->brand_id                 = $brand_id;
                            $fleet->model_id                 = $model_id;
                            $fleet->mega_discription         = $mega_discription;
                            $fleet->booking_conditions       = $booking_conditions;
                            $fleet->insurance_provider       = $insurance_provider;
                            $fleet->insurance_Expire_date    = $insurance_Expire_date;
                            $fleet->type                     = $type;
                            $fleet->fleet_size               = $fleet_size;
                            $fleet->car_SKU                  = $car_SKU;
                            $fleet->car_year                 = $car_year;
                            $fleet->car_service_type         = $car_service_type;
                            $fleet->car_color                = $car_color;
                            $fleet->car_number               = $car_number;
                            $fleet->car_chasis_number        = $car_chasis_number;
                            $fleet->allowed_distance         = $allowed_distance;
                            $fleet->unit                     = $unit;
                            $fleet->child_seat               = $child_seat;
                            $fleet->insurence                = $insurence;
                            $fleet->additional_distance      = $additional_distance;
                            $fleet->owner_name               = $owner_name;
                            $fleet->is_reserved              = $is_reserved;
                            $fleet->phone                    = $phone;
                            $fleet->email                    = $email;
                            $fleet->billing_email            = $billing_email;
                            $fleet->features                 = $features;
                            $fleet->documents                = $documents;
                            $fleet->documents2               = $documents2;
                            $fleet->documents3               = $documents3;
                            // $fleet->documents4               = $documents4;
                            $fleet->image                    = $info['basename'];
                            // $fleet->status                   = $status;

                            $fleet->organisation_id          =$organisation_id;
                                // dd($fleet) ;
                                           $fleet->save();

                            // $fleet_details[] = [
                            //     'organisation_id' => $organisation_id,
                            //     'mega_discription' => $mega_discription,
                            //     'brand_id' => $brand_id,
                            //     'is_reserved' => $is_reserved,
                            //     'features' => $features,
                            //     'booking_conditions' => $booking_conditions,
                            //     'insurance_provider' => $insurance_provider,
                            //     'documents3' => $documents3,
                            //     'type' => $type,
                            //     'car_SKU' => $car_SKU,
                            //     'insurance_Expire_date' => $insurance_Expire_date,
                            //     'model_id' => $model_id,
                            //     'email' => $email,
                            //     'documents' =>$documents,
                            //     'documents2' => $documents2,
                            //     'car_year' => $car_year,
                            //     'car_service_type' => $car_service_type,
                            //     'car_color' => $car_color,
                            //     'car_number' => $car_number,
                            //     'car_chasis_number' => $car_chasis_number,
                            //     'fleet_size' => $fleet_size,
                            //     'allowed_distance' => $allowed_distance,
                            //     'unit' => $unit,
                            //     'additional_distance' => $additional_distance,
                            //     'insurence' => $insurence,
                            //     'child_seat' => $child_seat,
                            //     'owner_name' => $owner_name,
                            //     'phone' => $phone,
                            //     'billing_email' => $billing_email,

                            // ];
                        }
                            $i++;
                        }


                        // dd($fleet_details);
                        $emailDuplicate = $this->checkEmailDuplicate($fleet_details);
                        if (count($emailDuplicate)) {
                            return redirect()->back()->withErrors($emailDuplicate);
                        }
                        // foreach ($fleet_details as $details) {

                        //     $fleet = Fleet::create([
                        //         'email' =>   $details['email'],
                        //         'organisation_id' => getUser()->organisation_id,
                        //         'mega_discription' =>   $details['mega_discription'],
                        //         'brand_id' =>   $details['brand_id'],
                        //         'is_reserved'  =>  $details['is_reserved'],
                        //         'features' =>  $details['features'],
                        //         'booking_conditions'   =>  $details['booking_conditions'],
                        //         'insurance_provider' =>  $details['insurance_provider'],
                        //         'documents3' =>   $details['documents3'],
                        //         'type' =>  $details['type'],
                        //         'car_SKU' =>  $details['car_SKU'],
                        //         'insurance_Expire_date' =>   $details['insurance_Expire_date'],
                        //         'model_id' =>   $details['model_id'],
                        //         'documents' =>  $details['documents'],
                        //         'documents2'  =>   $details['documents2'],
                        //         'car_year' =>   $details['car_year'],
                        //         'car_service_type' =>   $details['car_service_type'],
                        //         'car_number'  =>  $details['car_number'],
                        //         'car_chasis_number'  =>  $details['car_chasis_number'],
                        //         'fleet_size'  =>   $details['fleet_size'],
                        //         'allowed_distance' => $details['allowed_distance'],
                        //         'unit' => $details['unit'],
                        //         'insurence' => $details['insurence'],
                        //         'child_seat' => $details['child_seat'],
                        //         'additional_distance' => $details['additional_distance'],
                        //         'owner_name' => $details['owner_name'],
                        //         'phone' => $details['phone'],
                        //         'billing_email' => $details['billing_email'],
                        //     ]);
                        // }

                        return redirect()->back()->with('success', __('Fleet Data Upload successfully!'));
                    }

                }
            } else {
                return redirect()->back()->withErrors(['error' => 'The upload file must be a file of type: csv, xls, xlsx.']);
            }
        }

    }

    public function checkEmptyValueValidation($mega_discription, $brand_id,$features, $booking_conditions,$insurance_provider, $documents3, $is_reserved,$fleet_size,$car_SKU, $insurance_Expire_date,$documents, $documents2,$car_service_type, $car_color,$car_year,$car_chasis_number)
    {
        $errorMsg = '';
        if ($mega_discription == "") {
            $errorMsg = ['mega_discription' => 'The Mega Discription column can not be empty.'];
            return $errorMsg;
        }
       else if ($brand_id == "") {
            $errorMsg = ['brand_id' => 'The Brand Id column can not be empty.'];
            return $errorMsg;
        }

        else if ($features == "") {
            $errorMsg = ['features' => 'The features column can not be empty.'];
            return $errorMsg;
        }
        else if ($booking_conditions == "") {
            $errorMsg = ['booking_conditions' => 'The booking_conditions column can not be empty.'];
            return $errorMsg;
        }
        else if ($insurance_provider == "") {
            $errorMsg = ['insurance_provider' => 'The insurance_provider column can not be empty.'];
            return $errorMsg;
        }
        else if ($documents3 == "") {
            $errorMsg = ['documents3' => 'The documents3 column can not be empty.'];
            return $errorMsg;
        }

        else if ($fleet_size == "") {
            $errorMsg = ['fleet_size' => 'The fleet_size column can not be empty.'];
            return $errorMsg;
        }
        else if ($car_SKU == "") {
            $errorMsg = ['car_SKU' => 'The car_SKU column can not be empty.'];
            return $errorMsg;
        }
        else if ($insurance_Expire_date == "") {
            $errorMsg = ['insurance_Expire_date' => 'The insurance_Expire_date column can not be empty.'];
            return $errorMsg;
        }
        else if ($documents == "") {
            $errorMsg = ['documents' => 'The documents column can not be empty.'];
            return $errorMsg;
        }
        else if ($documents2 == "") {
            $errorMsg = ['documents2' => 'The documents2 column can not be empty.'];
            return $errorMsg;
        }
        else if ($car_service_type == "") {
            $errorMsg = ['car_service_type' => 'The car_service_type column can not be empty.'];
            return $errorMsg;
        }
        else if ($car_color == "") {
            $errorMsg = ['car_color' => 'The car_color column can not be empty.'];
            return $errorMsg;
        }
        else if ($car_year == "") {
            $errorMsg = ['car_color' => 'The car_year column can not be empty.'];
            return $errorMsg;
        }
        else if ($car_chasis_number == "") {
            $errorMsg = ['car_chasis_number' => 'The car_chasis_number column can not be empty.'];
            return $errorMsg;
        }

        else {
            return $errorMsg = [];
        }

    }

    // check email in customers table
    public function checkEmailUniqValidation($email)
    {
        $errorMsg = '';
        $fleet = Fleet::where('email', $email)->first();
        if ($fleet) {
            $errorMsg = ['email' => 'Email already exist!'];
            return $errorMsg;
        } else {
            return $errorMsg = [];
        }
    }

    // check duplicate email in excel data
    public function checkEmailDuplicate($fleet_details)
    {
        $errorMsg = '';
        $data = array_intersect_key(
            $fleet_details,
            array_unique(array_column($fleet_details, 'email'))
        );
        if (count($fleet_details) != count($data)) {
            $errorMsg = ['email' => 'The email must be unique.'];
            return $errorMsg;
        } else {
            return $errorMsg = [];
        }
    }


     //Updated on 02/01/2023 
     
     public function profile(Request $request)
    {
        $id = getUser()->organisation_id;

        $bank =  CompanyBank::find($id);
        $dns = CompanyKYC::select(
            'created_at',
            'updated_at',
            'ow_document1',
            'ow_document2',
            'ow_document3',
            'ow_document4',
            'bu_document1',
            'bu_document2',
            'bu_document3',
            'bu_document4',
            'bu_document5',
            'ot_document1',
            'ot_document2',
            'ot_document3',
            'ot_document4'
        )->where('organisation_id', '=', $id)->get();


        return view('profile.view')->with(compact('bank', 'bank'))->with(compact('dns', 'dns'));
    }



    public function docs_post(Request $request)
    {

        $id = getUser()->organisation_id;
        //Owner documents
        if ($request->hasFile('own_doc1')) {
            dd($request->all());
            $owner_document_name1 = $request->file('own_doc1')->getClientOriginalName();
            $owner_document_type1 = $request->input('ow_document_type1');
            $file = $request->file('own_doc1');
            $file->move(public_path('/company/docs'), $owner_document_name1);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('ow_document1' => $owner_document_name1, 'ow_doc_type1' => $owner_document_type1));
        }

        if ($request->hasFile('own_doc2')) {
            $owner_document_name2 = $request->file('own_doc2')->getClientOriginalName();
            $owner_document_type2 = $request->input('ow_document_type2');
            $file = $request->file('own_doc2');
            $file->move(public_path('/company/docs'), $owner_document_name2);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('ow_document2' => $owner_document_name2, 'ow_doc_type2' => $owner_document_type2));
        }
        if ($request->hasFile('own_doc3')) {
            $owner_document_name3 = $request->file('own_doc3')->getClientOriginalName();
            $owner_document_type3 = $request->input('ow_document_type3');
            $file = $request->file('own_doc3');
            $file->move(public_path('/company/docs'), $owner_document_name3);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('ow_document3' => $owner_document_name3, 'ow_doc_type3' => $owner_document_type3));
        }
        if ($request->hasFile('own_doc4')) {
            $owner_document_name4 = $request->file('own_doc4')->getClientOriginalName();
            $owner_document_type4 = $request->input('ow_document_type4');
            $file = $request->file('own_doc4');
            $file->move(public_path('/company/docs'), $owner_document_name4);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('ow_document4' => $owner_document_name4, 'ow_doc_type4' => $owner_document_type4));
        }

        //Owner Documents End

        //Business Documents
        if ($request->hasFile('bu_doc1')) {
            $owner_document_name1 = $request->file('bu_doc1')->getClientOriginalName();
            $file = $request->file('bu_doc1');
            $file->move(public_path('/company/docs'), $owner_document_name1);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('bu_document1' => $owner_document_name1));
        }


        if ($request->hasFile('bu_doc2')) {
            $owner_document_name2 = $request->file('bu_doc2')->getClientOriginalName();
            $file = $request->file('bu_doc2');
            $file->move(public_path('/company/docs'), $owner_document_name2);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('bu_document2' => $owner_document_name2));
        }
        if ($request->hasFile('bu_doc3')) {
            $owner_document_name3 = $request->file('bu_doc3')->getClientOriginalName();
            $file = $request->file('bu_doc3');
            $file->move(public_path('/company/docs'), $owner_document_name3);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('bu_document3' => $owner_document_name3));
        }
        if ($request->hasFile('bu_doc4')) {
            $owner_document_name4 = $request->file('bu_doc4')->getClientOriginalName();
            $file = $request->file('bu_doc4');
            $file->move(public_path('/company/docs'), $owner_document_name4);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('bu_document4' => $owner_document_name4));
        }

        if ($request->hasFile('bu_doc5')) {
            $owner_document_name4 = $request->file('bu_doc5')->getClientOriginalName();
            $file = $request->file('bu_doc5');
            $file->move(public_path('/company/docs'), $owner_document_name4);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('bu_document5' => $owner_document_name4));
        }

        //Business Documents End
        //Other Documents
        if ($request->hasFile('other_doc1')) {
            $owner_document_name1 = $request->file('other_doc1')->getClientOriginalName();
            $file = $request->file('other_doc1');
            $file->move(public_path('/company/docs'), $owner_document_name1);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('other_document1' => $owner_document_name1));
        }


        if ($request->hasFile('other_doc2')) {
            $owner_document_name2 = $request->file('other_doc2')->getClientOriginalName();
            $file = $request->file('other_doc2');
            $file->move(public_path('/company/docs'), $owner_document_name2);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('other_document2' => $owner_document_name2));
        }
        if ($request->hasFile('other_doc3')) {
            $owner_document_name3 = $request->file('other_doc3')->getClientOriginalName();
            $file = $request->file('other_doc3');
            $file->move(public_path('/company/docs'), $owner_document_name3);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('other_document3' => $owner_document_name3));
        }
        if ($request->hasFile('other_doc4')) {
            $owner_document_name4 = $request->file('other_doc4')->getClientOriginalName();
            $file = $request->file('other_doc4');
            $file->move(public_path('/company/docs'), $owner_document_name4);
            DB::table('company_k_y_c_s')->where('organisation_id', '=', $id)->update(array('other_document4' => $owner_document_name4));
        }



        return redirect()->route('profile');
    }

    public function docs()
    {
        return view('profile.docs');
    }

     //Updated on 02/01/2023 --End






}
