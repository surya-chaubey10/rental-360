@extends('layouts.main')
@section('title', '')
 
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
<style>
    .text-center {
        text-align: center;
    }
    .modal-body{
    overflow-y: auto;
}
    </style>

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">


@endsection

@section('content')
 
<section class="app-user-view-account">
  <div class="row"> 
    <div class="col-xl-12">   <!-- col-lg-5 col-md-5 order-1 order-md-0 -->
      <div class="card"> 
        <div class="card-body"> 
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
                          <h4 class="h5"><b>Customer Search</b></h4>
                      </div>
                      <div class="row">
                      <div class="col-md-12 col-12">
                          <div class="mb-1">
                            <!-- <label class="form-label" for="select_customer">Select Customer</label> -->
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
                              <!-- <select class="form-select select_customer" id="select_customer" name="select_customer">
                                <option value=""></option>
                                @foreach($customer as $customer) 
                                <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                                @endforeach
                              </select> -->

                              <input type="hidden" id="select_customer" name="select_customer" value="" class="select_customer typeahead form-control"> 
                              <input type="text" id="select_customer_n" name="select_customer_n" data-id="" class=" form-control">  
                            </div>                           
                          </div>
                        </div> 
                        <!-- <div class="col-md-6 col-12" id="phoneDiv">
                          <div class="mb-1">
                          <label class="form-label" for="phone-column">Phone</label>
                            <div class="mb-1">
                               <input type="tel" id="phone" name="phone"  class="form-control" >
                            </div>
                          </div> -->
                           <div class="container row mb-4 col-md-6 col-12" style="width: 53%;">
                                <div class="form-group md-group show-label billingform ">
                                  <label class="form-label">Phone</label>
                                  <input class="form-control mb-1" type="tel" name="phone"  id="phone1" value="+971 ">
                                </div>
                                  <div class="form-group md-group show-label">
                                  <select hidden name="" id="address-country" class="form-control">
                                    </select>
                                  </div>
                                </div>
                            
                        <div class="col-md-12 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="email-column">Email</label>
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
                              <label class="form-label" for="pickup_date_time-column">Pickup Date</label>
                              <input type="date" id="pickup_date_time" class="form-control" value="" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                            </div>

                            <div class="mb-1">
                              <label class="form-label" for="pickup_date_time-column">Pickup Time</label>
                              <input type="time" id="pickup_time" class="form-control" value="00:00:00" placeholder="Date" name="pickup_time"  /> 
                            </div>

                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="drop_off_date_time-column">Drop-off Date</label>
                              <input type="date" id="drop_off_date_time" class="form-control" value="" placeholder="Date" name="drop_off_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                            </div>

                            <div class="mb-1">
                              <label class="form-label" for="pickup_time-column">Drop-off Time</label>
                              <input type="time" id="drop_off_time" class="form-control" value="00:00:00" placeholder="Date" name="drop_off_time" /> 
                            </div>

                          </div>

                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_driver-column"> Drive Type</label>
                              <div class="mb-1">
                                <select class="form-select" id="select_driver" name="select_driver">
                                  <option value=""> </option>
                                  <option value="1">Self Drive</option>
                                  <option value="2">Car with Drive</option>  
                                  <option value="3">Limousine</option>  
                                </select>
                              </div>
                            </div>
                          </div>
             
                          <input type="hidden" id="updated_id" class="form-control" value="" placeholder="Name" name="updated_id" /> 
                          
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="no_of_traveller-column">No. of Passengers (Optional)</label>
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
                             
                              <div class="location-input col-md-12 col-12">
                                <input
                                  class="form-control map-input"
                                 
                                  rows="3"type="text" id="location-1" name="origin" 
                                  placeholder=" "
                                 style="" > 
                             
                             
                            </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="dropoff_address-column">Drop-off Address</label>
                              
                              <div class="location-input col-md-12 col-12">
                                <input
                                  class="form-control"
                                  rows="3"
                                  id="location-2" name="destination" 
                                 
                                  placeholder=" "
                                  style=" " > 
                                  <!-- onkeyup="myFunction()" -->
                              </div>
                            </div>
                          </div>
                          <div class="demo-inline-spacing mb-1">
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
                            <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="merchantName">Merchant Name</label>
                                    <input type="text" class="form-control" name="merchantName" id="merchantName" placeholder="Name"> 
                                      
                                </div>
                            </div>

                            <!-- <div class="col-xl-6 col-md-6 col-6" id="merchantPhoneDiv">
                                <div class="mb-1">
                                    <label class="form-label" for="merchantPhone">Phone</label>
                                    <input type=tel class="form-control" name="merchantPhone" id="merchant_Phone" placeholder="Phone">
                                </div>
                            </div>  -->
                            <div class="container row mb-4 col-md-6 col-12" style="width: 53%;">
                                <div class="form-group md-group show-label billingform ">
                                  <label class="form-label">Phone</label>
                                  <input class="form-control mb-1" type="tel" name="merchantPhone"  id="merchant_Phone" value="+971 ">
                                </div>
                                  <div class="form-group md-group show-label">
                                  <select hidden name="" id="address-country" class="form-control">
                                    </select>
                                  </div>
                                </div>

                            <div class="col-xl-6 col-md-6 col-6">
                              <!-- <div class="mb-1">
                                  <label class="form-label" for="merchant_sku">Please Enter SKU</label> 
                                  <input type="text" class="form-control merchant_sku" name="merchant_sku" id="merchant_sku" placeholder="Search SKU Name">
                                  <div id="opensku_list"></div> 
                                  <input type="hidden" class="form-control merchant_sku_id" name="merchant_sku_id" id="merchant_sku_id" placeholder="" value="">
                                  <input type="hidden" class="form-control merchant_sku_brand" name="merchant_sku_brand" id="merchant_sku_brand" placeholder="" value="">
                                  <input type="hidden" class="form-control merchant_sku_model" name="merchant_sku_model" id="merchant_sku_model" placeholder="" value="">
                              </div> -->
                             
                                 <div class="mb-1">
                                    <label class="form-label" for="select_vehicle-column">Brand</label>
                                    <div class="mb-1">
                                      <select class="form-select select3 select_marchantvehicle" id="select_vehicle" name="merchant_sku_brand">
                                        <option value=""></option>
                                        @if($vehicleopen)
                                        @foreach($vehicleopen as $vehicleopen)
                                          <option  value="{{$vehicleopen->id}}">{{$vehicleopen->brand_name}}</option>
                                        @endforeach
                                        @endif
                                      </select>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-xl-6 col-md-6 col-6">
                                  <div class="mb-1">
                                    <label class="form-label" for="select_model-column">Model</label>
                                    <div class="mb-1">
                                      <select class="form-select select3 select_marchantmodel" id="select_model" name="merchant_sku_model">
                                        <option value=""></option>
                                      </select>
                                    </div>
                                  </div>
                               </div>
                               <div class="col-xl-6 col-md-6 col-6">
                                  <div class="mb-1">
                                    <label class="form-label" for="Comment-column">Comment</label>
                                    <div class="mb-1">
                                    <textarea class="form-control" placeholder="Comment" name="open_comment" id="comment" style="resize:none" rows="2" cols="50"></textarea>
                                  </div>
                                  </div>
                               </div>
                           </div>
 
                        <div class="row mb-2 " id="auto_dispached"> 
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_vehicle-column">Brand</label>
                              <div class="mb-1">
                                <select class="form-select select2  select_vehicle" id="select_vehicle" name="select_vehicle">
                                  <option value=""></option>
                                  @foreach($vehicle as $vehicle)
                                    <option  value="{{$vehicle->id}}">{{$vehicle->brand_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1" style=" margin-left: 27px;width: 100%;">
                              <label class="form-label" for="select_model-column" >Model</label>
                              <div class="mb-1" >
                                <select class="form-select select2 select_model" id="select_model" name="select_model">
                                  <option value=""></option>
                                  
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-12" style="display:none" id="skudiv">
                            <div class="mb-1">
                              <label class="form-label" for="select_sku">SKU</label>
                              <div class="mb-1">
                                <select class="form-select select_sku" id="select_sku" name="select_sku">
                                  <option value=""></option>
                                  
                                </select>
                                <span class="SKU_error" id="SKU_error" style="color:red"> </span>
                                <input type="hidden" class="SKU_error_value" id="SKU_error_value">

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
                                    <option  value="{{$fleet->id}}">{{$fleet->car_SKU}} - {{$fleet->car_number}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div> --}}
                        </div>
                      
                      </div>
                      <div class="col-4"> 
                        <!-- <img class="mb-3" src="{{asset('public/images/map/booking_map.png')}}" alt="booking-map-image" title="booking-map-image" height="100%" width="100%">  -->
                        <!-- <div class="leaflet-map" id="user-location"></div>  -->
                        <br>
                           <!-- <div  id="showmap" class="mapshowdive" ></div>  -->
                           <div class="col-md-10 col-12" style="margin-left:15px;">  
                       

                         <div class="mb-2"> <br>
                        <!-- <input type="text" id="address-input" name="address_address" class="form-control map-input">
                        <input type="hidden" name="address_latitude" id="address-latitude" value="" />
                        <input type="hidden" name="address_longitude" id="address-longitude" value="" /> -->
                        
                      </div>
                    </div>
                     
                    <div class="containerrr-map" id="google-map" style="height: 463px"></div>
                       <div id="output" class="result-table" style="font-size: 100%;"></div>

                        <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="noteTextarea">Note</label>
                                <textarea class="form-control " id="noteTextarea" rows="7" style="resize:none" name="note" placeholder="Textarea"></textarea>
                            </div>
                        </div>
                        </div>
                      </div>  
                      
                    <!-- </div>  -->
                  <!-- </div>
                </div> -->
                <div class="text-center">
                <button  id="submit" name="submit" type="submit" class="btn btn-success me-1 btn-form-block">Submit</button>
              </div> 
                 
            </section>  
          </form> 
        </div> 
      </div>
    </div>
  </div>
</section>
<script>
  //merchant_phone
var countryData = window.intlTelInputGlobals.getCountryData(),
  input = document.querySelector("#merchant_Phone"),
  addressDropdown = document.querySelector("#address-country");
var iti = window.intlTelInput(input, {
  preferredCountries: ["ae"],
  hiddenInput: "full_phone",
  utilsScript: "https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js?1549804213570" // just for formatting/placeholders etc
});
for (var i = 0; i < countryData.length; i++) {
  var country = countryData[i];
  var optionNode = document.createElement("option");
  optionNode.value = country.iso2;
  var textNode = document.createTextNode(country.name);
  optionNode.appendChild(textNode);
  addressDropdown.appendChild(optionNode);
}
addressDropdown.value = iti.getSelectedCountryData().iso2;
input.addEventListener('countrychange', function(e) {
  addressDropdown.value = iti.getSelectedCountryData().iso2;
});
addressDropdown.addEventListener('change', function() {
  iti.setCountry(this.value);
});
// phone1
var countryData = window.intlTelInputGlobals.getCountryData(),
  input = document.querySelector("#phone1"),
  addressDropdown = document.querySelector("#address-country");
var iti = window.intlTelInput(input, {
  preferredCountries: ["ae"],
  hiddenInput: "full_phone",
  utilsScript: "https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js?1549804213570" // just for formatting/placeholders etc
});
for (var i = 0; i < countryData.length; i++) {
  var country = countryData[i];
  var optionNode = document.createElement("option");
  optionNode.value = country.iso2;
  var textNode = document.createTextNode(country.name);
  optionNode.appendChild(textNode);
  addressDropdown.appendChild(optionNode);
}
addressDropdown.value = iti.getSelectedCountryData().iso2;
input.addEventListener('countrychange', function(e) {
  addressDropdown.value = iti.getSelectedCountryData().iso2;
});
addressDropdown.addEventListener('change', function() {
  iti.setCountry(this.value);
});
  </script>
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
    origin: document.getElementById("location-1").value,
    destination: document.getElementById("location-2").value,
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
  document.getElementById("location-1").value = "";
  document.getElementById("location-2").value = "";
  directionsDisplay.setDirections({
    routes: []
  });

}

// Create autocomplete objects for all inputs
var origin = {};
var destination = {};

var input1 = document.getElementById("location-1");
var autocomplete1 = new google.maps.places.Autocomplete(input1, origin);

var input2 = document.getElementById("location-2");
var autocomplete2 = new google.maps.places.Autocomplete(input2, destination);

$(document).ready(function() {
  $('#location-2').change(function() {
    setTimeout(
  function() 
  {

  //create request
  var request = {
    origin: document.getElementById("location-1").value,
    destination: document.getElementById("location-2").value,
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
@endsection  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi3QbrwGSa9syCfRzSbrfvBMw42JNtztk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('vendor-script')
  {{-- Vendor js files --}}
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script> -->
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}

  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/manage-booking-list.js') }}"></script>  
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
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

.input-group-text {
	border:none;
}
.form-check {
    padding-left: rem(28);
}

// extra styling for telephone formatting
.billingform .intl-tel-input .form-control {
    padding-left: 47px !important;
}
.intl-tel-input .flag-dropdown .selected-flag {
  padding: 11px 16px 11px 6px;
}
.intl-tel-input {
  z-index: 99;
  width: 100%;
}
.iti-flag {
  box-shadow: none;
}
.intl-tel-input .selected-flag:focus {
  outline: none;
}
    </style>