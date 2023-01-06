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
      <h4 class="card-title"><b>Transfers Details</b></h4>
       
        <a href="" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" > <i data-feather='printer'></i>Print</a>
    </div> 
 <div class="row">
   
 <div class="col-md-4" style="margin:4px 0 0 22px;">
       <h1 class="text-danger">MYRIDE</h1>
       <p><b>Ultimate Sales,Inventory,Accounting Management System</b></p>
       <p><b>Phone:</b>017000000</p>
       <p><b>Email:</b>support@codeshape.net</p>
       <p><b>Address:</b>Ground Floor,Road#24,House#339,New DOHS,Mohakhali,Dhaka-1206,Bangladesh</p>
      
    </div>
    
    <div class="col-md-4" style="margin: 4px 0 0 381px;">
     <h1 class="text-black">Transfers Details</h>
       <table style="font-size:15px; margin: 24px 0 0 3px;">
        <tbody >
          <tr style="margin: 30px 0 0 114px;">
          <th  scope="row">Date</th> 
          <td ><span style="margin: 30px 0 0 114px;">12/09/2022</span></td>
        </tr>
        <tr>
          <th  scope="row">Created By</th> 
          <td><span style="margin: 30px 0 0 114px;">Super Admin</span></td>
        </tr>
        <tbody>
       </table>
    </div>

    <div class="card-datatable table-responsive pt-0">
      <table class=" table">
        <thead class="table-light">
          <tr>
             <th>Reason</th>
             <th>FROM ACCOUNT</th>
             <th>TO ACCOUNT</th>
             <th>AMOUNT</th>
             <th>DATE</th>
             <th>STATUS</th>
             <th>Created By</th>
          </tr>
        </thead>
        <tbody>
        <tr>
             <td>Regular Transfer</td>
             <td>Cash[CASH-0001]</td>
             <td>Dutch Bangla Bank[DBBL-0003]</td>
             <td>$10000</td>
             <td>14th jul,2022</td>
             <td class="text-success">Active</td>
             <td>Super Admin</td>
          </tr>
</tbody>
      </table>
       </div>

       <section>
     <div class="row">
      <div class="card-body col-md-2">
     
        <a href="" class="btn btn-secondary waves-effect" style="float: right;" >Go Back</a>
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
 <script src="{{ asset('js/scripts/pages/balance-transfer-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
