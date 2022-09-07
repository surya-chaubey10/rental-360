<?php
namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;

use App\Models\ManageBookings;
use Illuminate\Http\Request;

class ManageBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //  dd('hii');
     return view('booking.managebooking.list');    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.managebooking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
         try{
                $user = new ManageBookings;
                $user->fullname      = $request->fullname;
                $user->username      = $request->username;
                $user->email         = $request->email;
                $user->mobile        = $request->contact;
                $user->api_token = \Str::random(35);
                $user->password      = \Hash::make('123456');
                $user->country_id       = $request->country;
                $user->save();
                
                $vendor = new VendorModel;
                $vendor->company       = $request->company;
                $vendor->customer_type = $request->customer_type;
                $vendor->user_id = $user->id;
                $vendor->save();

            DB::commit();
            return ajax_response(true, $vendor, [], "Vendor Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[], [], $message , $this->internal_server_error);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function show(ManageBookings $manageBookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageBookings $manageBookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageBookings $manageBookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageBookings $manageBookings)
    {
        //
    }
}
