<?php


namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\MyList;
use App\Models\OfferCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Storage;

class MyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Mylist()
    {

            return view('audience.mylist');
       
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
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function show(MyList $myList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function edit(MyList $myList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyList $myList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyList $myList)
    {
        //
    }
}
