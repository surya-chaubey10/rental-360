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
  

@endsection

@section('page-style')
  {{-- Page Css files --}}
  
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 80px;
    height: 20px;
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
    height: 10px;
    width: 10px;
    left: 12px;
    bottom: 5px;
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
   left: 43%;
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

.form-check-label{
	    margin-top: 3px;
}
thead, tbody, tfoot, tr, td, th{
	padding: 1rem 2rem !important;
}
</style>
@section('content')
 
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body px-2"> 
        <div id="loadingGif" class="loadering text-center mt-5" style="display:none">
        <img id="imga" src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif"></div> 
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Create Company</h4>
            </div><hr>
            
            <div class="loadering" style="display: none;"></div>

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
                                      value=""
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

                                </div>
                              </div>

                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="first_name">First Name*</label>
                                  <input
                                    type="text"
                                    id="first_name"
                                    class="form-control alphaValue"
                                    value=""
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
                                    value=""
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
                                    value=""
                                    name="admin_email"   
                                  />
                                  <span class="form-text text-danger" id="admin_email_error"></span>

                                </div>
                              </div>
                          
                              <!-- <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="admin_phone">Admin Phone Number*</label>
                                  <input
                                    type="tel"
                                    id="phone"
                                    class="form-control"
                                    value=""
                                    name="phone"
                                  />
                                  <span class="form-text text-danger" id="admin_phone_error"></span>
                                </div>
                              </div> -->

                               <div class="form-group col-md-6 smsForm">
                                <label for="contact1">Admin Phone Number</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Type contact1 number here...." pattern="[7-9]{1}[0-9]{9}" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please enter valid contact no.</div>
                              </div>

                              <div class="col-md-6 col-12">
                                <div class=" mb-1" style="margin-top: 3px;">
                                  <label class="form-label" for="password">Password
                                    <button class="btn btn-sm btn-danger" type="button"  id="generate_password">+ Generate</button>
                                  </label>
                                  <div class="input-group">
                                    <input
                                      type="password"
                                      class="form-control password"
                                      name="password" 
                                      id="password"  
                                    />
                                    <span class="input-group-text togglePassword" id="">
                                      <i data-feather="eye" style="cursor: pointer"></i>
                                    </span>
                                  </div>
                                </div>
                                <span class="form-text text-danger" id="admin_password_error"></span>

                              </div>
                          
                              <div class="col-md-6 col-12">
                                <div class=" mb-1 mt-1">
                                  <label class="form-label" for="confirm_password">Confirm Password</label>
                                  <div class="input-group">
                                    <input
                                      type="password"
                                      class="form-control password"
                                      name="confirm_password"
                                      id="confirm_password"
                                      placeholder="Enter confirm password"
                                    />
                                    <span class="input-group-text togglePassword" id="">
                                    <i data-feather="eye" style="cursor: pointer"></i>
                                    </span>
                                  </div>
                                </div>
                                  <span class="form-text text-danger" id="admin_confirm_password_error"></span>

                              </div>

                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="website">Website</label>
                                  <input
                                    type="url"
                                    id="website"
                                    class="form-control"
                                    value=""
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
                                    value=""
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
                                    value=""
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
                                          <option {{ $cont->id == 228 ? 'selected' : '' }} value="{{ $cont->id }}">{{ $cont->name }}</option>
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

                                  <option value="1">Abu Dhabi</option>
                                  <option value="2">Dubai</option>
                                  <option value="3">Sharjah</option>
                                  <option value="4">Ajman</option>
                                  <option value="5">Umm Al Quwain</option>
                                  <option value="6">Ras Al Khaimah </option>
                                  <option value="7">Fujairah</option>

                                  </select>
                                </div>
                              </div> 
                              <!-- <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="org_phone">Business Phone Number</label>
                                  <input
                                    type="text"
                                    id="org_phone"
                                    class="form-control"
                                    value=""
                                    name="org_phone"
                                  />
                                </div>
                              </div>   -->

                               <div class="form-group col-md-6 whatsappForm">
                                <label for="contact2">Bussiness Phone Number</label>
                                <input type="text" class="form-control" name="org_phone" id="org_phone" placeholder="Type contact2 number here...." pattern="[7-9]{1}[0-9]{9}" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please enter valid contact no.</div>
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
                                      <p class="px-1">Bank Details  : (Optional)</p>
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
                                                          <select name="b_status" id="b_status" class="form-control" >

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
                                                                              checked
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
                                                                        />
                                                                      <label class="form-label" for="user-name-column">No</label>


                                                                      </div>
                                                                    </div> 

                                                                    <div class="col-md-4 col-12 ">

                                                                    <a id="tax_cert_button" class="btn btn-primary d-none" role="button" download="tax_certificate.pdf" href="/public/company/template/TaxCertificateTemplate.pdf">
                                                                      Download Template
                                                                    </a>

                                                                    </div> 

                                                                    <div class="col-md-4 col-12 mt-2 mb-1">

                                                                    <label class="form-label" for="trn_number">TRN Number</label>
                                                                      <input
                                                                        type="text"
                                                                        id="trn_number"
                                                                        class="form-control"
                                                                        value=""
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

                                            <div class="row">
                                              <div class="col-12">
                                                <div class="card"> 
                                                  <div class="card-body">

                                                  <h4 class="card-title">More Information</h4><hr>


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
                                                                  checked
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
                                                                />
                                                                <label class="form-check-label" for="inlineRadio2">Manual</label>
                                                              </div>

                                                          </div>

                                                          <div class="col-md-6 col-12 payout_setup_auto">
                                                            <div class="mb-3">
                                                              <label class="form-label" for="withdraw_limit">Withdraw limit</label>
                                                              <select class="form-select" id="kt_select2_1" name="withdraw_limit">
                                                              <option value="">---select days---</option>
                                                              @for ($i = 0; $i <= 30; $i++)
                                                                  <option value="{{ $i }}">{{ $i == 0 ? "Same Time" : $i }}</option>
                                                              @endfor

                                                                </select>
                                                                <span class="form-text text-danger" id="widthdraw_limit_error"></span>
                                                            </div>
                                                          </div> 

                                                          <div class="col-md-6 col-12 payout_setup_auto">
                                                            <div class="mb-3">
                                                              <label class="form-label" for="available_limit">Available for Withdrawal</label>
                                                              <select class="form-select" id="kt_select2_2" name="available_limit">
                                                              <option value="">---select days---</option>
                                                                @for ($i = 0; $i <= 30; $i++)
                                                                    <option value="{{ $i }}">{{ $i == 0 ? "Same Time" : $i }}</option>
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
                                                                  value=""  
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
                                                                  value=""  
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
                                                                  value=""  
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
                                                                    <option  value="1" >Live</option> 
                                                                    <option  value="2" >Sanbox</option> 
                                                                  </select>
                                                              </div>
                                                            </div> 
                                                            <div class="col-md-6 col-12">
                                                              <div class="mb-1">
                                                                <label class="form-label" for="more_info_currency">Currency</label>
                                                                <select class="form-select" id="more_info_currency" name="more_info_currency">
                                                                  <option  value="1">AED</option> 
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
                                                                <input type="checkbox" id="branded_pay_page" name="branded_pay_page" value="1">
                                                                <div class="slider round"></div>
                                                                </label>
                                                            </div>


                                                            <div class="col-md-6 col-6 mb-2">

                                                                  <label class="switch">
                                                                  <input type="checkbox" id="branded_email" name="branded_email" value="1">
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
                                                                        value=""
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
                                                                        value=""
                                                                        placeholder="C76576JKHGJKHKU87897IUIO"
                                                                        name="api_key"   
                                                                      />
                                                                    </div>
                                                                  </div>
                                                              
                                                                  <div class="col-md-6 col-12">
                                                                    <div class="mb-1">
                                                                      <label class="form-label" for="sms_limit">SMS Limit</label>
                                                                      <select class="form-select" id="sms_limit" name="sms_limit">
                                                                          <option  value="100">100</option> 
                                                                          <option  value="50">50</option> 
                                                                          <option  value="20">20</option> 
                                                                        </select>
                                                                    </div>
                                                                  </div>

                                                                </div><!-- sms package row end -->

                                                        <!--  end-->
                                                        

                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    </section>
                                  </div>


                  <div class="tab-pane fade" id="pills-Permission" role="tabpanel" aria-labelledby="pills-Permission-tab">
                    <div class="card-body p-0">
                      <div class="table-responsive">

                        <table class="table mb-2">
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
                                   
                                        <input class="form-check-input module" data-id="{{$key}}" name="menu[]" type="checkbox" id="{{$menu->id}}" value="{{$menu->id}}" checked readonly/>
                                      <label class="form-check-label" for="menu">{{$menu->name}}</label>
                                </div>
                                </div>
                              </td>
                              <td>
                              @foreach($menu->sub_menu as $sub_menu)
                                <div class="d-flex align-items-center"> 
                                <div class="form-check-inline">
                          
                                    {{--  <input class="form-check-input sub_module{{$key}} sub_menu" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="{{$sub_menu->id}}" value="{{ $sub_menu->id }}"  readonly/>  --}}
                                    <input class="form-check-input sub_module{{$key}} sub_menu" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="{{$sub_menu->id}}" value="{{ $sub_menu->id }}" checked readonly/>

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
                                  />
                                  <label class="form-check-label" for="company_profile_tokenise">Tokenise</label>
                                </div> 
                                <div class="form-check form-check-inline mt-1">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    name="company_profile"
                                    id="company_profile"
                                    value="2"  checked
                                  />
                                  <label class="form-check-label" for="company_profile_normal">Normal</label>
                                </div> <br><br> <br><br> 


                                <div class="row"> 
                                      <div class="col-md-12 col-12 mb-1">
                                          <label class="form-label" for="billing_plan">Billing Plan</label>

                                          <select class="form-select" id="billing_plan" name="billing_plan">
                                            <option value="">---Select Plan---</option>
                                            @foreach($plans as $plan)
                                            <option  value="{{$plan->id}}">{{$plan->plan_name}}</option> 
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
                                            value=""
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
                                            value=""
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
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="convenience_fees_type"
                                              id="convenience_fees_type2"
                                              value="2"  checked
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
                                            value=""
                                            placeholder=""
                                            name="username"   
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
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="commision_fees_type"
                                              id="commision_fees_type2"
                                              value="2"  checked
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
                                            value=""
                                            placeholder=""
                                            name="commission_amount"   
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
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="withdrawal_charge_add"
                                              id="withdrawal_charge_add2"
                                              value="2"  checked
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
                                            value=""
                                            placeholder=""
                                            name="withdrawal_charge_amt"   
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
                                  <div class="row mb-1"><!-- payment gateway row start -->

                                    <div class="col-8"><!-- col-8 start -->

                                      <div class="row"><!-- row start -->

                                        <div class="col-md-6 col-6">
                                          <div class="mb-1  mt-2">
                                              <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="1" name="payment_gateway_charge[]" id="payment_gateway_charge1" value="1" />
                                              <label class="form-label" for="user-name-column">Visa/Mastercard</label>
                                          </div> 
                                        </div>


                                        <div class="col-md-4 col-4 mb-1">
                                          <input class="form-control ml-1 pga1" type="number" name="payement_gateway_amount[]" id="payement_gateway_amount1" readonly="readonly" placeholder="%" value=""
                                          />
                                        </div> 

                                      </div> <!-- row end -->

                                    </div><!-- col-8 end -->


                                    <div class="col-8"><!-- col-8 start -->

                                      <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                        <div class="mb-1  mt-2">
                                          <input
                                            class="form-check-input ml-1 payment_gateway_charge"
                                            type="checkbox"
                                            data-id="2"
                                            name="payment_gateway_charge[]"
                                            id="payment_gateway_charge2"
                                            value="2"  
                                          />
                                          <label class="form-label" for="user-name-column">Amex</label>

                                        </div>

                                      </div> 
                                      <div class="col-md-4 col-4 mb-1">
                                        <input
                                          class="form-control ml-1 pga2"
                                          type="number"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount2"
                                          readonly="readonly"
                                          placeholder="%"
                                          value=""
                                        />
                                      </div> 

                                      </div> <!-- row end -->

                                    </div><!-- col-8 end -->


                                    <div class="col-8"><!-- col-8 start -->

                                      <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                        <div class="mb-1  mt-2">
                                        <input
                                          class="form-check-input ml-1 payment_gateway_charge"
                                          type="checkbox"
                                          data-id="3"
                                          name="payment_gateway_charge[]"
                                          id="payment_gateway_charge3"
                                          value="3"  
                                        />
                                        <label class="form-label" for="user-name-column">Binance Pay</label>
                                        </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga3"
                                          type="number"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount3"
                                          readonly="readonly"
                                          placeholder="%"
                                          value=""

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
                                        />
                                        <label class="form-label" for="user-name-column">Spotii</label>


                                        </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga4"
                                          type="number"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount4"
                                          readonly="readonly"
                                          placeholder="%"
                                          value=""

                                        />

                                      </div> 

                                      </div> <!-- row end -->

                                    </div><!-- col-8 end -->


                                    <div class="col-8"><!-- col-8 start -->

                                      <div class="row"><!-- row start -->

                                      <div class="col-md-6 col-6">

                                        <div class="mb-1  mt-2">
                                        <input
                                          class="form-check-input ml-1 payment_gateway_charge"
                                          type="checkbox"
                                          data-id="5"
                                          name="payment_gateway_charge[]"
                                          id="payment_gateway_charge5"
                                          value="5"  
                                        />
                                        <label class="form-label" for="user-name-column">Tabby</label>


                                        </div>
                                      </div> 

                                      <div class="col-md-4 col-4 mb-1">

                                        

                                        <input
                                          class="form-control ml-1 pga5"
                                          type="number"
                                          name="payement_gateway_amount[]"
                                          id="payement_gateway_amount4"
                                          readonly="readonly"
                                          placeholder="%"
                                          value=""

                                        />

                                      </div> 

                                      </div> <!-- row end -->

                                    </div><!-- col-8 end -->

                                  </div> <!-- payment gateway row end -->



                                  <div class="row mt-1"> 

                                    <div class="col-md-4 col-4 mb-2">

                                          <label class="form-label" for="first_billing_date">First Billing Date</label>
                                          <input type="date" class="form-control picker" name="first_billing_date" id="first_billing_date" />
 
                                    </div>

                                    <div class="col-md-4 col-4 mb-2">

                                          <label class="form-label" for="end_billing_date">End Billing Date</label>
                                          <input type="date" class="form-control " name="end_billing_date" id="end_billing_date" vlaue="" readonly='readonly'/>

                                    </div>

                                    <div class="col-md-4 col-4 mt-2">

                                      <input
                                        class="form-check-input ml-1"
                                        type="checkbox"
                                        name="auto_renewal"
                                        id="auto_renewal"
                                        unchecked 
                                        
                                        style=" margin-top: 10px;"
                                      />
                                      <label class="form-label" for="auto_renewal" style=" margin-top: 10px;">Auto Renewal</label>

                                    </div> 

                                    

                                    <div class="col-md-12 col-12">
                                      <div class="mt-1 mb-1">
                                        <label class="form-label" for="description">Description & Details</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" style="resize:none"></textarea> 
                                      </div>
                                    </div> 

                                  </div> 

                                  <div class="">
                                    <input type="checkbox" class="form-check-input" id="desc_in_invoice" name="desc_in_invoice" checked>
                                    <label class="form-check-label" for="colorCheck2">Include Description in Invoice Item</label>
                                  </div>

                                  <br><br>
                                  <div class="row"> 

                                  <div class="col-md-4 col-12">
                                      <div class="mb-2">
                                        <label class="form-label" for="subs_currency">Currency</label>
                                        <select class="form-select" id="subs_currency" name="subs_currency">
                                            <option  value="1">AED</option> 

                                          </select>
                                      </div>
                                    </div> 


                                    <div class="col-md-12 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="subs_term_cond">Terms & Conditions</label>
                                        <textarea class="form-control" id="subs_term_cond" name="subs_term_cond" rows="3" style="resize:none"></textarea> 
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
                 <div>
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
 <script src="{{ asset('js/scripts/pages/app-company-create.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">


function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 ){
        e.preventDefault();
    }
}
function showDiv() {
  document.getElementById('submit');
  document.getElementById('loadingGif').style.display = "block";
  setTimeout(function() {
    document.getElementById('loadingGif').style.display = "none";
    document.getElementById('showme').style.display = "block";
  },2000);}


  
$(document).ready(function(){
  $('.filesize').on('change', function() {
    const size =
       (this.files[0].size / 1024 / 1024).toFixed(2);
  
    if (size > 2) {
        swal.fire('File must be between the size of 2 MB');
    } else {
        $("#output").html('<b>' +
           'This file size is: ' + size + " MB" + '</b>');
    }
  });
  });
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