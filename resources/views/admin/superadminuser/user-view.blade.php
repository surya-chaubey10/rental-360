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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection
<style>
.iti {
    width: 100%;
  }
</style>

@section('content')
 
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body px-1"> 
        <form class="update-new-user modal-content pt-0 form-block" autocomplete="off" id="form_idd1" method="post" enctype="multipart/form-data">
 
             <div class="card-header">
                  <h4 style="font-size: 1.486rem;">User View</h4>
                  <!-- <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save</button> -->
                </div><hr>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Account</button>
                  </li>
                  <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Information</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Social</button>
                  </li> -->
                </ul>

                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
           
            <div class="d-flex">
            @if($user->image !='')            
             <img src="{{ asset('images/users_images/' . $user->image  )}}" 
             id="account-upload-img"
             class="uploadedAvatar rounded me-50"
             alt="profile image"
             height="100"
             width="100"/>              
             @else 
               <img
               src="{{asset('public/images/portrait/small/defaultPic.jpg')}}"
               id="account-upload-img"
               class="uploadedAvatar rounded me-50"
               alt="profile image"
               height="100"
               width="100"/>
               @endif
               <!-- upload and reset button -->
                 <div class="d-flex align-items-end mt-75 ms-1">                
                 <div>
                 <h4>{{$user->fullname}}</h4>  
                 <!-- {{-- <button type="file" id="upload_pic" class="btn btn-sm btn-danger mb-75   btn-file">Update</button> --}} -->
                 <!-- <label for="account-upload" class="btn btn-sm btn-danger mb-75 me-75">Upload</label> -->
               <input type="file" id="account-upload" hidden accept="image/*" name="image"/>
               <!-- <button type="button" id="account-reset" class="btn btn-sm btn-outline-primary mb-75">Reset</button> -->
                  
                </div>
              </div>
              <!--/ upload and reset button -->
            </div>  
        
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body px-1">
                            
                                <div class="row">
                                 <!--  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="user-name-column">User Name</label>
                                      <input
                                        type="text"
                                        id="user-name-column"
                                        class="form-control"
                                        value="{{$user->username}}"
                                        placeholder="user Name"
                                        name="username"   readonly
                                      />
                                    </div>
                                  </div>
                                   -->
                                  <input type="hidden" id="user_updated_id" class="form-control" value="{{$user->id}}" placeholder="Name" name="user_updated_id" /> 
                                
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="last-name-column">Name</label>
                                      <input
                                        type="text"
                                        id="last-name-column"
                                        class="form-control"
                                        value="{{$user->fullname}}"
                                        placeholder="Full Name"
                                        name="fullname"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="email-column">Email(Username)</label>
                                      <input
                                        type="text"
                                        id="email-column"
                                        class="form-control"
                                        value="{{$user->email}}"
                                        placeholder="Email"
                                        name="email"
                                        readonly />
                                    </div>
                                  </div> 
 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="status-column">Status</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="status" name="status" disabled>
                                          <option {{ $user->status == '1' ? 'selected' : '' }} value="1">Pending</option>
                                          <option {{ $user->status == '2' ? 'selected' : '' }} value="2">Active</option>
                                          <option {{ $user->status == '3' ? 'selected' : '' }} value="3">Inactive</option> 
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="customer_type">User Role</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="role_id" name="role" disabled>
                                       
                                         @foreach($customer_type as $cust_type) 
                                          <option {{ $user->roleId == $cust_type->id ? 'selected' : '' }} value="{{$cust_type->id}}">{{$cust_type->role_name}}</option>
                                          @endforeach
                                        
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="Contact">Contact</label>
                                      <input type="tel" id="contact" class="form-control" name="contact"  value="{{$user->mobile}}" readonly />
                                    </div>
                                  </div>  
                                </div>
                              
                            </div>
                          </div>
                     
                    <div class="card" style=" border-style: ridge;">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Permission</h4>
                        </div>
                        <div class="table-responsive" >
                            <table class="table text-nowrap text-center border-bottom" >
                            <thead>
                                <tr>
                                <th class="text-start">MODULE</th>
                                <th>VIEW</th>
                                <th>CREATE</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                                </tr> 
                            </thead>
                            <tbody>
                                @if($all_submenu)
                                  @foreach($all_submenu as $allsubmenu)
                                  <tr>
                                  <td class="text-start">{{ $allsubmenu->name }}</td>
                                  <td>
                                    <div class="d-flex justify-content-center">
                                       <input class="form-check-input check_permission" name="urllink" type="checkbox" disabled {{ isset($allsubmenu->view_url) ? 'checked': '' }} value="" >
                                    </div>   
                                  </td>
                                  <td>
                                    <div class="d-flex justify-content-center">
                                       <input class="form-check-input check_permission" name="urllink" disabled {{ isset($allsubmenu->create) ? 'checked': '' }} type="checkbox" value="" >
                                    </div>   
                                  </td>
                                  <td>
                                    <div class="d-flex justify-content-center">
                                       <input class="form-check-input check_permission" name="urllink" disabled {{ isset($allsubmenu->edit_url) ? 'checked': '' }} type="checkbox" value="" >
                                    </div>   
                                  </td>
                                  <td>
                                    <div class="d-flex justify-content-center">
                                       <input class="form-check-input check_permission" disabled {{ isset($allsubmenu->delete) ? 'checked': '' }} name="urllink" type="checkbox" value=""  >
                                    </div>   
                                  </td>
                                </tr>
                                  @endforeach
                                @endif
                                </tbody>
                            </table>
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
                                        value="{{$user->dob}}"
                                        placeholder="01/01/2000"
                                        name="birth_date"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="mobile">Mobile</label>
                                      <input
                                        type="text"
                                        id="mobile"
                                        class="form-control"
                                        value="{{$user->mobile}}"
                                        placeholder="+8775578876"
                                        name="contact"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="website">Website</label>
                                      <input
                                        type="text"
                                        id="website"
                                        class="form-control"
                                        value="{{$user->website}}"
                                        placeholder="Website"
                                        name="website"
                                        readonly />
                                    </div>
                                  </div> 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="language">Language</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="language" name="language[]" disabled >
                                        <option {{ $user->language == '1' ? 'selected' : '' }} value="1">French</option>
                                          <option {{ $user->language == '2' ? 'selected' : '' }} value="2">Japanese</option>
                                          <option {{ $user->language == '3' ? 'selected' : '' }} value="3">English</option> 
                                        </select>
                                      </div>
                                    </div>
                                  </div> 
                                  <div class="col-md-3 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="gender">Gender</label>
                                      <div class="demo-inline-spacing">
                                        <div class="form-check form-check-inline">
                                          <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            disabled
                                            id="inlineRadio1"
                                            value="male"
                                            {{ $user->gender == 'male' ? 'checked' : ''}}
                                             />
                                          <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            id="inlineRadio2"
                                            disabled
                                            value="female" 
                                            {{ $user->gender == 'female' ? 'checked' : ''}}

                                          />
                                          <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-5 col-12">
                                  <label class="form-label" for="contact_option-column">Contact Option</label>  
                                    <div class="demo-inline-spacing">
                                    @php  $contact_option = explode(',',$user->contact_option) @endphp
                                    <input  class="form-check-input" id="contact_option" name="contact_option[]" type="checkbox" id="inlineCheckbox1" value="email" disabled  @if(in_array('email', $contact_option )) {{'checked'}} @endif   />
                                        <label class="form-check-label" for="inlineCheckbox1">Email</label> 
                                      
                                        <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="message" disabled  @if(in_array('message', $contact_option )) {{'checked'}} @endif  />
                                        <label class="form-check-label" for="inlineCheckbox2">Message</label> 
                                      
                                        <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="phone" disabled @if(in_array('phone', $contact_option )) {{'checked'}} @endif />
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
                                        value="{{$user->address1}}"
                                        placeholder="Address"
                                        name="address_line1"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                      <label class="form-label" for="address_line2">Address Line 2</label>
                                      <input
                                        type="text"
                                        id="address_line2"
                                        class="form-control"
                                        value="{{$user->address2}}"
                                        placeholder="Address"
                                        name="address_line2"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="post_code">Post Code</label>
                                      <input
                                        type="text"
                                        id="post_code"
                                        class="form-control"
                                        value="{{$user->postcode}}"
                                        placeholder="Post Code"
                                        name="post_code"
                                        readonly />
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
                                        value="{{$user->city}}"
                                        placeholder="City"
                                        readonly />
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
                                        value="{{$user->state}}"
                                        placeholder="State"
                                        readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="country">Country</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="country" name="country" disabled >
                                        @foreach (\App\Models\CountryMaster::select('id', 'name')->get() as $c)
                                    <option {{ $user->country_id == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
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
                                      value="{{$user->twitter}}"
                                      name="twitter"
                                      readonly />
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
                                      value="{{$user->facebook}}"
                                      name="facebook"
                                      readonly />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="instagram-floating">Instagram</label>
                                    <input
                                      type="text"
                                      id="instagram-floating"
                                      class="form-control"
                                      value="{{$user->instagram}}"
                                      name="instagram"
                                      placeholder="Instagram"
                                      readonly />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="github-column">Github</label>
                                    <input
                                      type="text"
                                      id="github-column"
                                      class="form-control"
                                      value="{{$user->github}}"
                                      name="github"
                                      placeholder="Github"
                                      readonly />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="codepen-id-column">Codepen</label>
                                    <input
                                      type="codepen"
                                      id="codepen-id-column"
                                      class="form-control"
                                      value="{{$user->codepen}}"
                                      name="codepen"
                                      placeholder="Codepen"
                                      readonly />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="stack-id-column">Stack</label>
                                    <input
                                      type="stack"
                                      id="stack-id-column"
                                      class="form-control"
                                      value="{{$user->stack}}"
                                      name="stack"
                                      placeholder="Stack"
                                      readonly />
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
  </div>
  </div>
</section>
<!--   -->
@endsection  

<script>
var input = document.querySelector("#contact");
window.intlTelInput(input,({
    preferredCountries: ["ae"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'');
        $('#contact').val("");
        $('#contact').val("+"+countryCode+" "+ $('#contact').val());
    });
});
 </script>

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection 
@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-update_user-list.js') }}"></script>   
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 