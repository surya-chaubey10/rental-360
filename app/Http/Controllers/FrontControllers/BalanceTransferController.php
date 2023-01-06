<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;

use App\Models\BalanceTransfer;
use Illuminate\Http\Request;

class BalanceTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.cash_book.balancetransfer.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.cash_book.balancetransfer.create');
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
     * @param  \App\Models\BalanceTransfer  $balanceTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(BalanceTransfer $balanceTransfer)
    {
        return view('accounts.cash_book.balancetransfer.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BalanceTransfer  $balanceTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(BalanceTransfer $balanceTransfer)
    {
        return view('accounts.cash_book.balancetransfer.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BalanceTransfer  $balanceTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BalanceTransfer $balanceTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BalanceTransfer  $balanceTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(BalanceTransfer $balanceTransfer)
    {
        //
    }
}
