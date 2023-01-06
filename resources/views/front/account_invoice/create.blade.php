
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
                          </div><hr> 
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Booking</label>
                    <select class="form-select select2 booking" id="booking" name="booking_id">
                    <option value=""></option>

                      @if($bookingdata!='')
                      
                          @foreach($booking as  $booking)
                          <option {{$bookingdata->id==$booking->id ? "selected":''}} value="{{$booking->uuid}}">1000{{$booking->id}} - {{ucfirst($booking->customer->fullname)}} - {{ isset($booking->fleet) ? ucfirst($booking->fleet->car_number) :'' }}</option>
                          @endforeach
                       @else
                          @foreach($booking as  $booking)  
                          <option value="{{$booking->uuid}}">1000{{$booking->id}} - {{ucfirst($booking->customer->fullname)}} - {{ isset($booking->fleet) ? ucfirst($booking->fleet->car_number) : 'Open Market' }}</option>
                               
                          @endforeach  
                       @endif   
                      </select>
                  </div>
                </div>
                <div class="col-md-6 col-12">   
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Full Name</label>       
                    @if($bookingdata!='')
                     @if($bookingdata->customer!='')
                       <input type="text" id="full_name" class="form-control" value="{{$bookingdata->customer->fullname}}" placeholder=" " name="full_name"  /> 
                    @else
                    <input type="text" id="full_name" class="form-control" value="" placeholder=" " name="full_name"  /> 
                    @endif
                    @else
                    <input type="text" id="full_name" class="form-control" value="" placeholder=" " name="full_name"  /> 
                    @endif
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Email</label>
                    @if($bookingdata!='')
                    @if($bookingdata->customer!='')
                        <input type="text" id="email" class="form-control" value="{{$bookingdata->customer->email}}" placeholder=" " name="email"  /> 
                   
                    @else
                        <input type="text" id="email" class="form-control" value="" placeholder=" " name="email"  /> 
                    @endif
                    @else
                        <input type="text" id="email" class="form-control" value="" placeholder=" " name="email"  /> 
                    @endif
                    
                  </div>
                </div>
                

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="currency_type-column">Currency Type</label>
                    <div class="mb-1">
                      <select class="form-select" id="currency_type" name="currency_type" >
                        <option value="AED">AED</option>
                          
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="transaction_type-column">Transaction Type</label> 
                    <select class="form-select" id="transaction_type" name="transaction_type" >
                        <!-- <option value="1">Sales </option> -->
                        <option value="3">Sales </option> 
                        <option value="2">Pre Auth </option>
                        <option value="4">Cash </option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="customer_refrence-column">Customer Refrence (Optional)</label>
                    <input type="text" id="customer_refrence" class="form-control" value="" placeholder=" " name="customer_refrence"  /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="invoice_refrence-column">Invoice Refrence (Optional)</label>
                    <input type="text" id="invoice_refrence" class="form-control" value="" placeholder=" " name="invoice_refrence"  /> 

                  </div>
                </div>
           
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="phone-column">Phone (Optional)</label><br>
                    @if($bookingdata!='')
                    @if($bookingdata->customer!='')
                           <input type="tel" id="phone" class="form-control" value="{{$bookingdata->customer->mobile}}" placeholder=" " name="phone"   style="width:665px;"/> 
                    
                    @else
                           <input type="tel" id="phone" class="form-control" value="" placeholder=" " name="phone"  style="width:665px;"/> 
                    @endif
                    @else
                           <input type="tel" id="phone" class="form-control" value="" placeholder=" " name="phone" style="width:665px;" /> 
                    @endif
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="street-column">Street (Optional)</label>
                    <input type="text" id="street" class="form-control" value="" placeholder=" " name="street" style="width:665px;" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="city-column">City (Optional)</label>
                    <input type="text" id="city" class="form-control" value="" placeholder=" " name="city"  /> 

                  </div>
                </div>
                
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="country-column">Country (Optional)</label>
                    <div class="mb-1">
                      <select class="form-select select2" id="country" name="country" >
                        <option value=""> </option>
                         @foreach($country as $country)
                          <option value="{{$country->id}}">{{$country->name}} </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="state-column">State (Optional)</label>
                    <div class="mb-1">
                    <input type="text" id="state" class="form-control" value="" placeholder=" " name="state"  /> 
                     
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
                @if($bookingdata!='')
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="pickup_time-column">Previous Drop Date&Time</label>
                    <input type="date" id="pickup_date_time" class="form-control pickup_date_time" value="{{$bookingdata->dropoff_date_time}}" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" readonly /> 
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="time-column">Previous Drop Time</label>
                    <input type="time" id="pickup_time" class="form-control pickup_time" value="{{$bookingdata->dropoff_time}}" placeholder="Time" name="pickup_time"  readonly /> 
                  </div>
                </div>
                @else
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="pickup_time-column">Previous Drop Date&Time</label>
                    <input type="date" id="pickup_date_time" class="form-control pickup_date_time" value="" placeholder="Date" name="pickup_date_time" min="<?php echo date('Y-m-d'); ?>" readonly /> 
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="time-column">Previous Drop Time</label>
                    <input type="time" id="pickup_time" class="form-control pickup_time" value="" placeholder="Time" name="pickup_time"  readonly /> 
                  </div>
                </div>
                @endif
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="drop_time-column">Extend Date</label>
                    <input type="date" id="drop_off_date_time" class="form-control drop_off_date_time" value="" placeholder="Date" name="extend_date_time" min="<?php echo date('Y-m-d'); ?>" /> 
                  </div>
                </div> 
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="drop_time-column">Extend Time</label>
                    <input type="time" id="drop_off_time" class="form-control drop_off_time" value="" placeholder="Date" name="extend_time" /> 
                  </div>
                </div>     
               
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="inv_description-column">Notes</label>
                    <div class="mb-1">
                      <input class="form-control" id="inv_description" name="inv_description" placeholder="" >  
                    </div>
                  </div>
                </div> 

              </div>  

        <!-- Product Details start -->
        <input type="hidden" id="document_type" class="form-control" value="account" name="document_type" /> 
        @if($bookingdata!='')
        <input type="hidden" id="fleet_id" class="form-control" value="{{isset($sku->id) ? $sku->id : '0'}}" name="fleet_id" /> 
        <input type="hidden" id="car_sku" class="form-control" value="{{isset($sku->car_SKU) ? $sku->car_SKU : '0'}}" name="car_sku" /> 
        <input type="hidden" id="brand_id" class="form-control" value="{{isset($bookingdata->brand_id) ? $bookingdata->brand_id : '0'}}" name="brand_id" />
        <input type="hidden" id="model_id" class="form-control" value="{{isset($bookingdata->model_id) ? $bookingdata->model_id : '0'}}" name="model_id" />
        <input type="hidden" id="bookingid" class="form-control" value="{{isset($bookingdata->id) ? $bookingdata->id : '0'}}" name="bookingid" />
        @endif
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
          <th style="max-width: 60px;">Discount(%)</th>
          <th style="max-width: 60px;">Tax(%)</th>
          <th style="min-width: 118px;">Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="head">

        <tr id='addr'>
          <td>
          <input type="hidden" name='sku[]' id="sku_set"  value="0" class="form-control sku" />
          <input type="text"  id="sku_select" placeholder='SKU' value="" class="form-control" readonly/>
          </td>
          <td>
          <input type="text" name='description[]' id="description_set" value="" placeholder='Description' class="form-control description" />
          </td>
          <td>
            <input type="text" name='unit_price[]' id="price_set" value="" placeholder='Price' class="form-control price" />
          </td> 
          <td>
          <input type="text" name='quantity[]' id="period_set" value="" placeholder='Qty'  class="form-control period" />
          </td>
          <td>
          <input type="text" name='discount[]' value="" placeholder='Discount' class="form-control discount"/>
          <input type="hidden"  value="" placeholder='discountamount' class="form-control discountamount"/>
          </td>
          <td>
          <input type="text" name='tax[]' id="vat_set" value="" placeholder='Tax' class="form-control tax"/>
          </td>
          <td>
          <input type="text" name='total[]' value="" placeholder='Total' class="form-control total"  />
          </td>
          <td><button type="button" name="remove" id="$incr" class="btn btn-danger btn_remove btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></td>
        </tr>
      <input type="hidden" value="$incr" id="incr">
        <tr id='addr'></tr>
      </tbody>
    </table>
  </div> 
</div>
<input id="add_row" class="btn btn-primary btn-sm add_row mt-1" value="Add Item " readonly  > 
</div>   
  <div class="row">
    <div class="col-2">
      <div class="form-check form-check-inline">
          <input class="form-check-input PromotionRadio" type="radio"  name="promotion_radio" id="promotion_radio"  value="{{isset($invoiceHeader->promotion_id) ? 1 : 0}}" {{isset($invoiceHeader->promotion_id) ? 'checked' : ''}} />
          <label class="form-check-label" for="inlineRadio4">Promotion</label>
      </div>
    </div> 
    <div class="col-3">
      <input type="text" name="promotion_code" class="form promotion_code" value="{{isset($invoiceHeader->promotion_code) ? $invoiceHeader->promotion_code : ''}}" id="promotion_code" disabled/>
      <input type="hidden" name="promotion_type" class="form promotion_type" value="0" id="promotion_type" />
      <input type="hidden" name="promotion_id" class="form promotion_id" value="{{isset($invoiceHeader->promotion_id) ? $invoiceHeader->promotion_id : 0}}" id="promotion_id" />
    </div>  
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
                    <input type="text" name="subTotal" class="form-control sub_total" value="" id="subTotal" readonly />
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
                    <input type="text" name="footer_promotion" class="form-control footer_promotion" value="{{isset($invoiceHeader->promotion_value) ? $invoiceHeader->promotion_value : 0}}" id="footer_promotion" readonly />
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
                    <input type="text" name="grandTotal" class="form-control grand_total" value="" id="grandTotal" readonly/>
                  </div>

                </div>

            </div>
          </div>
        </div>        

        <div class="text-center">
        <button  id="submit" name="submit" type="submit" class="btn btn-success me-1 btn-form-block">Save Invoice</button>

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
// fgfd
</script>
@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script> 
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  {{-- data table --}} 
 
@endsection
@section('page-script') 
  {{-- Page js files --}}
  
  <script src="{{ asset('js/scripts/pages/account-invoice-add.js') }}"></script>    
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection

 
