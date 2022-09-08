<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
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
        return  Offer::select('offers.id','offers.uuid','offers.offer_category_id','offers.vehicle_id','offers.startdate','offers.enddate','offers.status')
             ->withoutGlobalScope('organisation_id')
            ->where('offers.organisation_id', getUser()->organisation_id)
            ->get();
         
    }
    public function add()
    { 
      return view('contact.offer.add');    
   } 
}
