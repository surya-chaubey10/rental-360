<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\AudienceSubscribers;
use App\Models\User;
use App\Models\Country;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Http\Request; 

class AudienceSegmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function segmentApp()
    {
        return view('audience.segments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createApp()
    {
        return view('audience.create-segments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AudienceSegments  $audienceSegments
     * @return \Illuminate\Http\Response
     */
    public function show(AudienceSegments $audienceSegments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AudienceSegments  $audienceSegments
     * @return \Illuminate\Http\Response
     */
    public function edit(AudienceSegments $audienceSegments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AudienceSegments  $audienceSegments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudienceSegments $audienceSegments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AudienceSegments  $audienceSegments
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudienceSegments $audienceSegments)
    {
        //
    }
}
