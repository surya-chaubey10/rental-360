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
class AudienceSubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function audienceApp()
    {
        return view('audience.subscribers');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribers1()
    {
        return view('audience.add-subscribers');
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
     * @param  \App\Models\AudienceSubscribers  $audienceSubscribers
     * @return \Illuminate\Http\Response
     */
    public function show(AudienceSubscribers $audienceSubscribers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AudienceSubscribers  $audienceSubscribers
     * @return \Illuminate\Http\Response
     */
    public function edit(AudienceSubscribers $audienceSubscribers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AudienceSubscribers  $audienceSubscribers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudienceSubscribers $audienceSubscribers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AudienceSubscribers  $audienceSubscribers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudienceSubscribers $audienceSubscribers)
    {
        //
    }
}
