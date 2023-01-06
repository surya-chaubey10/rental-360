@extends('layouts.main')
@section('title', 'Create')
 
 
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

<style>
    .iti {
    width: 100%;
  }
</style>


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
        <form class="add-new-customer modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Add Customer</h4>
                </div><hr>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Account</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Information</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Social</button>
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
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">User Name</label>
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value=" "
                                        placeholder="user Name"
                                        name="username"   
                                      />
                                    </div>
                                  </div>
 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Name</label>
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value=" "
                                        placeholder="Full Name"
                                        name="fullname"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="email-column">Email</label>
                                      <input
                                        type="text"
                                        id="email-column"
                                        class="form-control"
                                        value=" "
                                        placeholder="Email"
                                        name="email"
                                      />
                                    </div>
                                  </div> 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="status-column">Status</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="status" name="status">
                                          <option   value="1">Pending</option>
                                          <option  value="2">Active</option>
                                          <option  value="3">Inactive</option> 
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="customer_type">Customer Type</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="customer_type" name="customer_type">
                                        <option value=""></option>
                                          @foreach($customer_type as $cust_type) 
                                          <option value="{{$cust_type->id}}">{{$cust_type->type_name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="company">Company</label>
                                      <input
                                        type="text"
                                        id="company"
                                        class="form-control"
                                        name="company"
                                        value=" " 
                                        placeholder="Company"
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
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <h4 class="card-title">Personal Information</h4>
                  <hr>
                  <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                              
                                <div class="row">
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="birth_date">Birth Date</label>
                                      <input
                                        type="date"
                                        id="birth_date"
                                        class="form-control  date-picker"
                                        value=" "
                                        placeholder="01/01/2000"
                                        name="birth_date"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="mobile">Mobile</label>
                                      <input
                                        type="tel"
                                        id="mobile"
                                        class="form-control"
                                        value=" "
                                        placeholder="+8775578876"
                                        name="contact"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="website">Website</label>
                                      <input
                                        type="text"
                                        id="website"
                                        class="form-control"
                                        value=" "
                                        placeholder="Website"
                                        name="website"
                                      />
                                    </div>
                                  </div> 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="language">Language</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="language" name="language[]" >
                                          <option value="1">French</option>
                                          <option  value="2">Japanese</option>
                                          <option  value="3">English</option> 
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="gender">Gender</label>
                                      <div class="demo-inline-spacing">
                                        <div class="form-check form-check-inline">
                                          <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            id="inlineRadio1"
                                            value="male"
                                             
                                          />
                                          <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            id="inlineRadio2"
                                            value="female" 
                                          />
                                          <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                  <label class="form-label" for="contact_option-column">Contact Option</label>  
                                    <div class="demo-inline-spacing">
                                      
                                        <input  class="form-check-input" id="contact_option" name="contact_option[]" type="checkbox" id="inlineCheckbox1" value="email"  />
                                        <label class="form-check-label" for="inlineCheckbox1">Email</label> 
                                      
                                        <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="message"   />
                                        <label class="form-check-label" for="inlineCheckbox2">Message</label> 
                                      
                                        <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="phone"  />
                                        <label class="form-check-label" for="inlineCheckbox2">Phone</label>
                                      
                                    </div> 
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
                                        value=" "
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
                                        value=" "
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
                                        value=" "
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
                                        value=" "
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
                                        value=" "
                                        placeholder="State"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="country">Country</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="country" name="country">
                                        <option value=""></option>
                                            @foreach($country as $country) 
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                                                                          
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
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
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
                                      value=" "
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
                                      value=" "
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
                                      value=" "
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
                                      value=" "
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
                                      value=" "
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
                                      value=" "
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
            
            <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block " style="width: 7%;
    margin-left: 43%">Save</button>

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
  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-customers-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 