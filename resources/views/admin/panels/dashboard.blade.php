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
            <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div>
          </div>
          <div class="text-center">
            <h1 class="mb-1 text-white">Welcome SuperAdmin</h1>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->

    <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Statistics</h4>
          <div class="d-flex align-items-center">
            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">Sales</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($sales,2)}}</p>
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
                <h4 class="fw-bolder mb-0">Customers</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($customer)}}</p>
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
                <h4 class="fw-bolder mb-0">Products</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($product)}}</p>
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
                <h4 class="fw-bolder mb-0">Revenue</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">0</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Orders Chart Card ends -->
  </div>

<div class="row match-height">
    <div class="col-lg-7 col-12">
      <div class="card card-company-table">
        <div class="card-header">
           <div>
            <h4 class="card-title">Top Merchant</h4> 
           </div>

   </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="top-merchant-table table">
              <thead>
                <tr>
                  <th></th>
                  <th>Company</th>
                  <th>Booking</th>
                  <th>Payment</th>
                  <th>Revenue</th>
                  <th>Trend<i data-feather="trending-up"></i></th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <td>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> 
    </div>
   
    <div class="col-lg-5 col-12">
      <div class="card card-company-table">
      <div class="card-header">
          <div>
            <h4 class="card-title">Trending Models</h4> 
          </div>

        </div>  
        <div class="card-datatable table-responsive pt-0"> 
    <table class="trading-model-table table"> 
      <thead class="table-light1">
     <tr>  
           
            <th>Name</th>
            <th>Rental</th>
            <th>Trend<i data-feather="trending-up"></i></th>
          

     </tr> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
    <!--/ Developer Meetup Card -->

    <!-- Browser States Card -->
    <div class="col-xl-12 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title ">Fleet</h4>
          <div class="d-flex align-items-center">
            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                <h4 class="fw-bolder mb-0">Sales</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($sales,2)}}</p>
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
                <h4 class="fw-bolder mb-0">Customers</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($customer)}}</p>
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
                <h4 class="fw-bolder mb-0">Products</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">{{number_format($product)}}</p>
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
                <h4 class="fw-bolder mb-0">Revenue</h4> 
                  <p class="card-text fw-bolder font-small-3 mb-0 text-end">0</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Browser States Card -->

   
  </div>
 
</section>
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

@endsection  
