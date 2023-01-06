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
  <section class="invoice-add-wrapper prev-invoice">
    <div class="row invoice-add">
      <div class="card invoice-preview-card">
        <div class="card-body invoice-padding">

          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div class="col-md-9">
              <div class="logo-wrapper">
                <h3 class="text-danger invoice-logo">BRILLIANT RENT A CAR</h3>
              </div>
              <p class="card-text mb-0" style="margin-left:5%">utyutuy</p>
              <p class="card-text mb-0"style="margin-left:5%">xcgdgh</p>
              <p class="card-text mb-0"style="margin-left:5%">fdghhg</p>
            </div>
            <div class="col-md-3">
              <div class="d-flex align-items-center mb-1">
                &nbsp;&nbsp;&nbsp;&nbsp; <span class="title">Date :</span> &nbsp; 
                <input type="text" class="form-control invoice-edit-input  " value="2022-10-15" readonly/>
              </div>  
            </div>
          </div>
          <hr class="invoice-spacing" />
          <div class="row row-bill-to invoice-spacing"> 
            <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
              <h6 class="mb-1">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-1">NAME:</td>
                    <td><strong>yadav</strong></td>
                  </tr>
                  <tr>
                    <td class="pe-1">EMAIL:</td>
                    <td>yadav@gmail.com</td>
                  </tr> 
                </tbody>
              </table>
            </div>
          </div>
          <div class="row invoice-sales-total-wrapper">
            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
              <div class="d-flex align-items-center mb-1">
                <label for="agents" class="form-label"><b>Agents:</b></label>
                <input type="text" class="form-control ms-50" id="agents" value="jon" readonly placeholder="jomr" />
              </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
              <div class="invoice-total-wrapper">
                <div class="invoice-total-item">
                  <p class="invoice-total-title">Grand Total:</p>
                  <p class="invoice-total-amount"></p>
                </div>
              </div>
            </div>
          </div>
          <hr class="invoice-spacing" />
          <div class="row invoice-sales-total-wrapper">
            <h3 class="mb-1">Link</h3>
            <p><a href="javascript:;" rel="nofollow" id="copy" class="text-secondary"> </a> </p>
            <div class="icon-wrapper"  height= 40px; width= 60px; >  
              <a href="javascript:;"     id="url_copy" class="btn btn-danger waves-effect url_copy">  <i data-feather='copy'></i></a>
              <a href="https://api.whatsapp.com/send?phone={{isset($get_data->mobile)? $get_data->mobile:''}}&text={{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i data-feather='message-circle'></i></a>
              <a target="_blank" id="make_payment" href="{{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
              <button class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></button>
              <a href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
            </div>
          </div>

        </div>  
      </div>
    </div>    
  </section>
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
 
 