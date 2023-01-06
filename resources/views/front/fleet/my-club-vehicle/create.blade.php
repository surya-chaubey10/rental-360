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
  <style>
    .ui-autocomplete {
        z-index: 100;
    }

    .ui-autocomplete
    {
        position:absolute;
        cursor:default;
        z-index:1001 !important
    }
</style>
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
    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <form class="add-new-offer modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
                <div class="card-header">
                  <h4 style="font-size: 1.750rem;"><b>Create Vehicle</b></h4>
                  <button disabled   id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button>
                </div>
                <hr>
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
                                      <label class="form-label" for="offer_category"><b>Vehicle Name</b></label>
                                      <input
                                        type="text"
                                        id="vehicle_name"
                                        class="form-control"
                                        name="vehicle_name"
                                        value="" 
                                      />                                 
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Slug</b></label>
                                      <input
                                        type="text"
                                        id="slug"
                                        class="form-control"
                                        name="slug"
                                        value="" 
                                      />                                 
                                    </div>
                                  </div> 
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="image_path"><b>Image</b></label>
                                      <input
                                        type="file"
                                        id="image_path"
                                        class="form-control"
                                        value=""
                                        name="image_path"
                                      />
                                    </div>
                                  </div> 
                                  
                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Description</b></label>
                                      <textarea 
                                        id="description"
                                        class="form-control"
                                        name="description"
                                        rows="4"
                                        value="">     </textarea>                            
                                        </div>
                                      </div> 

                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>Make Year *</b></label>
                                      <input
                                        type="text"
                                        id="make_year"
                                        class="form-control"
                                        name="make_year"
                                        value="" 
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Rent Day 1 to Day 3 *</b></label>
                                      <input
                                        type="text"
                                        id="day1_to_day3"
                                        class="form-control"
                                        name="day1_to_day3"
                                        value="" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Rent Day 3 to Day 10 *</b></label>
                                      <input
                                        type="text"
                                        id="day3_to_day10"
                                        class="form-control"
                                        name="day3_to_day10"
                                        value="" 
                                      />
                                    </div>
                                  </div> 

                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>Rent Day 3 to Day 10 *</b></label>
                                      <input
                                        type="text"
                                        id="day10_to_day30"
                                        class="form-control"
                                        name="day10_to_day30"
                                        value="" 
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Drop Price *</b></label>
                                      <input
                                        type="text"
                                        id="drop_price"
                                        class="form-control"
                                        name="drop_price"
                                        value="" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Half Day Price *</b></label>
                                      <input
                                        type="text"
                                        id="half_day_price"
                                        class="form-control"
                                        name="half_day_price"
                                        value="" 
                                      />
                                    </div>
                                  </div> 


                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>Full Day Price *</b></label>
                                      <input
                                        type="text"
                                        id="full_day_price"
                                        class="form-control"
                                        name="full_day_price"
                                        value="" 
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Extra Hourly Price *</b></label>
                                      <input
                                        type="text"
                                        id="extra_hourly_price"
                                        class="form-control"
                                        name="extra_hourly_price"
                                        value="" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Deposit Amount *</b></label>
                                      <input
                                        type="text"
                                        id="deposite_amount"
                                        class="form-control"
                                        name="deposit_amount"
                                        value="" 
                                      />
                                    </div>
                                  </div> 

                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>No. Of Seats *</b></label>
                                      <input
                                        type="text"
                                        id="no_of_seats"
                                        class="form-control"
                                        name="no_of_seats"
                                        value="" 
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>No. Of Doors *</b></label>
                                      <input
                                        type="text"
                                        id="no_of_doors"
                                        class="form-control"
                                        name="no_of_doors"
                                        value="" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>Contact Option</b></label>
                                      <div class="row">
                                       <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                            <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="1"    />
                                              <label class="form-check-label" for="inlineCheckbox2">Zero Deposit</label> 
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">

                                             <input  class="form-check-input" name="contact_option[]" type="checkbox" id="inlineCheckbox2" value="2"    />
                                              <label class="form-check-label" for="inlineCheckbox2">Rent Now </label> 
                                            
                                            </div>
                                       </div>
                                       </div>
                                     
                                    </div>
                                  </div> 

                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="image_path"><b>Image</b></label>
                                      <input
                                        type="file"
                                        id="image_path"
                                        class="form-control"
                                        value=""
                                        name="image_path"
                                      />
                                    </div>
                                  </div> 

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Vehicle Category</b></label>
                                      <select class="form-select" id="vehicle_category" name="vehicle_category">
                                          <option  value="1">Primium</option>
                                          <option  value="2">Luxery</option>
                                        </select>                                 
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Vehicle Brand</b></label>
                                      <select class="form-select" id="vehicle_brand" name="vehicle_brand">
                                          <option  value="1">Brand A</option>
                                          <option  value="2">Brand B</option>
                                        </select>                                
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Vehicle Features</b></label>
                                      <select class="form-select" id="vehicle_features" name="vehicle_features">
                                          <option  value="1"> A1</option>
                                          <option  value="2"> B1</option>
                                        </select>                                  
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Vehicle Type</b></label>
                                      <select class="form-select" id="vehicle_type" name="vehicle_type">
                                          <option  value="1"> A1</option>
                                          <option  value="2"> B1</option>
                                        </select>                                 
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Vehicle Service Type</b></label>
                                      <select class="form-select" id="vehicle_service_type" name="vehicle_service_type">
                                          <option  value="1"> A1</option>
                                          <option  value="2"> B1</option>
                                        </select>                                  
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="status-column"><b>Status</b></b></label>
                                        <select class="form-select" id="status" name="status">
                                          <option  value="1">Enable</option>
                                          <option  value="2">Disable</option>
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
 <script src="{{ asset('js/scripts/pages/app-vehicl-list.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 