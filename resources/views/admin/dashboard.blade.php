@extends('layouts.main')
@section('title', 'Dashboard')
 

 

@section('vendor-style')  
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">

  <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">

  @endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
<!-- hi -->

<style>
thead, tbody, tfoot, tr, td, th{
	text-align: center !important;
}

.my-padding {
    padding: 0 3rem;
}
.my-maring-right{
	margin-right: 2rem;
}

h6.fw-bolder.mb-0 {
    display: inline-block;
}
.avatar .avatar-content .avatar-icon {
    height: 1.5rem !important;
    width: 1.5rem !important;
}

</style>

  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-4 col-md-12 col-sm-12">
      <div class="card card-congratulations">
        <div class="card-body text-center">
          <img
            src="{{asset('images/elements/decore-left.png')}}"
            class="congratulations-img-left"
            alt="card-img-left"
          />
          <img
            src="{{asset('images/elements/decore-right.png')}}"
            class="congratulations-img-right"
            alt="card-img-right"
          />
          <div class="avatar avatar-xl bg-primary shadow">
       <!--      <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div> -->
          </div>
          <div class="text-center">
            <h4 class="mb-1 text-white"style="margin-top: 14%">&nbsp;Welcome SuperAdmin</h4>
            <h6 class="mb-1 text-white">Here are marketing insights for the day</h6>

            
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->

    <div class="col-lg-8 col-md-6 col-12">
      <div class="card card-statistics">
		<div class="col-12">
        <div class="card-header" style="padding-left: 0.5rem;">
          <div>
            <h4 class="card-title" style="font-size: 17px;">Highlights</h4>
          </div>
              <div class="btn-group mt-md-0 mt-1 size" role="group" aria-label="Basic radio toggle button group" style="padding-right: 3rem;" id="myBtnContainer">

                <a class="btn1 active" for="radio_option1" onclick="filterSelection('Today')">Today</a>
                <a class="btn1" onclick="filterSelection('1D')" for="radio_option2">1D</a>  
                <a class="btn1" onclick="filterSelection('1W')" for="radio_option3">1W</a>
                <a class="btn1" onclick="filterSelection('1M')" for="radio_option3">1M</a>
                <a class="btn1" onclick="filterSelection('3M')" for="radio_option3">3M</a>
                <a class="btn1" onclick="filterSelection('6M')" for="radio_option3">6M</a>
                <a class="btn1" onclick="filterSelection('1Y')" for="radio_option3">1Y</a>
                <a class="btn1" onclick="filterSelection('MTD')" for="radio_option3">MTD</a>
                
              <!-- <div class="d-flex align-items-center" style="margin-left:23px;">
                <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
              </div> -->
            </div>
          </div>
		  </div>
        <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv Today" id="Today">
		
		 <div class="col-12 mt-2" style="margin-left: 1.4rem;">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::today())->count() }}</h4> <!-- {{number_format($sales,2)}} -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereDate('created_at', Carbon\Carbon::today())->count() }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereDate('created_at', Carbon\Carbon::today())->sum('debit')*10/100}}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereDate('created_at', Carbon\Carbon::today())->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
		  </div>
		  
        </div>
        <!--getchange=================================-->
        <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 1D" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::yesterday())->count(); }}</h4> <!-- {{number_format($sales,2)}} -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereDate('created_at', Carbon\Carbon::yesterday())->count() }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereDate('created_at', Carbon\Carbon::yesterday())->sum('debit')*10/100}} </h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereDate('created_at', Carbon\Carbon::today())->sum('debit')}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->

        <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 1W" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count(); }}</h4>
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">
                  {{ App\Models\GeneralLedger::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->

        <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 1M" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count(); }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->

        <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 3M" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count(); }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->
         <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 6M" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count(); }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->
         <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv 1Y" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereYear('created_at', now()->year)->count(); }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereYear('created_at', now()->year)->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereYear('created_at', now()->year)->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereYear('created_at', now()->year)->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->

         <!--getchange=================================-->
        <div class="card-body statistics-body filterDiv MTD" id="Today">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\ManageBookings::whereMonth('created_at', Carbon\Carbon::now()->month)->count(); }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Bookings</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\Transaction::whereMonth('created_at', Carbon\Carbon::now()->month)->count(); }}</h4> 
                <!-- {{number_format($customer)}}GeneralLedger.php -->
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payments</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereMonth('created_at', Carbon\Carbon::now()->month)->sum('debit')*10/100 }}
                  <!-- {{number_format($product)}} --></h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Revenue</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ App\Models\GeneralLedger::whereMonth('created_at', Carbon\Carbon::now()->month)->sum('debit') }}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Payout</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--getchange=================================-->

    <!--   </div> -->
    </div>
    </div>

    <!-- Orders Chart Card ends -->
  </div>

<!--=========================================top merchant==-->
<div class="row match-height">
    <div class="col-lg-7 col-12">
      <div class="card card-company-table">
        <div class="card-header" style="margin-left: 1rem; ">
           <div>
            <h4 class="card-title" style="font-size:17px;">Top Merchant</h4> 
         </div>
            <div class="btn-group mt-md-0 mt-1 size" role="group" aria-label="Basic radio toggle button group" id="myBtnContainerTop"  >
                <a class="btnTop active" onclick="filterSelectionTop('todayTop')"  for="radio_option1">Today</a>
                <a class="btnTop" onclick="filterSelectionTop('11D')" for="radio_option2">1D</a>  
                <a class="btnTop" onclick="filterSelectionTop('11W')" for="radio_option3">1W</a>
                <a class="btnTop" onclick="filterSelectionTop('11M')" for="radio_option3">1M</a>
                <a class="btnTop" onclick="filterSelectionTop('33M')" for="radio_option3">3M</a>
                <a class="btnTop" onclick="filterSelectionTop('66M')" for="radio_option3">6M</a>
                <a class="btnTop" onclick="filterSelectionTop('11Y')" for="radio_option3">1Y</a>
                <a class="btnTop" onclick="filterSelectionTop('TopMTD')" for="radio_option3">MTD</a>
            </div>
          </div>
        <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop todayTop">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count() }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count() }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('debit')*10/100}}</td>
                        <td> @if(App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::today())->whereDate('created_at', Carbon\Carbon::today())->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::tomorrow())->count() * (100/ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::today())->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->
        <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 11D">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::yesterday())->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::yesterday())->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereDate('created_at', Carbon\Carbon::yesterday())->sum('debit')*10/100}}</td>
                        <td> @if(App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::tomorrow())->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::tomorrow())->count() * (100/ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::today())->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->
        <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 11W">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum('debit')*10/100}}</td>
                        <td> @if(App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->endOfWeek(), Carbon\Carbon::now()])->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() * (100/ App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->endOfWeek(), Carbon\Carbon::now()])->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

         <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 11M">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('debit')*10/100}}</td>
                        <td> @if( App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() * (100/ App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

         <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 33M">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('debit')*10/100}}</td>
                        
                        <td> @if(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth(3)->startOfMonth(), Carbon\Carbon::now()])->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth(3)->startOfMonth(), Carbon\Carbon::now()])->count() * (100/ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

          <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 66M">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('debit')*10/100}}</td>
                        
                        <td> @if(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth(6)->startOfMonth(), Carbon\Carbon::now()])->count() != '0')
                          <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth(6)->startOfMonth(), Carbon\Carbon::now()])->count() * (100/ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth(3)->startOfMonth(), Carbon\Carbon::now()])->count() ), 0)}} % 
                          </h6> 
                         @else
                          <h6 class="fw-bolder mb-0">0%</h6> 
                         @endif<i data-feather="trending-up">
                        </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

        <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop 11Y">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereYear('created_at', now()->year)->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereYear('created_at', now()->year)->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereYear('created_at', now()->year)->sum('debit')*10/100}}</td>
                         
                        <td> @if(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                          [Carbon\Carbon::now()->subMonth(6)->startOfMonth(), Carbon\Carbon::now()])->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format(App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereYear('created_at', now()->year)->count() * (100/ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereBetween('created_at', 
                          [Carbon\Carbon::now()->subMonth(6)->startOfMonth(), Carbon\Carbon::now()])->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                       </td>
                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

         <!--topmarchant=============-->
        <div class="card-body p-0 filterDivTop TopMTD">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                </tr>
              </thead>
              <!-- top-merchant-table  -->
                  <tbody>
                     @foreach ($topmarchants as $topmarchant)
                      <tr>
                        <td>{{ $topmarchant->org_name }} </td>
                        <td>{{ App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count(); }}</td>
                        <td>{{ App\Models\Transaction::where('organisation_id',$topmarchant->organisation_id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count(); }}</td>
                        <td>{{ App\Models\GeneralLedger::where('organisation_id',$topmarchant->organisation_id)->whereMonth('created_at', Carbon\Carbon::now()->month)->sum('debit')*10/100}}</td>
                         
                        <td> @if( App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format( App\Models\ManageBookings::where('organisation_id',$topmarchant->organisation_id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count() * (100/ App\Models\ManageBookings::whereYear('created_at', now()->year)->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                       </td>

                      </tr>
                     @endforeach
                 </tbody>
              </table>
           </div>
         </div>
         <!--Top ===============topmarchant-->

       </div> 
    </div>
<!--=========================================top merchant==-->


    <!-- <div class="row match-height"> -->
    <div class="col-lg-5 col-12">
      <div class="card card-company-table">
        <div class="card-header">
          <div style=" padding-left: 2rem; "> <h4 class="card-title" style="margin-left: 0%;font-size:17px;" >Trending Models</h4></div>

         <div class="btn-group mt-md-0 mt-1 size" role="group" aria-label="Basic radio toggle button group" style="margin-left: 5%; margin-right: 3.5rem; " id="myBtnContainerTrend" > 
            <a class="btnTrend active" onclick="filterSelectionTrend('todayTrend')" for="radio_option1">Today</a>
            <a class="btnTrend" onclick="filterSelectionTrend('1DTrend')" for="radio_option2">1D</a>  
            <a class="btnTrend" onclick="filterSelectionTrend('1WTrend')" for="radio_option3">1W</a>
            <a class="btnTrend" onclick="filterSelectionTrend('1MTrend')" for="radio_option3">1M</a>
          </div>      
        </div>

        <!--Trending Models=====================-->
       <div class="card-datatable table-responsive pt-0 filterDivTrend todayTrend"> 
            <table class="table"> 
            <!-- trading-model-table -->
              <thead class="table-light1">
                  <tr>     
                    <th>Name</th>
                    <th>Rental</th>
                    <th>Trend<i data-feather="trending-up"></i></th>
                  </tr> 
              </thead>
              <tbody>
                 @foreach ($trendingModels as $trendingModel)
           

                  <tr>
                    <td>
                    <!-- <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" height="26" width="26"/> -->
                      <span class="fw-bold">{{ substr($trendingModel->merchant_sku,  strpos($trendingModel->merchant_sku, "-"))  }}</span> <!-- substr($trendingModel->merchant_sku, 0, strpos($trendingModel->merchant_sku, "-")) -->
                    </td>
                    <td>{{ App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereDate('created_at', Carbon\Carbon::today())->count() }}</td>
                   <!--  <td>  10% <i data-feather="trending-up"></td>   -->

                    <td> @if( App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereDate('created_at', Carbon\Carbon::today())->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format( App\Models\ManageBookings::where('organisation_id',$trendingModel->organisation_id)->whereMonth('created_at', Carbon\Carbon::today())->count() * (100/ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::today())->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                    </td>
                  </tr> 
                 @endforeach         
              </tbody>
            </table>
          </div>
          <!--Trending Models=====================-->

        <!--Trending Models=====================-->
       <div class="card-datatable table-responsive pt-0 filterDivTrend 1DTrend"> 
            <table class="table"> 
            <!-- trading-model-table -->
              <thead class="table-light1">
                  <tr>     
                    <th>Name</th>
                    <th>Rental</th>
                    <th>Trend<i data-feather="trending-up"></i></th>
                  </tr> 
              </thead>
              <tbody>
                 @foreach ($trendingModels as $trendingModel)
                  <tr>
                    <td>
                    <!-- <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" height="26" width="26"/> -->
                      <span class="fw-bold">{{ substr($trendingModel->merchant_sku,  strpos($trendingModel->merchant_sku, "-"))}}</span>
                    </td>
                    <td>{{ App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereDate('created_at', Carbon\Carbon::yesterday())->count() }}</td>
                    <!-- <td> 12% <i data-feather="trending-up"></td>   -->

                    <td> @if( App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereDate('created_at', Carbon\Carbon::yesterday())->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format( App\Models\ManageBookings::where('organisation_id',$trendingModel->organisation_id)->whereMonth('created_at', Carbon\Carbon::today())->count() * (100/ App\Models\ManageBookings::whereDate('created_at', Carbon\Carbon::yesterday())->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                    </td>
                  </tr> 
                 @endforeach         
              </tbody>
            </table>
          </div>
          <!--Trending Models=====================-->

           <!--Trending Models=====================-->
       <div class="card-datatable table-responsive pt-0 filterDivTrend 1WTrend"> 
            <table class="table"> 
            <!-- trading-model-table -->
              <thead class="table-light1">
                  <tr>     
                    <th>Name</th>
                    <th>Rental</th>
                    <th>Trend<i data-feather="trending-up"></i></th>
                  </tr> 
              </thead>
              <tbody>
                 @foreach ($trendingModels as $trendingModel)
                  <tr>
                    <td>
                   <!--  <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" height="26" width="26"/> -->
                      <span class="fw-bold">{{ substr($trendingModel->merchant_sku,  strpos($trendingModel->merchant_sku, "-")) }}</span>
                    </td>
                    <td>{{ App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() }}</td>
                    <!-- <td>  10% <i data-feather="trending-up"></td>   -->
                  <td> @if( App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::today()])->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format( App\Models\ManageBookings::where('organisation_id',$trendingModel->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() * (100/ App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::today()])->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                  </td>

                  </tr> 
                 @endforeach         
              </tbody>
            </table>
          </div>
          <!--Trending Models=====================-->

           <!--Trending Models=====================-->
       <div class="card-datatable table-responsive pt-0 filterDivTrend 1MTrend"> 
            <table class="table"> 
            <!-- trading-model-table -->
              <thead class="table-light1">
                  <tr>     
                    <th>Name</th>
                    <th>Rental</th>
                    <th>Trend<i data-feather="trending-up"></i></th>
                  </tr> 
              </thead>
              <tbody>
                 @foreach ($trendingModels as $trendingModel)
                  <tr>
                    <td>
                    <!-- <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" height="26" width="26"/> -->
                      <span class="fw-bold">{{ substr($trendingModel->merchant_sku,  strpos($trendingModel->merchant_sku, "-"))  }}</span>
                    </td>
                    <td>{{ App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() }}</td>
                   <!--  <td>  9%<i data-feather="trending-up"></td>   -->

                    <td> @if( App\Models\ManageBookings::where('merchant_sku',$trendingModel->merchant_sku)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() != '0')
                        <h6 class="fw-bolder mb-0">{{number_format( App\Models\ManageBookings::whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::today()])->count() * (100/ App\Models\ManageBookings::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() ), 0)}} % 
                        </h6> 
                       @else
                        <h6 class="fw-bolder mb-0">0%</h6> 
                       @endif<i data-feather="trending-up">
                  </td>

                  </tr> 
                 @endforeach         
              </tbody>
            </table>
          </div>
          <!--Trending Models=====================-->
        </div>
      </div>
    </div> 
    <!--/ Developer Meetup Card -->

    <!-- Browser States Card -->
    <div class="col-lg-12 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Fleet</h4>
          <div class="row match-height">
            <div class="btn-group mt-md-0 mt-1 size my-maring-right" role="group" aria-label="Basic radio toggle button group" id="myBtnContainerFleet"> 
                <a class="btnFleet active" onclick="filterSelectionFleet('todayFleet')" for="radio_option1">Today</a>
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet1D')" for="radio_option2">1D</a>  
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet1W')" for="radio_option3">1W</a>
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet1M')" for="radio_option3">1M</a>
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet3M')" for="radio_option3">3M</a> 
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet6M')" for="radio_option3">6M</a>
                <a class="btnFleet" onclick="filterSelectionFleet('Fleet1Y')" for="radio_option3">1Y</a>
                <a class="btnFleet" onclick="filterSelectionFleet('FleetMTD')" for="radio_option3">MTD</a>
            </div>
          </div>
         <!--  <div class="d-flex align-items-center">
            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
          </div> -->
        </div>
        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet todayFleet">
          <div class="row my-padding mt-1">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->count() - App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                @if(App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->count() != '0')
                <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->where('is_reserved',1)->count()*(100/ App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->count()), 2)}} %
                </h4> 
                 @else
                 <h4 class="fw-bolder mb-0">100%</h4> 
                 @endif
                <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
               
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->
        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet1D">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereDate('created_at', Carbon\Carbon::yesterday())->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::yesterday())->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereDate('created_at', Carbon\Carbon::today())->count() - App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                @if(App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::yesterday())->count() != '0')
                <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::today())->count()*(100/ App\Models\Fleet::where('is_reserved',1)->whereDate('created_at', Carbon\Carbon::yesterday())->count() ), 2)}} %</h4> 
                 @else
                 <h4 class="fw-bolder mb-0">100%</h4> 
                 @endif
                <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->

        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet1W">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() - App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  @if(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                              [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count()*(100/ App\Models\Fleet::whereBetween('created_at', 
                              [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->

        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet1M">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() - App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                
                  @if(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count()*(100/ App\Models\Fleet::whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->


        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet3M">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count() - App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
               

                  @if(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count()*(100/ App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->


         <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet6M">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count() - App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                

                  @if(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count()*(100/ App\Models\Fleet::whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->

        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet Fleet1Y">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereYear('created_at', now()->year)->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereYear('created_at', now()->year)->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereYear('created_at', now()->year)->count() - App\Models\Fleet::whereYear('created_at', now()->year)->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
               
                  @if(App\Models\Fleet::where('is_reserved',1)->whereYear('created_at', now()->year)->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereYear('created_at', now()->year)->count()*(100/ App\Models\Fleet::whereYear('created_at', now()->year)->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->

        <!--fleet=====================================-->
        <div class="card-body statistics-body filterDivFleet FleetMTD">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereMonth('created_at', Carbon\Carbon::now()->month)->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Fleet Universe</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::where('is_reserved',1)->whereMonth('created_at', Carbon\Carbon::now()->month)->count();}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Engage</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{App\Models\Fleet::whereMonth('created_at', Carbon\Carbon::now()->month)->count() - App\Models\Fleet::whereMonth('created_at', Carbon\Carbon::now()->month)->count()}}</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                

                  @if(App\Models\Fleet::where('is_reserved',1)->whereMonth('created_at', Carbon\Carbon::now()->month)->count() != '0')
                  <h4 class="fw-bolder mb-0">{{number_format(App\Models\Fleet::where('is_reserved',1)->whereMonth('created_at', Carbon\Carbon::now()->month)->count()*(100/ App\Models\Fleet::whereMonth('created_at', Carbon\Carbon::now()->month)->count() ), 2)}} %
                  </h4> 
                   @else
                   <h4 class="fw-bolder mb-0">100%</h4> 
                   @endif
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">Occupancy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--fleet=====================================-->
        <br/>
      </div>
    </div>
    <!--/ Browser States Card -->

   
  <!-- <div class="row match-height"> -->
    <!-- Timeline Card -->
    <!-- <div class="col-lg-6 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-start pb-1">
          <div>

            <h4 class="card-title mb-25">Usage Tracker</h4> 
          </div>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">ds</a>
              <a class="dropdown-item" href="#">sd</a>
              <a class="dropdown-item" href="#">d</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-start mb-3">
          <div class="card-body statistics-body">
          <div class="row">
            <div class="col-sm-4 col-6 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">100</h4>
                  <p class="card-text font-small-3 mb-0">Total merchant</p>
                </div>
              </div>
            </div>
             <div class="col-sm-4 col-6 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                      <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">20</h4>
                  <p class="card-text font-small-3 mb-0">Active Today</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-6 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
              <div class="my-auto">
                  <h4 class="fw-bolder mb-0">20%</h4> 
                </div>                            
                  <i data-feather="trending-up" class="avatar-icon bold"></i>                                           
              </div>
            </div>   
          </div>
        </div>
          </div>
          <div id="revenue-chart"></div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-12">
      <div class="card card-user-timeline">
        <div class="card-header">
          <div class="d-flex align-items-center">
          <i data-feather="list" class="user-timeline-title-icon"></i>
            
            <h4 class="card-title">Activity Log</h4>
          </div>
        </div>
        <div class="card-body">
          <ul class="timeline ms-50">
            <li class="timeline-item">
              <span class="timeline-point timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>12 Invoices have been paid</h6>
                <p>Invoices are paid to the company</p>
                <div class="d-flex align-items-center">
                  <img class="me-1" src="{{asset('images/icons/json.png')}}" alt="data.json" height="23" />
                  <h6 class="more-info mb-0">data.json</h6>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Client Meeting</h6>
                <p>Project meeting with Carl</p>
                <div class="d-flex align-items-center">
                   <div class="avatar me-50">
                    <img
                      src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                      alt="Avatar"
                      width="38"
                      height="38"
                    />
                  </div> 
                  <div class="more-info">
                    <h6 class="mb-0">Carl Roy (Client)</h6>
                    <p class="mb-0">CEO of Infibeam</p>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Create a new project</h6>
                <p>Add files to new design folder</p>
                <div class="avatar-group">
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Billy Hopkins"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"   
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Amy Carson"
                    class="avatar pull-up"
                  >
                    <img
                     src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Brandon Miles"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-8.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Daisy Weber"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                  <div
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="bottom"
                    title="Jenny Looper"
                    class="avatar pull-up"
                  >
                    <img
                      src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                      alt="Avatar"
                      width="33"
                      height="33"
                    />
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
              <div class="timeline-event">
                <h6>Update project for client</h6>
                <p class="mb-0">Update files as per new design</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> -->
 
</section>

<style>
  .btn1
  {
    margin-left:14px;
  }
  .btnTop
  {
    margin-left:14px;
  }
  .btnTrend
  {
    margin-left:14px;
  }
  .btnFleet
  {
    margin-left:14px;
  }
  </style>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> -->
  <!-- <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>

 

 
 
@endsection
@section('page-script')
  <!-- Page js files -->

  <script src="{{ asset('js/scripts/pages/app-invoice-list.js') }}"></script> 
  <script src="{{ asset('js/scripts/pages/dashboard-list.js') }}"></script> 
  <script src="{{ asset('js/scripts/pages/dashboard-model-list.js') }}"></script> 
  <script src="{{ asset('js/scripts/pages/company-dashboard-trending-list.js') }}"></script> 
  <script src="{{ asset('js/scripts/pages/app-payments.js') }}"></script>
  <script src="{{ asset('js/scripts/cards/card-analytics.js') }}"></script>


<script>
filterSelection("Today")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

//active class
$(".btn1").click(function(){
    $(".btn1").removeClass("active");
    $(this).addClass("active");
});
</script>

<style>
.filterDiv {
  display: none;
}

.show {
  display: block;
}

.btn1:hover {
  /*background-color: red;*/
}

.btn1.active {
  text-decoration: underline;
  color: red;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn1:hover {

  color: red;
}

.btn1 {
  border: none;
  outline: none;
   
  cursor: pointer;
}

</style>

<!-- Top marchent script ==========================================================-->
<script>
filterSelectionTop("todayTop")
function filterSelectionTop(c) {
  var x, i;
  x = document.getElementsByClassName("filterDivTop");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "showTop");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "showTop");
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

//active class
$(".btnTop").click(function(){
    $(".btnTop").removeClass("active");
    $(this).addClass("active");
});
</script>

<style>
.filterDivTop {
  display: none;
}

.showTop {
  display: block;
}

.btnTop:hover {
  /*background-color: red;*/
}

.btnTop.active {
  text-decoration: underline;
  color: red;
}

/* Style the active class, and buttons on mouse-over */
.active, .btnTop:hover {

  color: red;
}

.btnTop {
  border: none;
  outline: none;
   
  cursor: pointer;
}

</style>
<!-- Top marchent script -->



<!-- Top trend script ==========================================================-->
<script>
filterSelectionTrend("todayTrend")
function filterSelectionTrend(c) {
  var x, i;
  x = document.getElementsByClassName("filterDivTrend");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "showTrend");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "showTrend");
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
// var btnContainer = document.getElementById("myBtnContainerTrend");
// var btns = btnContainer.getElementsByClassName("btnTrend");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function(){
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }

//active class
$(".btnTrend").click(function(){
    $(".btnTrend").removeClass("active");
    $(this).addClass("active");
});
</script>

<style>
.filterDivTrend {
  display: none;
}

.showTrend {
  display: block;
}

.btnTrend:hover {
  /*background-color: red;*/
}

.btnTrend.active {
  text-decoration: underline;
  color: red;
}

/* Style the active class, and buttons on mouse-over */
.active, .btnTrend:hover {

  color: red;
}

.btnTrend {
  border: none;
  outline: none;
   
  cursor: pointer;
}

</style>
<!-- Top marchent script -->



<!-- Top fleet script ==========================================================-->
<script>
filterSelectionFleet("todayFleet")
function filterSelectionFleet(c) {
  var x, i;
  x = document.getElementsByClassName("filterDivFleet");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "showFleet");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "showFleet");
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}
 

//active class
$(".btnFleet").click(function(){
    $(".btnFleet").removeClass("active");
    $(this).addClass("active");
});

</script>

<style>
.filterDivFleet {
  display: none;
}

.showFleet {
  display: block;
}

.btnFleet:hover {
  /*background-color: red;*/
}

.btnFleet.active {
  text-decoration: underline;
  color: red;
}

/* Style the active class, and buttons on mouse-over */
.active, .btnFleet:hover {

  color: red;
}

.btnFleet {
  border: none;
  outline: none;
   
  cursor: pointer;
}

</style>
@endsection  
