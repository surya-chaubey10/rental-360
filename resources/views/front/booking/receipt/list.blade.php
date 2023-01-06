@extends('layouts.main')
@section('title', '')
<style>
  tr td{
  padding: 0 !important;
  margin: 0 !important;
}
</style>
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')

<section class="invoice-preview-wrapper">
<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-12 col-md-12 col-12">
    <div class="card invoice-preview-card">
        <div class="card-body invoice-padding pb-0">
      <h4 class="card-title"><b>Receipt</b></h4>
       <a class="btn btn-danger" style="float: right; margin-top: -45px;" href="{{url('receipt-print')}}" target="_blank"><i data-feather="printer"  class="foo bar" stroke-width="1"></i> Print </a>
       <br>
       <hr class="invoice-spacing" />

          <!-- Header starts -->
          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div>
              <h1 class="invoice-title" style="color:red;position: absolute;left: 18px;top: 120px;"> MYRIDE</h1><br><br>
              <p class="card-text mb-25" style="color:red;">From</p>
              <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
              <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
              <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>
            <div>
              <br> <br>
              <p class="card-text mb-25" style="color:red;">To</p>
              <p class="card-text mb-25">Office 149, 450 Sout</p>
              <p class="card-text mb-25">San D</p>
              <p class="card-text mb-0">+1 (12</p>
            </div>
            <div>
              <br> <br>
              <p class="card-text mb-25">Invoice#</p>
              <p class="card-text mb-25">Customer One</p>
            </div>
            <div class="mt-md-0 mt-2">
            <br>
              <h6 class="invoice-title" style="font-size:15px">Encontro : 
                <span class="invoice-number" style="font-size:15px">{{date('d-m-Y')}}</span>
              </h6>
            </div>
          </div>
          <!-- Header ends -->
        </div>

        <!-- Address and Contact starts -->
        <div class="card-body invoice-padding pt-30 m-2">
          <div class="row invoice-spacing">
            <div class="col-xl-6 p-0">
              <h6 class="mb-2 fw-bold">Endereco de pickup:</h6>
              <p class="card-text mb-25"> {{$receipt_data->pickup_address}}</p>
              <p class="card-text mb-25">Data e hora de recolha:<span class="invoice-number" style="font-size:15px">{{date('d-m-Y h:i A', strtotime($receipt_data->picking_date_time))}}</span></p>
              
            </div>
            <div class="col-xl-6 p-0 mt-xl-0 mt-2">
              <h6 class="mb-2 fw-bold">Endereco de saida:</h6>
              <p class="card-text mb-25">{{$receipt_data->drop_off_address}}</p>
              <p class="card-text mb-25">Data e hora de entrega:<span class="invoice-number" style="font-size:15px">{{date('d-m-Y h:i A', strtotime($receipt_data->drop_off_date_time))}}</span></p>
             
              <hr class="invoice-spacing" style="margin-top:30px" />
            <table class="table pt-0" >
            <tbody>
              <tr style="text-align:left">
              <td class="py-1" >
             Veiculo:
              </td>
              <td class="py-1">
               {{$receipt_data->vehicle->vehicle_name}}
              </td>
              </tr>
              <tr>
              <td class="py-1">
               Motorista:
              </td>
              <td class="py-1">
              {{$receipt_data->customer->user->fullname}}
              </td>
              </tr>
              <tr >
              <td class="py-1">
               Quilometragem:
              </td>
              <td class="py-1">
               0
              </td>
              </tr>
              <tr>
              <td class="py-1">
               Tempo de espere (em minutos):
              </td>
              <td class="py-1">
               0
              </td>
              </tr>
              <tr>
              <td class="py-1">
               Montante:
              </td>
              <td class="py-1">
              ₹ 0
              </td>
              </tr>
              <tr>
              <td class="py-1">
               Taxa Total(%):
              </td>
              <td class="py-1">0
              %
              </td>
              </tr>
              <tr>
              <td class="py-1">
               Total Encargos Fiscais:
              </td>
              <td class="py-1">
               ₹ 0
              </td>
              </tr>
            </tbody>
          </table>
            </div>
          </div>
        </div>
        <!-- Address and Contact ends -->
    
        <!-- Invoice Note starts -->
        <div class="card-body invoice-padding pt-0">
          <div class="row">
            <div class="col-8">
              <span class="fw-bold" 
                >{{$receipt_data->note}}</span
              >
            </div>
          </div>
        </div>
        <!-- Invoice Note ends -->
      </div>
    </div>
    <!-- /Invoice -->
  </div>
</section>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}

 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
