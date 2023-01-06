<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\ExpenseSubCategory;
use Illuminate\Http\Request;

class ExpenseSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.expenses.expense_sub_category.list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.expenses.expense_sub_category.create');

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
     * @param  \App\Models\ExpenseSubCategory  $expenseSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseSubCategory $expenseSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseSubCategory  $expenseSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseSubCategory $expenseSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseSubCategory  $expenseSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseSubCategory $expenseSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseSubCategory  $expenseSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseSubCategory $expenseSubCategory)
    {
        //
    }
}
