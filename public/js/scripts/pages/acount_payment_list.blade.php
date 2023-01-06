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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

.maring-custom{
margin-left: 2rem;
}
.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
    padding-right: 6px;
    padding-left: 52px;
    margin-left: 0; }
</style>
 
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  @endsection
@section('content')
  <section id="acounts_payment_list">
 
       <div class="row">
         <div class="card">
           <br> 
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="true"> Payments</button>
               
              </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-payments-tab" data-bs-toggle="pill" data-bs-target="#pills-payments" type="button" role="tab" aria-controls="pills-payments" aria-selected="false">Transcations</button>
                </li>
 
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-invoice-tab" data-bs-toggle="pill" data-bs-target="#pills-invoice" type="button" role="tab" aria-controls="pills-invoice" aria-selected="false">Statement</button>
                </li> 
            </ul> 
            <div class="tab-content" id="pills-tabContent" >
              <div class="tab-pane fade show active" id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab"> 

              <button type="button" class="btn btn-primary" style="margin:-6% 0% 2% 83%;" data-bs-toggle="modal" data-bs-target="#modals-addslide">Quick Payment</button>
              
                <div class="card-datatable table-responsive pt-0"> 
                  <table class="invoice-list-table1 table ">
                    <thead class="table-light">
                      <tr> 
                      
                        <th class="col-2">Invoice Id</th> 
                        <th class="col-2">Description</th>
                        <th class="col-1">currency</th>  
                        <th class="col-1">Total</th>
                        <th class="col-1">Status</th> 
                        <th class="col-1">Type</th> 
                        <th class="col-1">AddedOn</th> 
                        <th class="col-2">Sync With Booking</th> 
                        <th class="col-2">Action</th> 
                       
                      </tr> 
                    </thead> 
                  </table>
                </div>  
              </div>

              <div class="tab-pane fade show " id="pills-payments" role="tabpanel" aria-labelledby="pills-booking-tab">
                  <div class="card-datatable table-responsive">
                    <table class="invoice-list-table2 table">
                      <thead>
                        <tr> 
                       
                          <th>ref</th>
                          <th>name </th>
                          <th>type</th>
                          <th>payment method</th>
                          <th>amount</th>
                          <th>date&time</th>
                          <th>status</th> 
                        </tr>
                      </thead>
                    </table>
                  </div>
                  </div>
 
              <div class="tab-pane fade show " id="pills-invoice" role="tabpanel" aria-labelledby="pills-booking-tab">
                 <div class="col-12">
                  <div class="row mb-3">
                 <div class="col-10">
                 <table class="table">
                 @php $orgs = org_details() @endphp
                      <h2 class="maring-custom">Account ID: {{$orgs->id}}</h2>
                      
					  
                           <tr>
                            <th>Currency </th>
                            <th>Reserve </th>
                            <th> Bank</th>
                            <th>Payment Schedule</th>
                            <th>Last Payout</th>
                            <th>Pending</th> 
                          </tr>
                         
                            <tr> 
                            <td>AED </td>
                            <td>N/A </td>
                            <td> {{(isset($get_bank_first->bank_name) ? $get_bank_first->bank_name : '')}}</td>
                            <td>{{$subscription->payout_setup == 0 ? 'Manual' : 'Auto'}}</td>
                            <td>{{(isset($last_payout->debit) ? $last_payout->debit : '')}}</td>
                            <td>{{(isset($pending->Balance) ? $pending->Balance : '')}}</td> 
                            </tr>
                            <input type="hidden" id="available_balance" class="form-control available_balance" value="{{(isset($pending->Balance) ? $pending->Balance : '0')}}" />
                  </table>
                  </div>
                  <div class="col-2 d-flex justify-content-center align-items-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modals-withdraw"> Withdraw  </button> 
                  </div>
                  </div>
                    
                <div class="card invoice-list-wrapper">
                    @php $space="     "; @endphp
                    <table class=" table"> 
                        <thead>
                        <tr>
                         
                            <th>date </th>
                            <th> transaction ref</th>

                            <th>type </th>
                            <th>credit</th>
                            <th>debit</th>
                            <th>balance</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                         <td class="text-danger"><p class="font-weight-bold">Privious Balance </p></td>  
                         <td> </td>
                         <td>  </td>
                         <td> </td>
                         <td> </td>
                         <td>{{(isset($last_payout->Balance) ? $last_payout->Balance : '')}} </td> 
                         </tr>
                          @foreach($gl as $gl_data)
                          <tr>
                         <td>{{date("d/M/Y",strtotime($gl_data->created_at))}}</td> 
                           @if($gl_data->trans_ref==NULL)                        
                          <td>N/A</td>                       
                         @else
                         <td><a class="fw-bold" data-id="{{($gl_data->transaction_id)}}" id="statement_details" data-bs-toggle="modal" data-bs-target="#detais" style="color:red;"> {{($gl_data->trans_ref)}}</a></td>             
                        @endif

                        @if($gl_data->type==1)
                            <td class="text-danger"> <span class="text-primary">Transfer From Pending  </span> {{$space}} {{$gl_data->note}}</td>
                        @elseif($gl_data->type==2)
                          <td class="text-danger"> <span class="text-primary">Pay Out   </span> {{$space}} {{$gl_data->note}}</td>

                        @elseif($gl_data->type==3)
                          @php  $paid= $gl_data->credit-$gl_data->partial_amount;  @endphp
                        <td class="text-danger"> <span class="text-primary">Partially Payment   </span> {{$space}} {{$gl_data->note}} Paid Amount - {{$paid}}  Available - {{$gl_data->partial_amount}} </td>

                        @elseif($gl_data->type==4)
                            <td class="text-danger"> <span class="text-primary">Cash payment   </span> {{$space}} {{$gl_data->note}}</td>

                       @elseif($gl_data->type==5)
                        
                          <td class="text-danger"> <span class="text-primary">Refund   </span> {{$space}} {{$gl_data->note}}  </td>

                          
                       @elseif($gl_data->type==6)
                        
                        <td class="text-danger"> <span class="text-primary"> Charged   </span> {{$space}} {{$gl_data->note}}  </td>   
                        @else

                        @endif

                         <td>{{$gl_data->credit}} </td>
                         <td>{{$gl_data->debit}} </td>
                         <td>{{$gl_data->Balance}} </td> 
                         </tr>
                          @endforeach
                        </tbody>
                    </table>
                    </div>
                 </div>
                 </div>
              
      
              <!-- Modal to add new model starts-->
              <div class="modal  new-payment-modal fade" id="modals-addslide">
                <div class="modal-dialog modal-xl" style="width: 60%;margin: 10% 0 0 25%;" >
                    <form class="add-Queck-Payment modal-content pt-0 " autocomplete="off" id="form_model" method="post"  enctype="multipart/from-data" > 
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Quick Payment</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="row">
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Full Name</label>
                                  <input type="text"  id="full_name" class="form-control" value=""  placeholder=" " name="full_name" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="transaction_type-column">Transaction Type</label>
                                   <select class="form-control select2 transaction_type"  name="transaction_type">
                                      <option value="1">Sales</option>
                                      <option value="2">Pre Auth</option>
                                      <!-- <option value="3">Tokenize</option> -->
                                      <option value="4">Cash</option>
                                   </select>
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1  col-md-12 col-12">
                                  <label class="form-label" for="phone-column">Phone (optional)</label><br>
                                  <input type=tel maxlength="14" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="phone" class="form-control" value=""  name="phone" style="width:470px;" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Email</label>
                                  <input type="email" id="email" class="form-control" value="" placeholder=" " name="email" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Amount</label>
                                  <input type="number" id="amount" class="form-control" value='' placeholder='0.00' name="amount" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Description (optional)</label>
                                  <input type="text" id="description" class="form-control" value="" placeholder=" " name="description" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Agent</label>
                                  <input type="text" class="form-control" value="{{getUser()->fullname}}"  readonly /> 
                                  <input type="hidden" id="agent" class="form-control agent" value="{{getUser()->id}}" placeholder=" " name="agent" /> 
                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Comment (optional)</label>
                                  <input type="text" id="comment" class="form-control" value="" placeholder="" name="comment" /> 

                                </div>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Send Payment Link</button>
                            <button type="reset" class="btn btn-outline-secondary cancel"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
              <!-- Modal to add new model Ends-->

               <!-- Modal to add new model starts-->
               <div class="modal  new-withdraw-modal fade" id="modals-withdraw">
                <div class="modal-dialog modal-xl" style="width: 60%;margin: 10% 0 0 25%;" >
                    <form class="withdraw-Payment modal-content pt-0 " autocomplete="off" id="form_models" method="post"  enctype="multipart/from-data" > 
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>
                          
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="row">
                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Requested Amount</label>
                                  <input type="text" id="amount_request" class="form-control" value="" name="amount_request" /> 
                                  <input type="hidden" id="amount_value" class="form-control" value="" name="amount_value" /> 
                                   
                                   <input type="hidden" id="current_balance" class="form-control"  name="current_balance" /> 
  
                                </div>
                              </div>

                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Maximum Withdraw Amount</label>
                                  <input type="text" id="maximum_amount" class="form-control" value="{{isset($pending->Balance) ? $pending->Balance : ''}}" name="maximum_amount" readonly/> 
                                   
                                </div>
                              </div>

                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Bank</label>
                                  <select id="bank" name="bank" class="form-select select3">
                                  <!-- <option  value=""></option> -->
                                  @if($get_bank)
                                  @foreach($get_bank as $get_bank)
                                          <option  value="{{$get_bank->id}}">{{$get_bank->bank_name}}</option>
                                        @endforeach
                                        @endif
                              </select>
                                </div>
                              </div>
                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                @if(isset($subscription))
                                @if($subscription->withdrawal_type==2)

                                    <?php $per= '%' ; ?>
                                  <label class="form-label" for="full_name-column">Withdraw Fees</label>
                                  <input type="text" id="withdrawl_fees" class="form-control" value="{{$subscription->withdrawal_amount}}{{$per}}" name="withdrawl_fees" readonly/> 
                                  <input type="hidden" id="withdrawl_select" class="form-control" value="{{$subscription->withdrawal_amount}}" /> 
                                  <input type="hidden" id="withdrawal_type" class="form-control"  name="withdrawal_type"  value="{{$subscription->withdrawal_type}}"  /> 
                                  <input type="hidden" id="total_with" class="form-control"  name="total_with"  value=""  /> 

                                  @elseif($subscription->withdrawal_type==1)
                                 
                                  <label class="form-label" for="full_name-column">Withdraw Fees</label>
                                  <input type="text" id="withdrawl_fees" class="form-control" value="{{$subscription->withdrawal_amount}}" name="withdrawl_fees" readonly/> 
                                  <input type="hidden" id="withdrawl_select" class="form-control" value="{{$subscription->withdrawal_amount}}" /> 
                                  <input type="hidden" id="withdrawal_type" class="form-control"  name="withdrawal_type"  value="{{$subscription->withdrawal_type}}"  /> 
                                  <input type="hidden" id="total_with" class="form-control"  name="total_with"  value=""  /> 

                                  @else

                                  <label class="form-label" for="full_name-column">Withdraw Fees</label>
                                  <input type="text" id="withdrawl_fees" class="form-control" value="{{$subscription->withdrawal_amount}}" name="withdrawl_fees" readonly/> 
                                  <input type="hidden" id="withdrawl_select" class="form-control" value="{{$subscription->withdrawal_amount}}" /> 
                                  <input type="hidden" id="withdrawal_type" class="form-control"  name="withdrawal_type"  value="{{$subscription->withdrawal_type}}"  /> 
                                  <input type="hidden" id="total_with" class="form-control"  name="total_with"  value=""  /> 

                                  @endif
                                  @else

                                  <label class="form-label" for="full_name-column">Withdraw Fees</label>
                                  <input type="text" id="withdrawl_fees" class="form-control" value="{{(isset($subscription->withdrawal_amount) ? $subscription->withdrawal_amount : '')}}" name="withdrawl_fees" readonly/> 
                                  <input type="hidden" id="withdrawl_select" class="form-control" value="{{$subscription->withdrawal_amount}}" /> 
                                  <input type="hidden" id="withdrawal_type" class="form-control"  name="withdrawal_type"  value="{{$subscription->withdrawal_type}}"  /> 
                                  <input type="hidden" id="total_with" class="form-control"  name="total_with"  value=""  /> 

                                @endif
                                </div>
                              </div>
                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="phone-column">Requested Date</label>
                                  <input type="date" id="request_date" class="form-control" value="{{isset($date) ? $date : ''}}" placeholder=" " name="request_date" /> 

                                </div>
                              </div>
                               
                              <div class="col-md-4 col-6">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Withdraw Amount</label>
                                  <input type="text" id="total_withdra" class="form-control" value="" name="total_withdra" readonly/> 
                                   
                                </div>
                              </div>

                            </div>

                            <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Withdraw</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
              <!-- Modal to add new model Ends-->
             
              <!-- medium modal -->
                <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                      <div class="modal-header" style="height: 52px;">
                        <button  type="reset" style="margin-left:90%;margin-top: 14px" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
                        </div>   
                          <div class="modal-body" id="mediumBody">
                            <div class="col-xl-12 col-md-12 col-12">
                              <section class="invoice-add-wrapper prev-invoice">
                                <div class="row invoice-add">
                                  <div class="card invoice-preview-card">
                                    <div class="card-body invoice-padding">

                                      <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div class="col-md-9">
                                        <span class="avatar">
                                        @php $org = org_details() @endphp
                                                  @if(isset($org->org_logo))
                                                  <img
                                                      src="/public/company/logo/{{$org->org_logo}}"
                                                      class="congratulations-img-right"
                                                      alt="card-img-right"
                                                      height="40" 
                                                      width="40"
                                                  />
                                                  @else
                                                    <img class="round" src="{{ asset('/public/company/logo/202210190637logo.jpg') }}" alt="avatar" height="40" width="40">
                                                  @endif</span>&nbsp&nbsp
                                                       <span>
                                                      @php  $user= getUser();  $org= org_details(); @endphp
                                                        <!-- {{( isset($org->org_name) ? $org->org_name : '' )}} -->
                                                        
                                                      </span>
                                                      <br>
                                                      <br>
                                                      <p class="card-text mb-0"> {{(isset($org->org_city) ? $org->org_city : '')}}</p>
                                                          @if(isset($org->org_state))
                                                          @if($org->org_state==1)
                                                          <p class="card-text mb-0"> Abu Dhabi</p>
                                                            @elseif($org->org_state==2)
                                                            <p class="card-text mb-0">Dubai</p>
                                                            @elseif($org->org_state==3)                                     
                                                            <p class="card-text mb-0"> Sharjah</p>
                                                            @elseif($org->org_state==4)                                   
                                                            <p class="card-text mb-0"> Ajman</p>
                                                            @elseif($org->org_state==5)                                     
                                                            <p class="card-text mb-0"> Umm Al Quwain</p>
                                                            @elseif($org->org_state==6)                                      
                                                            <p class="card-text mb-0"> Ras Al Khaimah</p>
                                                            @elseif($org->org_state==7)                                       
                                                            <p class="card-text mb-0"> Fujairah</p>
                                                            @endif
                                                          @else          
                                                            <p class="card-text mb-0"> {{isset($org->org_state) ? $org->org_state : ''}}</p>
                                                          @endif
                                                          <p class="card-text mb-0" > {{(isset($org->countrymaster) ? $org->countrymaster->name : '')}} </p>
                                                          <!-- <p class="card-text mb-0">{{(isset($org->org_phone) ? $org->org_phone : '')}}</p> -->
                                                          <p class="card-text mb-0">{{(isset($org->website) ? $org->website : '' )}}</p>
                                                       <p class="card-text mb-0">{{(isset($org->org_contact_person_number) ? $org->org_contact_person_number : '' )}}</p>
                                          </div>
                                     
                                        <div class="col-md-3">
                                          <div class="d-flex align-items-center mb-1">
                                            <span class="title">Date: {{ now()->toDateString() }}</span>
                                            <!-- <input type="text" class="form-control invoice-edit-input" value="{{ now()->toDateTimeString() }}" readonly/> -->
                                          </div>  
                                        </div>
                                      </div>
                                      <hr class="invoice-spacing" />
                                      <div class="row row-bill-to invoice-spacing" style="padding-top: 5%;"> 
                                        <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
                                          <h6 class="mb-1">Bill To:</h6>
                                          <table>
                                            <tbody>
                                              <tr>
                                                <td class="pe-1">NAME:</td>
                                                <td><strong id="name1"></strong></td>
                                              </tr>
                                              <tr>
                                                <td class="pe-1">EMAIL:</td>
                                                <td id="email1"></td>
                                              </tr> 
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                      <div class="row invoice-sales-total-wrapper" style="padding-top: 5%;">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                          <div class="d-flex align-items-center mb-1">
                                            <label for="agents" class="form-label"><b>Agents:</b></label>
                                            <input type="text" class="form-control ms-50" id="agents" value="" readonly placeholder="Agent Name" />
                                            <input type="hidden" class="form-control ms-50" id="phone_sms" value="" />
                                             <input type="hidden" class="form-control ms-50" id="id_sms" value=""/>
                                          </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                          <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                              <p class="invoice-total-amount"><b>Grand Total: </b><span class="title" id="grand_total"></span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <hr class="invoice-spacing" />
                                      <div class="row invoice-sales-total-wrapper" style="padding-top: 5%;">
                                        <h3 class="mb-1">Link</h3>
                                         <a target="_blank" href="" rel="nofollow"    id="payment_link" style="color: red;"> </a>
                                        <div class="icon-wrapper"  height= 40px; width= 60px; style="margin-top: 3%;"> 
                                       <!-- <a title="Whatsapp" href="https://api.whatsapp.com/send?phone= &text={{isset($get_data->short_link)? $get_data->short_link:''}}" class="btn btn-danger waves-effect">  <i class="fa fa-whatsapp" style="font-size:24px"></i></a> -->

                                          
                                          <a title="Whatsapp" href="" class="btn btn-danger waves-effect" id="my-link"> <i class="fa fa-whatsapp" style="font-size:25px"></i></a>
                                          <a  title="Payment" target="_blank" id="make_payment" href="" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                          <button  title="Message"class="btn btn-danger waves-effect" id="sms_send_data"> <i data-feather='message-square'></i></button>
                                          <a title="Mail" href="javascript:;" id="mail_send_data" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                                        </div>
                                      </div>

                                    </div>  
                                  </div>
                                </div>    
                              </section>
                            </div>

                          </div>
                      </div>
                  </div>
                </div>
            <!--Ends medium modal -->

          </div> 
       </div>  
      
	    <?php   ?>  
       <section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
      <!-- <div class="card-body">  -->  
         </div>
         <div class="modal fade show " id="detais" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content" style="width:90%; margin-left:5%">  
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <label for="" id="status_label" class="label label-lg bg-light-success label-inline"> </label>
                 <span id="transaction_type"> </span> <span id="transaction_referance"> </span>
              </h5>
              
              <!-- <span class="btn btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></span> -->
              <button   type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
             </div>
          <div class="modal-body">
              <ul class="list-group" style="border-radius: 0px">
                  <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_id"></span> : Rental 360</li>
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

                      <div class="col-md-4 col-lg-4 align-items-center text-center mt-5">
                      <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                      <p id="name" class="m-0"> </p>
                      <p id="c_email" class="m-0"> </p>
                      <p id="address" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off"></p>
                      <p id="c_country" class="m-0"> </p> 
                      <p id="c_state" class="m-0"> </p>
                      <br>
                      <p id="refund_p" class=""><b>Refund:</b>
                            <button class="btn btn-danger btn-sm" id="refund_btn"> <i data-feather='minus-square'></i>
                            <input type="hidden" id="hidden_cart_id">
                            <input type="hidden" id="hidden_cart_amount">
                            <input type="hidden" id="hidden_tran_ref">
                            <input type="hidden" id="hidden_id">
                            <input type="hidden" id="hidden_email">
                            <input type="hidden" id="hidden_name">
                            <input type="hidden" id="availables_bal">
                            <input type="hidden" id="hidden_phone">
                            <input type="hidden" id="hidden_currency">
                            <input type="hidden" id="hidden_booking">
                            <input type="hidden" id="hidden_invoice_id">
                            <input type="hidden" id="hidden_total_amount">
                            <input type="hidden" id="hidden_tran_type">

                            </button>
                        </p>
                        <!-- <p id="refunded" class="text-color:danger"><b>Refunded</b>     -->
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
                          <div class="col-md-9 col-lg-9 col-sm-12"></div>
                          <div class="col-md-3 col-lg-3 col-sm-12">
                          <ul class="list-group-custom " style="border-radius: 0px; margin: 21px 0 0 0;">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Sub Total</strong></div>
                                    <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="sub_total"> </span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Discount</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="discount"> </span></div>
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Delivery Charges</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="shipping_charges">  </span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Grand Total</strong></div>
                                        <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="grand_totalsss"> </span></div>
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


<!-- STATEMENT POPUP trans_ref -->

<!--section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
      
      <form class="update-new-vendor modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">            
           
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
                  <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_id"></span> : Rental 360</li>
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
                      <p id="name" class="m-0"> </p>
                      <p id="c_email" class="m-0"> </p>
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
                          <input type="hidden" id="availables_bal" value="">
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
         
  </form>
</section 

<?php  ?>  

<!-- Refund Model-->
<div class="modal fade" id="refund_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund Form</h5>
                <button data-bs-dismiss="modal" class="btn btn btn-primary font-weight-bold btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="r_name" id="r_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="r_phone" id="r_phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="amount">Amount<small style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="r_amount" id="r_amount" placeholder="" />
                        <span class="form-text text-danger" id="r_amount_error"></span>
                    </div>
                    <!-- <div class="col-md-6 mb-4">
                        <label for="amount">Available Balance<small style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="r_balance" id="r_balance" placeholder="" />
                        <span class="form-text text-danger" id="r_amount_error"></span>
                    </div> -->
                    <div class="col-md-6 mb-4">
                        <label for="description">Reason</label>
                        <input type="text" class="form-control" name="r_description" id="r_description" placeholder="" autofocus/>
                        <span class="form-text text-danger" id="r_description_error"></span>
                    </div>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-primary font-weight-bold" id="refund"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Refund</button>
            </div>
        </div>
    </div>
</div>

<!-- ====INVOICEPREVIEW -->
<div class="modal fade show " id="invoicede" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="    width: 63%; margin-left: 20%;">  
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    <label for="" id="status_label_data" class="label label-lg bg-light-success label-inline"> </label>
                    <span id="transaction_type_data"> </span> <span id="transaction_referance_data"> </span>
                    </h5>
                    <button   type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-11 col-md-11 col-12" style="margin-left:6%;">
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
                                        @php $org = org_details() @endphp
                                                  @if(isset($org->org_logo))
                                                  <img
                                                      src="/public/company/logo/{{$org->org_logo}}"
                                                      class="congratulations-img-right"
                                                      alt="card-img-right"
                                                      height="60" 
                                                      width="60"
                                                  />
                                                  <br>
                                                  <br>
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
                                      
                                      <p class="card-text mb-0"> {{(isset($org->org_city) ? $org->org_city : '')}}</p>
                                      @if(isset($org->org_state))
        
                                      @if($org->org_state==1)
                                      <p class="card-text mb-0"> Abu Dhabi</p>
                                        @elseif($org->org_state==2)
                                      
                                        <p class="card-text mb-0">Dubai</p>
                                        @elseif($org->org_state==3)
                                       
                                        <p class="card-text mb-0"> Sharjah</p>
                                        @elseif($org->org_state==4)
                                       
                                        <p class="card-text mb-0"> Ajman</p>
                                        @elseif($org->org_state==5)
                                      
                                        <p class="card-text mb-0"> Umm Al Quwain</p>
                                        @elseif($org->org_state==6)
                                       
                                        <p class="card-text mb-0"> Ras Al Khaimah</p>
                                        @elseif($org->org_state==7)
                                        
                                        <p class="card-text mb-0"> Fujairah</p>
                                        @endif
                                      @else          
                                        <p class="card-text mb-0"> {{isset($org->org_state) ? $org->org_state : ''}}</p>
                                      @endif
                                      <p class="card-text mb-0" > {{(isset($org->countrymaster) ? $org->countrymaster->name : '')}} </p>
                                    
                                      <!-- <p class="card-text mb-0">{{(isset($org->org_phone) ? $org->org_phone : '')}}</p> -->
                                      <p class="card-text mb-0">{{(isset($org->website) ? $org->website : '' )}}</p>
                                      <p class="card-text mb-0">{{(isset($org->org_contact_person_number) ? $org->org_contact_person_number : '' )}}</p>
                                     
                                    </div>
                                    <div class="invoice-number-date mt-md-2 mt-2 col-md-6 field-wraps">
                                      <div class="d-flex align-items-center justify-content-md-end mb-1">
                                        <h4 class="invoice-title">Invoice: </h4>
                                        <div class="input-group input-group-merge invoice-edit-input-group">
                                          
                                          <input type="text" class="form-control invoice_id_data"  value="" readonly />
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-md-end mb-1">
                                        <h4 class="title">Date : </h4>
                                        <div class="input-group input-group-merge invoice-edit-input-group">
                                          <input type="text" class="form-control invoice_date  " value="" readonly/>
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
                                                <td ><p id="name_data"> </p></td>
                                            </tr>
                                            <tr>
                                                <td class="pe-1">ADDRESS:</td>
                                                <td id="address_data"></td>
                                            </tr>
                                            <tr>
                                                <td class="pe-1">PHONE:</td>
                                                <td id="phone1_data"></td>
                                            </tr>
                                            <tr>
                                                <td class="pe-1">EMAIL:</td>
                                                <td id="email1_data"></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body invoice-padding">      
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
                                                    <tbody id="tbody1">

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
                                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="sub_total_data"> </span></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Discount</strong></div>
                                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discount_data"> </span></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Delivery Charges</strong></div>
                                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_charges_data"> </span></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Grand Total</strong></div>
                                                            <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_totalsss_data"> </span></div>
                                                        </div>
                                                    </li>
                                                    </ul>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="card-body invoice-padding">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-3 order-md-1 order-2 mt-md-0 mt-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <label for="agents" class="form-label"><b>Agents:</b></label>
                                                <input type="text" class="form-control col-md-4" id="agents" value=" {{(isset($org->org_name) ? $org->org_name : '')}}" readonly placeholder=" " />
                                             
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
                                        value="" readonly>{{(isset($get_data->note) ? $get_data->note : '')}}</textarea>
                                      </div>
                                    </div>
                                  </div>                   
                                </div>
                              </div>
                            </div>    
                          </section>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ==== -->
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

  <script src="{{ asset('js/scripts/pages/app-payment_transaction-list.js') }}"></script>
  <script src="http://159.223.107.48/js/scripts/pages/account-invoice-list.js"></script>
  <script src="{{ asset('js/scripts/pages/app-payment_payments-list.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-payment_statement-list.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
  <script src="{{ asset('vendors/js/intel/intlTelInput.js') }}"></script>
@endsection

<script>
/* function myFunction() {
  var copyText = document.getElementById('payment_link');
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;


function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
} */
</script>