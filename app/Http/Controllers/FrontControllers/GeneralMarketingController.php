<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;

use App\Models\GeneralMarketing;
use Illuminate\Http\Request;

class GeneralMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.Marketing.GeneralMarketing.create');   
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\GeneralMarketing  $generalMarketing
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralMarketing $generalMarketing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneralMarketing  $generalMarketing
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralMarketing $generalMarketing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralMarketing  $generalMarketing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralMarketing $generalMarketing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralMarketing  $generalMarketing
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralMarketing $generalMarketing)
    {
        //
    }
}
