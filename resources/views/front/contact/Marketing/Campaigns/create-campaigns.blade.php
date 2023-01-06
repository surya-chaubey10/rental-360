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
        <form class="update-new-vendor modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data"> 
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Campaign</h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save & Next</button>
                </div><hr>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Recipients</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Setup</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link"  type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Template</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Schedule</button>
                  </li><li class="nav-item" role="presentation">
                    <button class="nav-link"  type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Confirm</button>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                    <h4>Choose one or more lists/segments for sending email</h4>
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">             
                                <div class="row">
                                  <div class="col-md-4 col-12">
                        <label style="font-size:15px;" class="form-label" for="user-name-column">  Set as default </label>
                        <div class="mb-1">
                         <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions1"
                          id="inlineRadio1"
                          value="option1"
                          checked/>&nbsp
                                <label style="font-size:17px;" class="form-label" for="user-name-column"> default </label></div></div>
                                  <input type="hidden" id="vendor_updated_id" class="form-control" value="" placeholder="Name" name="vendor_updated_id" /> 
                                  <input type="hidden" id="user_updated_id" class="form-control" value="" placeholder="Name" name="user_updated_id" />                                
                                  <div class="col-md-4 col-12">
                                  <label style="font-size:15px;" class="form-label" for="user-name-column"> To which list Shall we send? </label>
                                    <div class="mb-1">
                                    <select class="form-select" id="status" name="status">
                                          <option  value="1">choose</option>
                                          <option  value="2">Active</option>
                                          <option  value="3">Inactive</option> 
                                        </select>
                                    </div>                               
                                    </div>
                                  </div>
                                  <hr> 
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-4 col-12">
                                  <label style="font-size:15px;" class="form-label" for="user-name-column">  Set as default </label>
                                  <div class="mb-1">
                                  <input
                                  class="form-check-input"
                                  type="radio"
                                  name="inlineRadioOptions1"
                                  id="inlineRadio1"
                                  value="option1"
                                  checked
                                />&nbsp
                                <label style="font-size:17px;" class="form-label" for="user-name-column"> default </label>
                                  </div>
                                  </div>
                                  <input type="hidden" id="vendor_updated_id" class="form-control" value="" placeholder="Name" name="vendor_updated_id" /> 
                                  <input type="hidden" id="user_updated_id" class="form-control" value="" placeholder="Name" name="user_updated_id" /> 
                                   <div class="col-md-4 col-12">
                                    <label style="font-size:15px;" class="form-label" for="user-name-column"> To which list Shall we send? </label>
                                    <div class="mb-1">
                                    <select class="form-select" id="status" name="status">
                                          <option  value="1">choose</option>
                                          <option  value="2">Active</option>
                                          <option  value="3">Inactive</option> 
                                        </select> 
                                    </div>
                                    <div class="card-body" style="margin-top:-65px; margin-left:800px;"> <div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></div>
                                  </div>
                                </div>
                                </div>
                            </div>
                            </div>
                          </div><hr>
                         <button  id="submit" name="submit" type="submit" class="btn btn-secondary">+ New List/Segment</button>
                        </div>
                      </div>
                    </section> 
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                 
                <section id="input-mask-wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
       
        <div class="card-body">
          <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              <label class="form-label" for="credit-card">Name your Campaign</label>
              <input
                type="text"
                class="form-control credit-card-mask"
                placeholder="Name your Campaign"
                id="credit-card"
              />
            </div>
            <div class="col-md-6">             
              <div class="input-group input-group-merge">
            <h4>Track Opens</h4>
            <p >A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read</p>
             </div>
            </div>
            <div class="col-md-2">
            <div class="form-check form-check-danger">
              <input type="checkbox" class="form-check-input" id="colorCheck5" checked="">
              <label class="form-check-label" for="colorCheck5"></label>
            </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              <label class="form-label" for="credit-card">Email Suject</label>
              <input
                type="text"
                class="form-control credit-card-mask"
                placeholder="Email Suject"
                id="credit-card"
              />
            </div>
            <div class="col-md-6">             
              <div class="input-group input-group-merge">
            <h4>Track Clicks</h4>
            <p >A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read</p>
             </div>
            </div>
            <div class="col-md-2">
            <div class="form-check form-check-danger">
              <input type="checkbox" class="form-check-input" id="colorCheck5" checked="">
              <label class="form-check-label" for="colorCheck5"></label>
            </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              <label class="form-label" for="credit-card">From Name</label>
              <input
                type="text"
                class="form-control credit-card-mask"
                placeholder="From Name"
                id="credit-card"
              />
            </div>
            <div class="col-md-6">             
              <div class="input-group input-group-merge">
            <h4>Track Opens</h4>
            <p >A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read</p>
             </div>
            </div>
            <div class="col-md-2">
            <div class="form-check form-check-danger">
              <input type="checkbox" class="form-check-input" id="colorCheck5" checked="">
              <label class="form-check-label" for="colorCheck5"></label>
            </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              <label class="form-label" for="credit-card">From Email</label>
              <input
                type="text"
                class="form-control credit-card-mask"
                placeholder="From Email"
                id="credit-card"
              />
            </div>
            <div class="col-md-6">             
              <div class="input-group input-group-merge">
            <h4>Add DKIM Signature</h4>
            <p >A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read</p>
             </div>
            </div>
            <div class="col-md-2">
            <div class="form-check form-check-danger">
              <input type="checkbox" class="form-check-input" id="colorCheck5" checked="">
              <label class="form-check-label" for="colorCheck5"></label>
            </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked">
              <label class="form-check-label" for="inlineCheckbox2">Use sending default value</label>
            </div>
            </div>
            <div class="col-md-6">             
              <div class="input-group input-group-merge">
            <h4>Custom Tracking Domain</h4>
            <p >A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read</p>
             </div>
            </div>
            <div class="col-md-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked">
              <label class="form-check-label" for="inlineCheckbox2"></label>
            </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-3">
              <label class="form-label" for="credit-card">Reply To</label>
              <input
                type="text"
                class="form-control credit-card-mask"
                placeholder="Reply To"
                id="credit-card"
              />
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

 