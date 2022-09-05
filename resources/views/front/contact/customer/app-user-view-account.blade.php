@extends('layouts.main')

@section('title', 'User View - Account')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sweet-alerts.css') }}">
@endsection

@section('content')

<section class="app-user-view-account">
  <div class="row">
    <!-- User Card -->
    <div class="card">
    <div class="card-body">
    <!-- User Sidebar -->
        <div class="row">
            <div class=" col-md-6 ">
              
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

              <div class="col-md-6"> 
                <div class="user-info text-center mt-3">
                  <h5>{{$customer->user->fullname}}</h5>
                  <span class="badge bg-light-secondary">{{$customer->customer_typee->type_name}}</span>
                </div>
                <div class="d-flex justify-content-center pt-2">
                <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                  Edit
                </a>
                <a href="javascript:;" class="btn btn-outline-danger">delete</a>
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

        <div class="col-md-6">

        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-75">
                <span class="fw-bolder me-25">Username:</span>
                <span>{{$customer->user->username}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Billing Email:</span>
                <span>{{$customer->user->email}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Status:</span>
                <span class="badge bg-light-success">{{$customer->approvale_status}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Role:</span>
                <span>Author</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Tax ID:</span>
                <span>Tax-8965</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Contact:</span>
                <span>{{$customer->user->mobile}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Language:</span>
                <span>English</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Country:</span>
                <span>Wake Island</span>
              </li>
            </ul>
        
        </div>
   
        </div>
      </div>
      </div>
      <!-- /User Card -->
    </div>
    </div>
    <!--/ User Sidebar -->

      <!-- Activity Timeline -->
      <div class="card">
        <h4 class="card-header">User Activity Timeline</h4>
        <div class="card-body pt-1">
          <ul class="timeline ms-50">
            <li class="timeline-item">
              <span class="timeline-point timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>User login</h6>
                  <span class="timeline-event-time me-1">12 min ago</span>
                </div>
                <p>User login at 2:12pm</p>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Meeting with john</h6>
                  <span class="timeline-event-time me-1">45 min ago</span>
                </div>
                <p>React Project meeting with john @10:15am</p>
                <div class="d-flex flex-row align-items-center mb-50">
                  <div class="avatar me-50">
                    <img
                      src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                      alt="Avatar"
                      width="38"
                      height="38"
                    />
                  </div>
                  <div class="user-info">
                    <h6 class="mb-0">Leona Watkins (Client)</h6>
                    <p class="mb-0">CEO of pixinvent</p>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Create a new react project for client</h6>
                  <span class="timeline-event-time me-1">2 day ago</span>
                </div>
                <p>Add files to new design folder</p>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Create Invoices for client</h6>
                  <span class="timeline-event-time me-1">12 min ago</span>
                </div>
                <p class="mb-0">Create new Invoices and send to Leona Watkins</p>
                <div class="d-flex flex-row align-items-center mt-50">
                  <img class="me-1" src="{{asset('images/icons/pdf.png')}}" alt="data.json" height="25" />
                  <h6 class="mb-0">Invoices.pdf</h6>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- /Activity Timeline -->

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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/modal-edit-user.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-user-view-account.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-user-view.js') }}"></script>
@endsection
