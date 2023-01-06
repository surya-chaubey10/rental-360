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
                  <h4 style="font-size: 1.486rem;">Payment Gateway</h4> 
                  <a href="javascript:;" id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Settings</a>
                </div><hr>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-Misc-tab1" data-bs-toggle="pill" data-bs-target="" type="button" role="tab" aria-controls="pills-Misc" aria-selected="true">General</button> 
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-Misc-tab" data-bs-toggle="pill" data-bs-target="#pills-Misc" type="button" role="tab" aria-controls="pills-Misc" aria-selected="false">PayU Money</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-pusher1-tab" data-bs-toggle="pill" data-bs-target="#pills-pusher1" type="button" role="tab" aria-controls="pills-pusher.com1" aria-selected="false">Paypal</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Thresholdcharges-tab" data-bs-toggle="pill" data-bs-target="#pills-Thresholdcharges" type="button" role="tab" aria-controls="pills-Thresholdcharges" aria-selected="false">RazorPay</button>
                  </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-Misc" role="tabpanel" aria-labelledby="pills-Misc-tab"> 
                  <h4 class="card-title">PayU Money</h4>
                  <hr> 
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                            
                                <div class="row">
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data"><b>Active</b></label> 
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio3" value="option3" checked="">
                                      <label class="form-check-label" for="inlineRadio3">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio4" value="option4">
                                      <label class="form-check-label" for="inlineRadio4">No</label>
                                    </div>
                                   </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Label</label> 
                                      <input 
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="Full Name"
                                        name="fullname"
                                      />
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">PayU Money Key</label>
                                      <input
                                        type="number"
                                        id="user-name-column"
                                        class="form-control"
                                        name="username"   
                                        min="1" max="100"
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">PayU Money Salt</label> 
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="Full Name"
                                        name="fullname"
                                      />
                                    </div>
                                  </div>
								  
								 
                    <div class="col-md-12 col-12" >       
                      <div class="mb-2">
                        <label  class="form-label" for="brand-name-column">Gateway Dashboard payment Description</label>  
                      <textarea class="form-control" rows="3" id="brand-name-column" name="brand_description" 
                      placeholder="brand_description_name" > 
		             </textarea>
                      </div>
                    </div>
          
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Currency</label>     
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value="INR"
                                        placeholder="user Name" 
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data"><b>Enable Test Mode</b></label> 
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio3" value="option3" checked="">
                                      <label class="form-check-label" for="inlineRadio3">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio4" value="option4">
                                      <label class="form-check-label" for="inlineRadio4">No</label>
                                    </div>
                                   </div>
                                  </div>

                                  
                                  
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data"><b>Selected by default on invoice</b></label>   
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadio" id="inlineRadio3" value="option3" checked="">
                                      <label class="form-check-label" for="inlineRadio3">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadio" id="inlineRadio4" value="option4">
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
                  <div class="tab-pane fade" id="pills-Google" role="tabpanel" aria-labelledby="pills-Google-tab">
                  <h4 class="card-title">Google</h4>
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
                                      <label class="form-label" for="user-name-column">Bank Name</label>
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="user Name"
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">BIC/SWIFT</label>
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="Full Name"
                                        name="fullname"
                                      />
                                    </div>
                                  </div><div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Account Name</label>
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="user Name"
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">IBAN (Unique)</label>
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="Full Name"
                                        name="fullname"
                                      />
                                    </div>
                                  </div><div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">Acount No. (Unique)</label>
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value=""
                                        placeholder="user Name"
                                        name="username"   
                                      />
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Currency</label>
                                      <select class="form-select" id="status" name="status">
                                          <option  value="1">AED</option> 
                                        </select>
                                    </div>
                                  </div>


                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="email-column">State</label>
                                      <input
                                        type="text"
                                        id="email-column"
                                        class="form-control"
                                        value=""
                                        placeholder="Email"
                                        name="email"
                                      />
                                    </div>
                                  </div>  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-3">
                                      <label class="form-label" >&nbsp;</label><br>
                                       <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                      <i data-feather="plus" class="me-25"></i>
                                      <span>Add Bank</span>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-12 col-12">
                                  <div class="mb-1">
                                             
                                               
                                                   Company &nbsp;&nbsp;&nbsp;
                                                   Contact &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country &nbsp;&nbsp;&nbsp;
                                                   Country  &nbsp;&nbsp;&nbsp;
                                              
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    <h4 class="card-title">Address</h4>
                  <hr>
                  <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                              
                                <div class="row">
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="address_line1">Address Line 1</label>
                                      <input
                                        type="text"
                                        id="address_line1"
                                        class="form-control"
                                        value=""
                                        placeholder="Address"
                                        name="address_line1"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                      <label class="form-label" for="address_line2">Address Line 2</label>
                                      <input
                                        type="text"
                                        id="address_line2"
                                        class="form-control"
                                        value=""
                                        placeholder="Address"
                                        name="address_line2"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="post_code">Post Code</label>
                                      <input
                                        type="text"
                                        id="post_code"
                                        class="form-control"
                                        value=""
                                        placeholder="Post Code"
                                        name="post_code"
                                      />
                                    </div>
                                  </div> 
                                  
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="city">City</label>
                                      <input
                                        type="text"
                                        id="city"
                                        class="form-control"
                                        name="city"
                                        value=""
                                        placeholder="City"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="state">State</label>
                                      <input
                                        type="text"
                                        id="state"
                                        class="form-control"
                                        name="state"
                                        value=""
                                        placeholder="State"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="country">Country</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="country" name="country">
                                        
                                        </select>
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
                  <div class="tab-pane fade" id="pills-pusher" role="tabpanel" aria-labelledby="pills-pusher-tab">
                  <h4 class="card-title">Pusher.com</h4>
                  <hr>
                  <section id="multiple-column-form">
                    <div class="row">
                      <div class="col-12">
                        <div class="card"> 
                          <div class="card-body">
                            
                              <div class="row"> 
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="twitter">Twitter</label>
                                    <input
                                      type="text"
                                      id="twitter"
                                      class="form-control"
                                      placeholder="Twitter"
                                      value=""
                                      name="twitter"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">  
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <input
                                      type="text"
                                      id="facebook"
                                      class="form-control"
                                      placeholder="Facebook"
                                      value=""
                                      name="facebook"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="instagram-floating">Instagram</label>
                                    <input
                                      type="text"
                                      id="instagram-floating"
                                      class="form-control"
                                      value=""
                                      name="instagram"
                                      placeholder="Instagram"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="github-column">Github</label>
                                    <input
                                      type="text"
                                      id="github-column"
                                      class="form-control"
                                      value=""
                                      name="github"
                                      placeholder="Github"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="codepen-id-column">Codepen</label>
                                    <input
                                      type="codepen"
                                      id="codepen-id-column"
                                      class="form-control"
                                      value=""
                                      name="codepen"
                                      placeholder="Codepen"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="stack-id-column">Stack</label>
                                    <input
                                      type="stack"
                                      id="stack-id-column"
                                      class="form-control"
                                      value=""
                                      name="stack"
                                      placeholder="Stack"
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

 