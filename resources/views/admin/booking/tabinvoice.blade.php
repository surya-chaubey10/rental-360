@extends('layouts.main')
@section('title', '')
 
<link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
<section class="app-user-view-account">
  <div class="row">
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <div class="card"> 
        <div class="card-body mt-1 px-2"> 
          <form class="update-new-vendor modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data"> 
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Booking</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Invoice</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Transaction</button>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-8"><!--col-8-start--> 
                          <div class="mb-1 border-bottom">
                           <h4 class="h5"><b>Customer Info</b></h4>
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
                                <div class="mb-1 ">
                                  <input type="tel" id="phone" name="phone"value="{{$get_data->customer->mobile}}"   class="form-control" readonly style="width:442px;">
                                </div >
                              </div>
                            </div><div class="col-md-12 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="email-column">Email</label>
                                <div class="mb-1">
                                  <input type="text" id="email" name="email"  value="{{$get_data->customer->email}}"  class="form-control" readonly>
                                </div>
                              </div>
                            </div> 
                          </div>
                          <br>
                          <div class="mb-1 border-bottom">
                           <h4 class="h5"><b>Booking Info</b></h4>
                          </div>
                          <div class="row"> 
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="pickup_date_time-column">Pickup Date</label>
                                <input type="date" id="pickup_date_time" class="form-control" value="{{$get_data->pickup_date_time}}" placeholder="Date" name="pickup_date_time"   readonly /> 
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="pickup_date_time-column">Pickup Time</label>
                                <input type="time" id="pickup_time" class="form-control" value="{{$get_data->pickup_time}}" placeholder="Date" name="pickup_date_time"   readonly /> 
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="drop_off_date_time-column">Drop-off Date</label>
                                <input type="date" id="drop_off_date_time" class="form-control"  value="{{$get_data->dropoff_date_time}}"  placeholder="Date" name="drop_off_date_time"    readonly /> 
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="drop_off_date_time-column">Drop-off Time</label>
                                <input type="time" id="drop_off_date_time" class="form-control"  value="{{$get_data->dropoff_time}}"  placeholder="Date" name="drop_off_date_time"    readonly /> 
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="select_driver-column">Select Driver</label>
                                <div class="mb-1">
                                  <input type="text" class="form-control" id="select_driver" name="select_driver"   
                                   value="{{(isset($get_data->driver_id) ? ($get_data->driver_id == 1 ? 'Self Drive' : ($get_data->driver_id == 2 ? 'Car with Driver' : 'Limousine'   ) )  : '' )}}" readonly>
                                </div>
                              </div>
                            </div>
                            <input type="hidden" id="updated_id" class="form-control" value="{{$get_data->id}}" placeholder="Name" name="updated_id" /> 
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="no_of_traveller-column">No. of Travellers (Including Children)</label>
                                <input
                                  type="number"
                                  id="no_of_traveller"
                                  class="form-control"
                                  value="{{$get_data->number_of_tavellers}}"
                                  placeholder="1"
                                  name="no_of_traveller" readonly
                                />
                              </div>
                            </div> 
                            <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="pickup_address-column">Pickup Address</label><br>
                             
                              <div class="location-input col-md-12 col-12">
                              <input
                                  class="form-control map-input"                               
                                  rows="3"type="text" id="pickup_address" name="pickup_address"  value="{{$get_data->pickup_address}}"
                                  placeholder=" "readonly
                                 style="" > 
                                <input
                                  class="form-control map-input"                                
                                  rows="3"type="text" id="location-1" name="origin"  value="{{$get_data->pickup_address}}"
                                  placeholder=" "readonly
                                 style="" hidden> 
                             
                             
                            </div>
                            </div>
                          </div>
                            <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="dropoff_address-column">Drop-off Address</label><br>
                              
                              <div class="location-input col-md-12 col-12">
                              <input
                                  class="form-control"
                                  rows="3"
                                  id="dropoff_address" name="dropoff_address"  value="{{$get_data->dropoff_address}}"
                                 
                                  placeholder=" "readonly
                                  style=" " > 
                                <input
                                  class="form-control"
                                  rows="3"
                                  id="location-2" name="destination"  value="{{$get_data->dropoff_address}}"
                                 
                                  placeholder=" "readonly
                                  style=" " hidden> 
                                  <!-- onkeyup="myFunction()" -->
                              </div>
                            </div>
                          </div>
                            <div class="demo-inline-spacing mb-1">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" {{$get_data->dispatch_type == 1 ? 'checked' : ''}} onclick="return false;" onkeydown="return false;" readonly>
                                  <label class="form-check-label" for="inlineRadio1">Auto Dispatch</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input inlineRadio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2" {{$get_data->dispatch_type == 2 ? 'checked' : ''}} onclick="return false;" onkeydown="return false;" readonly > 
                                  <label class="form-check-label" for="inlineRadio1">Manual Assignment</label>
                              </div> 
                            </div>
                            <div class="row mb-2 " id="merchant" style="display:none"> 
                              <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="merchantName">Merchant Name</label>
                                  <input type="text" class="form-control" name="merchantName" id="merchantName" value="{{$get_data->merchant_name}}"  placeholder="Name"readonly>       
                                </div>
                              </div>
                              <div class="col-xl-6 col-md-6 col-6"> 
                                <div class="mb-1">
                                  <label class="form-label" for="merchantPhone">Phone</label>
                                  <input type="number" class="form-control" name="merchantPhone" id="merchantPhone" value="{{$get_data->merchant_phone}}"readonly >
                                </div>
                              </div> 
                              <div class="col-xl-6 col-md-6 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="merchantPhone">Please Enter SKU</label>
                                  <input type="number" class="form-control" name="merchant_sku" id="merchant_sku" value="{{$get_data->merchant_sku}}"placeholder="" readonly>
                                </div>
                              </div> 
                            </div>
                            <input type="hidden" class="form-control" name="select_vehicle" id="select_vehicle" value="0" placeholder="">
                            <div class="row mb-2 " id="auto_dispached"> 
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="select_brand_id-column">Brand</label>
                                <div class="mb-1">  
                                <input type="text" readonly class="form-control select_brand_id" name="select_brand_id" id="select_brand_id" value="{{$vehicle->brand_name}}" placeholder="">   
                              </div> 
                            </div>
                          </div>
                          <input type="hidden" class="form-control" name="select_model" id="select_model" value="0" placeholder="">
                          <div class="col-md-6 col-12">
                            <div class="mb-1" style="    padding-left: 6%;    margin-left: -12px;  width: 110%;">
                              <label class="form-label" for="select_model-column">Model</label>
                              <div class="mb-1">
                              
                                <input type="text" readonly class="form-control select_model" name="select_model" id="select_model" value="{{$model->model_name}}" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="select_model-column">Fleet</label>
                              <div class="mb-1">
                                <input type="text" readonly class="form-control select_fleet" name="select_fleet" id="select_fleet" value="{{$fleet->car_SKU}}" placeholder="">
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
                        <!-- <img class="mb-3" src="{{asset('public/images/map/booking_map.png')}}" alt="booking-map-image" title="booking-map-image" height="63%" width="100%"> <br> -->
                        <div class="containerrr-map" id="google-map" style="height: 463px"></div>
                        <div id="output" class="result-table" style="font-size: 100%;"></div>  <br>
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-1">
                              <label class="form-label" for="noteTextarea">Note</label>
                              <textarea class="form-control " id="noteTextarea" rows="7" name="note" readonly>{{(isset($get_data->note) ? $get_data->note : '')}}</textarea>
                            </div>
                          </div>
                        </div> 
                      </div>   
                    </section>   
                    
                  </div>

                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" >
                  @if(isset($transaction->id))
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">  
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            <label for="" id="status_label" class="label label-lg bg-light-success label-inline">Authorised</label>
                            <span id="transaction_type">sale</span> <span id="transaction_referance">{{isset($transaction->tran_ref) ? $transaction->tran_ref:''}}</span>
                          </h5>
                          <span class="btn btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></span>
                        </div>
                        <div class="modal-body" style="padding: 0px;">
                          <ul class="list-group" style="border-radius: 0px">
                            <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_id">{{isset($transaction->id) ? $transaction->id:''}}</span> : Rental 360</li>
                          </ul>
                          <div class="row">
                            <div class="col-md-8 col-lg-8">
                              <ul class="list-group" style="border-radius: 0px">
                                <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Amount</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amount_currency">{{isset($transaction->cart_amount) ? $transaction->cart_amount:''}}</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Cart Id</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_cart_id">{{isset($transaction->cart_id) ? $transaction->cart_id:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item" id="customer_inovice_li">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Status</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_status">{{isset($transaction->payment_status) ? $transaction->payment_status:''}}</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_resp_msg">{{isset($transaction-> response_code) ? $transaction->response_code:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_date">{{isset($transaction-> transaction_time) ? $transaction->transaction_time:''}}</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row" id="invoice_li">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_no">1000{{isset($get_data->id) ? $get_data->id:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item " id="invoice_ref_li">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_ref">{{isset($amount->invoice_ref) ? $amount->invoice_ref:''}}</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Customer Ref</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_customer_ref">{{isset($amount->customer_ref) ? $amount->customer_ref:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Description</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_description">Payment with tok enabled, save card enabled</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Scheme</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_scheme">{{isset($transaction-> payment_method) ? $transaction->payment_method:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Payment Description</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="payment_description" style="font-size: 10px;">{{isset($transaction-> payment_description) ? $transaction->payment_description:''}}</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Type</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_type">{{isset($transaction-> card_type) ? $transaction->card_type:''}}</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="list-group-item">
                                  <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Month</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryMonth">12</span></div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Year</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryYear">2023</span></div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <div class="col-md-4 col-lg-4">
                              <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                              <p id="name" class="m-0">{{(isset($get_data->fullname) ? $get_data->fullname : '')}}</p>
                              <p id="c_email" class="m-0">{{(isset($get_data->customer_email) ? $get_data->customer_email : '')}}</p>
                              <p id="address" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off">{{(isset($get_data->address1) ? $get_data->address1 : '')}} {{(isset($get_data->address2) ? $get_data->address2 : '')}} <br>{{(isset($get_data->postcode) ? $get_data->postcode : '')}}</p>
                              <p id="c_country" class="m-0">{{(isset($get_data->customer_city) ? $get_data->customer_city : '')}} </p> 
                              <p id="c_state" class="m-0">{{(isset($get_data->state) ? $get_data->state : '')}}</p>
                              <br>
                              <p id="refund_p" class="d-none"><b>Refund:</b>
                                <button class="btn btn-danger btn-sm" id="refund_btn"> <i class="fa fa-minus-square"></i>
                                <input type="hidden" id="hidden_cart_id" value="MKX-96745">
                                <input type="hidden" id="hidden_cart_amount" value="500.00">
                                <input type="hidden" id="hidden_tran_ref" value="TST2128500394932">
                                <input type="hidden" id="hidden_id" value="722">
                                <input type="hidden" id="hidden_email" value="hamzaashraf160@gmail.com">
                                <input type="hidden" id="hidden_name" value="Talha Talib">
                                <input type="hidden" id="hidden_phone" value="+971">
                                <input type="hidden" id="hidden_currency" value="AED">
                                </button>
                              </p>
                            </div>
                          </div>
                          <fieldset style="margin: 26px 0 1px -1px;">
                            <legend>Invoice Items:</legend>
                            <div class="row" id="table_row">
                              <div class="col-md-12 col-lg-12 col-sm-12">
                                <table class="table table-bordered table-sm">
                                  <thead>
                                    <tr>
                                      <th width="15%">SKU</th>
                                      <th width="30%">Description</th>
                                      <th width="10%">Price</th>
                                      <th width="10%">Period</th>
                                      <th width="10%">Discount</th>
                                      <th width="10%">Tax</th>
                                      <th width="10%">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                   @if(isset($get_details[0]->invoicedetails))
                                    @foreach($get_details[0]->invoicedetails as $total)
                                      <tr>
                                        <td>{{(isset($fleet->car_SKU) ? $fleet->car_SKU : '')}}</td>
                                        <td>{{(isset($total->description) ? $total->description : '')}}</td>
                                        <td>{{(isset($total->price) ? $total->price : '')}}</td>
                                        <td>{{(isset($total->period) ? $total->period : '')}} </td>
                                        <td>{{(isset($total->discount) ? $total->discount : '')}}</td>
                                        <td>{{(isset($total->tax) ? $total->tax : '')}}</td>
                                        <td>{{(isset($total->total) ? $total->total : '')}}</td>   
                                      </tr>
                                    @endforeach 
                                    @endif
                                  </tbody>
                                </table>
                              </div>
                              <div class="col-md-12 col-lg-12 col-sm-12" >
                                <div class="row" id="list_to_hide">
                                  <div class="col-md-5 col-lg-5 col-sm-12"></div>
                                    <div class="col-md-7 col-lg-7 col-sm-12">
                                      <ul class="list-group " style="border-radius: 0px; margin: 21px 0 0 0;">
                                        <li class="list-group-item">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Sub Total</strong></div>
                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="sub_total">{{(isset($get_details[0]->subtotal) ? $get_details[0]->subtotal : '')}}</span></div>
                                          </div>
                                        </li>
                                        <li class="list-group-item">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Discount</strong></div>
                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discount">{{(isset($get_details[0]->subtotal_discount) ? $get_details[0]->subtotal_discount : '')}}</span></div>
                                          </div>
                                        </li>    
                                        <li class="list-group-item">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Delivery Charges</strong></div>
                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_charges">{{(isset($get_details[0]->delivery_charge) ? $get_details[0]->delivery_charge : '')}} </span></div>
                                          </div>
                                        </li>
                                        <li class="list-group-item">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Grand Total</strong></div>
                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_total">{{(isset($get_details[0]->grand_total) ? $get_details[0]->grand_total : '')}}</span></div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- </div> -->
                          </fieldset>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>


                  
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">                
                    <div class="col-xl-11 col-md-11 col-12" style="margin-left:6%;">
                      <form id="jquery-val-form" method="post" novalidate="novalidate" >
                        <section class="invoice-add-wrapper prev-invoice">
                          <div class="row invoice-add">
                            <div class="card invoice-preview-card">
                              <div class="card-body invoice-padding ">
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                  <div class="col-md-6">
                                    <div class="logo-wrapper">
                                      <defs>
                                        <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                          <stop stop-color="#000000" offset="0%"></stop>
                                          <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </linearGradient>
                                        <linearGradient
                                          id="invoice-linearGradient-2"
                                          x1="64.0437835%"
                                          y1="46.3276743%"
                                          x2="37.373316%"
                                          y2="100%"
                                         >
                                        </linearGradient>
                                      </defs>
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-400.000000, -178.000000)">
                                          <g transform="translate(400.000000, 178.000000)">
                                            <path
                                              class="text-primary"
                                              d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                              style="fill: currentColor"
                                            ></path>
                                            <path
                                              d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                              fill="url(#invoice-linearGradient-1)"
                                              opacity="0.2"
                                            ></path>
                                            <polygon
                                              fill="#000000"
                                              opacity="0.049999997"
                                              points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"
                                            ></polygon>
                                            <polygon
                                              fill="#000000"
                                              opacity="0.099999994"
                                              points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"
                                            ></polygon>
                                            <polygon
                                              fill="url(#invoice-linearGradient-2)"
                                              opacity="0.099999994"
                                              points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"
                                            ></polygon>
                                          </g>
                                        </g>
                                      </g>
                                      </svg>        
                                      <h3 class="text-danger invoice-logo">Rental 360</h3>
                                    </div>
                                    <p class="card-text mb-0" >{{(isset($get_data->org_street1) ? $get_data->org_street1 : '' )}}, {{(isset($get_data->org_street2) ? $get_data->org_street2 : '')}} </p>
                                    <p class="card-text mb-0"> {{(isset($get_data->org_city) ? $get_data->org_city : '')}}, {{(isset($get_data->org_state) ? $get_data->org_state : '')}}, {{(isset($get_data->org_postal) ? $get_data->org_postal : '')}}</p>
                                    <p class="card-text mb-0">{{(isset($get_data->org_phone) ? $get_data->org_phone : '')}}, {{(isset($get_data->org_contact_person_number) ? $get_data->org_contact_person_number : '')}} </p>
                                  </div>
                                  <div class="invoice-number-date mt-md-2 mt-2 col-md-6 field-wraps">
                                    <div class="d-flex align-items-center justify-content-md-end mb-1">
                                      <h4 class="invoice-title">Invoice: </h4>
                                      <div class="input-group input-group-merge invoice-edit-input-group">
                                        
                                        <input type="text" class="form-control invoice-edit-input"  value="1000{{(isset($get_data->booking_code) ? $get_data->booking_code : '' )}}" readonly />
                                      </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-md-end mb-1">
                                      <h4 class="title">Date: </h4>
                                      <div class="input-group input-group-merge invoice-edit-input-group">
                                        <input type="text" class="form-control invoice-edit-input  " value="{{(isset($get_data->created_at) ? $get_data->created_at : '')}} " readonly/>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr class="invoice-spacing" />
                              <div class="card-body invoice-padding">
                                <div class="row row-bill-to invoice-spacing">
                                  <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
                                    <h6 class="mb-1">Bill To:</h6>
                                    <table>
                                      <tbody>
                                        <tr>
                                          <td class="pe-1">NAME:</td>
                                          <td><strong>{{(isset($get_data->fullname) ? $get_data->fullname : '')}} </strong></td>
                                        </tr>
                                        <tr>
                                          <td class="pe-1">ADDRESS:</td>
                                          <td>{{(isset($get_data->address1) ? $get_data->address1 : '')}} {{(isset($get_data->address2) ? $get_data->address2 : '')}} <br> {{(isset($get_data->customer_city) ? $get_data->customer_city : '')}} {{(isset($get_data->postcode) ? $get_data->postcode : '')}}</td>
                                        </tr>
                                        <tr>
                                          <td class="pe-1">PHONE:</td>
                                          <td>{{(isset($get_data->mobile) ? $get_data->mobile : '')}} </td>
                                        </tr>
                                        <tr>
                                          <td class="pe-1">EMAIL:</td>
                                          <td>{{(isset($get_data->customer_email) ? $get_data->customer_email : '')}} </td>
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
                                            <p class="card-text col-title mb-md-50 mb-0">DESC</p> 
                                            @foreach($get_details as $details)
                                              @foreach($details->invoicedetails as $descriptions)
                                                <p class="card-text mb-0">{{(isset($descriptions->description) ? $descriptions->description : '')}} </p>  
                                        
                                              @endforeach      
                                            @endforeach      
                                          </div>                                                        
                                          <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                            <p class="card-text col-title mb-md-50 mb-0">Amount</p>
                                            @foreach($get_details as $details)
                                              @foreach($details->invoicedetails as $totals)
                                                <p class="card-text mb-0">{{(isset($totals->total) ? $totals->total : '')}} </p>  
                                              @endforeach      
                                            @endforeach 
                                          </div>                   
                                        </div>       
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper">
                                  <div class="col-md-3 order-md-1 order-2 mt-md-0 mt-3">
                                    <div class="d-flex align-items-center mb-1">
                                      <label for="agents" class="form-label"><b>Agents:</b></label>
                                      <input type="text" class="form-control col-md-4" id="agents" value=" {{(isset($get_data->org_name) ? $get_data->org_name : '')}}" readonly placeholder=" " />
                                    </div>
                                  </div>
                                  <div class="col-md-9 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper">
                                      <div class="invoice-total-item">
                                        <p class="invoice-total-title">Subtotal:  {{(isset($get_details[0]->subtotal) ? $get_details[0]->subtotal : '')}} </p>
                                      </div>
                                      <div class="invoice-total-item">
                                        <p class="invoice-total-title">Discount:  {{(isset($get_details[0]->subtotal_discount) ? $get_details[0]->subtotal_discount : '')}} </p>
                                      </div>
                                      <div class="invoice-total-item">
                                        <p class="invoice-total-title">Delivery Charge:  {{(isset($get_details[0]->delivery_charge) ? $get_details[0]->delivery_charge : '')}} </p>
                                      </div>
                                      <hr class="my-50" />
                                      <div class="invoice-total-item">
                                        <p class="invoice-total-title">Grand Total:  {{(isset($get_details[0]->grand_total) ? $get_details[0]->grand_total : '')}} </p>
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
                                      <textarea class="form-control" rows="2" id="inv_preview_note" name="inv_preview_note" 
                                      value="" readonly>{{(isset($get_data->invoice_preview_note) ? $get_data->invoice_preview_note : '')}}</textarea> 
                                        <input type="hidden" class="form-control"  id="booking_uuid" name="booking_uuid" value="{{(isset($get_data->booking_uuid) ? $get_data->booking_uuid : '')}}"> @csrf
                                    </div>
                                  </div>
                                </div>                   
                              </div>
                            </div>
                          </div>    
                          </div>
                        </section>
                      </form>
                    </div>
                    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">                
                          <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off"     id="booking_form" method="">
                            <div class="card-header">
                              <h4 style="font-size: 1.486rem;">Copy Link</h4>
                              <a href="" class="text-secondary" style="float: right; margin-top: -45px;" > <i data-feather='x'></i></a>
                            </div>
                            <hr> 
                            <section id="multiple-column-form">
                              <div class="modal-body">
                                <h3>Link</h3>
                                <p id="Link"></p>
                                <p>
                                <a href="" rel="nofollow" class="text-secondary"> https://secure.paytabs.com/payment/request/invoice/1943473/4488146F27064431BB6F7EDA402A11</a>
                                </p>
                              </div>
                              <div class="card-body"> 
                                <div class="icon-wrapper"  height= 40px; width= 60px; >  
                                  <button class="btn btn-danger waves-effect">  <i data-feather='copy'></i></button>
                                  <a href="https://api.whatsapp.com/send?phone=919016643264&text=Raj" class="btn btn-danger waves-effect">  <i data-feather='message-circle'></i></a>
                                  <a target="_blank" href="https://secure.paytabs.com/payment/request/invoice/1943473/4488146F27064431BB6F7EDA402A11" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                  <button class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></button>
                                  <a href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                                </div>
                              </div>
                              <div class="card-footer"> 
                                <button  id="reset" name="reset" type="reset" style="float: right;" class="btn btn-secondary mb-1 waves-effect">  Close  </button>
                              </div>  
                            </section>
                          </form> 
                        </div>  
                      </div>
                    </div>
                  </div>
                
                </div> 
              </div>
            </div>  
          </div> 
        </form>
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

  // Clear results
  $(document).ready(function() {
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
  $('#location-2').change(function() {
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
 });

});
    </script>
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
  width: %;
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi3QbrwGSa9syCfRzSbrfvBMw42JNtztk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
  <!-- <script src="{{ asset('js/scripts/pages/booking-invoice-list.js') }}"></script>    
  <script src="{{ asset('js/scripts/pages/booking-invoice-create.js') }}"></script>  
  <script src="{{ asset('js/scripts/pages/manage-booking-list.js') }}"></script>   -->
  <!-- <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script>  -->
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>

@endsection

 