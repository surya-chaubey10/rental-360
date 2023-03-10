@extends('layouts.main')

@section('title', 'View Vendor')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sweet-alerts.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')

<section class="app-user-view-account">
  <div class="row">
    <!-- User Card -->
    <div class="card">
    <div class="card-body">
    <!-- User Sidebar -->
        <div class="row">
            <div class=" col-md-4 "> 
      <!-- User Card -->
      <div class="card">
        <div class="card-body">
          <div class="user-avatar-section">
            
           <div class="row">
                <div class=" col-md-3">
                    <img
                      class="img-fluid rounded mt-3"
                      src="{{asset('images/portrait/small/avatar-s-2.jpg')}}"
                      height="110"
                      width="110"
                      alt="User avatar"
                    />
               </div> 
               <div class="col">
              <div class="row-md-4"> 
                <div class="user-info text-center mt-3">
                  <h5>{{$vendor->user->fullname}}</h5>
                  <span class="badge bg-light-secondary">{{$vendor->customer_typee->type_name}}</span>
                </div>
                <div class="d-flex justify-content-center pt-2">
                <a href="../vendor-edit/{{$vendor->uuid}}" class="btn btn-primary me-1"> 
                  Edit
                </a>
                <button data-id="{{$vendor->uuid}}" class="btn btn-outline-danger delete-record">delete</button>
                </div>
            </div>
            </div>
            </div>
          </div>

          </div>
          
          <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start me-2">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="check" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">1.23k</h4>
                <small>Tasks Done</small>
              </div>
            </div>
            <div class="d-flex align-items-start">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="briefcase" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">568</h4>
                <small>Projects Done</small>
              </div>
            </div>
          </div>
          
        </div>
      </div>

        <div class="col-md-4"> 
        <div class="card-body">
          
            <div class="info-container">
              <ul class="list-unstyled">
              <li class="mb-75">
                <span class="fw-bolder me-25">Username:</span>
                <span>{{$vendor->user->username}}</span>
              </li>
              
              <li class="mb-75">
                <span class="fw-bolder me-25">Status:</span>
                <span class="badge bg-light-secondary">{{$vendor->approval_status}}</span>
              </li>
               
               
              <li class="mb-75">
                <span class="fw-bolder me-25">Contact:</span>
                <span>{{$vendor->user->mobile}}</span>
              </li>
              
              <li class="mb-75">
                <span class="fw-bolder me-25">Country:</span>
                <span>{{$vendor->user->country->name}}</span>
              </li>
              </ul>
        
            </div>
            </div>
   
        </div>

                
        <div class="col-md-4"> 
        <div class="card-body">

        <div class="transaction-item ">
            <div class="d-flex">
              <div class="avatar bg-light-warning rounded float-start">
                <div class="avatar-content">
                  <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">&nbsp;&nbsp;&nbsp;WALLET BALANCE</h6>
                <small>&nbsp;&nbsp;&nbsp;$1000</small>
              </div>
            </div><br><br>
            <button type="button" class="btn btn-primary ">View Details</button>
          </div>
          </div>
          </div>

                 




      </div>
      </div>
      <!-- /User Card -->
    </div>
    </div>
    <!--/ User Sidebar -->

      

      <!-- Invoice table -->
      <div class="card">
        <table class="invoice-table table text-nowrap">
          <thead>
            <tr>
              <th></th>
              <th>#ID</th>
              <th><i data-feather="trending-up"></i></th>
              <th>TOTAL Paid</th>
              <th class="text-truncate">Issued Date</th>
              <th class="cell-fit">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /Invoice table -->
   
    <!--/ User Content -->
  </div>
</section>

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  {{-- data table --}}
  <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <!-- <script src="{{ asset('js/scripts/pages/modal-edit-user.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-user-view-account.js') }}"></script> -->
  <script src="{{ asset('js/scripts/pages/app-vendor-view.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection
