<?php


namespace App\Http\Controllers\AdminControllers;
use App\Models\FleetVisibility;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FleetVisibilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fleetApp()
    {
        return view('marketing.fleetlist');
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
     * @param  \App\Models\FleetVisibility  $fleetVisibility
     * @return \Illuminate\Http\Response
     */
    public function show(FleetVisibility $fleetVisibility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FleetVisibility  $fleetVisibility
     * @return \Illuminate\Http\Response
     */
    public function edit(FleetVisibility $fleetVisibility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FleetVisibility  $fleetVisibility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FleetVisibility $fleetVisibility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FleetVisibility  $fleetVisibility
     * @return \Illuminate\Http\Response
     */
    public function destroy(FleetVisibility $fleetVisibility)
    {
        //
    }
}
