<?php

namespace App\Http\Controllers\FrontControllers;  
use App\Http\Controllers\Controller;

use App\Models\EmployeePayroll;
use Illuminate\Http\Request;

class EmployeePayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payroll.list');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payroll.add');   
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
     * @param  \App\Models\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeePayroll $employeePayroll)
    {
       
        return view('payroll.show');   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
     return view('payroll.edit');     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeePayroll $employeePayroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeePayroll $employeePayroll)
    {
        //
    }
}
