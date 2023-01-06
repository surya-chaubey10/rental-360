@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">  
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')

<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
      <h4 class="card-title"><b>Account Transactions</b></h4>
       
        <a href="" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" > <i data-feather='printer'></i> Print</a>
    </div> 
    <div class="card">
    <div class="card-body">
   <div class="row">
   
    <div class="col-md-4">
       <h1 class="text-danger">MYRIDE</h1>
       <p><b>Ultimate Sales,Inventory,Accounting Management System</b></p>
       <p><b>Phone:</b>017000000</p>
       <p><b>Email:</b>support@codeshape.net</p>
       <p><b>Address:</b>Ground Floor,Road#24,House#339,New DOHS,Mohakhali,Dhaka-1206,Bangladesh</p>
      
    </div>
    
    <div class="col-md-4" style="margin: 4px 0 0 381px;">
     <h1 class="text-black">Account Details</h>
       <table style="font-size:15px; margin: 24px 0 0 3px;">
        <tbody >
          <tr style="margin: 30px 0 0 114px;">
          <th  scope="row">Bank Name</th> 
          <td ><span style="margin: 30px 0 0 114px;">Cash</span></td>
        </tr>
        <tr>
          <th  scope="row">Branch Name</th> 
          <td><span style="margin: 30px 0 0 114px;">Office</span></td>
        </tr>
        <tr>
          <th  scope="row">Account Number</th> 
          <td><span style="margin: 30px 0 0 114px;">CASH-0001</span></td>
        </tr>
        <tr>
          <th  scope="row">Created At</th> 
          <td><span style="margin: 30px 0 0 114px;">30th apr,2022</span></td>
        </tr>
        <tbody>
       </table>
    </div>
    </div>
    </div>

    <div class="card">
      <div class="card-body">
   <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card" style="background-color:#f39d00b3;">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75 text-white">10</h3>
            <span class="text-white">Total Transactions</span>
          </div>
           
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card" style="background-color:#6610f2;">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75 text-white">$143610.00</h3>
            <span class="text-white">Creadit Amount</span>
          </div>
         
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card" style="background-color:#ea5455;">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75 text-white">$76963.50</h3>
            <span class="text-white">Debit Amount</span>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card" style="background-color:#28c76f;">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75 text-white">$66646.50</h3>
            <span class="text-white">Available Balance</span>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  </div>
   </div>

   <div class="card">
      <div class="card-body">
    <div class="card-datatable table-responsive pt-0">
      <table class=" accounts-view-list table">
        <thead class="table-light">
          <tr>
             <th>#</th>
             <th>Reason</th>
             <th>Date</th>
             <th>Type</th>
             <th>AMOUNT</th>
             <th>STATUS</th>
             <th>Created By</th>
          </tr>
        </thead>
        </table>
       </div>
       </div>
       </div>

       <section>
     <div class="row">
      <div class="card-body col-md-2">
     
        <a href="{{route('account-list')}}" class="btn btn-secondary waves-effect" style="float: right;" >Go Back</a>
      </div> 
    </div> 
</section>

    </div>
  <!-- list and filter end -->
</section>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  
@endsection

@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/accounts-view-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
