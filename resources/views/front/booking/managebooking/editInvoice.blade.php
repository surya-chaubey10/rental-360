@extends('layouts.main')
@section('title', '')
 
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

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
 <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">

@endsection

@section('content')
 
  <form class="add-manage-booking-invoice-update modal-content pt-0 form-block" autocomplete="off" id="booking_form_invoice-update" method="post">
    <section class="app-user-view-account">
      <div class="row"> 
        <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
          <div class="card"> 
            <div class="card-body">  
                          <div class="card-header">
                            <h4 style="font-size: 1.486rem;">Update Invoice</h4>
                            <!-- <a href="{{route('manage-booking-edit',$uuid)}}"  class="btn btn-info me-1" style="margin:0% 0% 0% 55%;">Back</a>
                            <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Invoice</button> -->
                          </div><hr> 
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Full Name</label>
                    <input type="text" id="full_name" class="form-control" value="{{$customer->fullname}}" placeholder=" " name="full_name" /> 

                  </div>
                </div>
                <input type="hidden" id="booking_uuid" class="form-control" value="{{$uuid}}" placeholder=" " name="booking_id" /> 
                    
                <input type="hidden" class="form-control" name="document_type" id="document_type" value="booking">
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="full_name-column">Email</label>
                    <input type="text" id="email" class="form-control" value="{{$customer->email}}" placeholder=" " name="email" /> 

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
                    <input type="text" id="customer_refrence" class="form-control" value="" placeholder=" " name="customer_refrence" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="invoice_refrence-column">Invoice Number</label>
                    <input type="text" id="invoice_refrence" class="form-control" value="{{isset($invoiceHeader->invoice_ref) ? $invoiceHeader->invoice_ref : ''}}" placeholder=" " name="invoice_refrence" /> 

                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="mb-1">
                    <label class="form-label" for="phone-column">Phone (Optional)</label><br>
                    <input type="text" id="phone" class="form-control" value="{{$customer->mobile}}" placeholder=" " name="phone"  style="width:665px;"/> 

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
                  <div class="mb-1">
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
        <input type="hidden" id="sku_id" class="form-control" value="{{isset($sku[0]->id) ? $sku[0]->id:'0'}}" name="sku_id" /> 
        <input type="hidden" id="description_set" class="form-control" value="{{isset($invoiceDetail[0]->description) ? $invoiceDetail[0]->description: ''}}" name="description_set" /> 
        <input type="hidden" id="price_set" class="form-control" value="{{isset($invoiceDetail[0]->price) ? $invoiceDetail[0]->price: ''}}" name="price_set" /> 
        <input type="hidden" id="diffDays_set" class="form-control" value="{{isset($invoiceDetail[0]->period) ? $invoiceDetail[0]->period : ''}}" name="diffDays_set" /> 

        <input type="hidden" id="invoice_id" class="form-control" value="{{isset($invoiceDetail[0]->invoice_id) ? $invoiceDetail[0]->invoice_id : ''}}" name="invoice_id" /> 


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
       
        @php $incr= 0; @endphp
        @foreach($invoiceDetail  as $key => $details)
        <tr id='addr{{$key}}'>
        @php 
            $discount = 0;
            if($details->price && $details->period && $details->discount){
              $discount = ($details->price * $details->period) * $details->discount / 100;
            }
        @endphp
       @if($key==0)
          <td>
          @if($booked->dispatch_type==2)
          <input type="text" name='sku1[]' value="" class="form-control" readonly/>
          <input type="hidden" name='sku[]' value="0" class="form-control sku"  />
          @else
          <input type="text" name='sku1[]' value="{{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}}" class="form-control"/>
          <input type="hidden" name='sku[]' value="{{isset($sku[0]->id) ? $sku[0]->id:''}}" class="form-control sku"/>
          @endif
          </td>
          <td>
          <input type="text" name='description[]' value="{{$details->description}}" class="form-control description"/>
          </td>
          <td>
            <input type="text" name='unit_price[]' value="{{$details->price}}" class="form-control price"/>
          </td> 
          <td>
          <input type="text" name='quantity[]' value="{{$diffDays}}" class="form-control period"/>
          </td>
          <td>
          <input type="text" name='discount[]' value="{{$details->discount}}" class="form-control discount"/>
          <input type="hidden"  value="{{$discount}}" placeholder='discountamount' class="form-control discountamount"/>
          </td>
          <td>
          <input type="text" name='tax[]' value="{{$details->tax}}" class="form-control tax"/>
          </td>
          <td>
          <input type="text" name='total[]' value="{{$details->total}}" class="form-control total" readonly />
          </td>
          
          @else  
          <td colspan='2'>
               @if($booked->dispatch_type==2)
                <input type="hidden" name='sku1[]' value="" class="form-control"/>
                <input type="hidden" name='sku[]' value="0" class="form-control sku"/>
              @else
                 <input type="hidden" name='sku1[]' value="{{isset($sku[0]->car_SKU) ? $sku[0]->car_SKU:''}}" class="form-control"/>
                 <input type="hidden" name='sku[]' value="{{isset($sku[0]->id) ? $sku[0]->id:''}}" class="form-control sku"/>
              @endif 
          
          <input type="text" name='description[]' value="{{$details->description}}" class="form-control description"/>
          </td>
          <td>
            <input type="text" name='unit_price[]' value="{{$details->price}}" class="form-control price"/>
          </td>
          
          <td>
          <input type="text" name='quantity[]' value="{{$diffDays}}" class="form-control period"/>
          </td>
          <td>
          <input type="text" name='discount[]' value="{{$details->discount}}" class="form-control discount"/>
          <input type="hidden"  value="{{$discount}}" placeholder='discountamount' class="form-control discountamount"/>
          </td>
          <td>
          <input type="text" name='tax[]' value="{{$details->tax}}" class="form-control tax"/>
          </td>
          <td>
          <input type="text" name='total[]' value="{{$details->total}}" class="form-control total" readonly />
          </td>
          <td><button type="button" name="remove" id="{{$incr+1}}" class="btn btn-danger btn_remove btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></td> @endif
          </tr>
          @php $incr= $key; @endphp
        @endforeach
      <input type="hidden" value="{{$incr}}" id="incr">
        <tr id='addr{{$incr+1}}'></tr>
      </tbody>
    </table> 
  </div> 
</div>
<input id="add_row" class="btn btn-primary btn-sm add_row mt-1" value="Add On " readonly  > 
</div>   
  <div class="row">
    <div class="col-1">
      <div class="form-check form-check-inline">
          <input class="form-check-input PromotionRadio" type="radio"  name="promotion_radio" id="promotion_radio"  value="{{($invoiceHeader->promotion_id !=0) ? '1' : 0 }}" {{($invoiceHeader->promotion_id != 0) ? 'checked' : '' }} />
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
                    <input type="text" name="subTotal" class="form-control sub_total" value="{{$invoiceHeader->subtotal}}" id="subTotal" readonly />
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
                    <input type="text" name="grandTotal" class="form-control grand_total" value="{{$invoiceHeader->grand_total}}" id="grandTotal" readonly/>
                  </div>

                </div>

            </div>
          </div>
        </div>  

           <div class="text-center">    
                       <a href="{{route('manage-booking-edit',$uuid)}}"  class="btn btn-danger me-1" >Back</a> 
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
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script> 
  {{-- data table --}} 
 
@endsection
@section('page-script') 
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/booking-invoice-list.js') }}"></script>    
  <script src="{{ asset('js/scripts/pages/booking-invoice-update.js') }}"></script>    
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>

@endsection

 