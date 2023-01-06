@extends('layouts.main')
@section('title', '')
<link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
    #project-label {
     display: block;
     font-weight: bold;
     margin-bottom: 1em;
  }
  #project-icon {
     float: left;
     height: 32px;
     width: 32px;
  }
  #project-description {
     margin: 0;
     padding: 0;
  }
   .card .card-header {
    padding: 0 !important; 
}
.iti {
    width: 100%;
  }
</style>

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


@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">


@endsection

@section('content')
 
<section class="app-user-view-account">
  <div class="row"> 
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
      <div class="card"> 
        <div class="card-body px-1"> 
          <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="post"> 
                <div class="card-header ">
                  <h4 style="font-size: 1.486rem;">Create Booking</h4>
                </div><hr> 
        
            <section id="multiple-column-form">
              <div class="row">
                <!-- <div class="col-12">
                  <div class="card">  -->
                    <!-- <div class="card-body"> -->
                      <div class="col-8 "><!--col-8-start--> 
                        <div class="mb-1 border-bottom">
                          <h4 class="h5"><b>Customer Info</b></h4>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="Company">Select Company</label>
                              <div class="mb-1">
                              <select class="form-select Company" id="Company" name="Company">
                                  <option value=""></option>
                                  @foreach($Company as $Organisation) 
                                  <option value="{{$Organisation->id}}">{{$Organisation->org_name}}</option>
                                  @endforeach
                                </select>   
                              </div> 
                            </div>
                          </div>
                          
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_customer">Select Customer</label>
                              <div class="mb-1">
                                <!-- <select class="form-select select_customer" id="select_customer" name="select_customer">
                                  <option value=""></option>
                                  @foreach($customer as $customer) 
                                  <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                                  @endforeach
                                </select> -->

                                <input type="hidden" id="select_customer" name="select_customer" value="" class="select_customer typeahead form-control"> 
                                <input type="text" id="select_customer1" name="select_customer1" data-id="" class="typeahead form-control"> 
                                <div id="customer_list"></div>

                              </div>
                              
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                            <label class="form-label" for="phone-column">Phone</label>
                              <div class="mb-1">
                                <input type="tel" id="phone" name="phone" value="" class="form-control" readonly>
                              </div>
                            </div>
                          </div><div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="email-column">Email</label>
                              <div class="mb-1">
                                <input type="text" id="email" name="email" value="" class="form-control" readonly>
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
                                <label class="form-label" for="pickup_date_time-column">Pickup Date</label>
                                <input type="date" id="pickup_date_time" class="form-control" value="" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                              </div>

                              <div class="mb-1">
                                <label class="form-label" for="pickup_date_time-column">Pickup Time</label>
                                <input type="time" id="pickup_time" class="form-control" value="" placeholder="Date" name="pickup_time" min="<?php echo date('H:i'); ?>" /> 
                              </div>

                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="drop_off_date_time-column">Drop-off Date&Time</label>
                                <input type="date" id="drop_off_date_time" class="form-control" value="" placeholder="Date" name="drop_off_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                              </div>

                              <div class="mb-1">
                                <label class="form-label" for="pickup_time-column">Drop-off Time</label>
                                <input type="time" id="drop_off_time" class="form-control" value="" placeholder="Date" name="drop_off_time" min="<?php echo date('H:i'); ?>" /> 
                              </div>

                            </div>

                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="select_driver-column">Select Driver</label>
                                <div class="mb-1">
                                  <select class="form-select" id="select_driver" name="select_driver">
                                    <option value=""> </option>
                                    <option value="1">Self Drive</option>
                                    <option value="2">Car with Driver</option>  
                                    <option value="3">Limousine</option>  
                                  </select>
                                </div>
                              </div>
                            </div>

                            <input type="hidden" id="updated_id" class="form-control" value="" placeholder="Name" name="updated_id" /> 
                            
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="no_of_traveller-column">No. of Travellers (Including Children)</label>
                                <input
                                  type="number"
                                  id="no_of_traveller"
                                  class="form-control"
                                  value=""
                                  placeholder="1"
                                  name="no_of_traveller"
                                />
                              </div>
                            </div> 
                            
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="pickup_address-column">Pickup Address</label>
                                <div class="mb-1">
                                  <input
                                    class="form-control"
                                    id="pickup_address"
                                    rows="3"
                                    name="origin"
                                    placeholder=" "
                                  > 
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="dropoff_address-column">Drop-off Address</label>
                                <div class="mb-1">
                                  <input
                                    class="form-control"
                                    id="dropoff_address"
                                    rows="3"
                                    name="destination"
                                    placeholder=" "
                                  > 
                                </div>
                              </div>
                            </div>
                            <div class="demo-inline-spacing mb-1">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" checked="">
                                  <label class="form-check-label" for="inlineRadio1">Auto Dispatch</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2"  >
                                  <label class="form-check-label" for="inlineRadio1">Manual Assignment</label>
                              </div> 
                          </div>
                          <div class="row mb-2 " id="merchant" style="display:none"> 
                            <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="merchantName">Merchant Name</label>
                                    <input type="text" class="form-control" name="merchantName" id="merchantName" placeholder="Name"> 
                                      
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="merchantPhone">Phone</label>
                                    <input type="number" class="form-control" name="merchantPhone" id="merchantPhone" placeholder="Phone">
                                </div>
                            </div> 

                            <div class="col-xl-6 col-md-6 col-6">
                              <div class="mb-1">
                                  <label class="form-label" for="merchant_sku">Please Enter SKU</label>
                                  <input type="text" class="form-control merchant_sku" name="merchant_sku" id="merchant_sku" placeholder="">
                                  <input type="hidden" class="form-control merchant_sku_id" name="merchant_sku_id" id="merchant_sku_id" placeholder="" value="">
                                  <input type="hidden" class="form-control merchant_sku_brand" name="merchant_sku_brand" id="merchant_sku_brand" placeholder="" value="">
                                  <input type="hidden" class="form-control merchant_sku_model" name="merchant_sku_model" id="merchant_sku_model" placeholder="" value="">
                              </div>
                            </div>  
  
                          </div>

                          <div class="row mb-2 " id="auto_dispached"> 
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="select_vehicle-column">Brand</label>
                                <div class="mb-1">
                                  <select class="form-select select_vehicle" id="select_vehicle" name="select_vehicle">
                                    <option value=""></option>
                                    @foreach($vehicle as $vehicle)
                                    
                                      <option  value="{{$vehicle->id}}">{{$vehicle->brand_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="select_model-column">Model</label>
                                <div class="mb-1">
                                  <select class="form-select select_model" id="select_model" name="select_model">
                                    <option value=""></option>
                                    
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6 col-12" style="display:none" id="skudiv">
                              <div class="mb-1">
                                <label class="form-label" for="select_sku-column">SKU</label>
                                <div class="mb-1">
                                  <select class="form-select select_sku" id="select_sku" name="select_sku">
                                    <option value=""></option>
                                    
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                              <input type="hidden" class="form-control" name="sku" id="sku" value="0" placeholder="Phone">
                                {{--  <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_fleet-column">Fleet</label>
                              <div class="mb-1">
                                <select class="form-select select_fleet" id="select_fleet" name="select_fleet">
                                <option value=""></option>
                                  @foreach($fleet as $fleet)
                                    <option  value="{{$fleet->id}}">{{$fleet->car_SKU}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div> --}}
                        </div>
                      
                      </div>
                      <div class="col-4"> 
                      <div class="containerrr-map" id="google-map" style="height: 463px"></div>
                       <div id="output" class="result-table" style="font-size: 100%;"></div>
                        <!-- <img class="mb-3" src="{{asset('public/images/map/booking_map.png')}}" alt="booking-map-image" title="booking-map-image" height="100%" width="100%">  -->
                        <!-- <div class="leaflet-map" id="user-location"></div> -->
                         <br>
                        <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="noteTextarea">Note</label>
                                <textarea class="form-control " id="noteTextarea" rows="7" name="note" placeholder="Textarea"></textarea>
                            </div>
                        </div>
                        </div>
                      </div>  

                    <div class="text-center">
                       <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button>                      
                    </div> 
                  <!-- </div>
                </div> -->
               
              </div> 
               
            </section>  
          </form> 
        </div> 
      </div>
    </div>
  </div>
</section>
<script>
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
      $("#output").html("<div class='containerrr-map'> Distance: " + result.routes[0].legs[0].distance.text + "Time: " + result.routes[0].legs[0].duration.text + ".</div>");
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

      $("#output").html("<div class='containerrr-map'> Distance: " + result.routes[0].legs[0].distance.text + "Time: " + result.routes[0].legs[0].duration.text + ".</div>");
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
  font-size: 1.6rem;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  height: 3rem;
  /* Animation */
  animation-name: moveIn;
  animation-duration: 1s;
  animation-timing-function: ease-out;
}

.containerrr-map {
  width: 100%;
  height: 20rem;
  margin: 1rem auto;
}

    </style>

@endsection  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi3QbrwGSa9syCfRzSbrfvBMw42JNtztk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('vendor-script')
  {{-- Vendor js files --}}
    
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}

  <script src="{{ asset('js/scripts/pages/app-booking.js') }}"></script> 
  <!-- <script src="{{ asset('js/scripts/pages/manage-booking-list.js') }}"></script>   -->
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection

<script>
// Vanilla Javascript
var input = document.querySelector("#phone");
window.intlTelInput(input,({
    preferredCountries: ["ae"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'')
        $('#phone').val("");
        $('#phone').val("+"+countryCode+" "+ $('#phone').val());
    });
});

var input = document.querySelector("#merchantPhone");
window.intlTelInput(input,({
    preferredCountries: ["ae"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'')
        $('#merchantPhone').val("");
        $('#merchantPhone').val("+"+countryCode+" "+ $('#merchantPhone').val());
    });
});
// fgfd
</script>