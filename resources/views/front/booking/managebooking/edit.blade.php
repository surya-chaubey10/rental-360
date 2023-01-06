@extends('layouts.main')
@section('title', '')
 
<style>
   .card .card-header {
    padding: 0 !important; 
}
.iti {
    width: 100%;
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
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">

@endsection

@section('content')
 
<section class="pdate-manage-booking">
  <div class="row"> 
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
      <div class="card"> 
        <div class="card-body"> 
          <form class="update-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form_update" method="post"> 
                <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Update Booking</h4>
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
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="select_customer-column">Select Customer</label>
                            <div class="mb-1">
                            
                              <input type="text" id="customer" value="{{$get_data->customer->fullname}}" name="select_customer"  class="form-control" readonly>
                            </div>
                          </div>
                        </div> 
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                          <label class="form-label" for="phone-column">Phone</label>
                            <div class="mb-1">
                              
                               <input type="tel" id="phone" name="phone"value="{{$get_data->customer->mobile}}"   class="form-control" >
                            </div>
                          </div>
                        </div><div class="col-md-12 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="email-column">Email</label>
                            <div class="mb-1">
                               <input type="text" id="email" name="email"  value="{{$get_data->customer->email}}"  class="form-control" >
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
                              <label class="form-label" for="pickup_date_time-column">Pickup Date </label>
                              <input type="date" id="pickup_date_time" class="form-control" value="{{$get_data->pickup_date_time}}" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                            </div>
                          </div>
                          <div class="col-md-6 col-12"> 
                          <div class="mb-1">
                              <label class="form-label" for="pickup_date_time-column">Pickup Time</label>
                              <input type="time" id="pickup_time" class="form-control" value="{{$get_data->pickup_time}}" placeholder="Date" name="pickup_time"  /> 
                            </div>
                            </div>

                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="drop_off_date_time-column">Drop-off Date </label>
                              <input type="date" id="drop_off_date_time" class="form-control"  value="{{$get_data->dropoff_date_time}}"  placeholder="Date" name="drop_off_date_time" min="<?php echo date('Y-m-d'); ?>"  /> 
                            </div>
                          </div> 

                          <div class="col-md-6 col-12">
                          <div class="mb-1">
                              <label class="form-label" for="pickup_time-column">Drop-off Time</label>
                              <input type="time" id="drop_off_time" class="form-control" value="{{$get_data->dropoff_time}}" placeholder="Date" name="drop_off_time" /> 
                            </div>
                            </div>

                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_driver-column">Select Driver</label>
                              <div class="mb-1">
                                <select class="form-select" id="select_driver" name="select_driver">
                                  <option value=""> </option>
                                  <option {{$get_data->driver_id == 1 ? 'selected' : ''}} value="1">Self Drive</option>
                                  <option {{$get_data->driver_id == 2 ? 'selected' : ''}} value="2">Car with Driver</option>  
                                  <option {{$get_data->driver_id == 3 ? 'selected' : ''}} value="3">Limousine</option>  
                                </select>
                              </div>
                            </div>
                          </div>

                           

                          <input type="hidden" id="updated_id" class="form-control" value="{{$get_data->id}}" placeholder="Name" name="updated_id" /> 
                         
                            <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="no_of_traveller-column">No. of Passengers</label>
                              <input
                                type="number"
                                id="no_of_traveller"
                                class="form-control"
                                value="{{$get_data->number_of_tavellers}}"
                                placeholder="1"
                                name="no_of_traveller"
                              />
                            </div>
                          </div> 
                          <input type="hidden" value="{{$get_data->brand_id}}" id="brand" class="form-control"  />
                              <input type="hidden" value="{{$get_data->model_id}}" id="model" class="form-control"  />
                              <input type="hidden" value="{{$get_data->vehicle_id}}" id="sku_id" class="form-control"  />
                          <input type="hidden" value="{{$get_data->pickup_address}}" id="selectedpickup_address" class="form-control"  />
                          
                          <!-- <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="pickup_address-column">Pickup Address</label>
                              <div class="mb-1">
                                <input
                                  class="form-control"
                                  id="pickup_address"
                                  value="{{$get_data->pickup_address}}"  
                                  rows="3"
                                  name="pickup_address"
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
                                  value="{{$get_data->dropoff_address}}"  
                                  rows="3"
                                  name="dropoff_address"
                                  placeholder=" "
                                > 
                              </div>
                            </div>
                          </div> -->

                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="pickup_address-column">Pickup Address</label>
                             
                              <div class="location-input col-md-12 col-12">
                                <input
                                  class="form-control map-input"
                                 
                                  rows="3"type="text" id="location-1" name="origin"  value="{{$get_data->pickup_address}}"
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
                                  id="location-2" name="destination"  value="{{$get_data->dropoff_address}}"
                                  
                                  placeholder=" "
                                  style=" " > 
                                  <!-- onkeyup="myFunction()" -->
                              </div>
                            </div>
                          </div>

                          <div class="demo-inline-spacing mb-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" {{$get_data->dispatch_type == 1 ? 'checked' : ''}} onclick="return false;" onkeydown="return false;" readonly>
                                <label class="form-check-label" for="inlineRadio1">Own inventory</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2" {{$get_data->dispatch_type == 2 ? 'checked' : ''}} onclick="return false;" onkeydown="return false;" readonly > 
                                <label class="form-check-label" for="inlineRadio1">Open Market</label>
                            </div> 
                        </div>
                        @if($get_data->dispatch_type == 2)
                        <div class="row mb-2 " id="merchant" style=""> 
                            <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="merchantName">Merchant Name</label>
                                    <input type="text" class="form-control" name="merchantName" id="merchantName" value="{{$get_data->merchant_name}}"  placeholder="Name"readonly> 
                                      
                                </div>
                              </div>

                            <div class="col-xl-6 col-md-6 col-6"> 
                                <div class="mb-1">
                                    <label class="form-label" for="merchantPhone">Phone</label>
                                   
                                    <input type="number" class="form-control" name="merchantPhone" id="merchantPhone" value="{{$get_data->merchant_phone}}"readonly>
                                </div>
                            </div> 

                            <div class="col-xl-6 col-md-6 col-6">
                              <div class="mb-1">
                                  <label class="form-label" for="select_vehicle-column">Brand</label>
                                  <div class="mb-1">
                                    <select class="form-select select_marchantvehicle" id="select_vehicle" name="merchant_sku_brand">
                                      <option value=""></option>
                                      @if($vehicleopen)
                                      @foreach($vehicleopen as $vehicleopen)
                                        <option {{$vehicleopen->id == $get_data->brand_id ? 'selected' : ''  }} value="{{$vehicleopen->id}}">{{$vehicleopen->brand_name}}</option>
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
                                    <select class="form-select  select_marchantmodel" id="select_model" name="merchant_sku_model">
                                      <option value=""></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="Comment-column">Comment</label>
                                  <div class="mb-1">
                                  <textarea class="form-control" placeholder="Comment" style="resize:none" name="open_comment" id="comment" rows="2" cols="50">{{isset($get_data->open_market_comment) ? $get_data->open_market_comment : ''  }}</textarea>
                                  </div>
                                </div> 
                              </div>
                        </div>   
                        @endif
                        @if($get_data->dispatch_type == 1)
                        <div class="row mb-2 " id="auto_dispached"> 
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_brand_id-column">Brand</label>
                              <div class="mb-1"> 
                              <select class="form-select select_vehicle" id="select_vehicle" name="select_vehicle" >
                                  
                                  @foreach($vehicle as $vehicle)
                                      <option {{$vehicle->id == $get_data->brand_id ? 'selected' : ''  }} value="{{$vehicle->id}}">{{$vehicle->brand_name}}</option>
                                    @endforeach   
                                </select> 
                              </div> 
                            </div>
                          </div>

                            <div class="col-md-6 col-12">
                            <div class="mb-1" style=" margin-left: 27px;width: 100%;">
                              <label class="form-label" for="select_model-column">Model</label>
                              <div class="mb-1"> 
                              <select class="form-select select_model" id="select_model" name="select_model" > 
                                </select>   </div>
                             </div>
                            </div>  

                          <div class="col-md-6 col-12" style=" " id="skudiv">
                            <div class="mb-1">
                              <label class="form-label" for="select_sku">SKU</label>
                              <div class="mb-1">
                                <select class="form-select select_sku" id="select_sku" name="select_sku" >
                                  <option value=""></option>
                                  
                                </select>
                                <span class="SKU_error" id="SKU_error" style="color:red"> </span>
                                <input type="hidden" class="SKU_error_value" id="SKU_error_value">
                              </div>
                            </div>
                          </div>
                      </div>
                      @endif
                          {{--  <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_fleet-column">SKU</label>
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
                        <!-- <img class="mb-3" src="{{asset('public/images/map/booking_map.png')}}" alt="booking-map-image" title="booking-map-image" height="100%" width="100%">  -->
                        <!-- <div class="leaflet-map" id="user-location"></div>  -->  
                        <div class="containerrr-map" id="google-map" style="height: 463px"></div>
                        <div id="output" class="result-table" style="font-size: 100%;"></div>    
                        <!-- <div  id="showmap" class="mapshowdive" >
                         </div> -->
                        <div class="row">
                        <div class="col-12"> 
                            <div class="mb-1">
                                <label class="form-label" for="noteTextarea">Note</label>
                                <textarea class="form-control " id="noteTextarea" rows="7" name="note" style="resize:none" placeholder="Textarea" >  {{$get_data->note}} </textarea>
                            </div>
                        </div>
                        </div>
                      </div>  
                     
                    <!-- </div>  -->
                  <!-- </div>
                </div> --> 
               
              </div> 
                        <div class="text-center">
                            <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Update Booking</button>
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
// function calcRoute() {
//   //create request
//   var request = {
//     origin: document.getElementById("location-1").value,
//     destination: document.getElementById("location-2").value,
//     travelMode: google.maps.TravelMode.DRIVING,
//     unitSystem: google.maps.UnitSystem.METRIC
//   }
//   // Routing
//   directionsService.route(request, function(result, status) {
//     if (status == google.maps.DirectionsStatus.OK) {

//       //Get distance and time            

//       $("#output").html("<div class='containerrr-map'> Distance: " + result.routes[0].legs[0].distance.text + "Time: " + result.routes[0].legs[0].duration.text + ".</div>");
//       document.getElementById("output").style.display = "block";

//       //display route
//       directionsDisplay.setDirections(result);
//     } else {
//       //delete route from map
//       directionsDisplay.setDirections({
//         routes: []
//       });
//       //center map in London
//       map.setCenter(myLatLng);

//       //Show error message           

//       // alert("Enter Vailid Address");
//       // clearRoute();
//     }
//   });

// }

// Clear results

// function clearRoute() {
//   document.getElementById("output").style.display = "none";
//   document.getElementById("location-1").value = "";
//   document.getElementById("location-2").value = "";
//   directionsDisplay.setDirections({
//     routes: []
//   });

// }

// Create autocomplete objects for all inputs
var origin = {};
var destination = {};
var input1 = document.getElementById("location-1");
var autocomplete1 = new google.maps.places.Autocomplete(input1, origin);

var input2 = document.getElementById("location-2");
var autocomplete2 = new google.maps.places.Autocomplete(input2, destination);

  // Clear results
  $(document).ready(function() {
    var request = {
        origin: document.getElementById("location-1").value,
        destination: document.getElementById("location-2").value,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
      }
  console.log(request);
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
      
    function clearRoute() {
      document.getElementById("output").style.display = "none";
      document.getElementById("location-1").value = "";
      document.getElementById("location-2").value = "";
      directionsDisplay.setDirections({
        routes: []
      });

    }
});

$(document).ready(function() {

  var request;
  $('#location-2').change(function() {

    setTimeout(
  function() 
  {


    //create request
    request = {
    origin: document.getElementById("location-1").value,
    destination: document.getElementById("location-2").value,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  }
  console.log(request);

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

  }, 100);




 

 });

});
    </script>


@endsection  

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi3QbrwGSa9syCfRzSbrfvBMw42JNtztk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script>

   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/update-manage-booking.js') }}"></script>  
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>

@endsection

 <script>

// Vanilla Javascript


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