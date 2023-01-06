@extends('layouts.main')
@section('title', '')
 
 
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
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
        <form class="update-new-offer modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
                <div class="card-header">
                  <h4 style="font-size: 1.750rem;"><b>Localization</b></h4>
                  <a href="javascript:;" id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Setting</a>
                </div>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                    <input type="hidden" id="inventory_updated_id" class="form-control" value=""  name="offer_updated_id" /> 
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                                <div class="row">  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="startdate"><b>Date Formate</b></label>
                                      <select class="form-select" id="discount_type" name="discount_type" >
                                          <option value="dd-mm-yy" >dd-mm-yy</option>
                                          <option value="d F Y" >d F Y</option>
                                          <option value="yyyy-MM-dd" >yyyy-MM-dd</option>
                                          <option value="MMM dd yyyy" >MMM dd yyyy</option>
                                       </select>     
                                    </div>
                                  </div> 
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>Time Formate</b></label>
                                      <select class="form-select" id="discount_type" name="discount_type" >
                                          <option>Select</option>
                                          <option value="24" >24 hour</option>
                                          <option value="12" >12 hour</option>
                                        </select>     
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="Default_Time_Zone"><b>Default Time Zone</b></label>
                                      <select class="form-select" id="time_zone" name="time_zone" >
                                          <option>Select</option>
                                          <option value="india" >India Standard Time</option>
                                          <option value="Canada" >Eastern Standard Time</option>
                                          <option value="South Africa" >South Africa Standard Time</option>
                                          <option value="American Samoa	" >UTC-11	</option>
                                         </select>     
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="discount_type"><b>Default Language</b></label>
                                      <select class="form-select" id="discount_type" name="discount_type" >
                                          <option>Select</option>
                                          <option value="1" >English</option>
                                          <option value="2" >Hindi</option>
                                          <option value="3" >French</option>
                                          <option value="4" >Chinese</option>
                                          <option value="5" >Russian</option>
                                          <option value="6" >Japanese</option>
                                          <option value="7" >Korean</option>
                                          <option value="8" >Italian</option>
                                          <option value="9" >Bhojpuri</option>
                                         </select>     
                                    </div>
                                  </div> 
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="Disabled-Languages"><b>Disabled Languages</b></label>
                                    <div class="col-md-4 col-6">
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="">
                                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                      <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                   </div>
                                  </div>
                                  <div class="col-md-12 col-12">
                                   <div class="mb-1">
                                    <label class="form-label" for="luu-data"><b>Output client PDF Ducuments from admin area in client language</b></label>
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
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 