@extends('layouts.main')
@section('title', '')
<link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
   .card .card-header {
    padding: 0 !important; 
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

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
 <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">

@endsection

@section('content')
 
  <form class="add-manage-booking-invoice modal-content pt-0 form-block" autocomplete="off" id="booking_form_invoice" method="post">
    <section class="app-user-view-account">
      <div class="row"> 
        <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
          <div class="card"> 
            <div class="card-body">  
                          <div class="card-header">
                            <h4 style="font-size: 1.486rem;">Create Invoice</h4>
                            <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Invoice</button>
                          </div><hr> 
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Full Name</label>
                    <input type="text" id="full_name" class="form-control" value="{{isset($customer->fullname) ? $customer->fullname:''}}" placeholder=" " name="full_name" /> 

                  </div>  
                </div>
                <input type="hidden" id="booking_id" class="form-control" value="{{$uuid}}" placeholder=" " name="booking_id" /> 
                  
                <input type="hidden" class="form-control" name="document_type" id="document_type" value="booking"> 
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Email</label>
                    <input type="text" id="email" class="form-control" value="{{isset($customer->email) ? $customer->email :''}}" placeholder=" " name="email" /> 

                  </div>
                </div>
                

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="currency_type-column">Currency Type</label>
                    <div class="mb-1">
                      <select class="form-select" id="currency_type" name="currency_type">
                        <option value="AED">AED</option>
                          
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="transaction_type-column">Transaction Type</label> 
                    <select class="form-select" id="transaction_type" name="transaction_type">
                        <option value="1">Sales </option>
                        <option value="2">Pre Auth </option>
                        <option value="3">Tokenize </option> 
                      </select>
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
                    <label class="form-label" for="phone-column">Phone (Optional)</label><br>
                    <input type="text" id="phone" class="form-control" value="{{$customer->mobile}}" placeholder=" " name="phone" style="width:665px;"/> 

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
                    <input type="text" id="city" class="form-control" value="{{isset($customer_details->city)? $customer_details->city: '' }}" placeholder=" " name="city" /> 

                  </div>
                </div>
                
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="country-column">Country (Optional)</label>
                    <div class="mb-1">
                      <select class="form-select" id="country" name="country">
                        <option value=" "> </option>
                        @foreach($country as $country)
                        <option {{$customer->country_id == $country->id ? 'selected':''}} value="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="state-column">State (Optional)</label>
                    <div class="mb-1">
                    <input type="text" id="state" class="form-control" value="{{isset($customer_details->state)? $customer_details->state: '' }}" placeholder=" " name="state" /> 
                     
                    </div>
                  </div>
                </div> 
                
                
                <div class="col-md-6 col-12">
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
                </div> 
                
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="inv_description-column">Description (Optional)</label>
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
        <input type="hidden" id="sku_id" class="form-control" value="{{isset($sku[0]->id) ? $sku[0]->id:''}}" name="sku_set" /> 
        <input type="hidden" id="description_set" class="form-control" value="{{isset($brand->brand_name) ? $brand->brand_name: ''}} {{isset($brand_vehicle->vehicle_name) ? $brand_vehicle->vehicle_name:''}} - {{isset($diffDays) ? $diffDays : ''}} day rental" name="description_set" /> 
        <input type="hidden" id="price_set" class="form-control" value="{{$price}}" name="price_set" /> 
        <input type="hidden" id="diffDays_set" class="form-control" value="{{$diffDays}}" name="diffDays_set" /> 


        <div class="card-body">
<div class="row"> 
  <div class="col-12 ">
    <table class="table table-bordered table-hover" id="tab_logic" style="margin-left:-2%;width: 104%;">
      <thead class="table-light">
        <tr>
          <th style="min-width: 150px;">SKU</th>
          <th>Description</th>
          <th style="min-width: 110px;">Price</th>
          <th style="max-width: 70px;">Period</th>
          <th style="max-width: 60px;">Discount</th>
          <th style="max-width: 60px;">Tax(%)</th>
          <th style="min-width: 118px;">Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="head">
        <tr id='addr0'>
          <td>
          <input type="text" name='sku1[]' value="{{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}}" class="form-control sku"/>
          <input type="hidden" name='sku[]' value="{{isset($sku[0]->id) ? $sku[0]->id:''}}" class="form-control sku"/>
          </td>
          <td>
          <input type="text" name='description[]' value="{{isset($brand->brand_name) ? $brand->brand_name : ''}} {{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}} - {{isset($diffDays) ? $diffDays : ''}} day rental" class="form-control description"/>
          </td>
          <td>
            <input type="text" name='unit_price[]' value="{{$price}}" class="form-control price"/>
          </td>
          
          <td>
          <input type="text" name='quantity[]' value="{{$diffDays}}" class="form-control period"/>
          </td>
          <td>
          <input type="text" name='discount[]' value="0" class="form-control discount"/>
          </td>
          <td>
          <input type="text" name='tax[]' value="0" class="form-control tax"/>
          </td>
          <td>
          <input type="text" name='total[]' value="{{ $price}}" class="form-control total" readonly />
          </td>
          <td></td>
          </tr>
        <tr id='addr1'></tr>
      </tbody>
    </table>
  </div> 
</div>
<input id="add_row" class="btn btn-primary btn-sm add_row mt-1" value="Add On " readonly  > 
</div>   
               
        <!-- Product Details ends -->

        <!-- Invoice Total starts -->
        <div class="card-body invoice-padding">
          <div class="row invoice-sales-total-wrapper">
            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
              <div class="d-flex align-items-center mb-1">
                
              </div>
            </div>
            <div class="col-md-6 justify-content-end order-md-2 order-1">

                <div class="d-flex row mb-1">

                  <div class="col-3">
                    <label for="subTotal" class="form-label text-nowrap mt-1">Sub Total</label>
                  </div>

                  <div class="col-9">
                    <input type="text" name="subTotal" class="form-control sub_total" value="{{$price}}" id="subTotal" readonly />
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
                    <input type="text" name="grandTotal" class="form-control grand_total" value="{{$price}}" id="grandTotal" readonly/>
                  </div>

                </div>

            </div>
          </div>
        </div>        

            </div>          
          </div>
        </div>
      </div>
    </section>
</form>
<script>
// Vanilla Javascript
var input = document.querySelector("#phone");
window.intlTelInput(input,({
    preferredCountries: ["ae", "in", "us", "uk"],
}));

$(document).ready(function() {
    $('.iti__flag-container').click(function() { 
        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'')
        $('#phone').val("");
        $('#phone').val("+"+countryCode+" "+ $('#phone').val());
    });
});
// fgfd
</script>
@endsection  

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
  <script src="{{ asset('js/scripts/pages/bookings-invoice-list.js') }}"></script>    
  <script src="{{ asset('js/scripts/pages/bookings-invoice-create.js') }}"></script>    
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>

@endsection

 