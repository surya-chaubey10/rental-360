<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use App\Models\SuperAdminDashboard;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('sdkdksjgfhj');
        return view('dashboard.dashboard');   

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
     * @param  \App\Models\SuperAdminDashboard  $superAdminDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(SuperAdminDashboard $superAdminDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuperAdminDashboard  $superAdminDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperAdminDashboard $superAdminDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuperAdminDashboard  $superAdminDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperAdminDashboard $superAdminDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuperAdminDashboard  $superAdminDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperAdminDashboard $superAdminDashboard)
    {
        //
    }
}
