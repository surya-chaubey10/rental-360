@extends('layouts.main')
@section('vendor-style')

<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
<link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-toastr.css')}}">

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
                <svg
                  viewBox="0 0 139 95"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  height="24"
                >
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
              <p class="card-text mb-0" style="margin-left:5%"></p>
              <p class="card-text mb-0"style="margin-left:5%"></p>
              <p class="card-text mb-0"style="margin-left:5%"></p>
            </div>
            <div class="invoice-number-date mt-md-0 mt-2 col-md-6">
              <div class="d-flex align-items-center justify-content-md-end mb-1">
                <h4 class="invoice-title">Invoice</h4>
                <div class="input-group input-group-merge invoice-edit-input-group">
                  <input type="text" class="form-control invoice-edit-input"  value="1000"readonly />
                </div>
              </div>
              <div class="d-flex align-items-center mb-1">
                <span class="title" style="margin-left:36%;">Date:</span>
                <input type="text" class="form-control invoice-edit-input  " value="13-10-2022" readonly/>
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
                      <td class="pe-1">NAME:-</td>
                      <td><strong>Ali</strong></td>
                    </tr>
                  <tr>
                      <td class="pe-1">ADDRESS: -</td>
                      <td> Dubai  </td>
                  </tr>
                  <tr>
                      <td class="pe-1">PHONE:-</td>
                      <td>+8459347823</td>
                  </tr>
                  <tr>
                      <td class="pe-1">EMAIL:-</td>
                      <td>ali@gmail.com</td>
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
                        <p class="card-text mb-0">Audi</p>             
                      </div>                   
                      <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                        <p class="card-text col-title mb-md-50 mb-0">Amount</p>
                        <p class="card-text mb-0">100</p>
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
                <label for="agents" class="form-label"><b>Agents: </b></label>
                <input type="text" class="form-control ms-50" id="agents" value="Haider" readonly placeholder="" />
              </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
              <div class="invoice-total-wrapper">
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Subtotal:</p>
                  <p class="invoice-total-amount">100</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Discount:</p>
                  <p class="invoice-total-amount">2%</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Delivery Charge:</p>
                  <p class="invoice-total-amount">10</p>
                </div>
                <hr class="my-50" />
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Grand Total:</p>
                  <p class="invoice-total-amount">88</p>
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
                <textarea class="form-control" rows="2" id="inv_preview_note" name="inv_preview_note" value="" readonly>long/car/trip/Audi-Q-8</textarea>
                <input type="hidden" class="form-control"  id="booking_id" name="booking_id" value=""> @csrf
              </div>
            </div>
          </div>                   
        </div>
      </div>
      <div class="card-body" style="margin-left:40%;">
          <a  href="javascript:;"  class="btn btn-primary w-40 mb-5 waves-effect waves-float waves-light" id="store_note" data-bs-toggle="modal" data-bs-target="#large">
           Create Invoice
          </a>       
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
          
                            <div class="card-header">
                                <h4 style="font-size: 1.486rem;">Copy Link</h4>
                                <a href="" class="text-secondary" style="float: right; margin-top: -45px;" > <i data-feather='x'></i></a>
                            </div>
                            <hr> 
                  
                            <section id="multiple-column-form">
                              <div class="modal-body">
                                 
                                  <p>
                                  <a href="javascript:;" rel="nofollow" id="copy" class="text-secondary"> </a> 
                                </p>
                                <input type="hidden" value="" id="copied_url">
                              </div> 

                              <div class="card-body">  
                                <div class="icon-wrapper"  height= 40px; width= 60px; >  
                                  <a href="javascript:;"     id="url_copy" class="btn btn-danger waves-effect url_copy">  <i data-feather='copy'></i></a>
                                  <a href="https://api.whatsapp.com/send?phone={{isset($get_data->mobile)? $get_data->mobile:''}}&text={{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i data-feather='message-circle'></i></a>
                                  <a target="_blank" id="make_payment" href="{{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                  <button class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></button>
                                  <a href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                                </div>
                              </div>
                              <div class="card-footer">
                              <a href="javascript:;" id="button"  name="button" type="cancle" style="float: right;" class="btn btn-secondary mb-1 waves-effect">  Close  </a>
                              </div>
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

@endsection

@section('page-script') 
<script src="{{asset('js/scripts/pages/preview-invoice.js')}}"></script>
@endsection
 
 