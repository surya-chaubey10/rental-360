@extends('layouts.main')
@section('title', 'Users')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')
<style>
  .toggle {

-webkit-appearance: none;

-moz-appearance: none;

appearance: none;

width: 62px;

height: 32px;

display: inline-block;

position: relative;

border-radius: 50px;



outline: none;

border: none;

cursor: pointer;

background-color: red;

transition: background-color ease 0.3s;

}



.toggle:before {

content: "";

display: block;

position: absolute;

z-index: 20;

width: 28px;

height: 28px;

background: #fff;

left: 0px;

top: 2px;

border-radius: 50%;

font: 10px/28px Helvetica;

text-transform: uppercase;

font-weight: bold;

text-indent: -22px;

word-spacing: 10px;

color: #fff;

text-shadow: -1px -1px rgba(0,0,0,0.15);

white-space: nowrap;

box-shadow: 0 1px 2px rgba(0,0,0,0.2);

transition: all cubic-bezier(0.3, 1.5, 0.7, 1) 0.3s;

}



.toggle:checked {

background-color: #4CD964;

}



.toggle:checked:before {

left: 32px;

}



  </style>

    <section class="app-user-list">
        <!-- <div class="row"> -->
            <!-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">21,459</h3>
                            <span>Total Users</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                                <i data-feather="user" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">4,567</h3>
                            <span>Paid Users</span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                                <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">19,860</h3>
                            <span>Active Users</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">237</h3>
                            <span>Pending Users</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                                <i data-feather="user-x" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- </div> -->
        <!-- list and filter start -->
         <!--   
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">Search & Filter</h4>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>   -->
            <div class="card"> 
        <div class="card-body border-bottom">
            <div class="card-header"> 
            <h4 ><b> </b></h4>
            <a href="{{route('user-create')}}" class="btn btn-danger" >Add New User</a> 
            </div> 
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
            </div>
            <!-- Modal to add new user starts-->
            <!-- <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" >
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                                    placeholder="John Doe" name="fullname" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-uname">Username</label>
                                <input type="text" id="basic-icon-default-uname" class="form-control dt-uname"
                                    placeholder="Web Developer" name="username" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                                    placeholder="john.doe@example.com" name="email" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-contact">Contact</label>
                                <input type="text" id="basic-icon-default-contact" class="form-control dt-contact"
                                    placeholder="+1 (609) 933-44-22" name="contact" />
                            </div>
                             <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-company">Company</label>
                                <input type="text" id="basic-icon-default-company" class="form-control dt-contact"
                                    placeholder="PIXINVENT" name="company" />
                            </div>  
                            <div class="mb-1">
                                <label class="form-label" for="country">Country</label>
                                
                                <select id="country" class="select2 form-select" name="country">
                                @foreach (\App\Models\CountryMaster::select('id', 'name')->get() as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="user-role" class="select2 form-select" name="role">
                                    <option value="subscriber">Subscriber</option>
                                    <option value="editor">Editor</option>
                                    <option value="maintainer">Maintainer</option>
                                    <option value="author">Author</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button id="submit" type="submit" class="btn btn-outline-primary btn-form-block">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div> -->
            <!-- Modal to add new user Ends-->
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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/app-user-list.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection
