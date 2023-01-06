@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
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

    <div class="card-body border-bottom mb-1">
        <h4 class="card-title"><b>Purchase Payments</b></h4>
        <div style="float:right; margin: -85px 130px; font-size: 74px;" > 
            <i data-feather='refresh-ccw'></i>
            <i data-feather='file'></i>
            <i data-feather='printer'></i>
        </div>
        <a href="{{route('supplier-add-purchase')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Create</a>


    </div><!-- card-body-end -->
            
            <div class="card-datatable table-responsive pt-0">
                <table class="supplier-purchase-list-table table">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Purchase No</th>
                        <th>Supplier</th>
                       
                        <th>Total</th>
                        <th>Paid Amount</th>
                        <th>Account</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                </table>
            </div>

        

    </div>



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
  <!-- <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script> -->
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> -->
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
 <script src="{{ asset('js/scripts/pages/supplier-purchase-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection