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
<section class="app-vendor-list">
   
  <!-- list and filter start -->
  <div class="card">
  <div class="card-body border-bottom">
     <div class="card-header"> 
      <h4 ><b> Vendor Visibility</b></h4>
       <a href="#" class="btn btn-danger" >Create</a> 
    </div>
    </div>
    <div class="btn-group " style="margin:0 0 0 78%;">
  <div style="color:red; text-decoration:underline;font-weight:bold;">Today</div>&nbsp&nbsp&nbsp
  <div>1D</div>&nbsp&nbsp
  <div>1W</div>&nbsp&nbsp&nbsp&nbsp
  <div>1M</div>&nbsp&nbsp&nbsp&nbsp
  <div>3M</div>&nbsp&nbsp&nbsp&nbsp
  <div>1Y</div>&nbsp&nbsp
  <div>MTD</div>&nbsp&nbsp

</div>
    <div class="card-datatable table-responsive pt-0">
      <table class="invoice-list-table table">
        <thead>
          <tr>
            <th></th>
            <th>#</th>
            <th>company</th>
            <th>booking</th>
            <th>payment</th>
            <th>revenue</th>
            <th>trand<i data-feather="trending-up"></i></th>
          
           
          </tr>
        </thead>
      </table>
    </div>
  </div> 
</section> 
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<!-- <script src="{{asset('vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script> -->
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/vendor-visibility.js')}}"></script>
@endsection
