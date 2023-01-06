@extends('layouts.main')
@section('title', '')
 
@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
 
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
  @endsection
@section('content')
    <section id="acounts_payment_list">
        <div class="row"> 
        <form  action="{{route('company-general-leader')}}" method="get" > 
          
          
            <div class="col-md-4 col-6" >
                <div class="mb-1">
                    <label class="form-label" for="select_company-column">Select Company</label>
                    <div class="mb-1">
                        <select class="form-select select2" id="select_company" name="select_company">
                        @if($allcompanies)
                            @foreach($allcompanies as $allcompany)
                                @if(isset($orgid))
                                    <option value="{{$allcompany->id}}" {{ $orgid->id == $allcompany->id ? 'selected': '' }}> {{$allcompany->org_name}}</option>
                                @else
                                    <option value="{{$allcompany->id}}"> {{$allcompany->org_name}}</option>
                                @endif
                             @endforeach
                            @endif
                        </select>
                    </div>
                </div> 
           
                <div class="col-md-8 col-6" style="margin:-14% 0% 25% 100%;">
                <button  name="submit" type="submit" value="filter" style="float:right;margin-left:2%;" class="btn btn-success me-1">Search</button>
                   <a href="{{ route('company-general-leader') }}" class="btn btn-danger filter-button" style="float:right;" >Clear </a>
                </div> 
            </div> 
          </form>
         </div>     
         @if(isset($orgid))
         <span class="text-danger">Filter By : {{$orgid->org_name}}</span>
         @endif

         <span class="dropdown-wrapper" aria-hidden="true">     
                <div class="card-datatable table-responsive pt-0">  
                @php $space="     "; @endphp
                  <table class=" gltable table">              
                    <thead class="table-light">
                      <tr> 
                        <th>Date</th> 
                        <th>Type</th>
                        <th>company</th>
                        <th></th>  
                        <th></th>
                        <th>Credit</th> 
                        <th>Debit</th> 
                        <th>Balance</th> 
                      </tr> 
                    </thead> 
                    <tbody>
                    <tr>

                    @foreach($gl as $gl_data )
                    
                        <td>{{date("d/M/Y",strtotime($gl_data->created_at))}}</td> 
                        @if($gl_data->credit !=0)    
                                            
                        <td>Transaction Fee Received</td>       
                        @else
                        <td>Withdrawal Fee Received </td>    
                        @endif
                    <!-- add company -->
                    <td>{{isset($gl_data->org_name) ? $gl_data->org_name:'' }}</td>
                        <!-- end company -->
                        @if($gl_data->trans_ref==NULL)                        
                        <td>N/A</td>                       
                        @else
                        <td><a  data-id="{{($gl_data->transaction_id)}}" id="statement_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> {{($gl_data->trans_ref)}}</a></td>             
                        @endif
                       
                       
                        @if($gl_data->type==1)
                            <td class="text-danger"> <span class="text-primary">{{isset($gl_data->org_name) ? $gl_data->org_name:'' }} </span> {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}}</td>
                        @elseif($gl_data->type==2)
                        <td class="text-danger"> <span class="text-primary">Pay Out   </span> {{$space}} {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}}</td>

                        @elseif($gl_data->type==3)
                        @php  $paid= $gl_data->credit-$gl_data->partial_amount;  @endphp
                        <td class="text-danger"> <span class="text-primary">Partially Payment   </span> {{$space}} {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}} Paid Amount - {{$paid}}  Available - {{$gl_data->partial_amount}} </td>

                        @elseif($gl_data->type==4)
                            <td class="text-danger"> <span class="text-primary">Cash Payment   </span> {{$space}} {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}}</td>

                        @elseif($gl_data->type==5)
                        
                        <td class="text-danger"> <span class="text-primary">Refund   </span> {{$space}} {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}}  </td>

                        @elseif($gl_data->type==6)
                        
                        <td class="text-danger"> <span class="text-primary"> Charged   </span> {{$space}} {{$space}} Fixed Fee-{{$gl_data->fixed_fee}},{{$space}}PG Fee={{$gl_data->pgcharges}},{{$space}}Comission Fee-{{$gl_data->commision}},Vat-{{$gl_data->vat}}  </td>   
                        @else
                        <td>  </td>
                        @endif

                        @if($gl_data->credit !=0)
                        @php  $total = $gl_data->vat + $gl_data->commision + $gl_data->pgcharges + $gl_data->fixed_fee; @endphp
                        <td> {{isset($total) ? $total : '0'}}</td> 
                        @else
                        <td>{{isset($gl_data->withdrawal_fee) ? $gl_data->withdrawal_fee : '0' }}</td>
                        @endif

                        <td>  </td>
                        <td>  </td>

                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  
                </div>  
        </section>
<!-- STATEMENT POPUP trans_ref -->
<section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
         </div>
         <div class="modal fade show " id="detais" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content" style="width:90%; margin-left:5%">  
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <label for="" id="status_label" class="label label-lg bg-light-success label-inline"> </label>
                 <span id="transaction_type"> </span> <span id="transaction_referance"> </span>
              </h5>
              
              <button   type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
             </div>
          <div class="modal-body">
              <ul class="list-group" style="border-radius: 0px">
                  <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_id1"></span> : Rental 360</li>
              </ul>
              <div class="row">
                  <div class="col-md-8 col-lg-8">
                      <ul class="list-group" style="border-radius: 0px">
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Amount</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amount_currency"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Cart Id</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_cart_id"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item" id="customer_inovice_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Status</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_status"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_resp_msg"> </span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_date"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row" id="invoice_li">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_no"> </span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item " id="invoice_ref_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_ref"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Customer Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_customer_ref"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Description</strong></div>
                                         
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_description"></span></div>
                                         
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Scheme</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_scheme"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Payment Description</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="payment_description" style="font-size: 10px;"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Type</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_type"> </span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Month</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryMonth"> </span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Year</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryYear"> </span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                        </ul>
                      </div>

                      <div class="col-md-4 col-lg-4">
                      <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                      <p id="name" class="m-0"></p>
                      <p id="c_email" class="m-0"> </p>
                      <p id="comapany" class="m-0"> </p>
                      <p id="address" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off"></p>
                      <p id="c_country" class="m-0"> </p> 
                      <p id="c_state" class="m-0"> </p>
                      <br>
                      <p id="refund_p" class="d-none"><b>Refund:</b>
                          <button class="btn btn-danger btn-sm" id="refund_btn"> <i class="fa fa-minus-square"></i>
                          <input type="hidden" id="hidden_cart_id" value="">
                          <input type="hidden" id="hidden_cart_amount" value="">
                          <input type="hidden" id="hidden_tran_ref" value="">
                          <input type="hidden" id="hidden_id" value="">
                          <input type="hidden" id="hidden_email" value="">
                          <input type="hidden" id="hidden_name" value="">
                          <input type="hidden" id="hidden_phone" value="">
                          <input type="hidden" id="hidden_currency" value="">
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
                                    <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="sub_total"> </span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Discount</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discount"> </span></div>
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Delivery Charges</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_charges">  </span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Grand Total</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_totalsss"> </span></div>
                                    </div>
                                </li>
                              </ul>
                        </div>
                      </div>
                    </div>
                  </div>

              </fieldset>
          </div>
      </div>
  </div>
 </div>  
         
</section>

@endsection




@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->

  <script src="{{ asset('js/scripts/pages/companygl-list.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
  

@endsection
