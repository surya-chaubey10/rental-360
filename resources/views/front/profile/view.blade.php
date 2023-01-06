@extends('layouts.main')
@section('title', 'Profile')


@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}"> -->

@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">

@endsection

@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
<link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">

@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 18px;
  }

  .switch input {
    display: none;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #737373;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.slider {
    background-color: #2ab934;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(12px);
    -ms-transform: translateX(12px);
    transform: translateX(33px);
  }

  /*------ ADDED CSS ---------*/
  .slider:after {
    content: 'OFF';
    color: white;
    display: block;
    position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
  }

  input:checked+.slider:after {
    content: 'ON';
  }
</style>



@section('content')

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#pills-General" type="button" role="tab" aria-controls="pills-General" aria-selected="true">Company Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-KYC-tab" data-bs-toggle="pill" data-bs-target="#pills-KYC" type="button" role="tab" aria-controls="pills-KYC" aria-selected="false">Document Details</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-Subscription-tab" data-bs-toggle="pill" data-bs-target="#pills-Subscription" type="button" role="tab" aria-controls="pills-Subscription" aria-selected="false">Agreement Details</button>
  </li>

  <!-- Info -->

  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card">
        <div class="card-body">
          <form>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-General" role="tabpanel" aria-labelledby="pills-General-tab">
                <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Basic Info</h4>
                  <!-- <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button> -->
                </div>
                <hr>
                <section id="multiple-column-form">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">

                          <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="company_name">Company Name</label>
                                <input type="text" id="company_name" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{( isset($org->org_name) ? $org->org_name : '' )}}" name="company_name" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="company_logo">Trading Name</label>
                                <input type="text" id="company_logo" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{( isset($org->org_logo) ? $org->org_name : '' )}}" placeholder="Full Name" name="company_logo" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="first_name">Address</label>
                                <input type="tel" id="first_name" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{$org->org_city}}" name="first_name" readonly />
                              </div>
                            </div>

                            <!-- <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="admin_email">Address</label>
          <input
            type="text"
            id="admin_email"
            class="form-control"
            value="{{(isset($orgs_name->org_street1) ? $orgs_name->org_street1 : '')}}"
            name="admin_email"   
            readonly
                />
        </div>
      </div> -->

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="admin_phone">City</label>
                                <input type="text" id="admin_phone" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{$org->org_city}}" name="admin_phone" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1" style="margin-top: 3px;">
                                <label class="form-label" for="password">Region/State
                                  <!-- <button class="btn btn-sm btn-danger" type="button"  id="generate_password">+ Generate</button> -->
                                </label>
                                <input type="text" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{$org->org_state}}" name="country" id="country" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1 mt-1">
                                <label class="form-label" for="confirm_password">Country</label>
                                <input type="text" class="form-control" value=" @php  $user= getUser();  $org= org_details(); @endphp
                {{$org->org_city}}" name="country" id="country" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="website">Banking Currency</label>
                                <input type="text" id="website" class="form-control" value="{{(isset($bank->currency_id) ? $bank->currency_id : '')}}" name="website" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="designation">Company Type</label>
                                <input type="text" id="designation" class="form-control" value="Tokenise" name="designation" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="gener_city">Status</label>
                                <input type="text" id="gener_city" class="form-control" value="checked" name="gener_city" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="gener_country">Email</label>
                                <input type="text" id="gener_state" class="form-control" value="@php $user= getUser(); @endphp {{$user->email}}" name="gener_state" readonly />
                              </div>
                            </div>



                          </div>
                        </div>
                      </div>
                    </div>
                </section>

                <section id="multiple-column-form">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 style="font-size: 1.486rem;">Trading Details</h4>
                        </div>
                        <div class="card-body">

                          <div class="row">
                            <div class="col-md-4 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="cars">Business Activity</label>
                                <input type="text" id="active_plan" class="form-control" value="{{isset($bank->business_activity) ? $bank->business_activity : ''}}" name="active_plan" readonly />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="company_logo">Website</label>

                                <input type="text" id="company_logo" class="form-control" value="{{isset($bank->website) ? $bank->website : ''}}" name="company_logo" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="first_name">Products and Services</label>
                                <input type="tel" id="first_name" class="form-control" value="{{isset($bank->products_and_services) ? $bank->products_and_services : ''}}" name="first_name" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Trading Currency</label>
                                <input type="tel" id="last_name" class="form-control" value="{{isset($bank->trading_currency) ? $bank->trading_currency : ''}}" name="last_name" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Estimated Sales</label>
                                <input type="tel" id="last_name" class="form-control" value="{{isset($bank->estimated_sales) ? $bank->estimated_sales : ''}}" name="last_name" readonly />
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Average Ticket Size</label>
                                <input type="tel" id="last_name" class="form-control" value="{{isset($bank->average_ticket_size) ? $bank->average_ticket_size : ''}}" name="last_name" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Target Regions</label>
                                <input type="tel" id="last_name" class="form-control" value="{{isset($bank->target_regions) ? $bank->target_regions : ''}}" name="last_name" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Selected Countires</label>
                                <input type="tel" id="last_name" class="form-control" value="{{isset($bank->selected_countries) ? $bank->selected_countries : ''}}" name="last_name" readonly />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last_name">Status</label>
                                <input type="tel" id="last_name" class="form-control" value="Accepted" name="last_name" readonly />
                              </div>
                            </div>

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- KYC -->
                <h4 class="card-title"> KYC</h4>
                <hr>
                Bank Details : (Optional)
                <section id="multiple-column-form">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="bank_name">Bank Name</label>
                                <input type="text" id="bank_name" class="form-control" value="{{(isset($bank->bank_name) ? $bank->bank_name : '')}}" name="bank_name" placeholder="Enter Bank Name" readonly />
                                <span class="form-text text-danger" id="bank_name_error"></span>
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="bic">BIC/SWIFT</label>
                                <input type="text" id="bic" class="form-control" value="{{(isset($bank->bic_code) ? $bank->bic_code : '')}}" name="bic" placeholder="Enter BIC/SWIFT" readonly />
                                <span class="form-text text-danger" id="bic_error"></span>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="account_name">Account Name</label>
                                <input type="text" id="account_name" class="form-control" value="{{(isset($bank->account_name) ? $bank->account_name : '')}}" name="account_name" placeholder="Enter Account Name" readonly />
                                <span class="form-text text-danger" id="account_name_error"></span>
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="iban">IBAN (Unique)</label>
                                <input type="text" id="iban" class="form-control" value="{{(isset($bank->iban_code) ? $bank->iban_code : '')}}" name="iban" placeholder="Enter IBAN" readonly />
                                <span class="form-text text-danger" id="iban_error"></span>

                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="account_no">Acount No. (Unique)</label>
                                <input type="number" id="account_no" class="form-control" value="{{(isset($bank->account_no) ? $bank->account_no : '')}}" name="account_no" placeholder="Enter Account No." readonly />
                                <span class="form-text text-danger" id="account_no_error"></span>

                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="b_currency">Currency</label>
                                <select class="form-select" id="b_currency" name="b_currency" disabled>
                                  <option value="{{(isset($bank->currency_id) ? $bank->currency_id : '')}}">AED</option>
                                </select>
                                <span class="form-text text-danger" id="b_currency_error"></span>

                              </div>
                            </div>


                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="b_status">Status</label>
                                <select name="b_status" id="b_status" class="form-control" disabled>
                                  <option value="0">Under Review</option>
                                  <option value="1">Accepted</option>
                                  <option value="2" class="d-none">Rejected</option>
                                </select>
                                <span class="form-text text-danger" id="status_error"></span>

                              </div>
                            </div>
                          </div>
                </section>
                <!-- KYC End -->

              </div>


              <!-- Document -->

              <!--Document Details-->

              <div class="tab-pane active fade" id="pills-KYC" role="tabpanel" aria-labelledby="pills-KYC-tab">
                <!-- Documents Tab Menu -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Owner Documents</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bussiness Documents</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Others</button>
                  </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">

                              <div class="row">
                                @include('profile.owner-documents');
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>

                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">

                              <div class="row">
                                @include('profile.business-documents');
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>

                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">

                              <div class="row">
                                @include('profile.other-documents');
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                </section>
                <div class="text-center">
                  <button type="submit" class="btn btn-danger me-1 btn-form-block">Save</button>
                  <div>
                    <!-- -->
                    <!--Document Details End-->

                    <div class="tab-pane active fade" id="pills-plus" role="tabpanel" aria-labelledby="pills-plus-tab">

                      <!--Agreement Details-->

                      <div class="tab-pane fade" id="pills-Subscription" role="tabpanel" aria-labelledby="pills-Subscription-tab">
                        <section id="multiple-column-form">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-body">

                                  <div class="row">
                                    <div class="col-md-6 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="company_name">Signatory Name</label>
                                        <input type="text" id="company_name" class="form-control" value="Mohammad" name="company_name" readonly />
                                      </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="company_logo">Signatory Title</label>
                                        <input type="text" id="company_logo" class="form-control" value="CEO" placeholder="Full Name" name="company_logo" readonly />
                                      </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="company_logo">Signed On</label>
                                        <input type="text" id="company_logo" class="form-control" value="24-Feb-2022" placeholder="Full Name" name="company_logo" readonly />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>


                      <!-- Agreement End-->







                      <!-- Styles-------------------------------------------------------------------------------------------------------- -->
                      <style>
                        .filterDiv {
                          display: none;
                        }

                        .show1 {
                          display: block;
                        }

                        .btn1:hover {
                          /*background-color: red;*/
                        }

                        .nav-pills .nav-link {
                          padding: 0.786rem 6.5rem;
                        }

                        .btn1.active {
                          text-decoration: underline;
                          color: red;
                        }

                        /* Style the active class, and buttons on mouse-over */
                        .active,
                        .btn1:hover {

                          color: red;
                        }

                        .btn1 {
                          border: none;
                          outline: none;

                          cursor: pointer;
                        }
                      </style>

                      <!-- Top marchent script ==========================================================-->


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

                        .btn1 {
                          margin-left: 14px;
                        }

                        .btnTop {
                          margin-left: 14px;
                        }

                        /* Style the active class, and buttons on mouse-over */
                        .active,
                        .btnTop:hover {

                          color: red;
                        }

                        .btnTop {
                          border: none;
                          outline: none;

                          cursor: pointer;
                        }
                      </style>
                      <!-- Dashboard Analytics end -->
                      @endsection

                      @section('vendor-script')
                      <!-- vendor files -->
                      <script src="https://www.w3schools.com/lib/w3.js"></script>
                      <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
                      <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
                      <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
                      <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>

                      @endsection
                      @section('page-script')
                      <!-- Page js files -->
                      <!-- <script src="{{ asset('js/scripts/pages/dashboard-analytics.js') }}"></script> -->
                      <script src="{{ asset('js/scripts/pages/transaction-list.js') }}"></script>
                      <script src="{{ asset('js/scripts/pages/dashboard-invoice-list.js') }}"></script>
                      <script src="{{ asset('js/scripts/pages/recent-activity-list.js') }}"></script>


                      {{-- <script src="{{ asset('js/scripts/pages/app-invoice-list.js') }}"></script> --}}
                      <script src="{{ asset('js/scripts/pages/app-dashboard_payments-list.js') }}"></script>
                      <script src="{{ asset('js/scripts/pages/app-reservefleet-list.js') }}"></script>
                      <script src="{{ asset('js/scripts/cards/card-analytics.js') }}"></script>

                      @endsection

                      <!-- _____________________ -->

                      <style type="text/css">
                        .img-height {
                          /*height: 300px;*/
                          margin-bottom: 20px;
                        }

                        /*.content-body{
      margin-bottom: 30px;
    }*/
                      </style>