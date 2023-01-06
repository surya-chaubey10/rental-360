@extends('layouts.main')
@section('title', '')
 
<link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
<style>
  .iti {
    width: 100%;
  }
</style>
@section('content')

<section class="app-user-view-account">    
  <div class="row"> 
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
      <div class="card"> 
        <div class="card-body"> 
          <form class="add-new-lead modal-content pt-0 form-block"  autocomplete="off" id="form_idd" method="post" enctype="multipart/  form-data"> 
            {{ csrf_field() }}

            <div class="row"> 
              <div class="col-xl-6 col-md-6 col-6" >
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">General</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Requirement</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Social</button>
                  </li> 
                </ul>
              </div>  
             
            </div> 

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">  
                <div class="card-body"> 
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="first-name-column">First Name</label>
                        <input
                          type="text"
                          id="first-name-column"
                          class="form-control"
                          placeholder="First Name" 
                          name="first_name"
                        />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="last-name-column">Last Name</label>
                        <input
                          type="text"
                          id="last-name-column"
                          class="form-control"
                          placeholder="Last Name"
                          name="last_name"
                        />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="mobile-column">Mobile</label><br>
                        <input type="tel" id="mobile-column" class="form-control" placeholder="mobile"  name="mobile" />
                      </div>
                    </div>
                    
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="email-id-column">Email</label>
                        <input
                          type="email"
                          id="email-id-column"
                          class="form-control"
                          name="email"
                          placeholder="Email"
                        />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="source-column">Source</label>
                        <div class="mb-1">
                          <select class="select2 form-select" id="source" name="source">
                            <option  value="1">Social Media </option> 
                            <option value="2">Google</option> 
                            <option value="3">Direct</option> 
                            <option value="4">Other</option> 
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="assigned-column">Assigned (Optional)</label>
                        <div class="mb-1">
                          <select class="select2 form-select" id="assigned" name="assigned">
                                @foreach($user_name as $user) 
                                  <option value="{{$user->id}}">{{$user->fullname}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                    </div><div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="status-column">Status</label>
                        <div class="mb-1">
                          <select class="select2 form-select" id="status" name="status">
                            <option value="0">Pending</option> 
                            <option value="1">Qualified</option> 
                            <option value="2">Disqualified</option> 
                            <option value="3">Contacted</option> 
                            <option value="4">Propasal Sent</option> 
                            <option value="5">Converted</option> 
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="tags-column">Tags</label>
                        <input
                          type="text"
                          id="tags-column"
                          class="form-control"
                          placeholder=" "
                          name="tag"
                        />
                      </div> 
                    </div> 
                  </div>
                </div>
              </div> 

              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> 
                <div class="card-body"> 
                  <div class="row">
                    <div class="col-md-4 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="type-column">Type</label>
                        <div class="mb-1">
                          <select class="select2 form-select" id="type" name="type">
                            <option value=""> </option> 
                            <option value="1">Self Drive</option> 
                            <option value="2">Car with Driver</option> 
                            <option value="3">Limousine</option> 
                          </select>
                        </div> 
                      </div>
                    </div>
                    <div class="col-md-4 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="vehicle-column">Brand</label>
                        <div class="mb-1">
                          <select class="select2 form-select vehicle_name" id="vehicle_id" name="vehicle_id">
                          <option value=""> </option> 

                                @foreach($brand_name as $brand) 
                                  <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="model_id-column">Model</label>
                        <div class="mb-1">
                          <select class="form-select model-name" id="model_id" name="model_id">
                              
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="from-column">From</label>
                        <input
                          type="date"
                          id="from"
                          class="form-control date-picker"
                          value=""
                          placeholder="01/01/2000"
                          name="from"
                        />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="to-column">To</label>
                        <input
                          type="date"
                          id="to"
                          class="form-control  date-picker"
                          value=""
                          placeholder="01/01/2000"
                          name="to"
                        />
                      </div>
                    </div>
                    <div class="col-md-12 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="note-column">Note</label>
                        <div class="mb-1">
                          <textarea
                            class="form-control"
                            id="note"
                            rows="3"
                            name="note"
                            placeholder=" "
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>
              </div>


              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
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
                              <label class="form-label" for="slack-id-column">Slack</label>
                              <input
                                type="slack"
                                id="slack-id-column"
                                class="form-control"
                                value=""
                                name="slack"
                                placeholder="slack"
                              />
                            </div>
                          </div> 
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6 col-6"  role="presentation" > 
                <button id="submit" name="submit" type="submit" class="btn btn-success me-1 btn-form-block " style="float:right;">Submit</button>
              </div> 
            </div>
          </form> 
        </div>  
      </div>  
    </div> 
  </div>  
</section>
<!--   -->
<script>
// Vanilla Javascript
var input = document.querySelector("#mobile-column");
window.intlTelInput(input,({
    preferredCountries: ["ae"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'')
        $('#mobile-column').val("");
        $('#mobile-column').val("+"+countryCode+" "+ $('#mobile-column').val());
    });
});
// fgfd
</script>
@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}} 

 <script src="{{ asset('js/scripts/pages/app-leads-add.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 