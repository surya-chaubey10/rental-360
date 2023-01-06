@extends('layouts.main')
@section('vendor-style')

<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">

@endsection

@section('content')
<div class="col-xl-8 col-md-8 col-12" style="margin-left:16%;">
<form id="jquery-val-form" method="post" novalidate="novalidate" >
<section class="invoice-add-wrapper prev-invoice">
  <div class="row invoice-add">
    
      <div class="card invoice-preview-card">
        <div class="card-body invoice-padding ">
          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div class="col-md-6">
           
              <div class="logo-wrapper">
              <span class="">
              @php    $org= org_details(); @endphp 
                @if(isset($org->org_logo))
                <img
                    src="/public/company/logo/{{$org->org_logo}}"
                    class="congratulations-img-right"
                    alt="card-img-right"
                    height="40" 
                    width="40"
                /><br><br>
                <span class="user-name fw-bolder">
                   <h3>{{(isset($org->org_name) ? $org->org_name : '')}}</h3>
                  </span>
                @else
                  <img class="round" src="{{ asset('/public/company/logo/202210190637logo.jpg') }}" alt="avatar" height="40" width="40">
                  <span class="user-name fw-bolder">
                    <h3>{{(isset($org->org_name) ? $org->org_name : '')}}</h3>
                    </span>
                @endif</span>
              </div>
              <div  style="margin-top: -27px;">
              <p class="card-text mb-0"> {{(isset($org->org_city) ? $org->org_city : '')}}</p>
              <p class="card-text mb-0"> {{isset($org->org_state) ? $org->org_state : ''}}</p>
              <p class="card-text mb-0" > {{(isset($org->countrymaster) ? $org->countrymaster->name : '')}} </p>
              <p class="card-text mb-0">{{(isset($org->website) ? $org->website : '' )}}</p>
              <p class="card-text mb-0">{{(isset($org->org_phone) ? $org->org_phone : '' )}}</p>
            </div>
            </div>  
            <div class="invoice-number-date mt-md-3 mt-2 col-md-6">
              <div class="d-flex align-items-center justify-content-md-end mb-1">
                <h4 class="invoice-title">Invoice</h4>
                  <input type="text" class="form-control invoice-edit-input"  value="1000{{isset($get_data->booking_code) ? $get_data->booking_code:''}}" readonly />
                 <input type="hidden" id="uuid" class="form-control"  value="{{$get_data->uuid}}" />
                </div>
             
              <div class="d-flex align-items-center justify-content-md-end mb-1">
              <h4 class="title col-md-4 ">Date:</h4>
                <input type="text" class="form-control invoice-edit-input" value="{{ (!empty($get_data) && $get_data->date) ? 
                 Carbon\Carbon::parse($get_data->date)->format('d M Y') : '' }}" readonly/>
              </div>
              
            </div>
          </div>
        </div>
        <hr class="invoice-spacing" />
        @if($get_data->transaction_type==4)
        <div class="col-md-6" style="margin-left: 6%;"> 
           <div class="d-flex align-items-center mb-1">
                <label for="agents" class="form-label" style="width: 36%; font-size: 97%; font-weight: 900;"><b>Cash Collected</b></label>
                <input type="text" id="grand_totalssss" class="form-control"  value="{{isset($get_data->grand_total) ? $get_data->grand_total : ''}}" readonly/>
                <select class="form-select cash hidden" name="transaction_type" id="transaction_type" style="mergin-left: -22%;" required>
                 <option name="transaction_type" value="{{$get_data->transaction_type}}">Cash</option>
                 </select>
              </div>
              </div>
              @else
              <div class="col-md-6" style="margin-left: 6%; display:none;"> 
               <div class="d-flex align-items-center mb-1">
                <label for="agents" class="form-label" style="width: 36%; font-size: 97%; font-weight: 900;"><b>Cash Collected</b></label>
               <select class="form-select cash" name="transaction_type" style="mergin-left: -22%;" required>
                <option value=""> </option>
                <!-- <option name="cash_name" value="{{$get_data->transaction_type}}">Cash</option> -->
                 </select>
              </div>
              </div>
             
              @endif
        <div class="card-body invoice-padding">
          <div class="row row-bill-to invoice-spacing">
             
            <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
              <h6 class="mb-1">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-1">NAME:</td>
                    <td><strong>{{$get_data->fullname}}</strong></td>
                  </tr>
                  <tr>
                    <td class="pe-1">ADDRESS:</td>
                    <td>{{$get_data->address1}} {{$get_data->address2}} <br> {{$get_data->customer_city}} {{$get_data->postcode}}</td>
                  </tr>
                  <tr>
                    <td class="pe-1">PHONE:</td>
                    <td>{{$get_data->mobile}}</td>
                  </tr>
                  <tr>
                    <td class="pe-1">EMAIL:</td>
                    <td>{{$get_data->customer_email}}</td>
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
                       @foreach($get_details as $data)
                        <p class="card-text mb-0">{{$data->description}}</p>  
                        @endforeach                   
                      </div>                   
                     
                      <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                        <p class="card-text col-title mb-md-50 mb-0">Amount</p>
                        @foreach($get_details as $data)
                        <p class="card-text mb-0">{{$data->total}}</p>
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
            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
              <div class="d-flex align-items-center mb-1">
                <label for="agents" class="form-label"><b>Agents:</b></label>
                <input type="text" class="form-control ms-50" id="agents" value="{{$get_data->org_name}}" readonly placeholder="{{$get_data->org_name}}" />
              </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
              <div class="invoice-total-wrapper">
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Subtotal:</p>
                  <p class="invoice-total-amount">{{$get_data->subtotal}}</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Discount:</p>
                  <p class="invoice-total-amount">{{$get_data->subtotal_discount}}</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Promotion:</p>
                  <p class="invoice-total-amount">{{$get_data->promotion_value}}</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Delivery Charge:</p>
                  <p class="invoice-total-amount">{{$get_data->delivery_charge}}</p>
                </div>
                <hr class="my-50" />
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Grand Total:</p>
                  <p class="invoice-total-amount">{{$get_data->grand_total}}</p>
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
                <input type="hidden" class="form-control"  id="booking_id" name="booking_id" value="{{$get_data->booking_id}}">
                <input type="hidden" class="form-control"  id="transaction_type" name="transaction_type" value="{{$get_data->transaction_type}}">
                @csrf
              </div>
            </div>
          </div>                   
        </div>
      </div>
      <div class="card-body" style="margin-left:40%;">
      @if($get_data->transaction_type==4)
          <a  href="javascript:;"  class="btn btn-primary w-40 mb-5 waves-effect waves-float waves-light" id="store_note">
           Create Invoice
          </a>     
          @else
          <a  href="javascript:;"  class="btn btn-primary w-40 mb-5 waves-effect waves-float waves-light" id="store_note" data-bs-toggle="modal" data-bs-target="#large">
           Create Invoice
          </a> 
          @endif     
        </div>
    </div>    
  </div>
</section>
 </form>
 </div>
 

                <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered modal-lg">
                 
                    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0"> 
                      
                          <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="">
          
                            <div class="modal-header">
                                <h4 style="font-size: 1.486rem;">Copy Link</h4>
                                <!-- <button  type="reset" style="float: right; margin-top: -45px;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button> -->
                                @if($get_data->document_type=='account')
                                <a href="{{route('invoice-list')}}" class="btn btn-danger mb-1 waves-effect" style="float: right;" > <i data-feather='x'></i></a>
                                @else
                                <a href="{{route('manage-booking-list')}}" class="btn btn-danger mb-1 waves-effect" style="float: right;" > <i data-feather='x'></i></a>
                                @endif  
                            </div> 
                            <hr> 
                  
                            <section id="multiple-column-form">
                              <div class="modal-body">
                                 
                                <p>
                                  <a class="copyurl" href="{{isset($get_data->short_link)? $get_data->short_link:''}}"  style="color: red;" rel="nofollow" id="copy" >{{isset($get_data->short_link)? $get_data->short_link:''}} </a> 
                                </p>
                              </div> 
 
                              <div class="card-body">  
                                <div class="icon-wrapper"  height= 40px; width= 60px; >  
                                  
                                  <!-- <a title="Copy" href="javascript:;"     id="url_copy" class="btn btn-danger waves-effect url_copy">  <i data-feather='copy'></i></a> -->
                                  <a title="Whatsapp" href="https://api.whatsapp.com/send?phone={{isset($get_data->mobile)? $get_data->mobile:''}}&text={{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i class="fa fa-whatsapp" style="font-size:24px"></i></a>
                                  <a  title="Payment" target="_blank" id="make_payment" href="{{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                  <a  title="Message" href="javascript:;" id="sms_send" class="btn btn-danger waves-effect" > <i data-feather='message-square'></i></a>
                                  <a title="Mail" href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>

                                 
                                  <a title="Copy" id="clikboard" href="javascript:;"class="btn btn-danger waves-effect"><i data-feather='copy'></i> </a>                                                        
                                  <input  type="hidden" value="{{isset($get_data->short_link)? $get_data->short_link:''}}" id="myInput"> 
                                </div>
                              </div>

                              <!-- <div class="card-footer">
                                 
                                <a href="javascrips:;" id="button" dismiss="modal" name="button" type="button" style="float: right;" class="btn btn-secondary mb-1 waves-effect">  Close  </a>
                                </div> -->
                              
                            </section>
                          </form>  

                    </div>  
                  </div>
                </div>
                
                 
 


@endsection
@section('vendor-script')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

@endsection

@section('page-script') 
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

@endsection
 
 