 @extends('layouts.main')


@section('vendor-style')
  {{-- Page Css files --}}

  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/maps/leaflet.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
@endsection


@section('title', 'Booking Calendar ')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')

<style>
    .iti {
    width: 100%;
  }
  .dot {
  height: 14px;
  width: 14px;
  border-radius: 50%;
  display: inline-block;
}
.dot1{
  background-color: orange;
}
.dot2{
  background-color: grey;
}
.dot3{
  background-color: red;
}

.pac-container {z-index: 99999999999 !important;}
</style>

<div class="row mb-2">

  <div class="col-4">

      <select class=" select2 form-control" name="fleet_search" id="fleet_search">
      <option value=""></option>
      @foreach($fleets as $fleet)
      <option value="{{$fleet->id}}" data-brand="{{$fleet->brand_id}}" data-model="{{$fleet->model_id}}">{{$fleet->car_SKU}}</option>
      @endforeach

      </select>
       

  </div>



  <div class="col-8">
    
    <div class="text-end mb-2">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
      Filter
    </button>
    
  
    <button id="clear" type="button" class="btn btn-primary ">
      Clear
    </button>

    <a class="btn btn-primary" href="{{ url('/add-invoice') }}"  title="Create Invoice"><i data-feather="file"></i></a>

    <!-- <a class="btn btn-primary" href="{{ url('/acounts-payment-list') }}"  title="Quick Payment"></a> -->
    <button type="button" class="btn btn-primary "title="Quick Payment"  data-bs-toggle="modal" data-bs-target="#modals-addslide"><i class="bi bi-lightning"></i></button>

    </div>
    
  </div>

</div>

<div class="text-inline">
<span class="me-1"><span class="dot dot1"></span>  Reserved </span>     
<span class="me-1"><span class="dot dot2"></span>  Invoice </span>
<span><span class="dot dot3"></span>  Booking confirmed </span>
</div>


<!-- Button trigger modal -->


<!-- Full calendar start -->
<section>
<div class="card"> 
  <div class="card-body"> 
    <div id='calendar'>

    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    <!-- Filter Modal Start From Here! -->


    <!-- Modal -->
    <div class="modal fade" id="filterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel">Add Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
            
          

          <form id="filterForm">

          <div class="modal-body">
            <div class="row">

              <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label" for="filter_vehicle">Brand</label>
                  <div class="mb-1">
                    <select class="form-select filter_vehicle" id="filter_vehicle" name="filter_vehicle">
                      <option value=""></option>
                      @foreach($vehicle as $fvehicle)
                        <option  value="{{$fvehicle->id}}">{{$fvehicle->brand_name}}</option>
                      @endforeach
                    </select>
                    <span class="form-text text-danger" id="filter_vehicle_error"></span>

                  </div>
                </div>
              </div>

              <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label" for="filter_model">Model</label>
                  <div class="mb-1">
                    <select class="form-select filter_model" id="filter_model" name="filter_model">
                      <option value=""></option>
                      
                    </select>
                    <span class="form-text text-danger" id="filter_model_error"></span>

                  </div>
                </div>
              </div>

              <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label" for="filter_sku">SKU</label>
                  <div class="mb-1">
                    <select class="form-select filter_sku" id="filter_sku" name="filter_sku">
                      <option value=""></option>
                      
                    </select>
                    <span class="form-text text-danger" id="filter_sku_error"></span>

                  </div>
                </div>
              </div>

            </div>
            </div>
          </form>

          


          
          <div class="modal-footer">
            <button type="button" id="filter_submit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Modal End Here! -->

    <!-- Booking Form Modal Start From Here! -->

      <!-- Modal -->
      <div class="modal fade box-shodow-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Booking</h5>
              <button id="btnClose" type="button" class="btn-close btnClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="post"> 
                
                <section id="multiple-column-form">
                      <div class="row">

                            <div class="col-12"><!--col-8-start--> 
                                <div class="mb-1 border-bottom">
                                  <h4 class="h5"><b>Customer Info</b></h4>
                                </div>

                              <div class="row">

                                <div class="col-md-12 col-12">
                                  <div class="mb-1">
                                    <div class="mb-1"> 
                                      <input type="text" id="select_customer1" name="select_customer1" data-id="" class="typeahead form-control" placeholder="Search By Name,Email And Phone Number"> 
                                      <div id="customer_list"></div> 
                                    </div>
                                    
                                  </div>
                                </div>

                                <div class="col-md-6 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="select_customer">Customer</label>
                                    <div class="mb-1">

                                      <input type="hidden" id="select_customer" name="select_customer" value="" class="select_customer typeahead form-control"> 
                                      <input type="text" id="select_customer_n" name="select_customer_n" data-id="" class=" form-control">  
                                      <span class="form-text text-danger" id="select_customer_error"></span>
                                    </div>                           
                                  </div>
                                </div>   

                                <!-- <div class="col-md-6 col-12">
                                  <div class="mb-1">
                                  <label class="form-label" for="phone">Phone</label>
                                    <div class="mb-1">
                                      <input type="tel" id="phone" name="phone" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control " >
                                      <span class="form-text text-danger" id="phone_error"></span>

                                    </div>
                                  </div>
                                </div> -->

                                <div class="form-group col-md-6 smsForm11">
                                <label for="contact1">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Type contact1 number here...." pattern="[7-9]{1}[0-9]{9}" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please enter valid contact no.</div>
                              </div>

                                <div class="col-md-12 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="mb-1">
                                      <input type="text" id="email" name="email"  class="form-control" >
                                    </div>
                                  </div>
                                </div>

                                {{-- <section class="form-control-repeater">
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

                                </div> 
                                </section> --}}
                                

                              </div>
                              <br>

                                <div class="mb-1 border-bottom">
                                  <h4 class="h5"><b>Booking Info</b></h4>
                                </div>

                                <div class="row"> 

                                  <div class="col-md-6 col-12">

                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_date_time">Pickup Date</label>
                                      <input type="date" id="pickup_date_time" class="form-control" value="" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                                      <span class="form-text text-danger" id="pickup_date_time_error"></span>
                                    </div>

                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_time">Pickup Time</label>
                                      <input type="time" id="pickup_time" class="form-control" value="00:00:00" placeholder="Date" name="pickup_time"  /> 
                                      <span class="form-text text-danger" id="pickup_time_error"></span>
                                    
                                    </div>

                                  </div>

                                  <div class="col-md-6 col-12">

                                    <div class="mb-1">
                                      <label class="form-label" for="drop_off_date_time">Drop-off Date</label>
                                      <input type="date" id="drop_off_date_time" class="form-control" value="" placeholder="Date" name="drop_off_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                                      <span class="form-text text-danger" id="drop_off_date_time_error"></span>
                                    
                                    </div>

                                    <div class="mb-1">
                                      <label class="form-label" for="drop_off_time">Drop-off Time</label>
                                      <input type="time" id="drop_off_time" class="form-control" value="00:00:00" placeholder="Date" name="drop_off_time" /> 
                                      <span class="form-text text-danger" id="drop_off_time_error"></span>
                                    
                                    </div>

                                  </div>

                                  <div class="col-md-6 col-12">

                                    <div class="mb-1">
                                      <label class="form-label" for="select_driver">Select Drive</label>
                                      <div class="mb-1">
                                        <select class="form-select" id="select_driver" name="select_driver">
                                          <option value=""> </option>
                                          <option value="1">Self Drive</option>
                                          <option value="2">Car with Drive</option>  
                                          <option value="3">Limousine</option>  
                                        </select>
                                      <span class="form-text text-danger" id="select_driver_error"></span>

                                      </div>
                                    </div>

                                  </div>

                                  <input type="hidden" id="updated_id" class="form-control" value="" placeholder="Name" name="updated_id" /> 
                                  
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="no_of_traveller">No. of Passengers</label>
                                      <input
                                        type="number"
                                        id="no_of_traveller"
                                        class="form-control"
                                        value=""
                                        placeholder="1"
                                        name="no_of_traveller"
                                      />
                                      <span class="form-text text-danger" id="no_of_traveller_error"></span>

                                    </div>
                                  </div> 
                                   
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_address">Pickup Address</label>
                                      <div class="mb-1">
                                      <div class="location-input col-md-12 col-12 " style="width: 100%">
                                        <input
                                          class="form-control pac-container"
                                          id="pickup_address"
                                          rows="3"
                                          name="origin"
                                          placeholder=" "
                                          style="width: 49%;"
                                        > 
                                      <span class="form-text text-danger" id="pickup_address_error"></span>

                                      </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12" > 
                                    <div class="mb-1">
                                      <label class="form-label" for="dropoff_address">Drop-off Address</label>
                                      <div class="mb-1">
                                      <div class="location-input col-md-12 col-12 " style="width: 100%">
                                        <input
                                          class="form-control pac-container"
                                          id="dropoff_address"
                                          rows="3"
                                          name="destination"
                                          placeholder=" "
                                          style="width: 49%;"
                                        > 
                                      <span class="form-text text-danger" id="dropoff_address_error"></span>

                                      </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="demo-inline-spacing mb-1 mt-3">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">Own inventory</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2"  >
                                        <label class="form-check-label" for="inlineRadio1">Open Market</label>
                                    </div> 

                                </div>

                                <div class="row mb-2 " id="merchant" style="display:none"> 

                                  <div class="form-group col-md-6 ">
                                    <label for="contact1">Phone1</label>
                                    <input type="tel" class="form-control whatsappForm11" name="merchantPhone" id="merchantPhone" pattern="[7-9]{1}[0-9]{9}" required />
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please enter valid contact no.</div> 
                                  </div>


                                    <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="mselect_vehicle">Brand</label>
                                      <div class="mb-1">
                                        <select class="form-select select3 select_marchantvehicle" id="mselect_vehicle" name="merchant_sku_brand">
                                          <option value=""></option>
                                          @foreach($allvehicle as $mvehicle)
                                            <option  value="{{$mvehicle->id}}">{{$mvehicle->brand_name}}</option>
                                          @endforeach
                                        </select>
                                        <span class="form-text text-danger" id="mselect_vehicle_error"></span>

                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="mselect_model">Model</label>
                                      <div class="mb-1">
                                        <select class="form-select select3 select_marchantmodel" id="mselect_model" name="merchant_sku_model">
                                          <option value=""></option>
                                          
                                        </select>
                                        <span class="form-text text-danger" id="mselect_model_error"></span>

                                      </div>
                                    </div>
                                  </div>


                                  <div class="col-xl-6 col-md-6 col-6">
                                  <div class="mb-1">
                                    <label class="form-label" for="mcomment">Comment</label>
                                    <div class="mb-1">
                                    <textarea class="form-control" placeholder="Comment" name="open_comment" id="mcomment" style="resize:none" rows="2" cols="50"></textarea>
                                    <span class="form-text text-danger" id="mcomment_error"></span>
                                  </div>
                                  </div>
                                  </div>


          
                                </div>

                                <div class="row mb-2 " id="auto_dispached"> 

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle">Brand</label>
                                      <div class="mb-1">
                                        <select class="form-select select_vehicle" id="select_vehicle" name="select_vehicle">
                                          <option value=""></option>
                                          @foreach($vehicle as $vehicle)
                                            <option  value="{{$vehicle->id}}">{{$vehicle->brand_name}}</option>
                                          @endforeach
                                        </select>
                                        <span class="form-text text-danger" id="select_vehicle_error"></span>

                                      </div>
                                    </div>
                                  </div>   

                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_model">Model</label>
                                      <div class="mb-1">
                                        <select class="form-select select_model" id="select_model" name="select_model">
                                          <option value=""></option>
                                          
                                        </select>
                                        <span class="form-text text-danger" id="select_model_error"></span>

                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-12" id="skudiv">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_sku">SKU</label>
                                      <div class="mb-1">
                                        <select class="form-select select_sku" id="select_sku" name="select_sku">
                                          <option value=""></option>
                                          
                                        </select>
                                        <span class="form-text text-danger" id="select_sku_error"></span>

                                      </div>
                                    </div>
                                  </div>

                              </div>

                            <input type="hidden" class="form-control" name="sku" id="sku" value="0" placeholder="Phone">
                            <div class="containerrr-map" id="google-map" style="height: 225px;position: relative; width: 96%;margin-top: -12px"></div>
                            <div id="output" class="result-table"></div>

                                  <div class="row">
                                    <div class="col-12" style="margin-top: 50px;">
                                        <div class="mb-1" >
                                            <label class="form-label" for="noteTextarea">Note</label>
                                            <textarea class="form-control " id="noteTextarea" rows="7" style="resize:none" name="note" ></textarea>
                                            <span class="form-text text-danger" id="noteTextarea_error"></span>

                                          </div>
                                    </div>
                                  </div>

                                </div>
                              
                              </div>
                          
                            <!-- </div>  -->
                          <!-- </div>
                        </div> -->

                        
                </section>  
              </form> 

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger " id="bookinBtnClose" data-bs-dismiss="modal">Cancel</button>
              <button id="submit" name="submit" type="submit" class="btn btn-success btn-form-block booking_save">Submit</button>
            </div>
          </div>
        </div>
      </div>

        <!-- Invoice popup start -->
        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content" >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Invoice</h5>
              <button id="btnClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form class="add-manage-booking-invoice modal-content pt-0 form-block" autocomplete="off" id="booking_form_invoice" method="post">
    <section style="background-color:white;">
      <div class="row"> 
        <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0" style="background-color:white;"> 
          <div class="card"> 
            <div class="card-body">  
                          <!-- <div class="card-header">
                             <h4 style="font-size: 1.486rem;">Create Invoice</h4>
                            </div><hr>  -->
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Full Name</label>
                    <input type="text" id="full_name" class="form-control" value="{{isset($customer->fullname) ? $customer->fullname:''}}" placeholder=" " name="full_name" /> 
                    <span class="form-text text-danger" id="full_name_error"></span>
                 </div>  
                </div>
                <input type="hidden" id="booking_id" class="form-control" value="{{isset($uuid) ? $uuid : ''}}" placeholder=" " name="booking_id" /> 
                  
                <input type="hidden" class="form-control" name="document_type" id="document_type" value="booking"> 
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Email</label>
                    <input type="text" id="emails" class="form-control" value="{{isset($customer->email) ? $customer->email :''}}" placeholder=" " name="email" /> 
                    <span class="form-text text-danger" id="emails_error"></span>
                  </div>
                </div>
                

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="currency_type-column">Currency Type</label>
                    <div class="mb-1">
                      <select class="form-select" id="currency_type" name="currency_type">
                        <option value="AED">AED</option>
                          
                      </select>
                      <span class="form-text text-danger" id="currency_type_error"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="transaction_type-column">Transaction Type</label> 
                    <select class="form-select" id="transaction_type" name="transaction_type">
                        <!-- <option value="1">Sales </option> -->
                        <option value="3">Sales </option> 
                        <option value="2">Pre Auth </option>
                        <option value="4">Cash </option>
                      </select>
                      <span class="form-text text-danger" id="transaction_type_error"></span>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="customer_refrence-column">Customer Refrence (Optional)</label>
                    <input type="text" id="customer_refrence" class="form-control" value="" placeholder=" " name="customer_refrence" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="invoice_refrence-column">Invoice Refrence (Optional)</label>
                    <input type="text" id="invoice_refrence" class="form-control" value="" placeholder=" " name="invoice_refrence" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="phone-column">Phone (Optional)</label>
                    <input type="text" id="phones" class="form-control" value="{{isset($customer->mobile) ? $customer->mobile : ''}}" placeholder=" " name="phone" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="street-column">Street (Optional)</label>
                    <input type="text" id="street" class="form-control" value="" placeholder=" " name="street" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="city-column">City (Optional)</label>
                    <input type="text" id="city" class="form-control" value="{{isset($customer_details->city)? $customer_details->city: '' }} " placeholder=" " name="city" /> 

                  </div>
                </div>
                
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="country-column">Country (Optional)</label>
                    <div class="mb-1">
                      <select class="form-select" id="country" name="country">
                        <option></option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="state-column">State (Optional)</label>
                    <div class="mb-1">
                    <input type="text" id="state" class="form-control" value="{{isset($customer_details->state)? $customer_details->state: '' }} " placeholder=" " name="state" /> 
                     
                    </div>
                  </div>
                </div> 
                
                
                <!-- <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="zip-column">Zip</label>
                    <input
                      type="number"
                      id="zip"
                      class="form-control"
                      value=""
                      placeholder=""
                      name="zip"
                    />
                  </div>
                </div>  -->
                
                <div class="col-md-6 col-12">
                  <div class="mb-1" >
                    <label class="form-label" for="inv_description-column">Notes</label>
                    <div class="mb-1">
                      <input
                        class="form-control"
                        id="inv_description"
                        
                        name="inv_description"
                        placeholder=" "
                      >  
                    </div>
                  </div>
                </div> 
              </div>

        <!-- Product Details start -->

        <input type="hidden" id="sku_set" class="form-control" value="{{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}}" name="sku_set" /> 
        <input type="hidden" id="sku_id" class="form-control" value="{{isset($sku[0]->id) ? $sku[0]->id:'0'}}" name="sku_set" /> 
        <input type="hidden" id="description_set" class="form-control" value="{{isset($brand->brand_name) ? $brand->brand_name: ''}} {{isset($brand_vehicle->vehicle_name) ? $brand_vehicle->vehicle_name:''}} - {{isset($diffDays) ? $diffDays : ''}} day rental" name="description_set" /> 
        <input type="hidden" id="price_set" class="form-control" value="{{isset($total) ? $total : ''}}" name="price_set" /> 
        <input type="hidden" id="diffDays_set" class="form-control" value="{{isset($diffDays) ? $diffDays : ''}}" name="diffDays_set" />  


  <div class="card-body">
    <div class="row" style="overflow-x: auto;"> 
      <div class="col-12 ">
        <table class="table table-bordered table-hover" id="tab_logic" style="margin-left:-2%;width: 104%;">
          <thead class="table-light">
            <tr>
              <th style="min-width: 298px;">SKU</th>
              <th style="min-width: 298px;" >Description</th>
              <th style="min-width: 200px;">Price</th>
              <th style="min-width: 200px;">Period</th>
              <th style="min-width: 200px;">Discount(%)</th>
              <th style="min-width: 200px;">Tax(%)</th>
              <th style="min-width: 200px;">Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="head">
            <tr id='addr0'>
           
              <td>
              <input type="text" name='sku1[]' value="" class="form-control sku" readonly/>
              <input type="hidden" name='sku[]' value=" " class="form-control sku"/>
              </td>
             
              <td>
              <input type="text" name='description[]' value="{{isset($brand->brand_name) ? $brand->brand_name : ''}} {{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}} - {{isset($diffDays) ? $diffDays : ''}} day rental" class="form-control description description1"/>
              </td>
             
              <td>
                <input type="text" name='unit_price[]' value="{{isset($unitprice) ? $unitprice : '0'}}" class="form-control price"/>
              </td>
              
              <td>
              <input type="text" name='quantity[]' value="{{isset($period) ? $period : '0'}}" class="form-control period"/>
              </td>
              <td>
              <input type="text" name='discount[]' value="0" class="form-control discount"/>
              <input type="hidden"  value="" placeholder='discountamount' class="form-control discountamount"/>
              </td>
              <td>
              <input type="text" name='tax[]' value="{{isset($vat) ? $vat : '0'}}" class="form-control tax"/>
              </td>
              <td>
              <input type="text" name='total[]' value="{{ isset($total) ? $total:'0' }}" class="form-control total" readonly />
              </td>
              <td></td>
              </tr> 
            <tr id='addr1'></tr>
          </tbody>
        </table>
      </div> 
    </div>
    <input id="add_row" class="btn btn-primary btn-sm add_row mt-1 mb-1" value="Add On " readonly  > 
  </div>   
  
  <div class="col-md-4 card-body justify-content-end ">
  <div class="d-flex row">
    <div class="col-3">
      <div class="form-check form-check-inline">
        <input class="form-check-input PromotionRadio" type="radio"  name="promotion_radio" id="promotion_radio"  value="1" checked/>
        <label class="form-check-label" for="inlineRadio4" style="margin: -1px 0 0 7px;">Promotion</label>
      </div>
    </div> 
    <div class="col-9">
      <input type="text" name="promotion_code" class="form promotion_code form-control" style="margin-left:31px;" value="" id="promotion_code" />
      <input type="hidden" name="promotion_type" class="form promotion_type" value="0" id="promotion_type" />
      <input type="hidden" name="promotion_id" class="form promotion_id" value="0" id="promotion_id" />
    </div>  
	</div>
  </div>         
        <!-- Product Details ends -->

        <!-- Invoice Total starts -->
        <div class="card-body invoice-padding">
          <div class="row invoice-sales-total-wrapper">
            <div class="col-md-4 justify-content-end order-md-2 order-1" style="margin-left: 64%;">

                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="subTotal" class="form-label text-nowrap mt-1">Sub Total</label>
                  </div>

                  <div class="col-9">
                    <input type="text" name="subTotal" class="form-control sub_total" value="{{isset($total) ? $total : ''}} " id="subTotal" readonly />
                  </div>

                </div>

                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="footer_discount" class="form-label text-nowrap mt-1">Discount</label>
                  </div>

                  <div class="col-9">
                    <input type="text" name="footer_discount" class="form-control footer_discount" value="0" id="footer_discount" readonly />
                  </div>

                </div>
                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="footer_discount" class="form-label text-nowrap mt-1">Promotion</label>
                  </div>

                  <div class="col-9">
                     <input type="text" name="footer_promotion" class="form-control footer_promotion" value="0" id="footer_promotion" readonly />
                  </div>

                </div>

                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="deliveryCharge" class="form-label text-nowrap mt-1">Delivery Charge</label> 
                  </div>

                  <div class="col-9">
                    <input type="text" name="deliveryCharge" class="form-control delivery_charge" id="deliveryCharge" value="0" />
                  </div>

                </div>

                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="grandTotal" class="form-label text-nowrap mt-1  ">Grand Total</label>
                  </div>

                  <div class="col-9">
                    <input type="text" name="grandTotal" class="form-control grand_total" value="{{isset($total) ? $total : ''}} " id="grandTotal" readonly/>
                  </div>

                </div>

            </div>
			
			<!--div class="col-md-4 order-2 mt-md-0 mt-3">
              <div class="d-flex align-items-center mb-1">
                
              </div>
            </div-->
			
          </div>
        </div>    

             <div class="text-center">    
              <a href=" "  class="btn btn-danger me-1" >Back</a> 
                <button  id="invoice_submit" name="submit" type="submit" class="btn btn-success me-1 btn-form-block">Save Invoice</button>
            </div>    

            </div>          
          </div>
        </div>
          </div>
        </section>
    </form>

            </div>
           
          </div>
        </div>
      </div>
      <!-- Invoice popup -->

       <!-- Invoice Priview popup start -->
       <div class="modal fade" id="priviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" >
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Invoice Priview</h5>
              <button id="btnClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

     <div class="col-xl-12 col-md-12 col-12" >
    <form id="jquery-val-form" method="post" novalidate="novalidate" >
    <section class="invoice-add-wrapper prev-invoice">
      <div class="row invoice-add">
        
      <div class="card invoice-preview-card custom-margin">
        <div class="card-body invoice-padding ">
          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div class="col-md-8">
           
              <div class="logo-wrapper">
              <span class="">
              @php    $org= org_details(); @endphp 
                @if(isset($org->org_logo))
                <img
                    src="/company/logo/{{$org->org_logo}}"
                    class="congratulations-img-right"
                    alt="card-img-right"
                    height="50" 
                    width="50"
                /><br><br>
                <span class="user-name fw-bolder">
                   <h3>{{(isset($org->org_name) ? $org->org_name : '')}}</h3>
                  </span>
                @else
                  <img class="round" src="{{ asset('/company/logo/202210190637logo.jpg') }}" alt="avatar" height="40" width="40">
                  <span class="user-name fw-bolder">
                    <h3>{{(isset($org->org_name) ? $org->org_name : '')}}</h3>
                    </span>
                @endif</span>
                  
              </div>
              <div class="mt-md-0">
              <p class="card-text mb-0"> {{(isset($org->org_city) ? $org->org_city : '')}}</p>
              <p class="card-text mb-0"> {{isset($org->org_state) ? $org->org_state : ''}}</p>
              <p class="card-text mb-0" > {{(isset($org->countrymaster) ? $org->countrymaster->name : '')}} </p>
              <p class="card-text mb-0">{{(isset($org->website) ? $org->website : '' )}}</p>
              <p class="card-text mb-0">{{(isset($org->org_phone) ? $org->org_phone : '' )}}</p>
            </div>
            </div> 
            <div class="invoice-number-date col-md-6">
              <div class="d-flex align-items-center justify-content-md-end mb-1 col-md-8">
                <h4 class="invoice-title col-md-4">Invoice</h4>
                 
                  <input type="text" id="invoice_data" class="form-control invoice-edit-input"  value="" readonly />

                  <input type="hidden" id="uuid_data" class="form-control"  value="" />
 
              </div>
             
              <div class="d-flex align-items-center justify-content-md-end mb-1 col-md-8">
                <h4 class="title col-md-4 ">Date:</h4>
                <input type="text"  id="date_id" class="form-control invoice-edit-input" value=" " readonly/>
              </div>
              
            </div>
          </div>
        </div>
        <hr class="invoice-spacing" />
    
        <div class="col-md-6" style="margin-left: 6%;"> 
           <div class="d-flex align-items-center mb-1 ">  
                <label for="agents" class="form-label cash_collected" style="width: 36%; font-size: 97%; font-weight: 900;"><b>Cash Collected</b></label>
                <select class="form-select cash" name="transaction_type" id="transaction_type_data" style="mergin-left: -22%;" required>
               
                </select>
            </div>
        </div>
              
        <div class="card-body invoice-padding">
          <div class="row row-bill-to invoice-spacing">
             
            <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2 mb-2">
              <h6 class="mb-1">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-1">NAME:</td>
                    <td><strong id="fullname_data" > </strong></td>
                  </tr>
                  <tr>
                    <td class="pe-1">ADDRESS:</td>
                    <td id="transaction_type_data" > <br>  </td>
                  </tr>
                  <tr>
                    <td class="pe-1">PHONE:</td>
                    <td id="mobile_data" > </td>
                  </tr>
                  <tr>
                    <td class="pe-1">EMAIL:</td>
                    <td id="customer_email_data" > </td>
                  </tr>
                   
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card-body invoice-padding invoice-product-details">      
            <div data-repeater-list="group-a">
              <div class="repeater-wrapper" data-repeater-item>
                <div class="row">
                  <div class="col-12 d-flex product-details-border position-relative pe-0">
                    <div class="row w-100 pe-lg-0 pe-1 py-2">
                      <div class="col-lg-10 col-10 mb-lg-0 mb-10 mt-lg-0 mt-2">
                        <p class="card-text col-title mb-md-50 mb-0" >DESC</p>
                         <p class="card-text mb-0" id="description_data"> </p>  
                        </div>                   
                     
                      <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                        <p class="card-text col-title mb-md-50 mb-0" style="width: 110%;">Amount</p>
                          <p class="card-text mb-0" id="total_data"> </p>
                         </div>                   
                  </div>       
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="card-body invoice-padding">
          <div class="row invoice-sales-total-wrapper">
            <div class="col-md-6 order-md-1 order-2 mt-2">
              <div class="d-flex align-items-center mb-1">
                <label for="agents" class="form-label"><b>Agents:</b></label>
                <input type="text" class="form-control ms-50" id="org_name_data" value=" " readonly placeholder=" }" />
              </div>
            </div>
            <div class="col-md-6 d-flex order-md-2 order-1 mt-5">
              <div class="invoice-total-wrapper" style="margin-left: 108px;">
                <div class="invoice-total-item">
                  <p class="invoice-total-title" >Subtotal:</p>
                  <p class="invoice-total-amount" id="subtotal_data" style="margin: -36px 23px 23px 141px"> </p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Discount:</p>
                  <p class="invoice-total-amount" id="subtotal_discount_data" style="margin: -36px 23px 23px 141px"> </p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title" >Promotion:</p>
                  <p class="invoice-total-amount" id="promotion_value_data" style="margin: -36px 23px 23px 141px"> </p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Delivery Charge:</p>
                  <p class="invoice-total-amount" id="delivery_charge_data" style="margin: -36px 23px 23px 141px"> </p>
                </div>
                <hr class="my-50" />
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Grand Total:</p>
                  <p class="invoice-total-amount" id="grand_total_data" style="margin: -36px 23px 23px 141px"> </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body invoice-padding py-0"> 
          <div class="row">
            <div class="col-12">
              <div class="mb-2">
                <label for="note" class="form-label fw-bold">Note:</label>
                <textarea class="form-control" rows="2" id="inv_preview_note" name="inv_preview_note" value=""></textarea
                >
                <input type="hidden" class="form-control"  id="booking_id_data" name="booking_id" value="">
                <input type="hidden" class="form-control"  id="transaction_typesss" name="transaction_type" value=" ">
                @csrf
              </div>
            </div>
          </div>                   
        </div>
      </div>
      <div class="card-body" style="margin-left:40%;">
      
          <a  href="javascript:;"  class="btn btn-primary w-40 waves-effect waves-float waves-light" id="store_note">
           Create Invoice
          </a>     
               
          
          </div>
      </div>    
    </div>
  </section>
  </form>
  </div>

            </div>
           
          </div>
        </div>
      </div>
      <!-- Invoice Priview popup -->
      <!-- Copy Link Popup Start-->
      <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered modal-lg">
                 
                    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0"> 
                      
                          <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="">
          
                            <div class="modal-header">
                                <h4 style="font-size: 1.486rem;">Copy Link</h4>
                                <a href="{{route('booking-calender')}}" class="btn btn-danger mb-1 waves-effect" style="float: right;" > <i data-feather='x'></i></a>
                             </div> 
                            <hr> 
                  
                            <section id="multiple-column-form">
                              <div class="modal-body">
                                 
                                  <p>
                                  <a href="" target="_blank" style="color: red;" rel="nofollow" id="copyss_href1"></a> 
                                </p>
                                <input type="hidden" value="" id="copied_url">
                              </div> 
 
                              <div class="card-body">  
                                <div class="icon-wrapper"  height= 40px; width= 60px; >  
                                 
                                  <a title="Whatsapp" id="whatsappaaa" href="" class="btn btn-danger waves-effect">  <i class="fa fa-whatsapp" style="font-size:24px"></i></a>
                                  <a  title="Payment" target="_blank" id="payment1" href="" class="btn btn-danger waves-effect"><i data-feather='eye'></i></a>
                                  <a  title="Message" href="javascript:;" id="sms_send" class="btn btn-danger waves-effect" > <i data-feather='message-square'></i></a>
                                  <a title="Mail" href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                                </div>
                              </div>
 
                            </section>
                          </form>  

                    </div>  
                  </div>
                </div>
                <!-- Copy Link Popup end -->
    <!-- Form End -->
  </div>
</div>

  <!-- Modal to add new model starts-->
  <div class="modal  new-payment-modal fade" id="modals-addslide">
                <div class="modal-dialog modal-xl" style="width: 60%;margin: 10% 0 0 25%;" >
                    <form class="add-Queck-Payment modal-content pt-0 " autocomplete="off" id="form_model" method="post"  enctype="multipart/from-data" > 
                      
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Quick Payment</h5>
                            
                        </div>
                        <div class="modal-header mb-1">
                        <button  type="reset" style="margin-left: 94%;margin-top: -83px;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
                        </div>   
                        <div class="modal-body flex-grow-1">
                            <div class="row">
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Full Name</label>
                                  <input type="text"  id="full_name" class="form-control" value=""  placeholder=" " name="full_name" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="transaction_type-column">Transaction Type</label>
                                   <select class="form-control select2 transaction_type"  name="transaction_type">
                                      <option value="1">Sales</option>
                                      <option value="2">Pre Auth</option>
                                      <!-- <option value="3">Tokenize</option> -->
                                      <option value="4">Cash</option>
                                   </select>
                                </div>
                              </div>
                              <!-- <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="phone-column">Phone (optional)</label>
                                  <input type="tel" maxlength="14" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="phone_num" class="form-control" value=""  name="phone" /> 

                                </div>
                              </div> -->
                              <!-- <div class="container row mb-4 col-md-6 col-12" style="width: 53%;">
                                <div class="form-group md-group show-label billingform ">
                                  <label class="form-label">Phone (optional)</label>
                                  <input class="form-control mb-1" type="tel" name="phone"  id="phone_num" value="+971 ">
                                </div>
                                  <div class="form-group md-group show-label">
                                  <select hidden name="" id="address-country" class="form-control">
                                    </select>
                                  </div>
                                </div> -->

                                <div class="form-group col-md-6 whatsappForm">
                                <label for="contact2">Bussiness Phone Number</label>
                                <input type="text" class="form-control org_phone1" name="org_phone" id="org_phone" placeholder="" pattern="[7-9]{1}[0-9]{9}" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please enter valid contact no.</div>
                              </div> 


                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Email</label>
                                  <input type="email" id="email" class="form-control" value="" placeholder=" " name="email" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Amount</label>
                                  <input type="number" id="amount" class="form-control" value='' placeholder='0.00' name="amount" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Description (optional)</label>
                                  <input type="text" id="description" class="form-control" value="" placeholder=" " name="description" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Agent</label>
                                  <input type="text" class="form-control" value="{{getUser()->fullname}}"  readonly /> 
                                  <input type="hidden" id="agent" class="form-control agent" value="{{getUser()->id}}" placeholder=" " name="agent" /> 
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Comment (optional)</label>
                                  <input type="text" id="comment" class="form-control" value="" placeholder="" name="comment" /> 

                                </div>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Save/Create</button>
                            <button type="reset" class="btn btn-outline-secondary cancel"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
              <!-- Modal to add new model Ends-->
                    <!-- medium modal -->
                    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                      <div class="modal-header" style="height: 52px;">
                        <button  type="reset" style="margin-left:90%;margin-top: 14px" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
                        </div>   
                          <div class="modal-body" id="mediumBody">
                            <div class="col-xl-12 col-md-12 col-12">
                              <section class="invoice-add-wrapper prev-invoice">
                                <div class="row invoice-add">
                                  <div class="card invoice-preview-card">
                                    <div class="card-body invoice-padding">

                                      <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div class="col-md-9">
                                        <span class="avatar">
                                        @php $org = org_details() @endphp
                                                  @if(isset($org->org_logo))
                                                  <img
                                                      src="/company/logo/{{$org->org_logo}}"
                                                      class="congratulations-img-right"
                                                      alt="card-img-right"
                                                      height="40" 
                                                      width="40"
                                                  />
                                                  @else
                                                    <img class="round" src="{{ asset('/company/logo/202210190637logo.jpg') }}" alt="avatar" height="40" width="40">
                                                  @endif</span>&nbsp&nbsp
                                                       <span>
                                                      @php  $user= getUser();  $org= org_details(); @endphp
                                                        <!-- {{( isset($org->org_name) ? $org->org_name : '' )}} -->
                                                        
                                                      </span>
                                                      <br>
                                                      <br>
                                                      <p class="card-text mb-0"> {{(isset($org->org_city) ? $org->org_city : '')}}</p>
                                                          @if(isset($org->org_state))
                                                          @if($org->org_state==1)
                                                          <p class="card-text mb-0"> Abu Dhabi</p>
                                                            @elseif($org->org_state==2)
                                                            <p class="card-text mb-0">Dubai</p>
                                                            @elseif($org->org_state==3)                                     
                                                            <p class="card-text mb-0"> Sharjah</p>
                                                            @elseif($org->org_state==4)                                   
                                                            <p class="card-text mb-0"> Ajman</p>
                                                            @elseif($org->org_state==5)                                     
                                                            <p class="card-text mb-0"> Umm Al Quwain</p>
                                                            @elseif($org->org_state==6)                                      
                                                            <p class="card-text mb-0"> Ras Al Khaimah</p>
                                                            @elseif($org->org_state==7)                                       
                                                            <p class="card-text mb-0"> Fujairah</p>
                                                            @endif
                                                          @else          
                                                            <p class="card-text mb-0"> {{isset($org->org_state) ? $org->org_state : ''}}</p>
                                                          @endif
                                                          <p class="card-text mb-0" > {{(isset($org->countrymaster) ? $org->countrymaster->name : '')}} </p>
                                                          <!-- <p class="card-text mb-0">{{(isset($org->org_phone) ? $org->org_phone : '')}}</p> -->
                                                          <p class="card-text mb-0">{{(isset($org->website) ? $org->website : '' )}}</p>
                                                       <p class="card-text mb-0">{{(isset($org->org_contact_person_number) ? $org->org_contact_person_number : '' )}}</p>
                                          </div>
                                     <!-- wreee -->
                                        <div class="col-md-3">
                                          <div class="d-flex align-items-center mb-1">
                                            <span class="title">Date: {{ now()->toDateString() }}</span>
                                            <!-- <input type="text" class="form-control invoice-edit-input" value="{{ now()->toDateTimeString() }}" readonly/> -->
                                          </div>  
                                        </div>
                                      </div>
                                      <hr class="invoice-spacing" />
                                      <div class="row row-bill-to invoice-spacing" style="padding-top: 5%;"> 
                                        <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
                                          <h6 class="mb-1">Bill To:</h6>
                                          <table>
                                            <tbody>
                                              <tr>
                                                <td class="pe-1">NAME:</td>
                                                <td><strong id="name1"></strong></td>
                                              </tr>
                                              <tr>
                                                <td class="pe-1">EMAIL:</td>
                                                <td id="email1"></td>
                                              </tr> 
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                      <div class="row invoice-sales-total-wrapper" style="padding-top: 5%;">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                          <div class="d-flex align-items-center mb-1">
                                            <label for="agents" class="form-label"><b>Agents:</b></label>
                                            <input type="text" class="form-control ms-50" id="agents" value="" readonly placeholder="Agent Name" />
                                            <input type="hidden" class="form-control ms-50" id="phone_sms" value="" />
                                             <input type="hidden" class="form-control ms-50" id="id_sms" value=""/>
                                          </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                          <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                              <p class="invoice-total-amount"><b>Grand Total: </b><span class="title" id="grand_total"></span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <hr class="invoice-spacing" />
                                      <div class="row invoice-sales-total-wrapper" style="padding-top: 5%;">
                                        <h3 class="mb-1">Link</h3>
                                         <a target="_blank" href="" rel="nofollow"    id="payment_link" style="color: red;"> </a>
                                        <div class="icon-wrapper"  height= 40px; width= 60px; style="margin-top: 3%;"> 
                                       <!-- <a title="Whatsapp" href="https://api.whatsapp.com/send?phone= &text={{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i class="fa fa-whatsapp" style="font-size:24px"></i></a> -->

                                          
                                       <a title="Whatsapp" href="" class="btn btn-danger waves-effect" id="my-link">  <i class="fa fa-whatsapp" style="font-size:25px"></i></a>
                                          <a  title="Payment" target="_blank" id="make_payment" href="" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                          <a title="Message" href="javascript:;" id="sms_send_data" class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></a>
                                          <a title="Mail" href="javascript:;" id="mail_send_data" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
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
            <!--Ends medium modal -->
</section>
<script>

//-----------------------

   $(document).ready(function() {

        var input = document.querySelector("#org_phone");
        window.intlTelInput(input,({
            preferredCountries: ["ae"],
            separateDialCode: true,
        }));
        $('.org_phone1 .iti__flag-container').cahnge(function() { 
          alert();
            var countryCode = $('.org_phone1 .iti__selected-flag').attr('title');
            var countryCode = countryCode.replace(/[^0-9]/g,'');
            //alert(countryCode);
            $('#org_phone').val("");
            $('#org_phone').val("+"+countryCode+" "+ $('#org_phone').val());
        });
    });

const phoneInputField = document.querySelector("#phone");
const phoneInputField2 = document.querySelector("#merchantPhone");
const phoneInput = window.intlTelInput(phoneInputField, {preferredCountries: ["ae"], separateDialCode: true, hiddenInput : "full_phone",});
const phoneInput2 = window.intlTelInput(phoneInputField2, {preferredCountries: ["ae"],separateDialCode: true, hiddenInput : "full_phone",}); 
window.addEventListener('load', function() {
  // Get the forms we want to add validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
}, false);
$(document).ready(function() {
  $('.smsForm11 .iti__flag-container').click(function() { 
    var countryCode = $('.smsForm11 .iti__selected-flag').attr('title');
    var countryCode = countryCode.replace(/[^0-9]/g,'');
    //alert(countryCode);
    $('#phone').val("");
    $('#phone').val("+"+countryCode+" "+ $('#phone').val());
  });
  $('.whatsappForm11 .iti__flag-container').click(function() {
    var countryCode = $('.whatsappForm11 .iti__selected-flag').attr('title');
    var countryCode = countryCode.replace(/[^0-9]/g,'');
    //alert(countryCode);
    $('#merchantPhone').val("");
    $('#merchantPhone').val("+"+countryCode+" "+ $('#merchantPhone').val());
  });
});
//--------------------------------------


var myLatLng = {
lat: 23.4241,
lng: 53.8478
};
var mapOptions = {
  center: myLatLng,
  zoom: 7,
  mapTypeId: google.maps.MapTypeId.ROADMAP
};

// Hide result box
document.getElementById("output").style.display = "none";

// Create/Init map
var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);

// Create a DirectionsService object to use the route method and get a result for our request
var directionsService = new google.maps.DirectionsService();

// Create a DirectionsRenderer object which we will use to display the route
var directionsDisplay = new google.maps.DirectionsRenderer();

// Bind the DirectionsRenderer to the map
directionsDisplay.setMap(map);

// Define calcRoute function
function calcRoute() {
  //create request
  var request = {
    origin: document.getElementById("pickup_address").value,
    destination: document.getElementById("dropoff_address").value,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  }

  // Routing
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {

      //Get distance and time            
      $("#output").html("<div class='containerrr-map'><b> Distance : </b>" + result.routes[0].legs[0].distance.text + "<br> <b>Time :</b> " + result.routes[0].legs[0].duration.text + ".</div>");
      document.getElementById("output").style.display = "block"; 
      //display route
      directionsDisplay.setDirections(result);
    } else {
      //delete route from map
      directionsDisplay.setDirections({
        routes: []
      });
      //center map in London
      map.setCenter(myLatLng);

      //Show error message           

      // alert("Enter Vailid Address");
      // clearRoute();
    }
  });

}

// Clear results

function clearRoute() {
  document.getElementById("output").style.display = "none";
  document.getElementById("pickup_address").value = "";
  document.getElementById("dropoff_address").value = "";
  directionsDisplay.setDirections({
    routes: []
  });

}

// Create autocomplete objects for all inputs
var origin = {};
var destination = {};

var input1 = document.getElementById("pickup_address");
var autocomplete1 = new google.maps.places.Autocomplete(input1, origin);

var input2 = document.getElementById("dropoff_address");
var autocomplete2 = new google.maps.places.Autocomplete(input2, destination);

$(document).ready(function() {
  $('#dropoff_address').change(function() {
    setTimeout(
  function() 
  {

  //create request
  var request = {
    origin: document.getElementById("pickup_address").value,
    destination: document.getElementById("dropoff_address").value,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  }

  // Routing
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {

      //Get distance and time            

      $("#output").html("<div class='containerrr-map'><b> Distance : </b>" + result.routes[0].legs[0].distance.text + "<br> <b>Time :</b> " + result.routes[0].legs[0].duration.text + ".</div>");
       document.getElementById("output").style.display = "block";

      //display route
      directionsDisplay.setDirections(result);
    } else {
      //delete route from map
      directionsDisplay.setDirections({
        routes: [] 
      });
      //center map in London
      map.setCenter(myLatLng);

      //Show error message           

      // alert("Enter Valid Address");
      // clearRoute();
    }
   });
 });

});
});
    </script>
<style>
.containerrr {
  width: 65vw;
  height: 100%;
  border-radius: 1rem;
  background-color: #fff;
  padding: 2rem;
}

.location-label {
  font-size: 1.6rem;
  float: left;
  width: 25%;
  margin-top: .6rem;
}

.location-input {
  float: left;
  width: 75%;
  margin-top: .6rem;
}

.location-input::-webkit-input-placeholder {
  color: #465caa;
}
.result-table {
  font-size: 17px;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    margin-left: 13px;
    height: 2rem;
    animation-name: moveIn;
    animation-duration: 1s;
    animation-timing-function: ease-out;
}

.containerrr-map {
  width: 100%;
  height: 20rem;
  margin: 1rem auto;
}
#suggestions {
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border: 1px solid black;
    position: absolute;
    left: 310px;
    top: 5px;
    background-color: white;
    font-size: 12px;
}
    </style>
<!-- Full calendar end -->
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi3QbrwGSa9syCfRzSbrfvBMw42JNtztk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('page-script')
  {{-- Page js files --}}

  <script>  
 



 
      document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        var formBlock = $('.btn-form-block');
             formSection = $('.form-block'), 
            newUserForm = $('.add-manage-booking-invoice');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          dayMaxEvents: 3,
          editable:false,
          selectable: true,
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          },
          eventSources: [
            {
              url:'../fetchCalenderEvent',

              method: 'POST',
              
              extraParams: function() { // a function that returns an object
                return {
                _token: '{{csrf_token()}}',
                brandId : document.getElementById('filter_vehicle').value,
                modelId :  document.getElementById('filter_model').value,
                skuId : document.getElementById('filter_sku').value,
                SearchskuId : document.getElementById('fleet_search').value
              };
              },
            
            }

          ],

          select: function(info) {
            
            // Making booking form field empty.
            // document.getElementById("booking_form").reset();
            
            document.getElementById('pickup_date_time').value = info.startStr;
            var end_date = new Date(info.endStr);
            var finalEndDate = new Date(end_date.getTime() - (24*60*60*1000)).toISOString().slice(0, 10);
            document.getElementById('drop_off_date_time').value = finalEndDate;

            var is_select_fb = $('#filter_vehicle').val();  // getting filter brand value


            if(is_select_fb){

              $(function() {
                $("#select_vehicle option").each(function(i){

                    (is_select_fb == $(this).val() ? $(this).prop('selected', true) : '');
                });
              });

              $(function() {
                  $("#mselect_vehicle option").each(function(i){
                      (is_select_fb == $(this).val() ? $(this).prop('selected', true) : '');
                  });
              });

            }


            var is_select_fm = $('#filter_model').val();  // getting filter model value

            if(is_select_fm){

              $(function() {
                $("#select_model option").each(function(i){
                    (is_select_fm == $(this).val() ? $(this).prop('selected', true) : '');
                });
              });

              $(function() {
                  $("#mselect_model option").each(function(i){
                      (is_select_fm == $(this).val() ? $(this).prop('selected', true) : '');
                  });
              });

              



              // Getting fleet for pop-up booking form based on date
              var sku = 0;
              var pickup_date_time=$('#pickup_date_time').val();
              var drop_off_date_time=$('#drop_off_date_time').val();
              var from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
              var to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

              $.ajax({
                  url: '../get_available_fleet'+'/'+is_select_fm+'/'+sku+'/'+from_date+'/'+to_date, // JSON file to add data,
                  type: 'get',
                  dataType: 'json',
                  contentType: false,
                  cache : false, 
                  processData: false,
                  success: function (data) {   
                        $('.select_sku').html(data.html);


                        var is_select_fsku = $('#filter_sku').val();  // getting selected sku value in filter pop-up

                        var is_select_ad_fleet = $('#fleet_search').val();  // getting selected fleet value in advance search


                        if(is_select_fsku){

                          $(function() {
                              $("#select_sku option").each(function(i){
                                  (is_select_fsku == $(this).val() ? $(this).prop('selected', true) : '');
                              });
                          });

                        }

                        if(is_select_ad_fleet){

                        $(function() {
                            $("#select_sku option").each(function(i){
                                (is_select_ad_fleet == $(this).val() ? $(this).prop('selected', true) : '');
                            });
                        });

                        }

                  },
                  error: function (data) {
                  }
              });

              
            }

            // For Advance search based fleet getting

            var is_select_ad_fleet = $('#fleet_search').val();  // getting model value if advance search apply

            if(is_select_ad_fleet){

              var is_select_ad_model = $('#select_model').val();  // getting model value if advance search apply


              // Getting fleet for pop-up booking form based on date
              var sku = 0;
              var pickup_date_time=$('#pickup_date_time').val();
              var drop_off_date_time=$('#drop_off_date_time').val();
              var from_date = new Date(pickup_date_time).toLocaleDateString('fr-CA');
              var to_date = new Date(drop_off_date_time).toLocaleDateString('fr-CA');

              $.ajax({
                  url: '../get_available_fleet'+'/'+is_select_ad_model+'/'+sku+'/'+from_date+'/'+to_date, // JSON file to add data,
                  type: 'get',
                  dataType: 'json',
                  contentType: false,
                  cache : false, 
                  processData: false,
                  success: function (data) {   
                        $('.select_sku').html(data.html);

                        $(function() {
                            $("#select_sku option").each(function(i){
                                (is_select_ad_fleet == $(this).val() ? $(this).prop('selected', true) : '');
                            });
                        });


                  },
                  error: function (data) {
                  }
              });

            }

            // Select brand, model and SKU if SKU is selected in advance search box -- code start here


            if(is_select_ad_fleet){

              document.getElementById("filterForm").reset();

              var element = $('#fleet_search').find('option:selected'); 
              var ad_brand = element.attr("data-brand");
              var ad_model = element.attr("data-model");

              console.log(element);
              console.log(ad_brand);
              console.log(ad_model);

              $(function() {
                $("#select_vehicle option").each(function(i){

                    (ad_brand == $('#fleet_search').val() ? $('#fleet_search').prop('selected', true) : '');

                });
              });

              brandmodel(ad_brand,'0');

              function brandmodel(ad_brand,model_id) {
                  $.ajax({
                    url: '../brandmodel'+'/'+ad_brand+'/'+model_id, // JSON file to add data,
                    type: 'get',
                    dataType: 'json',
                    contentType: false,
                    cache : false, 
                    processData: false,
                    success: function (data) {   
                          $('.select_model').html(data.html);

                          $(function() {
                            $("#select_model option").each(function(i){

                                (ad_model == $(this).val() ? $(this).prop('selected', true) : '');

                            });
                          });

                    },
                    error: function (data) {
                    }
                });
              }





              displayDate();

            }



            // Select brand, model and SKU if SKU is selected in advance search box -- code end here


            $('#exampleModal').modal('show');




            $(document).on('click', '#submit', function (e) {
       
       
       // Form validation and save through ajax code start here.

       const select_customer = $('#select_customer').val();
       const phone = $('#phone').val();
       const pickup_date_time = $('#pickup_date_time').val();
       const drop_off_date_time = $('#drop_off_date_time').val();
      //  const pickup_time = $('#pickup_time').val();
      //  const drop_off_time = $('#drop_off_time').val();
       const select_driver = $('#select_driver').val();

      //  const no_of_traveller = $('#no_of_traveller').val();
      //  const pickup_address = $('#pickup_address').val();
      //  const dropoff_address = $('#dropoff_address').val();
       const merchantName = $('#merchantName').val();
       const merchantPhone = $('#merchantPhone').val();
       // const merchant_sku = $('#merchant_sku').val();

       const select_vehicle = $('#select_vehicle').val();
       const select_model = $('#select_model').val();  
       const select_sku = $('#select_sku').val();

       const noteTextarea = $('#noteTextarea').val();
       const mselect_vehicle = $('#mselect_vehicle').val();
       const mselect_model = $('#mselect_model').val();
       const mcomment = $('#mcomment').val();

       //Blank text in span error field
      $('#select_customer_error').html("");
      $('#pickup_date_time_error').html("");
      $('#drop_off_date_time_error').html("");
      // $('#pickup_time_error').html("");
      // $('#drop_off_time_error').html("");
      $('#select_driver_error').html("");

      // $('#no_of_traveller_error').html("");
      // $('#pickup_address_error').html("");
      // $('#dropoff_address_error').html("");
      $('#merchantName_error').html("");
      $('#merchantPhone_error').html("");
      
   //    $('#merchant_sku_error').html("");
      $('#select_vehicle_error').html("");
      $('#select_model_error').html("");   
      $('#select_sku_error').html("");
      // $('#noteTextarea_error').html("");   

      $('#mcomment_error').html("");
      $('#mselect_vehicle_error').html("");
      $('#mselect_model_error').html("");   

       // Applying Validations Here
       if(!phone || !$.trim(phone).length)
        {

            $('#phone_error').html("The phone field is required");
            return $('#phone').focus(); 
        }
       else if(!pickup_date_time || !$.trim(pickup_date_time).length)
       {
           $('#pickup_date_time_error').html("The pickup date field is required");
           return $('#pickup_date_time').focus(); 
       }
       else if(!drop_off_date_time || !$.trim(drop_off_date_time).length)
       {
           $('#drop_off_date_time_error').html("The drop-off date field is required");
           return $('#drop_off_date_time').focus(); 
       }
      //  else if(!pickup_time || !$.trim(pickup_time).length)
      //  {
      //      $('#pickup_time_error').html("The pickup time field is required");
      //      return $('#pickup_time').focus(); 
      //  }
      //  else if(!drop_off_time || !$.trim(drop_off_time).length)
      //  {
      //      $('#drop_off_time_error').html("The drop-off time field is required");
      //      return $('#drop_off_time').focus(); 
      //  }
       else if(!select_driver || !$.trim(select_driver).length)
       {
           $('#select_driver_error').html("The select drive field is required");
           return $('#select_driver').focus(); 
       }
      //  else if(!no_of_traveller || !$.trim(no_of_traveller).length)
      //  {
      //      $('#no_of_traveller_error').html("The no. of passengers field is required");
      //      return $('#no_of_traveller').focus(); 
      //  }
      //  else if(!pickup_address || !$.trim(pickup_address).length)
      //  {
      //      $('#pickup_address_error').html("The pick-up address field is required");
      //      return $('#pickup_address').focus(); 
      //  }
      //  else if(!dropoff_address || !$.trim(dropoff_address).length)
      //  {
      //      $('#dropoff_address_error').html("The drop-off address field is required");
      //      return $('#dropoff_address').focus(); 
      //  }


       if($('input[name="inlineRadioOptions"]:checked').val() == 1){

           if(!select_vehicle || !$.trim(select_vehicle).length)
           {
               $('#select_vehicle_error').html("The brand field is required");
               return $('#select_vehicle').focus(); 
           }
           else if(!select_model || !$.trim(select_model).length)
           {
               $('#select_model_error').html("The model field is required");
               return $('#select_model').focus(); 
           }
           else if(!select_sku || !$.trim(select_sku).length)
           {
               $('#select_sku_error').html("The SKU field is required");
               return $('#select_sku').focus(); 
           }
          //  else if(!noteTextarea || !$.trim(noteTextarea).length)
          //  {
          //      $('#noteTextarea_error').html("The textarea field is required");
          //      return $('#noteTextarea').focus(); 
          //  }
       }

       if($('input[name="inlineRadioOptions"]:checked').val() == 2){

           if(!merchantName || !$.trim(merchantName).length)
           {
               $('#merchantName_error').html("The merchant name field is required");
               return $('#merchantName').focus(); 
           }
           else if(!merchantPhone || !$.trim(merchantPhone).length)
           {
               $('#merchantPhone_error').html("The phone field is required");
               return $('#merchantPhone').focus(); 
           }
           // else if(!merchant_sku || !$.trim(merchant_sku).length)
           // {
           //     $('#merchant_sku_error').html("The SKU field is required");
           //     return $('#merchant_sku').focus(); 
           // }
           else if(!mselect_vehicle || !$.trim(mselect_vehicle).length)
           {
               $('#mselect_vehicle_error').html("The brand field is required");
               return $('#mselect_vehicle').focus(); 
           }
           else if(!mselect_model || !$.trim(mselect_model).length)
           {
               $('#mselect_model_error').html("The model field is required");
               return $('#mselect_model').focus(); 
           }
           else if(!mcomment || !$.trim(mcomment).length)
           {
               $('#mcomment_error').html("The comment field is required");
               return $('#mcomment_error').focus(); 
           }
          //  else if(!noteTextarea || !$.trim(noteTextarea).length)
          //  {
          //      $('#noteTextarea_error').html("The textarea field is required");
          //      return $('#noteTextarea').focus(); 
          //  }

       }
 
       if (!e.isDefaultPrevented()) {
           e.preventDefault()
   
           $( "#submit" ).prop( "disabled", true );

           let formData = new FormData($('#booking_form')[0])
           $.ajax({
                 url: 'save_manage_booking', // JSON file to add data,
                 type: 'POST',
                 dataType: 'json',
                 data: formData,
                 contentType: false,
                 cache : false, 
                 processData: false,
                 success: function (data) {  
                        
                     $( "#submit" ).prop( "disabled", false );
                     if (data.status === true) {
                            
                                 $('#exampleModal').modal('hide');
                                 $('#invoiceModal').modal('show');
                                 createInvoice_calender(data.data.uuid)
                         toastr['success'](''+data.message+'', {
                           closeButton: true,
                           tapToDismiss: false,
                           rtl: isRtl 
                         });

                         displayDate();
                      

                     } else if (data.status === false) {
                       $( "#submit" ).prop( "disabled", false );
                       toastr['error'](''+data.message+'', {
                         closeButton: true,
                         tapToDismiss: false,
                         rtl: isRtl
                       });
                        
                     }
                 },
                 error: function (data) {
                   $( "#submit" ).prop( "disabled", false );
                   toastr['error'](''+data.message+'', {
                     closeButton: true,
                     tapToDismiss: false,
                     rtl: isRtl
                   });
                 }
             }) 
         }
   });


          },                                // select event end here
          eventClick: function(info) {

            var eventObj = info.event;

            if (eventObj.url) {

              window.open(eventObj.url);

              info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
            }
          },

        });

        calendar.render();

        document.getElementById("bookinBtnClose").addEventListener("click", resetFormField);
        document.getElementById("btnClose").addEventListener("click", resetFormField);
        document.getElementById("submit").addEventListener("click", filterFunction);


        function resetFormField(){

          document.getElementById("booking_form").reset();

        }


        function displayDate() {

          calendar.refetchEvents();

        }



        $(document).on('change', '#fleet_search', function(){
          

          if($(this).val() != ''){

            document.getElementById("filterForm").reset();

            var element = $(this).find('option:selected'); 
            var ad_brand = element.attr("data-brand");
            var ad_model = element.attr("data-model");

            $(function() {
              $("#select_vehicle option").each(function(i){

                  (ad_brand == $(this).val() ? $(this).prop('selected', true) : '');

              });
            });

            brandmodel(ad_brand,'0');

            function brandmodel(ad_brand,model_id) {
                $.ajax({
                  url: '../brandmodel'+'/'+ad_brand+'/'+model_id, // JSON file to add data,
                  type: 'get',
                  dataType: 'json',
                  contentType: false,
                  cache : false, 
                  processData: false,
                  success: function (data) {   
                        $('.select_model').html(data.html);

                        $(function() {
                          $("#select_model option").each(function(i){

                              (ad_model == $(this).val() ? $(this).prop('selected', true) : '');

                          });
                        });

                  },
                  error: function (data) {
                  }
              });
            }

            


            
            displayDate();

          }


        });


        document.getElementById("filter_submit").addEventListener("click", filterFunction);

        function filterFunction() {

          $('#fleet_search option:first').prop('selected',true).trigger( "change" );

          calendar.refetchEvents();

        }


      });

      var isRtl = $('html').attr('data-textdirection') === 'rtl';



function createInvoice_calender(uuid) {
  $.ajax({
    url: '../../createInvoice_calender'+'/'+uuid, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (data) {   
      
       $('#full_name').val(data.customer.fullname); 
       $('#emails').val(data.customer.email); 
       $('#phones').val(data.customer.mobile); 
       $('#street').val(data.customer.address1); 
       $('#city').val(data.customer.city); 
       $('#state').val(data.customer.state); 
       
      if(data.booked.dispatch_type==1){
        $('.sku').val(data.sku[0].car_SKU);
      }else{
        $('.sku').val('0');
         
      }
        var kk=data.brand.brand_name;
        var kt=data.sku[0].car_SKU;
        var ktt='-'+data.diffDays;
        var kttt='day rental';
        var all=kk+kt+ktt+kttt;
        
       $('#sku_id').val(data.customer.fleet_id); 
       $('.description').val(all); 
       $('.total').val(data.total); 
       $('.tax').val(data.vat); 
       $('.discount').val('0'); 
       $('.period').val(data.period); 
       $('.price').val(data.price); 
       $('.sub_total').val(data.total); 
       $('.footer_discount').val('0'); 
       $('.footer_promotion').val('0'); 
       $('.delivery_charge').val('0'); 
       $('.grand_total').val(data.total); 
       $('#sku_set').val(data.sku[0].car_SKU); 
       $('#sku_id').val(data.sku[0].id); 
       $('#description_set').val(data.brand.brand_name); 
       $('#price_set').val(data.price); 
       $('#diffDays_set').val(data.diffDays); 
       $('#booking_id').val(data.uuid); 
       
       var selOpts = "";
      for (i=0;i<data.country.length;i++)
      {
          var id = data.country[i]['id'];
          var val = data.country[i]['name'];
          
          selOpts += "<option value='"+id+"'>"+val+"</option>";
      }
         
      $('#country').append(selOpts);

    },
    error: function (data) {
    }
});
}

$(document).on('click', '#invoice_submit', function (e) {

  // Form validation and save through ajax code start here.

 const full_name = $('#full_name').val();
//  const emails = $('#emails').val();
 const currency_type = $('#currency_type').val();
 const transaction_type = $('#transaction_type').val();
 
 //Blank text in span error field
$('#full_name_error').html("");
// $('#emails_error').html("");
$('#currency_type_error').html("");
$('#transaction_type_error').html("");

 // Applying Validations Here
 if(!full_name || !$.trim(full_name).length)
 {

     $('#full_name_error').html("The Name field is required");
     return $('#full_name').focus(); 
 } 

//  if(!emails || !$.trim(emails).length)
//  {

//      $('#emails_error').html("The Email field is required");
//      return $('#emails').focus(); 
//  } 

 if(!currency_type || !$.trim(currency_type).length)
 {

     $('#currency_type_error').html("The Currency field is required");
     return $('#currency_type').focus(); 
 }

 if(!transaction_type || !$.trim(transaction_type).length)
 {

     $('#transaction_type_error').html("The Transaction Type field is required");
     return $('#transaction_type').focus(); 
 } 


  if (!e.isDefaultPrevented()) {
        e.preventDefault()

      $( "#invoice_submit" ).prop( "disabled", true );
      
        let formData = new FormData($('#booking_form_invoice')[0])
      
        var grand =$('#grandTotal').val();
        if(grand==0){
            Swal.fire({
                icon: 'error',
                text: 'Check Your Invoice Value',
                customClass: {
                  confirmButton: 'btn btn-error'
                } 
              }); 
        }else{
       $.ajax({
            url: '../save_booking_invoice', // JSON file to add data,
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {  
              
                $( "#invoice_submit" ).prop( "disabled", false );
                if(data.status === true) {
                
                  if(data.data.transaction_type == "4") {
                          
                           $('#invoiceModal').modal('hide');
                           $('#priviewModal').modal('show');
                           bookingcalendarpreview(data.data.uuid)
                    
                  }else{
                    
                    toastr['success'](''+data.message+'', {
                      closeButton: true,
                      tapToDismiss: false,
                      rtl: isRtl 
                    });
                           $('#invoiceModal').modal('hide');
                           $('#priviewModal').modal('show');
                           bookingcalendarpreview(data.data.uuid)
                      
                  }
                } else if (data.status === false) {
                  
                  $( "#submit" ).prop( "disabled", false );
                  toastr['error'](''+data.message+'', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                  });
                   
                 
                }
            },
            error: function (data) {
              $( "#submit" ).prop( "disabled", false );
              toastr['error'](''+data.message+'', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
              });
            }
        })
      }
    }
});

function bookingcalendarpreview(uuid) {
  $.ajax({
    url: '../../bookingcalendarpreview'+'/'+uuid, // JSON file to add data,
    type: 'get',
    dataType: 'json',
    contentType: false,
    cache : false, 
    processData: false,
    success: function (data) {   
         
        var booking_code='1000';
        var booking_code1=data.get_data.booking_code;
        var booking_code2=booking_code+booking_code1;
       
        $('#invoice_data').val(booking_code2); 
        $('#booking_id_data').val(data.get_data.booking_id); 
        $('#transaction_typesss').val(data.get_data.transaction_type); 
        
        $('#uuid_data').val(data.get_data.uuid); 
        
        $('#copyss_href1').text(data.get_data.short_link); 
        $('#copied_url').val(data.get_data.short_link);   
         var link=data.get_data.short_link;
         var link2=data.get_data.mobile;
         
        
        document.getElementById("payment1").setAttribute("href",link);
        document.getElementById("whatsappaaa").setAttribute("href","https://api.whatsapp.com/send?phone="+link2+"&text="+link+"");

        let dateFormat1 = moment(data.get_data.date).format('DD-MM-YYYY');
          console.log(dateFormat1);
        $('#date_id').val(dateFormat1); 
        $('#emails').text(data.get_data.email); 
        $('#customer_email_data').text(data.get_data.customer_email); 
        $('#fullname_data').text(data.get_data.fullname); 
        $('#grand_total_data').text(data.get_data.grand_total); 
        $('#mobile_data').text(data.get_data.mobile); 

        var city=data.get_data.org_city;
        var city1=data.get_data.org_state;
        var city2=data.get_data.org_postal;
        var city3=city+city1+city2;

        $('#org_city_id').text(city3); 
        $('#org_phone_id').text(data.get_data.org_phone); 
        
        var street =data.get_data.org_street1;
        var street1 =data.get_data.org_street2;
        var street2=street+street1;

        $('#org_street2_id').text(street2); 
        $('#promotion_value_data').text(data.get_data.promotion_value); 
        $('#subtotal_data').text(data.get_data.subtotal); 
        $('#subtotal_discount_data').text(data.get_data.subtotal_discount); 
        $('#delivery_charge_data').text(data.get_data.delivery_charge); 
        if(data.get_data.transaction_type==4){
        
          $(".cash_collected").show();
          $("#transaction_type_data").show();
        
          var tt=data.get_data.transaction_type
          seltotal += "<option value='"+tt+"'>Cash</option>";
          $('#transaction_type_data').append(seltotal);
          
        }else{
          
          $(".cash_collected").hide();
          $("#transaction_type_data").hide();
          
        }
       
        $('#org_name_data').val(data.get_data.fullname);    
         
        var kk=data.get_data.address1;
        var kt=data.get_data.address2;
        var ktt=data.get_data.customer_city;
        var kttt=data.get_data.postcode;
        var all=kk+kt+ktt+kttt;
        $('#address1_data').text(all); 

        var selOpts = "";
      for (i=0;i<data.get_details.length;i++)
      {
          var val = data.get_details[i]['description'];
           selOpts += "<p>"+val+"</p>";
      }
         
      $('#description_data').append(selOpts);

      var seltotal = "";
      for (i=0;i<data.get_details.length;i++)
      {
          var val = data.get_details[i]['total'];
          seltotal += "<p>"+val+"</p>";
      }
         
      $('#total_data').append(seltotal);

    },
    error: function (data) {
    }
});

}

//Priview store start
$(document).ready(function() {

$('#store_note').on('click', function() {
var name = $('#inv_preview_note').val();   
var booking_uuid = $('#booking_id_data').val();
var transaction_type = $('#transaction_typesss').val();

   $.ajax({
       url: "../inv_note_store" + '/' + booking_uuid,
       type: "POST",
       data: {
           _token: $("#csrf").val(),
           type: 1,
           name: name, 
           transaction_type: transaction_type  
          
           
       },
       cache: false,
       success: function(response){
        
        if(transaction_type==4){
                 $('#priviewModal').modal('hide'); 
                 $('#large').modal('hide');
        }else{
                 $('#priviewModal').modal('hide'); 
                 $('#large').modal('show');
                  
        }
         
            var response = JSON.parse(response);
           if(response.statusCode==200){
             // window.location = "/memberInformation";				
           } 
       }
   });  
});


$('#mail_send').on('click', function() { 
var booking_uuid = $('#booking_id_data').val(); 

 $.ajax({
     url: "../popupmail_trigger" + '/' + booking_uuid,
     type: "get",
     data: { 
         
     },
     cache: false,
     success: function(res){
      console.log(res);
                if (res == 'true') {

          Swal.fire({
            icon: 'success',
            title: 'Sent!',
            text: 'Mail has been sent successfully.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
              
          });

          }
     }
 });   
});  

$('#mail_sendss').on('click', function() { 
var booking_uuid = $('#booking_id_data').val(); 
  
 $.ajax({
     url: "../popupmail_trigger" + '/' + booking_uuid,
     type: "get",
     data: { 
         
     },
     cache: false,
     success: function(res){
      console.log(res);
                if (res == 'true') {

          Swal.fire({
            icon: 'success',
            title: 'Sent!',
            text: 'Mail has been sent successfully.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
              
          });

          }
     }
 });   
});  


$('#sms_send').on('click', function() { 
 var uuid = $('#uuid_data').val(); 
    
     $.ajax({
         url: "../popupsms_trigger" + '/' + uuid,
         type: "get",

         cache: false,
         success: function(res){
          console.log(res);
          if (res == 'true') {

            Swal.fire({
              icon: 'success',
              title: 'Sent!',
              text: 'Payment link has been sent successfully.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
                
            });

            }
         }
     }); 
   });  

   $('#sms_sendss').on('click', function() { 
 var uuid = $('#uuid_data').val(); 
  
     $.ajax({
         url: "../popupsms_trigger" + '/' + uuid,
         type: "get",

         cache: false,
         success: function(res){
          
          if (res == 'true') {

            Swal.fire({
              icon: 'success',
              title: 'Sent!',
              text: 'Payment link has been sent successfully.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
                
            });

            }
         }
     }); 
   });  





     

});


</script>


@section('vendor-script')
  {{-- Vendor js files --}}
    
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

  <script src="https://momentjs.com/downloads/moment.min.js"></script>
  {{-- data table --}} 
 
@endsection


<script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-payment_payments-list.js') }}"></script>
<script src="{{ asset('js/scripts/pages/app-full-calender.js') }}"></script>
<script src="{{ asset('js/scripts/pages/booking-invoice-list.js') }}"></script>    
  <script src="{{ asset('js/scripts/pages/booking-invoice-create.js') }}"></script> 
  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
  <script src="https://momentjs.com/downloads/moment.min.js"></script>
@endsection

<style>
$white:    #fff !default;
$gray-100: #f8f9fa !default;
$gray-200: #e9ecef !default;
$gray-300: #dee2e6 !default;
$gray-400: #ced4da !default;
$gray-500: #adb5bd !default;
$gray-600: #6c757d !default;
$gray-700: #495057 !default;
$gray-800: #343a40 !default;
$gray-900: #212529 !default;
$black:    #000 !default;

// Colors
$blue:    #4267B2;
$purple:  #6A47DA;
$pink:    #F75358;
$red:    #FA6541;
$orange: #F8B91C;
$green:   #09C098;
$teal:   #0EE25C;
$body-color: #344051;
$primary: blue;
$spacer: 20px;

//before and after mixin 
@mixin pseudo($display: block, $pos: absolute, $content: ''){
  content: $content;
  display: $display;
  position: $pos;
}

.container {
  max-width: 600px;
  margin: 30px auto;
}
img {
  max-width: 100%;
  height: auto;
  vertical-align: middle;
}
// material style form
.md-group {
    position: relative;
    margin-bottom:  15px;
  padding-top: 1rem;
  padding-bottom: 1rem;
    input:not([type="submit"]),
    input:not([type="reset"]),
    textarea,
    select,
    select.form-control {
        border: none;
        border: 1px solid $gray-400;
        border-radius:0px;
        background-clip:unset;
        color:transparent;
        padding: 15px;
        height: 40px;
        &::placeholder{
        color:transparent;

        }

        &:focus{
            outline:none;
            border-color: blue;
        	box-shadow:none;
             color: #333 !important;
        &::placeholder{
        color:$gray-300 !important;
            
        }
        	& +label, .ng2-tag-input-focus + label {
        		top:0;
                font-size:  rem(12);
        	}
        }
        
        &:invalid  {
            .was-validated &{
             border-bottom:1.2px solid $red;
            }
            & ~label {
                .was-validated & {
                    color:$red;
                }
                
             }
            
        }
         &:valid, &:invalid {
               &:focus {
                outline:none;
            box-shadow:none;
            }
        }
        &:valid {
            .was-validated &{
             border-bottom:1.2px solid $green;
              & ~label {
                .was-validated & {
                    color:$green;
                }
                
             }
            }
        }

        
    }
    textarea {
        height: auto;
    }
    label {
    	margin:0;
    	position: absolute;	
    	top: 1.5rem;
    	pointer-events: none;
    	display:block;
    	left:0.75rem;
    	transition:all 0.2s ease-in-out;
        color:$gray-500;
        z-index: 9;
    }
&.is-valid {
    border-bottom: 1.2px solid $green;
    & ~label {
        color:$green;
    }
}
&.is-invalid {
    border-bottom: 1.2px solid $red;
    & ~label {
        color:$red;
    }
}
&.input-group {
	[class*="input-group"]{
		opacity:0;
		visibility:hidden;
		width:0;
         
	}
	.form-control {
		width:100%;
	}
}
}

.show-label {
	label {
        color: $blue;
        top: -10px;
        left: 0;
        font-size:  rem(14);

	}

	&.input-group {
		[class*="input-group"]{
		opacity:1;
		visibility:visible;
		width:auto;
	}
	.form-control {
		width:1%;
	}
	}
    .form-control {
         color:$body-color !important;
      padding: 0.3125rem !important;
        &::placeholder{
        color:$gray-300 !important;
            
        }
    }
}

</style>

