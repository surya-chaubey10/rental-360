@extends('layouts.main')
 
 
 
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">

  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
 
<section class="app-user-view-account">
  <div class="row"> 
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
      <div class="card"> 
        <div class="card-body"> 
          <form class="update-new-customer modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
            <div class="card-header">
              <h4 >General Marketing</h4> 
            </div>
              <hr>
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">System Emails</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">System URLs</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Background Jobs</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">   
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <p>Configure Email Service which is use by the system to send transaction emails like userverification,application notification,etc.</p>
                      <section id="multiple-column-form">
                         
                            
                                <div class="row">
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Method for sending system mail</label> 
                                        <select class="form-select" id="status" name="status" >
                                          <option readonly  value="1">Sendmail</option> 
                                        </select> 
                                     
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="company">From Email</label>
                                      <input
                                        type="text"
                                        id="company"
                                        class="form-control"
                                        name="company"
                                        value=" " 
                                        placeholder=" "
                                      />
                                    </div>
                                  </div>  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="company">From Name</label>
                                      <input
                                        type="text"
                                        id="company"
                                        class="form-control"
                                        name="company"
                                        value=" " 
                                        placeholder=" "
                                      />
                                    </div>
                                  </div>  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="company">Sendmail Path</label>
                                      <input
                                        type="text"
                                        id="company"
                                        class="form-control"
                                        name="company" readonly
                                        value=" " 
                                        placeholder="/usr/sbin/sendmail"
                                      />
                                    </div>
                                  </div>  
                                </div>

                                <div class="row"> 
                                  <div class="col-md-1 col-12">
                                    <div class="mb-2"> 
                                      <button class="btn btn-icon btn-danger" type="button" data-repeater-create> 
                                      <span> &nbsp; Save &nbsp; </span>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="col-md-2 col-12">
                                    <div class="mb-2"> 
                                      <button class="btn btn-icon btn-dark" type="button" data-repeater-create> 
                                      <span>Send a test mail</span>
                                      </button>
                                    </div>
                                  </div> 
                                </div> 
                      </section> 
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> 
                      <h4>System URLs</h4> 
                      <p>Below are the current applications URLs store in the system cache</p><br>
                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Unsubscribe</b></p>  <hr>

                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Open Track</b></p>  <hr>

                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Click Track</b></p>  <hr>

                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Delivery Handler</b></p>  <hr>

                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Update Profile</b></p>  <hr>

                      <p><i data-feather='link'></i>&nbsp;&nbsp;  http//:demo.acellmail.com/c/Subscribe/unsubscribe/MESSAGE_ID</p>
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Email web view</b></p>   

                       

                    
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                      <h4>Background Job Setup</h4>
                      <p>Please choose a background job type</p><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions1"
                          id="inlineRadio1"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">Cron job (Recommanded) <br> Please choose a background job type</label>
                      </div>
                      <br>
                      <br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioDisabledOptions"
                          id="inlineRadio4"
                          value="option4"
                          disabled
                        />
                        <label class="form-check-label" for="inlineRadio4">Async <br> The disabled attribute can be set to keep a user from using the element until some other condition has been met (like selecting a checkbox, etc.). </label>
                      </div> <hr>

                      <p>Please specify the PHP executable path on your system</p><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/bin/php</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/php/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/htdoc/php/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/php/xampp/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/xampp/htdocs/php/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">xampp/htdocs/php/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/xampp/htdocs/php7.4</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/xampp/htdocs/php</label>
                      </div><br>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="inlineRadio12"
                          value="option1"
                          checked
                        />
                        <label class="form-check-label" for="inlineRadio1">usr/xampp/htdocs/php/php8.0</label>
                      </div>
                      <hr>
                      <div class="col-md-2 col-12">
                        <div class="mb-2"> 
                          <button class="btn btn-icon btn-danger" type="button" data-repeater-create> 
                          <span>Save</span>
                          </button>
                        </div>
                      </div> 
          
                </div> 
              </div> <!-- tab content close< -->
          </form>
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
 <script src="{{ asset('js/scripts/pages/app-customer-update.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 