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
        <form class="update-new-customer modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="form_idd" method="post">
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Create</h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Booking</button>
                </div><hr> 
        
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                            
                                <div class="row">
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_customer-column">Select Customer</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="select_customer" name="select_customer">
                                            
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_date_time-column">Pickup Date&Time</label>
                                      <input type="date" id="pickup_date_time" class="form-control" value="" placeholder="Date" name="pickup_date_time" /> 
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="drop_off_date_time-column">Drop-off Date&Time</label>
                                      <input type="date" id="drop_off_date_time" class="form-control" value="" placeholder="Date" name="drop_off_date_time" /> 
                                    </div>
                                  </div>

                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle-column">Select Vehicle</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="select_vehicle" name="select_vehicle">
                                           
                                         
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_driver-column">Select Driver</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="select_driver" name="select_driver">
                                           
                                         
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <input type="hidden" id="customer_updated_id" class="form-control" value="" placeholder="Name" name="customer_updated_id" /> 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="no_of_traveller-column">No. of Travellers (Including Children)</label>
                                      <input
                                        type="number"
                                        id="no_of_traveller-column"
                                        class="form-control"
                                        value=""
                                        placeholder="1"
                                        name="no_of_traveller"
                                      />
                                    </div>
                                  </div> 
                                  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_address-column">Pickup Address</label>
                                      <div class="mb-1">
                                        <textarea
                                          class="form-control"
                                          id="pickup_address"
                                          rows="3"
                                          name="pickup_address"
                                          placeholder=" "
                                        ></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="dropoff_address-column">Drop-off Address</label>
                                      <div class="mb-1">
                                        <textarea
                                          class="form-control"
                                          id="dropoff_address"
                                          rows="3"
                                          name=""dropoff_address
                                          placeholder=" "
                                        ></textarea>
                                      </div>
                                    </div>
                                  </div><div class="col-md-4 col-12">
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
                                  </div> <hr>

                                  <section class="form-control-repeater">
                                  <div class="row">
                                    <div class="col-md-4 col-12">
                                      <div class="mb-1">
                                        <label class="form-label" for="add_field_name-column">Add User Define Field</label>
                                        <input
                                          type="text"
                                          id="add_field_name-column"
                                          class="form-control"
                                          value=""
                                          placeholder=" " 
                                          name="add_field_name"
                                        />
                                      </div>
                                    </div> 

                                    <div class="col-md-4 col-12">
                                      <div class="mb-3">
                                        <label class="form-label" >&nbsp;</label><br>
                                      <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Add</span>
                                      </button>
                                    </div>
                                  </div>
                                  {{-- Form-Repeater --}} 
                                  <div data-repeater-list="invoice" class="invoice-repeater"> 
                                    <div data-repeater-item>
                                      <div class="row d-flex align-items-end">
                                        <div class="col-md-10 col-12">
                                          <div class="mb-1">
                                            <label class="form-label" for="added_field_data">Field Name Goes Here</label>
                                            <input
                                              type="text"
                                              class="form-control"
                                              id="added_field_data"
                                              name="added_field_data"
                                              aria-describedby="added_field_data"
                                              placeholder="Vuexy Admin Template"
                                            />
                                          </div>
                                        </div> 
                                         
                                        <div class="col-md-2 col-12 ">
                                          <div class="mb-1">
                                            <label class="form-label" >&nbsp;</label><br>
                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                              <i data-feather="x" class="me-25"></i>
                                              <span>Delete</span>
                                            </button>
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
                    </section> 
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
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 