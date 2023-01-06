@extends('layouts.main')
@section('title', '')
 
 
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">

  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 18px;
  }
  
  .switch input {display:none;}
  
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
  
  input:checked + .slider {
    background-color: #2ab934;
  }
  
  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }
  
  input:checked + .slider:before {
    -webkit-transform: translateX(12px);
    -ms-transform: translateX(12px);
    transform: translateX(33px);
  }
  
  /*------ ADDED CSS ---------*/
  .slider:after
  {
   content:'OFF';
   color: white;
   display: block;
   position: absolute;
   transform: translate(-50%,-50%);
   top: 50%;
   left: 50%;
   font-size: 10px;
   font-family: Verdana, sans-serif;
  }
  
  input:checked + .slider:after
  {  
    content:'ON';
  }

  .iti {
    width: 100%;
  }

  .loadering{
    position: absolute;
    top:0px;
    right:0px;
    width:100%;
    height:100%;
    background-color:#ffffff8a;
    /* background-image:url({{asset('public/images/loadings.gif')}}); */
    background-size:190px;
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;
}

.toast-message {
   color: white !important;
   
}


</style>
@section('content')
 
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <div id="loadingGif" class="loadering text-center mt-5" style="display:none">
            <img id="imga" src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif"></div> 
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">

            <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Edit Company</h4>
                  <!-- <button  id="save" name="save" type="save" class="btn btn-danger me-1 btn-form-block">Save</button> -->
            </div><hr>
           

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active first_top_tab" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#pills-General" type="button" role="tab" aria-controls="pills-General" aria-selected="true">General</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link second_top_tab" id="pills-KYC-tab" data-bs-toggle="pill" data-bs-target="#pills-KYC" type="button" role="tab" aria-controls="pills-KYC" aria-selected="false">KYC</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link third_top_tab" id="pills-More_Information-tab" data-bs-toggle="pill" data-bs-target="#pills-More_Information" type="button" role="tab" aria-controls="pills-More_Information" aria-selected="false">More Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link fourth_top_tab" id="pills-Permission-tab" data-bs-toggle="pill" data-bs-target="#pills-Permission" type="button" role="tab" aria-controls="pills-Permission" aria-selected="false">Permission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link five_top_tab" id="pills-Subscription-tab" data-bs-toggle="pill" data-bs-target="#pills-Subscription" type="button" role="tab" aria-controls="pills-Subscription" aria-selected="false">Subscription</button>
                    </li>
                  </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-General" role="tabpanel" aria-labelledby="pills-General-tab">
                                            <h4 class="card-title">General</h4>
                                            <hr> 
                                        <section id="multiple-column-form">
                                          <div class="row">
                                            <div class="col-12">
                                              <div class="card"> 
                                                <div class="card-body">
                                          
                                                  <div class="row">
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="company_name">Company Name*</label>
                                                          <input
                                                            type="text"
                                                            id="company_name"
                                                            class="form-control alphaValue"
                                                            value="{{ucfirst($company->org_name)}}"
                                                            name="company_name"   

                                                          />
                                                          <span class="form-text text-danger" id="company_name_error"></span>
                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="company_logo">Company Logo*</label>
                                                        <input
                                                          type="file"
                                                          id="company_logo" 
                                                          class="form-control filesize"
                                                          value=""
                                                          placeholder="Full Name"
                                                          name="company_logo"
                                                        />
                                                        <span class="form-text text-danger" id="company_logo_error"></span>
                                                        @if($company->org_logo != '')
                                                        <img src="/public/company/logo/{{$company->org_logo}}" width="150px" height="150px" alt="Company Image">
                                                        @endif
                                                      </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="first_name">First Name*</label>
                                                        <input
                                                          type="text"
                                                          id="first_name"
                                                          class="form-control alphaValue"
                                                          value="{{($fullname ? ucfirst($fullname[0]) : '') }}"
                                                          name="first_name"   
                                                          onkeydown="preventNumberInput(event)"
                                                            onkeyup="preventNumberInput(event)"
                                                        />
                                                        <span class="form-text text-danger" id="first_name_error"></span>

                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="last_name">Last Name*</label>
                                                        <input
                                                          type="text"
                                                          id="last_name"
                                                          class="form-control alphaValue"
                                                          value="{{($fullname ? ucfirst($fullname[1]) : '') }}"
                                                          name="last_name"
                                                          onkeydown="preventNumberInput(event)"
                                                            onkeyup="preventNumberInput(event)"
                                                        />
                                                        <span class="form-text text-danger" id="last_name_error"></span>

                                                      </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="admin_email">Admin Email Address*</label>
                                                        <input
                                                          type="email"
                                                          id="admin_email"
                                                          class="form-control"
                                                          value="{{($company->user != '' ? $company->user->email : '')}}"
                                                          name="admin_email"   
                                                        />
                                                        <span class="form-text text-danger" id="admin_email_error"></span>

                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12 mb-1">
                                                      <label class="form-label" for="admin_phone">Admin Phone Number*</label>

                                                        <div class="input-group">

                                                            <input
                                                              type="text"
                                                              id="phone"
                                                              class="form-control"
                                                              value="{{$company->org_contact_person_number}}"
                                                              name="phone"
                                                             
                                                            />
                                                         
                                                        </div>
                                                        <span class="form-text text-danger" id="admin_phone_error"></span>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1" style="margin-top: 3px;">
                                                        <label class="form-label" for="password">Password
                                                          <button class="btn btn-sm btn-danger" type="button"  id="generate_password">+ Generate</button>
                                                        </label>
                                                          <div class="input-group">
                                                            <input
                                                              type="password"
                                                              class="form-control password"
                                                              name="password" 
                                                              id="password" 
                                                              value="{{($company != '' ? $company->password : '')}}" 
                                                            />
                                                            <span class="input-group-text togglePassword" id="">
                                                            <i data-feather="eye" style="cursor: pointer"></i>
                                                            </span>
                                                          </div>
                                                          <span class="form-text text-danger" id="admin_password_error"></span>

                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1 mt-1">
                                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                                          <div class="input-group">
                                                            <input
                                                              type="password"
                                                              class="form-control password"
                                                              name="confirm_password"
                                                              id="confirm_password"
                                                              placeholder="Enter confirm password"
                                                              value="{{($company != '' ? $company->password : '')}}"
                                                            />
                                                            <span class="input-group-text togglePassword" id="">
                                                            <i data-feather="eye" style="cursor: pointer"></i>
                                                            </span>
                                                          </div>
                                                        <span class="form-text text-danger" id="admin_confirm_password_error"></span>

                                                      </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="website">Website</label>
                                                        <input
                                                          type="url"
                                                          id="website"
                                                          class="form-control"
                                                          value="{{$company->website}}"
                                                          name="website"   
                                                        />
                                                        <span class="form-text text-danger" id="admin_web_error"></span>
                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="designation">Designation</label>
                                                        <input
                                                          type="text"
                                                          id="designation"
                                                          class="form-control"
                                                          value="{{$company->designation}}"
                                                          name="designation"
                                                        />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="gener_city">Office Address</label>
                                                        <input
                                                          type="text"
                                                          id="gener_city"
                                                          class="form-control alphaValue"
                                                          value="{{$company->org_city}}"
                                                          name="gener_city"   
                                                        />
                                                      </div>
                                                    </div>
                                                
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="gener_country">Country</label>
                                                        <select class="form-select" id="gener_country" name="gener_country">
                                                        <option value="">-- Country  --</option>
                                                        @if (count($countries) > 0)
                                                            @foreach ($countries as $cont)
                                                                <option {{$company->org_country_id == $cont->id ? 'selected' : ''}} value="{{ $cont->id }}">{{ $cont->name }}</option>
                                                            @endforeach
                                                        @endif
                                                        </select>
                                                        <span class="form-text text-danger" id="country_error"></span>

                                                      </div>
                                                    </div>


                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="gener_state">Emirates</label>
                                                        <select class="form-select" id="gener_state" name="gener_state">
                                                        <option value="">-- State --</option>

                                                        <option {{ $company->org_state == 1 ? 'selected' : '' }} value="1">Abu Dhabi</option>
                                                        <option {{ $company->org_state == 2 ? 'selected' : '' }} value="2">Dubai</option>
                                                        <option {{ $company->org_state == 3 ? 'selected' : '' }} value="3">Sharjah</option>
                                                        <option {{ $company->org_state == 4 ? 'selected' : '' }} value="4">Ajman</option>
                                                        <option {{ $company->org_state == 5 ? 'selected' : '' }} value="5">Umm Al Quwain</option>
                                                        <option {{ $company->org_state == 6 ? 'selected' : '' }} value="6">Ras Al Khaimah </option>
                                                        <option {{ $company->org_state == 7 ? 'selected' : '' }} value="7">Fujairah</option>

                                                        </select>
                                                        
                                                      </div>
                                                    </div> 
                                                    <div class="col-md-6 col-12">
                                                      <div class="mb-1">
                                                        <label class="form-label" for="org_phone">Business Phone Number</label>
                                                        <input
                                                          type="text"
                                                          id="org_phone"
                                                          class="form-control"
                                                          value="{{$company->org_phone}}"
                                                          name="org_phone"
                                                        />
                                                      </div>
                                                    </div>  
                                                  </div>
                                            
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </section>  
                  </div>

                  <div class="tab-pane fade" id="pills-KYC" role="tabpanel" aria-labelledby="pills-KYC-tab">
                                      <h4 class="card-title">KYC</h4>
                                      <hr>
                                      Bank Details  : (Optional)
                                          <section id="multiple-column-form">
                                            <div class="row">
                                              <div class="col-12">
                                                <div class="card"> 
                                                  <div class="card-body"> 
                                                    <div class="row">
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="bank_name">Bank Name</label>
                                                          <input
                                                            type="text"
                                                            id="bank_name"
                                                            class="form-control"
                                                            value=""
                                                            name="bank_name"   
                                                            placeholder="Enter Bank Name"
                                                          />
                                                          <span class="form-text text-danger" id="bank_name_error"></span>
                                                        </div>
                                                      </div>
                                                  
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="bic">BIC/SWIFT</label>
                                                          <input
                                                            type="text"
                                                            id="bic"
                                                            class="form-control"
                                                            value=""
                                                            name="bic"
                                                            placeholder="Enter BIC/SWIFT"
                                                          />
                                                          <span class="form-text text-danger" id="bic_error"></span>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="account_name">Account Name</label>
                                                          <input
                                                            type="text"
                                                            id="account_name"
                                                            class="form-control"
                                                            value=""
                                                            name="account_name"   
                                                            placeholder="Enter Account Name"
                                                          />
                                                          <span class="form-text text-danger" id="account_name_error"></span>
                                                        </div>
                                                      </div>
                                                  
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="iban">IBAN (Unique)</label>
                                                          <input
                                                            type="text"
                                                            id="iban"
                                                            class="form-control"
                                                            value=""
                                                            name="iban"
                                                            placeholder="Enter IBAN"
                                                          />
                                                          <span class="form-text text-danger" id="iban_error"></span>

                                                        </div>
                                                      </div>
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="account_no">Acount No. (Unique)</label>
                                                          <input
                                                            type="number"
                                                            id="account_no"
                                                            class="form-control"
                                                            value=""
                                                            name="account_no"   
                                                            placeholder="Enter Account No."
                                                          />
                                                          <span class="form-text text-danger" id="account_no_error"></span>

                                                        </div>
                                                      </div>
                                              
                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="b_currency">Currency</label>
                                                          <select class="form-select" id="b_currency" name="b_currency">
                                                              <option  value="AED">AED</option> 
                                                          </select>
                                                          <span class="form-text text-danger" id="b_currency_error"></span>

                                                        </div>
                                                      </div>


                                                      <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                          <label class="form-label" for="b_status">Status</label>
                                                          <select name="b_status" id="b_status" class="form-control">
                                                            <option value="0">Pending</option>

                                                          </select> 
                                                          <span class="form-text text-danger" id="status_error"></span>

                                                        </div>
                                                      </div>  
                                                      <div class="col-md-4 col-12">
                                                        <div class="mb-3">
                                                          <label class="form-label" >&nbsp;</label><br>
                                                          <button id="add" class="btn btn-icon btn-danger" type="button" data-repeater-create>
                                                          <i data-feather="plus" class="me-25"></i>
                                                          <span>Add Bank</span>
                                                          </button>
                                                          <button id="edit_btn" class="btn btn-icon btn-danger d-none" type="button" data-repeater-create>
                                                          <i data-feather="plus" class="me-25"></i>
                                                          <span>Edit Bank</span>
                                                          </button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 mb-4">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%">Id</th>
                                                                    <th>Bank Name</th>
                                                                    <th>BIC/SWIFT</th>
                                                                    <th>Account Name</th>
                                                                    <th>Account no.</th>
                                                                    <th>IBAN</th>
                                                                    <th>Currency</th>
                                                                    <th>Status</th>
                                                                    <th class="text-center" width="10%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody">
                                                            <input type="hidden" id="row_count" value="{{count($company->banks)}}">
                                                                @foreach($company->banks as $key => $bank)
                                                                <tr id="row_{{$bank->id}}">
                                                                      <td>{{$key+1}}<input type="hidden" name="d_id[]" value="{{$key+1}}"></td>
                                                                      <td>{{$bank->bank_name}}<input type="hidden" name="d_bank_name[]" value="{{$bank->bank_name}}"></td>
                                                                      <td>{{$bank->bic_code}}<input type="hidden" name="d_bic[]" value="{{$bank->bic_code}}"></td>
                                                                      <td>{{$bank->account_name}}<input type="hidden" name="d_account_name[]" value="{{$bank->account_name}}"></td>
                                                                      <td>{{$bank->account_no}}<input type="hidden" name="d_account_no[]" value="{{$bank->account_no}}"></td>
                                                                      <td>{{$bank->iban_code}}<input type="hidden" name="d_iban[]" value="{{$bank->iban_code}}"></td>
                                                                      <td>{{$bank->currency_id}}<input type="hidden" name="d_currency[]" value="{{$bank->currency_id}}"></td>
                                                                      <td>
                                                                        @if($bank->status == 0)
                                                                        <label class="label label-lg label-light-success label-inline">Pending</label> <input type="hidden" name="d_status[]" value="0"></td>

                                                                        @elseif($bank->status == 1)
                                                                        <label class="label label-lg label-light-success label-inline">Accepted</label> <input type="hidden" name="d_status[]" value="1"></td>

                                                                        @else
                                                                        <label class="label label-lg label-light-success label-inline">Rejected</label> <input type="hidden" name="d_status[]" value="2"></td>

                                                                        @endif
                                                                      <td>
                                                                          <input type="hidden" name="row_no" value="{{$key+1}}">
                                                                          <input type="hidden" name="e_id" value="{{$bank->id}}">
                                                                          <input type="hidden" name="bank_id" value="{{$bank->id}}">
                                                                          <input type="hidden" name="e_bank_name" value="{{$bank->bank_name}}">
                                                                          <input type="hidden" name="e_bic" value="{{$bank->bic_code}}">
                                                                          <input type="hidden" name="e_account_no" value="{{$bank->account_no}}">
                                                                          <input type="hidden" name="e_account_name" value="{{$bank->account_name}}">
                                                                          <input type="hidden" name="e_iban" value="{{$bank->iban_code}}">
                                                                          <input type="hidden" name="e_currency" value="{{$bank->currency_id}}">
                                                                          <input type="hidden" name="e_status" value="{{$bank->status}}">
                                                                          <div class="d-flex align-items-center col-actions"> 
                                                                          <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                                                              <span class="svg-icon svg-icon-md svg-icon-primary">
                                                                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                      <rect x="0" y="0" width="24" height="24"></rect>
                                                                                      <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                                                      <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                                  </g>
                                                                                  </svg>
                                                                              </span>
                                                                          </a>

                                                                          <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                                                                              <span class="svg-icon svg-icon-md svg-icon-danger">
                                                                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                      <rect x="0" y="0" width="24" height="24"></rect>
                                                                                      <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                                      <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                                                  </g>
                                                                              </svg>
                                                                              </span>
                                                                          </a>
                                                                          </div>
                                                                      </td>
                                                                  </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                  
                                            <h4 class="card-title">Documents</h4>
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
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="own_document1">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="own_document1"
                                                                  class="form-control filesize" 
                                                                  value=""  
                                                                  name="own_document1"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>
                                                                <select class="form-select" id="ow_document_type1" name="ow_document_type1">
                                                                    <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID - Front</option> 
                                                                    <option  value="3">Resident ID - Back</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select>
                                                              </div>
                                                            </div>
                                      
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="own_document2">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="own_document2"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="own_document2"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>
                                                                <select class="form-select" id="ow_document_type2" name="ow_document_type2">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID - Front</option> 
                                                                    <option  value="3">Resident ID - Back</option> 
                                                                    <option  value="4">Other</option> 
                                                                  </select>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="own_document3">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="own_document3"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="own_document3"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>
                                                                <select class="form-select" id="ow_document_type3" name="ow_document_type3">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID - Front</option> 
                                                                    <option  value="3">Resident ID - Back</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="own_document4">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="own_document4"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="own_document4"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>
                                                                <select class="form-select" id="ow_document_type4" name="ow_document_type4">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID - Front</option> 
                                                                    <option  value="3">Resident ID - Back</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select>
                                                              </div>
                                                            </div> 
                                                             

                                                          </div>
                                                          @if($company->kycDetail->ow_document1 || $company->kycDetail->ow_document2 || $company->kycDetail->ow_document3 || $company->kycDetail->ow_document4) 
                                                          <div class="">
                                                            <table class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th>File</th>
                                                                        <th>Type</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="doc_body1">
                                                                  @if($company->kycDetail->ow_document1)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ow_document1}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ow_document1}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ow_document1}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->ow_doc_type1 == 1)
                                                                        <span>Passport ID</span>
                                                                      @elseif($company->kycDetail->ow_doc_type1 == 2)
                                                                        <span>Resident ID - Front</span>
                                                                      @elseif($company->kycDetail->ow_doc_type1 == 3)
                                                                        <span>Resident ID - Back</span>
                                                                      @elseif($company->kycDetail->ow_doc_type1 == 4)
                                                                        <span>Other</span>
                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ow_document1}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ow_document1')" ><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->ow_document2)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ow_document2}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ow_document2}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ow_document2}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->ow_doc_type2 == 1)
                                                                        <span>Passport ID</span>
                                                                      @elseif($company->kycDetail->ow_doc_type2 == 2)
                                                                        <span>Resident ID - Front</span>
                                                                      @elseif($company->kycDetail->ow_doc_type2 == 3)
                                                                        <span>Resident ID - Back</span>
                                                                      @elseif($company->kycDetail->ow_doc_type2 == 4)
                                                                        <span>Other</span>
                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ow_document2}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ow_document2')"><i class="flaticon-delete" ></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif
                                                                  
                                                                  @if($company->kycDetail->ow_document3)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ow_document3}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ow_document3}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ow_document3}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->ow_doc_type3 == 1)
                                                                        <span>Passport ID</span>
                                                                      @elseif($company->kycDetail->ow_doc_type3 == 2)
                                                                        <span>Resident ID - Front</span>
                                                                      @elseif($company->kycDetail->ow_doc_type3 == 3)
                                                                        <span>Resident ID - Back</span>
                                                                      @elseif($company->kycDetail->ow_doc_type3 == 4)
                                                                        <span>Other</span>
                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ow_document3}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ow_document3')"><i class="flaticon-delete" ></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->ow_document4)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ow_document4}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ow_document4}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ow_document4}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->ow_doc_type4 == 1)
                                                                        <span>Passport ID</span>
                                                                      @elseif($company->kycDetail->ow_doc_type4 == 2)
                                                                        <span>Resident ID - Front</span>
                                                                      @elseif($company->kycDetail->ow_doc_type4 == 3)
                                                                        <span>Resident ID - Back</span>
                                                                      @elseif($company->kycDetail->ow_doc_type4 == 4)
                                                                        <span>Other</span>
                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ow_document4}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ow_document4')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                          @endif
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
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document1">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="bu_document1"
                                                                  class="form-control filesize" 
                                                                  value=""  
                                                                  name="bu_document1"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document_type_1">Document Type</label>
                                                                <!-- <select class="form-select" id="bu_document_type_1" name="bu_document_type_1">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID</option> 
                                                                    <option  value="3">License ID</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select> -->

                                                                  <input class="form-control" type="text" name="" id="" value="License *" readonly>
                                                                  <input class="form-control" type="hidden" name="bu_document_type_1" id="bu_document_type_1" value="1" >

                                                              </div>
                                                            </div>
                                        
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document2">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="bu_document2"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="bu_document2"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document_type_2">Document Type</label>
                                                                <!-- <select class="form-select" id="bu_document_type_2" name="bu_document_type_2">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID</option> 
                                                                    <option  value="3">License ID</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select> -->

                                                                  <input class="form-control" type="text" name="" id="" value="MoA *" readonly>
                                                                  <input class="form-control" type="hidden" name="bu_document_type_2" id="bu_document_type_2" value="2" >
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document3">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="bu_document3"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="bu_document3"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document_type_3">Document Type</label>
                                                                <!-- <select class="form-select" id="bu_document_type_3" name="bu_document_type_3">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID</option> 
                                                                    <option  value="3">License ID</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select> -->

                                                                  <input class="form-control" type="text" name="" id="" value="Share certificate" readonly>
                                                                  <input class="form-control" type="hidden" name="bu_document_type_3" id="bu_document_type_3" value="3" >
                                                              </div>
                                                            </div>

                                                            <!-- Do you have tax certificate section -->
                                                            <div class="col-md-12 col-12 mb-1">

                                                              <label class="form-label mb-1 mt-1" for="user-name-column"> Do you have tax certificate?</label>
                                                              <br>

                                                              <div class="row "> 

                                                                  <div class="col-md-4 col-12">
                                                                    <div class="  ">
                                                                        <input
                                                                            class="form-check-input ml-1 tax_document_check_box"
                                                                            type="radio"
                                                                            name="tax_document_check_box"
                                                                            id="tax_document_check_box1"
                                                                            value="1" 
                                                                            {{$company->kycDetail->tax_document_check_box == 1 ? 'checked' : ''}}
                                                                          />

                                                                        <label class="form-label" for="user-name-column">Yes</label>

                                                                    </div> 
                                                                  </div>

                                                                  <div class="col-md-4 col-12">
                                                                    <div class="  ">
                                                                      <input
                                                                      class="form-check-input ml-1 tax_document_check_box"
                                                                      type="radio"
                                                                      name="tax_document_check_box"
                                                                      id="tax_document_check_box2"
                                                                      value="0"  
                                                                      {{$company->kycDetail->tax_document_check_box == 0 ? 'checked' : ''}}
                                                                      />
                                                                    <label class="form-label" for="user-name-column">No</label>


                                                                    </div>
                                                                  </div> 

                                                                  <div class="col-md-4 col-12 ">

                                                                  <a id="tax_cert_button" class=" {{$company->kycDetail->tax_document_check_box == 1 ? 'd-none' : ''}} btn btn-primary" role="button" download="tax_certificate.pdf" href="/public/company/template/TaxCertificateTemplate.pdf">
                                                                    Download Template
                                                                  </a>

                                                                  </div> 

                                                                  <div class="col-md-4 col-12 mt-2 mb-1">
                                                                    <label class="form-label" for="trn_number">TRN Number</label>
                                                                    <input
                                                                          type="text"
                                                                          id="trn_number"
                                                                          class="form-control"
                                                                          value="{{$company->moreInfo->trn_number}}"
                                                                          placeholder=" "
                                                                          name="trn_number"   
                                                                        />
                                                                  </div> 

                                                              </div> 
                                                              </div> 

                                                            <!-- tax certificate section end -->


                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document4">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="bu_document4"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="bu_document4"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>
                                                                <!-- <select class="form-select" id="bu_document_type_4" name="bu_document_type_4">
                                                                <option  value="">--Select Type--</option> 
                                                                    <option  value="1">Passport ID</option> 
                                                                    <option  value="2">Resident ID</option> 
                                                                    <option  value="3">License ID</option> 
                                                                    <option  value="4">Other</option> 

                                                                  </select> -->

                                                                  <input class="form-control" type="text" name="" id="" value="Tax Certificate" readonly>
                                                                  <input class="form-control" type="hidden" name="bu_document_type_4" id="bu_document_type_4" value="4" >
                                                              </div>
                                                            </div> 


                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="bu_document5">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="bu_document5"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="bu_document5"
                                                                />
                                                              </div>
                                                            </div>


                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="last-name-column">Document Type</label>

                                                                  <input class="form-control" type="text" name="" id="" value="Proof of Bank Account" readonly>
                                                                  <input class="form-control" type="hidden" name="bu_document_type_5" id="bu_document_type_5" value="5" >

                                                              </div>
                                                            </div> 

                                                             
                                                          </div>

                                                          @if($company->kycDetail->bu_document1 || $company->kycDetail->bu_document2 || $company->kycDetail->bu_document3 || $company->kycDetail->bu_document4 || $company->kycDetail->bu_document5) 
                                                          <div class="">
                                                            <table class="table table-bordered text-center bd">
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th>File</th>
                                                                        <th>Type</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="doc_body2">
                                                                  @if($company->kycDetail->bu_document1)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->bu_document1}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->bu_document1}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->bu_document1}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->bu_doc_type1 == 1)
                                                                        <span>License</span>

                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->bu_document1}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'bu_document1')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->bu_document2)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->bu_document2}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->bu_document2}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->bu_document2}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->bu_doc_type2 == 2)
                                                                        <span>MoA</span>

                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->bu_document2}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'bu_document2')" ><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->bu_document3)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->bu_document3}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->bu_document3}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->bu_document3}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->bu_doc_type3 == 3)
                                                                        <span>Share certificate</span>

                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->bu_document3}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'bu_document3')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->bu_document4)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->bu_document4}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->bu_document4}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->bu_document4}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->bu_doc_type4 == 4)
                                                                        <span>Tax Certificate</span>

                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->bu_document4}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'bu_document4')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->bu_document5)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->bu_document5}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->bu_document5}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->bu_document5}}
                                                                      </td>
                                                                      <td>
                                                                      @if($company->kycDetail->bu_doc_type5 == 5)
                                                                        <span>Tax Certificate</span>

                                                                      @endif
                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->bu_document5}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'bu_document5')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                </tbody>
                                                            </table>
                                                          </div>
                                                          @endif
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
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document1">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="ot_document1"
                                                                  class="form-control filesize" 
                                                                  value=""  
                                                                  name="ot_document1"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document_type_1">Document Type</label>
                                                                <input type="text" class="form-control" id="ot_document_type_1" name="ot_document_type_1">

                                                              </div>
                                                            </div>
                                      
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document2">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="ot_document2"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="ot_document2"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document_type_2">Document Type</label>
                                                                <input type="text" class="form-control" id="ot_document_type_2" name="ot_document_type_2">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document3">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="ot_document3"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="ot_document3"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document_type_3">Document Type</label>
                                                                <input type="text" class="form-control" id="ot_document_type_3" name="ot_document_type_3">
                                                              </div>
                                                            </div> 
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document4">Upload Document</label>
                                                                <input
                                                                  type="file"
                                                                  id="ot_document4"
                                                                  class="form-control filesize"
                                                                  value=""  
                                                                  name="ot_document4"
                                                                />
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="ot_document_type_4">Document Type</label>
                                                                <input type="text" class="form-control" id="ot_document_type_4" name="ot_document_type_4">
                                                              </div>
                                                            </div>  
                                                             
                                                                
                                                          </div> 
                                                          @if($company->kycDetail->ot_document1 || $company->kycDetail->ot_document2 || $company->kycDetail->ot_document3 || $company->kycDetail->ot_document4) 

                                                          <div class="">
                                                            <table class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th>File</th>
                                                                        <th>Type</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="doc_body3">
                                                                  @if($company->kycDetail->ot_document1)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ot_document1}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ot_document1}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ot_document1}}
                                                                      </td>
                                                                      <td>
                                                                        <span>{{$company->kycDetail->ot_doc_type1}}</span>

                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ot_document1}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ot_document1')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->ot_document2)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ot_document2}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ot_document2}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ot_document2}}
                                                                      </td>
                                                                      <td>
                                                                        <span>{{$company->kycDetail->ot_doc_type2}}</span>

                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ot_document2}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ot_document2')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->ot_document3)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ot_document3}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ot_document3}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ot_document3}}
                                                                      </td>
                                                                      <td>
                                                                        <span>{{$company->kycDetail->ot_doc_type3}}</span>

                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ot_document3}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ot_document3')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif

                                                                  @if($company->kycDetail->ot_document4)
                                                                  <tr>
                                                                      <td>
                                                                      <a href="/public/company/docs/{{$company->kycDetail->ot_document4}}" target="_blank"><img src="/public/company/docs/{{$company->kycDetail->ot_document4}}" class="h-75px doc_image align-self-end img-border" width="100px" height="100px" alt=""></a>

                                                                      </td>
                                                                      <td>
                                                                        {{$company->kycDetail->ot_document4}}
                                                                      </td>
                                                                      <td>
                                                                        <span>{{$company->kycDetail->ot_doc_type4}}</span>

                                                                      </td>
                                                                      <td nowrap="nowrap">
                                                                          <a href="/public/company/docs/{{$company->kycDetail->ot_document4}}" target="_blank" class="btn btn-info">
                                                                              <i class="flaticon-eye"></i> View
                                                                          </a>
                                                                          <button type="button" class="btn btn-danger mr-4 doc_delete" onclick="deleteDocument({{ $company->kycDetail->id }}, 'ot_document4')"><i class="flaticon-delete"></i> Delete</button>
                                                                      </td>
                                                                  </tr>
                                                                  @endif
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                          @endif
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </section> 
                                              </div>
                                            </div> 
                                          </section>
                  </div> 
                          
                  <div class="tab-pane fade" id="pills-More_Information" role="tabpanel" aria-labelledby="pills-More_Information-tab">
                                    <section id="multiple-column-form">
                                      <div class="row">
                                        <div class="col-12">
                                          <div class="card"> 
                                            <div class="card-body"> 
                                                <h4 class="card-title">More Information</h4>
                                                <hr>
                                                  
                                            </div>
                                            <div class="row">
                                              <div class="col-12">
                                                <div class="card"> 
                                                  <div class="card-body">



                                                        <!-- payout setup section start -->
                                    <h4 class="card-title mt-1" >Payout Setup:</h4><hr>
                                    <div class="row"> 

                                      <div class="col-md-6 mb-2">

                                      <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input payout_setup"
                                              type="radio"
                                              name="payout_setup"
                                              id="payout_setup"
                                              value="1"   
                                              {{$company->subscription->payout_setup == 1 ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Auto</label>
                                          </div>

                                      </div>

                                      <div class="col-md-6 mb-2">

                                        <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input payout_setup"
                                              type="radio"
                                              name="payout_setup"
                                              id="payout_setup"
                                              value="0"   
                                              {{$company->subscription->payout_setup == 0 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">Manual</label>
                                          </div>

                                      </div>

                                        <div class="col-md-6 col-12 payout_setup_auto ">
                                          
                                          <div class="mb-3">

                                            <label class="form-label" for="withdraw_limit">Withdraw limit</label>
                                            <select class="form-select" id="kt_select2_1" name="withdraw_limit">
                                            <option value="">---select days---</option>
                                            @for ($i = 0; $i <= 30; $i++)
                                              <option value="{{ $i }}" {{ $company->moreInfo->withdraw_limit == $i ? 'selected' : '' }}>{{ $i == 0 ? "Same Time" : $i }}</option>
                                            @endfor

                                            </select>
                                            <span class="form-text text-danger" id="widthdraw_limit_error"></span>
                                        </div>

                                        </div>

                                        <div class="col-md-6 col-12 payout_setup_auto " >
                                          <div class="mb-3">
                                            <label class="form-label" for="available_limit">Available for Withdrawal</label>
                                            <select class="form-select" id="kt_select2_2" name="available_limit">
                                            <option value="">---select days---</option>
                                            @for ($i = 0; $i <= 30; $i++)
                                              <option value="{{ $i }}" {{ $company->moreInfo->available_limit == $i ? 'selected' : '' }}>{{ $i == 0 ? "Same Time" : $i }}</option>
                                            @endfor

                                              </select>
                                              <span class="form-text text-danger" id="available_limit_error"></span>
                                          </div>
                                        </div>

                                    <!-- paytabs info section start -->
                                    <h4 class="card-title mt-1" >Paytabs Info:</h4><hr>

                                        <div class="col-md-6 col-12">
                                          <div class="mb-1">
                                            <label class="form-label" for="profile_id">Profile Id</label>
                                            <input
                                              type="text"
                                              id="profile_id"
                                              class="form-control"
                                              value="{{$company->moreInfo->profile_id}}"  
                                              name="profile_id"
                                              placeholder="Enter Profile Id"
                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                          <div class="mb-1">
                                            <label class="form-label" for="server_key">Server Key</label>
                                            <input
                                              type="text"
                                              id="server_key"
                                              class="form-control"
                                              value="{{$company->moreInfo->server_key}}"  
                                              name="server_key"
                                              placeholder="Enter Server Key"
                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                          <div class="mb-1">
                                            <label class="form-label" for="company_prefix">Company Prefix 
                                              <button class="btn btn-sm btn-danger" type="button" style="margin-top: 3px;" id="generate_company_prefix">
                                                + Generate
                                                </button>
                                            </label>
                                            <input
                                              type="text"
                                              id="company_prefix"
                                              class="form-control"
                                              value="{{$company->moreInfo->company_prefix}}"  
                                              name="company_prefix"
                                              placeholder="maximum 3 characters"

                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                          <div class="mb-1 mt-1">
                                            <label class="form-label" for="last-name-column"></label>
                                            <input
                                              type="text"
                                              class="form-control"
                                              value=""  readonly
                                              placeholder="5"
                                              style="margin-top:17px"
                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                          <div class="mb-1 mt-1">
                                            <label class="form-label" for="account_type">Account Type</label>
                                            <select class="form-select" id="account_type" name="account_type" >
                                                <option  value="" >--Select account type--</option> 
                                                <option {{$company->moreInfo->account_type_id == 1 ? 'selected' : ''}}  value="1" >Live</option> 
                                                <option {{$company->moreInfo->account_type_id == 2 ? 'selected' : ''}}  value="2" >Sanbox</option> 
                                              </select>
                                          </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                          <div class="mb-1">
                                            <label class="form-label" for="more_info_currency">Currency</label>
                                            <select class="form-select" id="more_info_currency" name="more_info_currency">
                                                <option  {{$company->moreInfo->currency_id == 1 ? 'selected' : ''}}  value="1">AED</option> 

                                              </select>
                                          </div>
                                        </div>  

                                  
                                    </div>
                                    <!-- payout setup section end -->

                              <h4 class="card-title">Email Package: (Optional) </h4><hr>
                              
                              <div class="row"><!-- email package row start -->

                                <div class="col-6 mb-1">
                                  Branded Pay Page 
                                </div>

                                <div class="col-6 mb-1">
                                  Branded Email 
                                </div>

                                <div class="col-md-6 col-6 mb-2">
                                    <label class="switch">
                                    <input type="checkbox" id="branded_pay_page" name="branded_pay_page" value="1" {{$company->moreInfo->branded_pay_1 == 1 ? 'checked' : ''}}>
                                    <div class="slider round"></div>
                                    </label>
                                </div>


                                <div class="col-md-6 col-6 mb-2">

                                      <label class="switch">
                                      <input type="checkbox" id="branded_email" name="branded_email" value="1" {{$company->moreInfo->branded_pay_2 == 1 ? 'checked' : ''}}>
                                      <div class="slider round"></div>
                                      </label>  
                                </div>


                              </div><!-- email package row close -->

                                      <h4 class="card-title">SMS Package: (Optional) </h4><hr>
                                    <div class="row"> <!-- sms package row start -->

                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="sender_id_by_name">Sender Id By Name</label>
                                          <input
                                            type="text"
                                            id="sender_id_by_name"
                                            class="form-control"
                                            value="{{$company->moreInfo->sender_id}}"
                                            placeholder="Rental 360"
                                            name="sender_id_by_name"
                                          />
                                        </div>
                                      </div>

                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="api_key">Api Key</label>
                                          <input
                                            type="text"
                                            id="api_key"
                                            class="form-control"
                                            value="{{$company->moreInfo->api_key}}"
                                            placeholder="C76576JKHGJKHKU87897IUIO"
                                            name="api_key"   
                                          />
                                        </div>
                                      </div>
                                  
                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="sms_limit">SMS Limit</label>
                                          <select class="form-select" id="sms_limit" name="sms_limit">
                                              <option {{$company->moreInfo->sms_limit == 100 ? 'checked' : ''}} value="100">100</option>  
                                              <option {{$company->moreInfo->sms_limit == 50 ? 'checked' : ''}} value="50">50</option> 
                                              <option {{$company->moreInfo->sms_limit == 20 ? 'checked' : ''}} value="20">20</option> 
                                            </select>
                                        </div>
                                      </div>

                                    </div><!-- sms package row end -->    
                                    
                                    <!--end-->


                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                    </section>
                  </div>
                  <div class="tab-pane fade" id="pills-Permission" role="tabpanel" aria-labelledby="pills-Permission-tab">
                    <div class="card-body p-0">
                      <div class="table-responsive">

                        <table class="table mb-2" >
                          <thead>
                            <tr>
                              <th>MODULE</th>
                              <th>SUBMODULE</th>
                                
                            </tr>
                          </thead>
                          <tbody>

                              @foreach($menus as $key => $menu)
                                <tr>
                                  <td>
                                    <div class="d-flex align-items-center"> 
                                    <div class="form-check-inline">
                                            <input class="form-check-input module" data-id="{{$key}}" name="menu[]" type="checkbox" id="menu" value="{{$menu->id}}" {{ in_array($menu->id, $inserted_menu) ? 'checked' : '' }} readonly/>
                                          <label class="form-check-label" for="menu">{{$menu->name}}</label>
                                          
                                    </div>
                                    </div>
                                  </td>

                                  

                                  <td>

                                  @foreach($menu->sub_menu as $sub_menu)
                                    <div class="d-flex align-items-center"> 
                                    <div class="form-check-inline">
                                        <input class="form-check-input sub_module{{$key}}" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="sub_menu" value="{{$sub_menu->id}}" {{ in_array($sub_menu->id, $inserted_subMenu) ? 'checked' : '' }} readonly/>
                                        <label class="form-check-label mb-1" for="sub_menu">{{$sub_menu->name}}</label>
                                        
                                    </div>
                                    </div>
                                  @endforeach

                                  </td>
                                  
                                  
                                </tr>
                                @endforeach

                          </tbody>

                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-Subscription" role="tabpanel" aria-labelledby="pills-Subscription-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body"> 
                                <h4 class="card-title">Create Subscription</h4>
                                <hr>
                                <div class="form-check form-check-inline mt-1">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="company_profile"
                                  id="company_profile"
                                  value="1" 
                                  {{$company->moreInfo->company_profile == 1 ? 'checked' : ''}}
                                />
                                <label class="form-check-label" for="company_profile_tokenise">Tokenise</label>
                              </div> 
                              <div class="form-check form-check-inline mt-1">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="company_profile"
                                  id="company_profile"
                                  value="2"  {{$company->moreInfo->company_profile == 2 ? 'checked' : ''}}
                                />
                                <label class="form-check-label" for="company_profile_normal">Normal</label>
                              </div> <br><br> <br><br> 

                                <div class="row"> 
                                      <div class="col-md-12 col-12 mb-1">
                                          <label class="form-label" for="billing_plan">Biling Plan</label>

                                          <select class="form-select" id="billing_plan" name="billing_plan">
                                            <option value="">---Select Plan---</option>

                                            @foreach($plans as $plan)

                                              <option {{$company->subscription->billing_plan == $plan->id ? 'selected' : ''}} value="{{$plan->id}}">{{$plan->plan_name}}</option> 

                                            @endforeach
                                          </select>

                                      </div>
                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="add_on_charge">Add On Charge</label>
                                          <input
                                            type="number"
                                            id="add_on_charge"
                                            class="form-control"
                                            value="{{$company->subscription->add_on_charge}}"
                                            name="add_on_charge"   
                                            placeholder="AED"
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="deposit">Deposit</label>
                                          <input
                                            type="number"
                                            id="deposit"
                                            class="form-control"
                                            value="{{$company->subscription->diposit}}"
                                            placeholder="AED"
                                            name="deposit"   
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="convenience_fees_type">Convenience Fees Type</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="convenience_fees_type"
                                              id="convenience_fees_type1"
                                              value="1" 
                                              {{$company->subscription->convenience_type == 1 ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="convenience_fees_type"
                                              id="convenience_fees_type2"
                                              value="2"  
                                              {{$company->subscription->convenience_type == 2 ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="convenience_fees_type"
                                              id="convenience_fees_type3"
                                              value="3"   
                                              {{$company->subscription->convenience_type == 3 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="user-name-column">Convenience Amount</label>
                                          <input
                                            type="number"
                                            id="convenience_amount"
                                            class="form-control"
                                            value="{{($company->subscription->convenience_type == 3 ? '' : $company->subscription->convenience_amount)}}"
                                            placeholder=""
                                            name="username"   
                                            {{$company->subscription->convenience_type == 3 ? 'readonly' : ''}}
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1"> 
                                        </div>
                                      </div>


                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="user-name-column">Commission Fees Type</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="commision_fees_type"
                                              id="commision_fees_type1"
                                              value="1" 
                                              {{$company->subscription->commission_type == 1 ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="commision_fees_type"
                                              id="commision_fees_type2"
                                              value="2"  
                                              {{$company->subscription->commission_type == 2 ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="commision_fees_type"
                                              id="commision_fees_type3"
                                              value="3"   
                                              {{$company->subscription->commission_type == 3 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="user-name-column">Commission Amount</label>
                                          <input
                                            type="number"
                                            id="commission_amount"
                                            class="form-control"
                                            value="{{($company->subscription->commission_type == 3 ? '' : $company->subscription->commission_amount)}}"
                                            placeholder=""
                                            name="commission_amount"   
                                            {{$company->subscription->commission_type == 3 ? 'readonly' : ''}}
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1"> 
                                        </div>
                                      </div>

                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="user-name-column">Withdrawal Charges Add</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="withdrawal_charge_add"
                                              id="withdrawal_charge_add1"
                                              value="1" 
                                              {{$company->subscription->withdrawal_type == 1 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="withdrawal_charge_add"
                                              id="withdrawal_charge_add2"
                                              value="2"  
                                              {{$company->subscription->withdrawal_type == 2 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="withdrawal_charge_add"
                                              id="withdrawal_charge_add3"
                                              value="3"   
                                              {{$company->subscription->withdrawal_type == 3 ? 'checked' : ''}}

                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label mb-1" for="withdrawal_charge_amt">Withdrawal Charges Amount</label>
                                          <input
                                            type="number"
                                            id="withdrawal_charge_amt"
                                            class="form-control"
                                            value="{{($company->subscription->withdrawal_type == 3 ? '' : $company->subscription->withdrawal_amount)}}"
                                            placeholder=""
                                            name="withdrawal_charge_amt"   
                                            {{$company->subscription->withdrawal_type == 3 ? 'readonly' : ''}}
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1"> 
                                        </div>
                                      </div>  
                                </div> 
                                <label class="form-label mb-1 mt-1" for="user-name-column"> Payment Gateway Changes</label>
                                <br>
                                  <div class="row mb-1"> <!-- payment gateway row start -->

                                  <div class="col-8"><!-- col-8 start -->

                                    <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                        <div class="mb-1 mt-2 ">

                                            <input
                                                class="form-check-input ml-1 payment_gateway_charge"
                                                type="checkbox"
                                                data-id="1"
                                                name="payment_gateway_charge[]"
                                                id="payment_gateway_charge1"
                                                value="1"  
                                                {{in_array('1',$payment_gateway_array) ? 'checked' : ''}}
                                              />

                                          <label class="form-label" for="user-name-column">Visa/Mastercard</label>


                                        </div> 
                                      </div>

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga1 "
                                          type="text"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount"
                                          placeholder="%"
                                          value="{{array_key_exists('1',$padd_array) ? $padd_array[1] : ''}}"
                                          {{in_array('1',$payment_gateway_array) ? '' : 'readonly="readonly"'}}
                                        />

                                      </div> 

                                    </div> <!-- row end -->

                                  </div><!-- col-8 end -->

                                  <div class="col-8"><!-- col-8 start -->

                                    <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                              <div class="mb-1 mt-2 ">

                                              <input
                                                class="form-check-input ml-1 payment_gateway_charge"
                                                type="checkbox"
                                                data-id="2"
                                                name="payment_gateway_charge[]"
                                                id="payment_gateway_charge2"
                                                value="2"  
                                                {{in_array('2',$payment_gateway_array) ? 'checked' : ''}}
                                              />

                                              <label class="form-label" for="user-name-column">Amex</label>


                                              </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga2 "
                                          type="text"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount"
                                          placeholder="%"
                                          value="{{array_key_exists('2',$padd_array) ? $padd_array[2] : ''}}"
                                          {{in_array('2',$payment_gateway_array) ? '' : 'readonly="readonly"'}}
                                        />

                                      </div> 

                                    </div> <!-- row end -->

                                  </div><!-- col-8 end -->


                                  <div class="col-8"><!-- col-8 start -->

                                    <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                              <div class="mb-1 mt-2 ">

                                              <input
                                                class="form-check-input ml-1 payment_gateway_charge"
                                                type="checkbox"
                                                data-id="3"
                                                name="payment_gateway_charge[]"
                                                id="payment_gateway_charge3"
                                                value="3"  
                                                {{in_array('3',$payment_gateway_array) ? 'checked' : ''}}
                                              />

                                              <label class="form-label" for="user-name-column">Binance Pay</label>


                                              </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga3 "
                                          type="text"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount"
                                          placeholder="%"
                                          value="{{array_key_exists('3',$padd_array) ? $padd_array[3] : ''}}"
                                          {{in_array('3',$payment_gateway_array) ? '' : 'readonly="readonly"'}}
                                        />

                                      </div> 

                                      </div> <!-- row end -->

                                  </div><!-- col-8 end -->

                                  <div class="col-8"><!-- col-8 start -->

                                    <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                              <div class="mb-1 mt-2 ">

                                              <input
                                                class="form-check-input ml-1 payment_gateway_charge"
                                                type="checkbox"
                                                data-id="4"
                                                name="payment_gateway_charge[]"
                                                id="payment_gateway_charge4"
                                                value="4"  
                                                {{in_array('4',$payment_gateway_array) ? 'checked' : ''}}
                                              />

                                              <label class="form-label" for="user-name-column">Spotii</label>


                                              </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga4 "
                                          type="text"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount"
                                          placeholder="%"
                                          value="{{array_key_exists('4',$padd_array) ? $padd_array[4] : ''}}"
                                          {{in_array('4',$payment_gateway_array) ? '' : 'readonly="readonly"'}}
                                        />

                                      </div> 

                                      </div> <!-- row end -->

                                  </div><!-- col-8 end -->

                                  <div class="col-8"><!-- col-8 start -->

                                    <div class="row"><!-- row start -->


                                      <div class="col-md-6 col-6">

                                              <div class="mb-1 mt-2 ">

                                              <input
                                                class="form-check-input ml-1 payment_gateway_charge"
                                                type="checkbox"
                                                data-id="5"
                                                name="payment_gateway_charge[]"
                                                id="payment_gateway_charge5"
                                                value="5"  
                                                {{in_array('5',$payment_gateway_array) ? 'checked' : ''}}
                                              />

                                              <label class="form-label" for="user-name-column">Tabby</label>


                                              </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga5 "
                                          type="text"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount"
                                          value="{{array_key_exists('5',$padd_array) ? $padd_array[5] : ''}}"
                                          placeholder="%"
                                          {{in_array('5',$payment_gateway_array) ? '' : 'readonly="readonly"'}}
                                        />

                                      </div> 

                                    </div> <!-- row end -->

                                  </div><!-- col-8 end -->

                                  </div><!-- payment gateway row start -->


                                  <div class="row"> 

                                    <div class="col-md-4 col-4">
                                      <div class="mb-1">
                                        <div class="mb-1">
                                          <label class="form-label" for="first_billing_date">First Billing Date</label>
                                          <input type="date" value="{{$company->subscription->first_billing_date}}" class="form-control picker" name="first_billing_date" id="first_billing_date" />
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col-4">
                                      <div class="mb-1">
                                        <div class="mb-1">
                                          <label class="form-label" for="end_billing_date">End Billing Date</label>
                                          <input type="date" class="form-control" value="{{$company->subscription->end_billing_date}}" name="end_billing_date" id="end_billing_date" {{$company->subscription->auto_renewal == 1 ? "" : "readonly='readonly'" }} />
                                        </div>
                                      </div>

                                    </div>

                                    <div class="col-md-4 col-4 mt-2">

                                    <input
                                      class="form-check-input ml-1"
                                      type="checkbox"
                                      name="auto_renewal"
                                      id="auto_renewal"
                                      {{$company->subscription->auto_renewal == 1 ? 'checked' : ''}}
                                      style=" margin-top: 10px;"
                                    />
                                    <label class="form-label" for="auto_renewal" style=" margin-top: 10px;">Auto Renewal</label>

                                    </div> 

                                    



                                    <div class="col-md-12 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="description">Description & Details</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" style="resize:none">{{$company->subscription->description}}</textarea> 
                                      </div>
                                    </div> 
                                  </div> 

                                  <div class="">
                                    <input type="checkbox" class="form-check-input" id="desc_in_invoice" name="desc_in_invoice" {{$company->subscription->include_description == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="colorCheck2">Include Description in Invoice Item</label>
                                  </div>

                                  <br><br>
                                  <div class="row"> 

                                    <div class="col-md-4 col-12">
                                      <div class="mb-2">
                                        <label class="form-label" for="subs_currency">Currency</label>
                                        <select class="form-select" id="subs_currency" name="subs_currency">
                                            <option {{$company->subscription->currency == 1 ? 'selected' : ''}}  value="1">AED</option> 

                                          </select>
                                      </div>
                                    </div> 

                                    <div class="col-md-12 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="subs_term_cond">Terms & Conditions</label>
                                        <textarea class="form-control" id="subs_term_cond" name="subs_term_cond" rows="3" style="resize:none">{{$company->subscription->term_condition}}</textarea> 
                                      </div>
                                    </div> 
                                  </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </section> 
                  </div>


                  <hr>
                <div class="text-end ">

                  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                      <button class="nav-link active first_tab" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#pills-General" type="button" role="tab" aria-controls="pills-General" aria-selected="true">General</button>
                      </li>
                      <li class="nav-item" role="presentation">
                      <button class="nav-link second_tab" id="pills-KYC-tab" data-bs-toggle="pill" data-bs-target="#pills-KYC" type="button" role="tab" aria-controls="pills-KYC" aria-selected="false">KYC</button>
                      </li>
                      <li class="nav-item" role="presentation">
                      <button class="nav-link third_tab" id="pills-More_Information-tab" data-bs-toggle="pill" data-bs-target="#pills-More_Information" type="button" role="tab" aria-controls="pills-More_Information" aria-selected="false">More Information</button>
                      </li>
                      <li class="nav-item" role="presentation">
                      <button class="nav-link fourth_tab" id="pills-Permission-tab" data-bs-toggle="pill" data-bs-target="#pills-Permission" type="button" role="tab" aria-controls="pills-Permission" aria-selected="false">Permission</button>
                      </li>
                      <li class="nav-item" role="presentation">
                      <button class="nav-link five_tab" id="pills-Subscription-tab" data-bs-toggle="pill" data-bs-target="#pills-Subscription" type="button" role="tab" aria-controls="pills-Subscription" aria-selected="false">Subscription</button>
                      </li>
                  </ul>

                </div>
                <hr>

                <div class="text-center">
                <button  id="save" name="save" type="save" class="btn btn-danger me-1 btn-form-block" onclick="showDiv()">Submit</button>
                </div>  

                </div>  
              </div> 
            </div> 
                  

                </div>
              </div>   
            </div>  

        </div> 
      </div>
    </div>
  </div>
</section>
<!--   -->

@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
 <script src="{{ asset('js/scripts/pages/app-company-edit.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script> 
 <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">

  
  $(document).ready(function(){
    $('.filesize').on('change', function() {
      const size =
         (this.files[0].size / 1024 / 1024).toFixed(2);

      if (size > 2) {
        swal.fire("File must be between the size of 2 MB");
      } else {
          $("#output").html('<b>' +
             'This file size is: ' + size + " MB" + '</b>');
      }
    });
    });


function deleteDocument(id, document_name) {

    $.ajax({  
      url:"../documents/delete",
            method:"POST",
            data:{id, document_name, "_token": $('#token').val()},

      success:function(data)
      {
        if(data == 'true') {
          console.log('success')

        }
      }
    })
}


function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 ){
        e.preventDefault();
    }

    function showDiv() {
  document.getElementById('submit');
  document.getElementById('loadingGif').style.display = "block";
  setTimeout(function() {
    document.getElementById('loadingGif').style.display = "none";
    document.getElementById('showme').style.display = "block";
  },3000);}
}



</script>
<style>

    .loadering{
    position: absolute;
    top:142px;
    right:0px;
    width:100%;
    height:100%;
    background-color:#ffffff8a;
    /* background-image:url({{asset('public/images/loadings.gif')}}); */
    background-size:190px;
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>

 