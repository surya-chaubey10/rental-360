<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferPackages;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Storage;

class OfferPackagesController extends Controller
{
    public function index(){

        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/offer/offer_packages-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_offer_package-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_offer_package-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_offer_package-list.json')) {
            $user = $this->jsonOfferPackagesList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_offer_package-list.json', collect($data));
        }

        return view('contact.offerpackages.list',['pageConfigs' => $pageConfigs]); 
    }
    private function jsonOfferPackagesList()
    {
        return  OfferPackages::select('offer_packages.id','offer_packages.uuid','offer_packages.package_name','offer_packages.package_price','offer_packages.days_limit','offer_packages.created_at','offer_packages.status')
             ->withoutGlobalScope('organisation_id')
            ->where('offer_packages.organisation_id', getUser()->organisation_id)
            ->get();
         
    }
    
}
