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
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
 
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <form class=" modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data"> 
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Create Company</h4>
                  <a href="javascript:;" id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</a>
            </div><hr>
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#pills-General" type="button" role="tab" aria-controls="pills-General" aria-selected="true">Misc</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-KYC-tab" data-bs-toggle="pill" data-bs-target="#pills-KYC" type="button" role="tab" aria-controls="pills-KYC" aria-selected="false">Google</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-More_Information-tab" data-bs-toggle="pill" data-bs-target="#pills-More_Information" type="button" role="tab" aria-controls="pills-More_Information" aria-selected="false">Pusher.Com</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Permission-tab" data-bs-toggle="pill" data-bs-target="#pills-Permission" type="button" role="tab" aria-controls="pills-Permission" aria-selected="false">Threshold Charges</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Subscription-tab" data-bs-toggle="pill" data-bs-target="#pills-Subscription" type="button" role="tab" aria-controls="pills-Subscription" aria-selected="false">SMS Setting</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Email-Setting" data-bs-toggle="pill" data-bs-target="#pills-Email-Setting" type="button" role="tab" aria-controls="pills-SMSSetting" aria-selected="false">Email Setting</button>
                  </li>
                  </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-General" role="tabpanel" aria-labelledby="pills-General-tab">
                     <section id="multiple-column-form">
                        <div class="row">
                          <div class="col-12">
                            <div class="card"> 
                              <div class="card-body">
                              <h4 class="card-title">Misc</h4>
                                <hr> 
                                <div class="row">
                                <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data">Require client to be logged in to view contract</label>
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio3" value="1" checked="">
                                      <label class="form-check-label" for="inlineRadio3">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio4" value="2">
                                      <label class="form-check-label" for="inlineRadio4">No</label>
                                    </div>
                                   </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Dropbox App Key</label>
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        name="fullname"
                                      />
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Max file size upload in Media(MB)</label>
                                      <input
                                        type="number"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        name="username"   
                                        min="1" max="100"
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Maximum file upload on post</label>
                                      <input
                                        type="number"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        name="fullname"
                                      />
                                    </div>
                                  </div><div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Limit Top Search Bar results to</label>
                                      <input
                                        type="number"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Default Staff Role</label>
                                      <select id="user-role" class="select2 form-select">
                                        <option value="subscriber">Employee</option>
                                        <option value="editor">Superwiser</option>
                                        <option value="maintainer">Assistant Manager</option>
                                        <option value="author">Manager</option>
                                        <option value="admin">Owner</option>
                                     </select>
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Delete System activity log older then x month</label>
                                      <input
                                        type="number"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data">Show setup menu item only when hower with mouse on main sidbar area</label>
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio5" value="1" checked="">
                                      <label class="form-check-label" for="inlineRadio5">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio6" value="2">
                                      <label class="form-check-label" for="inlineRadio6">No</label>
                                    </div>
                                   </div>
                                  </div>

                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data">Show help menu item on setup menu</label>
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio7" value="1" checked="">
                                      <label class="form-check-label" for="inlineRadio7">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio8" value="2">
                                      <label class="form-check-label" for="inlineRadio8">No</label>
                                    </div>
                                   </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data">Use minified files version for css and js (only system files)</label>
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio4" id="inlineRadio9" value="1" checked="">
                                      <label class="form-check-label" for="inlineRadio9">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio4" id="inlineRadio4" value="2">
                                      <label class="form-check-label" for="inlineRadio4">No</label>
                                    </div>
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
                        <section id="multiple-column-form">
                          <div class="row">
                            <div class="col-12">
                              <div class="card"> 
                                <div class="card-body"> 
                                <h4 class="card-title">Google</h4>
                                  <hr>
                                  <div class="row">
                                    
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                    <label class="form-label" for="user-name-column">Google API key</label>
                                    <input
                                      type="text"
                                      id="user-name-column"
                                      class="form-control"
                                      value=""
                                      name="username"   
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                    <label class="form-label" for="last-name-column">Google API Client ID</label>
                                    <input
                                      type="text"
                                      id="last-name-column"
                                      class="form-control"
                                      value=""
                                      name="fullname"
                                    />
                                    </div>
                                  </div>  
                                  <hr>
                                <h5 class="card-title">reCAPTCHA</h5>
                                <div class="col-md-12 col-12">
                                  <div class="mb-1">
                                  <label class="form-label" for="user-name-column">Site Key</label>
                                  <input
                                    type="text"
                                    id="user-name-column"
                                    class="form-control"
                                    value=""
                                    name="username"   
                                  />
                                  </div>
                                </div>  
                                <hr>
                                <h5 class="card-title">Calender</h5>
                                <div class="col-md-12 col-12">
                                  <div class="mb-1">
                                  <label class="form-label" for="last-name-column">Google Calender</label>
                                  <input
                                    type="text"
                                    id="last-name-column"
                                    class="form-control"
                                    value=""
                                    name="fullname"
                                  />
                                  </div>
                                </div>
                                <div class="col-md-12 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="luu-data">Enable reCAPTCHA on customers area(Login/Register)</label>
                                  <div class="col-md-4 col-6">
                                    <input class="form-check-input" type="radio" name="inlineRadio6" id="reCAPTCHA1" value="1" checked="">
                                    <label class="form-check-label" for="reCAPTCHA1">Yes</label>
                                    <input class="form-check-input" type="radio" name="inlineRadio6" id="reCAPTCHA2" value="2">
                                    <label class="form-check-label" for="reCAPTCHA2">No</label>
                                  </div>
                                </div>
                              </div>    
                              <hr>
                                <h5 class="card-title">Google Picker</h5>     
                                <div class="col-md-12 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="luu-data">Enable Google Picker</label>
                                  <div class="col-md-4 col-6">
                                    <input class="form-check-input" type="radio" name="inlineRadio8" id="goopicker" value="1" checked="">
                                    <label class="form-check-label" for="GooPicker">Yes</label>
                                    <input class="form-check-input" type="radio" name="inlineRadio8" id="googlepicker" value="2">
                                    <label class="form-check-label" for="GoogPicker">No</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
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
                                                <h4 class="card-title">Pusher.com</h4>
                                                <hr>
                                              <div class="row">
                                              <div class="col-md-12 col-12">
                                              <div class="mb-1">
                                              <label class="form-label" for="user-name-column">APP ID</label>
                                              <input
                                                type="text"
                                                id="user-name-column"
                                                class="form-control"
                                                value=""
                                                name="username"   
                                                />
                                              </div>
                                            </div>
                                          <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                            <label class="form-label" for="user-name-column">APP KEY</label>
                                            <input
                                              type="text"
                                              id="user-name-column"
                                              class="form-control"
                                              value=""
                                              name="username"   
                                              />
                                            </div>
                                          </div>
                                        <div class="col-md-12 col-12">
                                          <div class="mb-1">
                                          <label class="form-label" for="user-name-column">APP Secret</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            name="username"   
                                            />
                                          </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                          <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Cluster <span style="color:red">http//pusher.com/docs/clusters </span></label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            name="username"   
                                            />
                                          </div>
                                        </div> 
                                        <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="luu-data">Enable Real Time Notifications</label>
                                          <div class="col-md-4 col-6">
                                            <input class="form-check-input" type="radio" name="realenable" id="real" value="1" checked="">
                                            <label class="form-check-label" for="real">Yes</label>
                                            <input class="form-check-input" type="radio" name="realenable" id="real2" value="2">
                                            <label class="form-check-label" for="real2">No</label>
                                          </div>
                                        </div>
                                      </div>       
                                        <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="luu-data">Enable Desktop Notifications</label>
                                          <div class="col-md-4 col-6">
                                            <input class="form-check-input" type="radio" name="desctopenable" id="desctop" value="1" checked="">
                                            <label class="form-check-label" for="desctop">Yes</label>
                                            <input class="form-check-input" type="radio" name="desctopenable" id="desctop1" value="2">
                                            <label class="form-check-label" for="desctop2">No</label>
                                          </div>
                                        </div>
                                      </div>
                                        <div class="col-md-12 col-12">
                                          <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Auto dismiss Desktop Notifications after x seconds (0 to disable)</label>
                                          <input
                                            type="number"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            name="username"   
                                            />
                                          </div>
                                        </div>    
                                                                                        
                                                                                   

                              </div>
                            </div>
                          </div>
                        </div>
                    </section>
                  </div>
                  <div class="tab-pane fade" id="pills-Permission" role="tabpanel" aria-labelledby="pills-Permission-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body"> 
                                <h4 class="card-title">Threshold Charges </h4>
                                <hr>
                                <div class="row"> 
                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Add On Change</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            placeholder="$300"
                                            name="username"   
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Diposit</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            placeholder=" $10"
                                            name="username"   
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Convenience Fees Type</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender"
                                              id="inlineRadio2"
                                              value=" " 
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender"
                                              id="inlineRadio2"
                                              value=" "  checked
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender"
                                              id="inlineRadio2"
                                              value=" "   
                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Convenience Amount</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            placeholder="%"
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
                                          <label class="form-label" for="user-name-column">Commission Fees Type</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender2"
                                              id="inlineRadio2"
                                              value=" " 
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender2"
                                              id="inlineRadio2"
                                              value=" "  checked
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender2"
                                              id="inlineRadio2"
                                              value=" "   
                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Commission Amount</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            placeholder="%"
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
                                          <label class="form-label" for="user-name-column">Withdrawal Charges Add</label><br>  
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender1"
                                              id="inlineRadio2"
                                              value=" " 
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Flat</label>
                                          </div> 
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender1"
                                              id="inlineRadio2"
                                              value=" "  checked
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="gender1"
                                              id="inlineRadio2"
                                              value=" "   
                                            />
                                            <label class="form-check-label" for="inlineRadio2">None</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                          <label class="form-label" for="user-name-column">Withdrawal Charges Amount</label>
                                          <input
                                            type="text"
                                            id="user-name-column"
                                            class="form-control"
                                            value=""
                                            placeholder="%"
                                            name="username"   
                                          />
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-12">
                                        <div class="mb-1"> 
                                        </div>
                                      </div>  
                                </div> 
                                Payment Gateway Changes <br><br>
                                <div class="row"> 
                                  <div class="col-md-5 col-12">
                                    <div class="mb-1">
                                                <label for="fname">Visa/Mastercard</label>
                                                <input type="text" id="fname" name="fname" style="height:30px; width:180px">
                                    </div>
                                  </div>
                                  <div class="col-md-5 col-12">
                                    <div class="mb-1">
                                                <label for="fname">Amex</label>
                                                <input type="text" id="fname" name="fname" style="height:30px; width:180px">
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
              </div> 
            </div> 
                  

                </div>
              </div>   
            </div>  
          </form>
      <!-- /Invoice table -->
    </div>
    <!--/ User Content -->
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
 <script src="{{ asset('js/scripts/pages/app-vendor-update.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 