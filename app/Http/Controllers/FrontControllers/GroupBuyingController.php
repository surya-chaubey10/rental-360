<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\GroupBuyingModel;
use App\Models\User;
use App\Models\Country;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Http\Request; 
class GroupBuyingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('offer.group.group-buying');   
        // return view('offer.group.preview-invoice');   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receipt()
    {
        return view('offer.group.manage-booking-receipt'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('offer.group.preview-invoice');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupBuying  $groupBuying
     * @return \Illuminate\Http\Response
     */
    public function show(GroupBuying $groupBuying)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupBuying  $groupBuying
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupBuying $groupBuying)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupBuying  $groupBuying
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupBuying $groupBuying)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupBuying  $groupBuying
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupBuying $groupBuying)
    {
        //
    }
}
