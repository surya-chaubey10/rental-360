@extends('layouts.main')
@section('vendor-style')

<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
@endsection

@section('content')
<div class="col-xl-8 col-md-8 col-12" style="margin-left:16%;">
<form id="jquery-val-form" method="post" novalidate="novalidate">
<section class="invoice-add-wrapper">
  <div class="row invoice-add">
    
      <div class="card invoice-preview-card">
        <div class="card-body invoice-padding ">
          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div>
             
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
              <p class="card-text mb-0" style="margin-left:5%">Office 149, 450 South Brand Brooklyn</p>
              <p class="card-text mb-0"style="margin-left:5%">San Diego County, CA 91905, USA</p>
              <p class="card-text mb-0"style="margin-left:5%">+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>
            <div class="invoice-number-date mt-md-0 mt-2">
              <div class="d-flex align-items-center justify-content-md-end mb-1">
                <h4 class="invoice-title">Invoice</h4>
                <div class="input-group input-group-merge invoice-edit-input-group">
                  <div class="input-group-text">
                    <i data-feather="hash"></i>
                  </div>
                  <input type="text" class="form-control invoice-edit-input" placeholder="53634" />
                </div>
              </div>
              <div class="d-flex align-items-center mb-1">
                <span class="title">Date:</span>
                <input type="text" class="form-control invoice-edit-input date-picker" />
              </div>
              <div class="d-flex align-items-center">
                <span class="title">Due Date:</span>
                <input type="text" class="form-control invoice-edit-input due-date-picker" />
              </div>
            </div>
          </div>
        </div>
        <hr class="invoice-spacing" />
        <div class="card-body invoice-padding pt-0" style="margin-left:1%">
          <div class="row row-bill-to invoice-spacing">
            <div class="col-xl-7 mb-lg-1 col-bill-to ps-0">
            <h6 class="mb-2">Invoice To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-1">Total Due:</td>
                    <td><strong>$12,110.55</strong></td>
                  </tr>
                  <tr>
                    <td class="pe-1">Bank name:</td>
                    <td>American Bank</td>
                  </tr>
                  <tr>
                    <td class="pe-1">Country:</td>
                    <td>United States</td>
                  </tr>
                  <tr>
                    <td class="pe-1">IBAN:</td>
                    <td>ETD95476213874685</td>
                  </tr>
                  <tr>
                    <td class="pe-1">SWIFT code:</td>
                    <td>BR91905</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-xl-4 p-0 ps-xl-2 mt-xl-0 mt-2">
              <h6 class="mb-2">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-1">Total Due:</td>
                    <td><strong>$12,110.55</strong></td>
                  </tr>
                  <tr>
                    <td class="pe-1">Bank name:</td>
                    <td>American Bank</td>
                  </tr>
                  <tr>
                    <td class="pe-1">Country:</td>
                    <td>United States</td>
                  </tr>
                  <tr>
                    <td class="pe-1">IBAN:</td>
                    <td>ETD95476213874685</td>
                  </tr>
                  <tr>
                    <td class="pe-1">SWIFT code:</td>
                    <td>BR91905</td>
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
                       
                        <p class="card-text mb-0">Audi A8</p>                     
                      </div>                   
                     
                      <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                        <p class="card-text col-title mb-md-50 mb-0">Amount</p>
                        <p class="card-text mb-0">$24.00</p>
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
                <input type="text" class="form-control ms-50" id="agents" placeholder="Agents" />
              </div>
            </div>
            <div class="col-md-8 d-flex justify-content-end order-md-2 order-1">
              <div class="invoice-total-wrapper">
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Subtotal:</p>
                  <p class="invoice-total-amount">$1800</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Discount:</p>
                  <p class="invoice-total-amount">$28</p>
                </div>
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Tax:</p>
                  <p class="invoice-total-amount">21%</p>
                </div>
                <hr class="my-50" />
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Total:</p>
                  <p class="invoice-total-amount">$1690</p>
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
                <textarea class="form-control" rows="2" id="note"></textarea
                >
              </div>
            </div>
          </div>                 
        </div>
      </div>
      <div class="card-body" style="margin-left:40%;">
          <a  href="javascript:;"  class="btn btn-primary w-40 mb-5 waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
           Create Invoice
</a>       
        </div>
    </div>    
  </div>
</section>
 </form>
 </div>

@endsection
@section('vendor-script')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
@endsection
