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

<style>
.div-display{
	display: flex;
    justify-content: space-between;	
}
.margin-custom{
	margin-right: 2rem;
	margin-top: 1.1rem;
}
</style>

<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">

    <div class="card-body border-bottom mb-1">
      <h4 class="card-title"><b>Booking</b></h4>
		<a href="{{route('add-booking')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px; margin-right: 2rem;" >Create</a>
		
        <ul class="nav nav-pills mb-3" style=" margin-left: 1rem; " id="pills-tab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Active</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Finished</button>
            </li>

        </ul>

        <!-- <div class="demo-inline-spacing">



            <div class=" col-xl-2 col-md-4 col-2 col-sm-4">
                    <select class="form-select " id="typeInput">
                    <option>All Time</option>
                    <option>Today</option>
                    <option>Yesterday</option>
                    <option>Befor yesterday</option>
                    </select>
            </div> -->

            <!-- <div class="col-xl-2 col-md-4 col-12 col-sm-6">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search Here">
                </div>
            </div> -->

            <!-- <div class="col-xl-2 col-md-4 col-12 col-sm-6">
                <div class="input-group">
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Booking#
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Booking Type</a>
                    <a class="dropdown-item" href="#">Merchant</a>
                    <a class="dropdown-item" href="#">Vehicle</a>
                  </div>
                </div> -->
            <!-- </div>
            <div class="col-xl-2 col-md-4 col-12 col-sm-6">
                <input type="date" class="form-control" id="dateTo" placeholder="From Date">
            </div>

            <div class="col-xl-2 col-md-4 col-12 col-sm-6">
                <input type="date" class="form-control" id="dateTo" placeholder="To Date">
            </div> -->

<!-- 
            <div >
                <a href="" class="btn text-danger"><b>X Clear Filter</b></a>
            </div> -->



        </div><!-- demo-inline-spacing-end -->

    <!-- </div>card-body-end -->

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            
        <div class="card-datatable table-responsive pt-0">
            <table class="booking-list-table table">
                <thead class="table-light">
                <tr>
                    
                    <th></th>
                    <th>BOOKING#</th>
                    <th>MERCHANT</th>
                    <th>STATUS</th>
                    <th>VEHICLE</th>
                    <th>PICKUP/DROP OFF</th>
                    <th>AIRPORT PICKUP</th>
                    <th>AMOUNT</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


        <div class="card-datatable table-responsive pt-0">
            <table class="booking-list-finish table">
                <thead class="table-light">
                <tr>
                     <th></th>
                    <th>BOOKING#</th>
                    <th>MERCHANT</th>
                    <th>STATUS</th>
                    <th>VEHICLE</th>
                    <th>PICKUP/DROP OFF</th>
                    <th>AIRPORT PICKUP</th>
                    <th>AMOUNT</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>


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
 <script src="{{ asset('js/scripts/pages/app-booking.js') }}"></script> 
 <script src="{{ asset('js/scripts/pages/app-booking-finish.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
