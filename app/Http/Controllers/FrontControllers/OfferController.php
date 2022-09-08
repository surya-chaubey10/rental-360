<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Vehicle;
use App\Models\OfferCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Storage;


class OfferController extends Controller
{
    public function index(){

        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/offer/offer-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_offer-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_offer-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_offer-list.json')) {
            $user = $this->jsonOfferList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_offer-list.json', collect($data));
        }

        return view('contact.offer.list',['pageConfigs' => $pageConfigs]); 
    }
    private function jsonOfferList()
    {
        return  Offer::select('offers.id','offers.uuid','offers.offer_category_id','offers.vehicle_id','offers.startdate','offers.enddate','offers.status','vehicles.vehicle_name','offer_categories.category_name')
            ->join('offer_categories as offer_categories', function ($join) {
                $join->on('offer_categories.id', '=', 'offers.offer_category_id');
            })
            ->leftjoin('vehicles as vehicles', function ($join) {
                $join->on('vehicles.id', '=', 'offers.vehicle_id');
            })
             ->withoutGlobalScope('organisation_id')
            ->where('offers.organisation_id', getUser()->organisation_id)
            ->get();
         
    }
    public function add()
    { 
        $offercategory = OfferCategory::select('id', 'category_name')->get();
        $vehicle = Vehicle::select('id', 'vehicle_name')->get();

        return view('contact.offer.add', compact('offercategory','vehicle')); 
   } 
   public function store(Request $request)
    {
        $path = public_path('../public/images/offer_images/');
        if (! file_exists($path) ) {
            mkdir($path, 0777, true);
         }

        $file = $request->file('image_path');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);
       
        DB::beginTransaction();
        try {
            $offer = new Offer;
            $offer->offer_category_id      = $request->offer_category;
            $offer->vehicle_id             = $request->vehicle;
            $offer->offer_image            = $fileName;
            $offer->startdate              = $request->startdate;
            $offer->enddate                = $request->enddate;
            $offer->starttime              = $request->starttime;
            $offer->endtime                = $request->endtime;
            $offer->discount_type          = $request->discount_type;
            $offer->minimum_value          = $request->minimum;
            $offer->maximum_value          = $request->maximum;
            $offer->status                 = $request->status;
            $offer->save();

            DB::commit();
            return ajax_response(true, $offer, [], "Offer Saved Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
        
    }
    public function update(Request $request)
    {
    
        $path = public_path('../public/images/offer_images/');
        if (! file_exists($path) ) {
            mkdir($path, 0777, true);
         }

        $file = $request->file('image_path');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);
       
        DB::beginTransaction();
        try {
            $offer = Offer::find($request->offer_updated_id);
           
            $offer->offer_category_id      = $request->offer_category;
            $offer->vehicle_id             = $request->vehicle;
            $offer->offer_image            = $fileName;
            $offer->startdate              = $request->startdate;
            $offer->enddate                = $request->enddate;
            $offer->starttime              = $request->starttime;
            $offer->endtime                = $request->endtime;
            $offer->discount_type          = $request->discount_type;
            $offer->minimum_value          = $request->minimum;
            $offer->maximum_value          = $request->maximum;
            $offer->status                 = $request->status;
           
            $offer->save();

            DB::commit();
            return ajax_response(true, $offer, [], "Offer Update Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
        
    }
    public function delete($uuid)
    {
        $offer = Offer::where('uuid', $uuid)->first();

        if (is_object($offer)) {
            $offer->delete();
        }
        return ajax_response(true, [], [], "Offer Deleted Successfully", $this->success);
    }
    public function edit($uuid)
    {
        $offer = Offer::with('offercategory', 'vehicle')->where('offers.uuid', $uuid)->first();
        $offercategory = OfferCategory::select('id', 'category_name')->get();
        $vehicle = Vehicle::select('id', 'vehicle_name')->get();

        return view('contact.offer.edit', compact('offercategory', 'vehicle', 'offer'));
    }
    public function copy($uuid)
    {
        $offer = Offer::with('offercategory', 'vehicle')->where('offers.uuid', $uuid)->first();
        $offercategory = OfferCategory::select('id', 'category_name')->get();
        $vehicle = Vehicle::select('id', 'vehicle_name')->get();

        return view('contact.offer.copy', compact('offercategory', 'vehicle', 'offer'));
    }
}
