<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;

use App\Models\BalanceAdjustment;
use Illuminate\Http\Request;

class BalanceAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.cash_book.balanceadjustment.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.cash_book.balanceadjustment.create');
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
     * @param  \App\Models\BalanceAdjustment  $balanceAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(BalanceAdjustment $balanceAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BalanceAdjustment  $balanceAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(BalanceAdjustment $balanceAdjustment)
    {
        return view('accounts.cash_book.balanceadjustment.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BalanceAdjustment  $balanceAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BalanceAdjustment $balanceAdjustment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BalanceAdjustment  $balanceAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BalanceAdjustment $balanceAdjustment)
    {
        //
    }
}
