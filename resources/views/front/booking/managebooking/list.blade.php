@extends('layouts.main') 
<style>
   .card .card-header {
    padding: 0 !important; 
}
.iti {
    width: 100%;
  }
</style>
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'> 
@endsection

@section('content')

 
<div class="card"> 
  <div class="card-body border-bottom">
    <div class="card-header" style="padding: 0px 2rem !important; margin-top: 0.2rem;"> 
      <h4 ><b>Manage Booking</b></h4>
      <a style=" margin-top: 1rem;" href="{{route('add-manage-booking')}}" class="btn btn-danger" >Create Booking</a> 
    </div> 
  <form action="{{route('manage-booking-list')}}"  method="get">  @csrf
    <div class="row">
      <div class="demo-inline-spacing"> 
        <!-- <div class=" col-xl-2 col-md-4 col-2 col-sm-4">
          <select class="form-select " id="dayInput" name="dayInput">
          <option value="1">All Time</option>
          <option  value="2">Today</option>
          <option  value="3">Yesterday</option>
          <option  value="4">Before yesterday</option>
          </select>
        </div>  -->
        <!-- <div class="col-xl-2 col-md-4 col-12 col-sm-6"> -->
            <!-- <div class="input-group">
              <input type="text" name="header_search" class="form-control" placeholder="Search Here">
            </div> -->
        <!-- </div>

        <div class="col-xl-2 col-md-4 col-12 col-sm-6">
          <div class="input-group"> -->
            <!-- <button type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Booking#
            </button> -->
            <!-- <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Booking Type</a>
              <a class="dropdown-item" href="#">Merchant</a>
              <a class="dropdown-item" href="#">Vehicle</a>
            </div> -->
          <!-- </div>
        </div> -->
        <!-- <div class="col-xl-3 col-md-4 col-12 col-sm-6">
            <input type="date" class="form-control" id="fromdate"   name="fromdate"  placeholder="From Date">
        </div>  -->
        <!-- <div class="col-xl-3 col-md-4 col-12 col-sm-6">
            <input type="date" class="form-control" name="todate"  id="todate"  placeholder="To Date">
        </div>   -->
      </div><!-- demo-inline-spacing-end --> 
    </div>
    <!-- <div class="row">
          <div class="text text-center mt-1">
              <button type="submit" class="btn btn-outline-primary text-danger"><b>Filter</b></button>
              <button type="reset" class="btn text-danger"><b>X Clear Filter</b></button>
          </div> 
        </div> -->
  </form>
</div>
 
  

  <div class="card-datatable table-responsive pt-0" > 
    <table class="manage-booking-table table table-sm" width="100%" cellspacing="0">
      <thead class="table-light">
        <tr>   
         
          <th>Booking</th> 
          <th>customer</th>
          <th>Status</th>  
          <th>vehicle</th>
          <th>pickup/drop-off</th> 
          <th>Agent</th> 
          <th>Amount</th> 
          <th>Action</th> 
         
        </tr> 
      </thead> 
    </table>
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
                                <div class="mb-1">
                                  <label class="form-label" for="phone-column">Phone (optional)</label>
                                  <input type="text" maxlength="14" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="phone" class="form-control phone_quick" value=""  name="phone" /> 

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
                                  <input type="number" id="amount" class="form-control" value=''  name="amount" /> 

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
                                  <input type="text" class="form-control" id="agent_name" value=""  readonly /> 
                                  <input type="hidden" id="agent" class="form-control agent" value="" placeholder=" " name="agent" /> 
                                  <input type="hidden" id="booking_ids" class="form-control " value="" name="booking_ids" /> 
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

              <!-- medium modal -->
              <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                        <button  type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>                 
                        </div>   
                          <div class="modal-body" id="mediumBody">
                            <div class="col-xl-12 col-md-12 col-12">
                              <section class="invoice-add-wrapper prev-invoice">
                                <div class="row invoice-add">
                                  <div class="card invoice-preview-card">
                                    <div class="card-body invoice-padding">

                                      <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div class="col-md-9">
                                          <div>
                                            <h3 class="text-danger invoice-logo">BRILLIANT RENT A CAR</h3>
                                          </div>
                                          @php  $user= getUser();  $org= org_details(); @endphp
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
                                          <p class="card-text mb-0">{{(isset($org->org_contact_person_number) ? $org->org_contact_person_number : '' )}}</p>                                    </div>
                                        <div class="col-md-3">
                                          <div class="d-flex align-items-center mb-1">
                                            <span class="title">Date: {{ now()->toDateTimeString() }}</span>
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
                                          <a title="Copy" href="javascript:;"     id="url_copy" class="btn btn-danger waves-effect url_copy">  <i data-feather='copy'></i></a>
                                          <a title="Whatsapp" href="" class="btn btn-danger waves-effect" id="my-link"> <i class="fa fa-whatsapp" style="font-size:25px"></i></a>
                                          <a title="Payment" target="_blank" id="make_payment" href="" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                          <a  title="Message" id="sms_send_data" class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></a>
                                          
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


<div class="modal fade" id="manage" tabindex="-1" aria-hidden="true">   
    <div class="modal-header bg-transparent">
    </div>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33"> Manage Transaction</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div><hr>
      
        <!-- <form action="{{url('/#')}} " method="post">
          {{ csrf_field() }} -->
          <div class="modal-body">
           <input type="hidden" name="mt_getuuid" value="" id="mt_getuuid">
            <label>Enter Transaction number</label>
            <div class="mb-1"> 
                <input type="text" class="form-control" name="tn_number" id="tn_number" placeholder="Adjust Payment">
            </div> 
          </div>
          <div class="modal-footer"> 
            <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="tn_submit" class="btn btn-danger">Submit</button> 
          </div>
        <!-- </form> -->
      </div>
    </div>
  
</div>

  <div class="modal fade" id="manage_invoice" tabindex="-1" aria-hidden="true">   
    <div class="modal-header bg-transparent">
    </div>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33"> Manage Transaction With Invoice</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div><hr>
        <div class="modal-body">
          <input type="hidden" name="mtbooking_uuid" value="" id="mtbooking_uuid">
          <div class="mb-1"> 
            <label>Enter Transaction number</label>
            <div class="mb-1"> 
                <input type="text" class="form-control" name="tn_number" id="tnbooking_number" placeholder="Adjust Payment" >
                <span id="span_error_tn_number" style="color:red"></span>
            </div> 
          </div>  
          <div class="mb-1"> 
            <label>Select Invoice</label>
            <div class="mb-1"> 
                <select type="text" class="form-control" name="invoice_id" id="invoice_idbooking" >
                <option value=""></option>
                  @if(count($invoice_data))
                    @foreach($invoice_data as $invoice_data)
                    <option value="{{$invoice_data->uuid}}">INV000{{$invoice_data->id}} - {{$invoice_data->grand_total}}</option>
                    @endforeach
                  @endif
                </select>  
                <span id="span_error_invoice" style="color:red"></span>
            </div> 
          </div>    
        </div>
        <div class="modal-footer"> 
          <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="tnbooking_submit" class="btn btn-danger">Submit</button> 
        </div>
      </div>
    </div>
  </div>

<div class="modal" id="invoice_preview_popup" tabindex="-1" aria-labelledby="#invoice_preview_popup" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered modal-lg"> 
        <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">  
        
          <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method=""> 
          <div class="card-header">
                <h4 style="font-size: 1.486rem;">Copy Link</h4>
                <button  type="reset" style="float: right; margin-top: -45px;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
                <!-- <a href="" class="text-secondary" style="float: right; margin-top: -45px;" > <i data-feather='x'></i></a> -->
            </div>
            <input type="hidden" id="booking_uuid" name="booking_uuid" value="">
            <input type="hidden" id="mobile" name="mobile" value="">
           
            <hr>   
            <section id="multiple-column-form"> 
               <div class="modal-body">  
                 <!-- <p>
                  <a href="javascript:;" rel="nofollow" id="copy" class="text-secondary">  </a>
                </p>
                <input type="hidden" value="" id="shortlink" name="shortlink">
              </div>  -->
                <a target="_blank" href="" rel="nofollow"    id="payment_link" style="color: red;"> </a>
                <div class="icon-wrapper"  height= 40px; width= 60px; style="margin-top: 3%;">  

              <!-- <div class="card-body">   
                <div class="icon-wrapper"  height= 40px; width= 60px; style="margin-top: 3%;" > --> 
                  <a href="javascript:;" id="url_copy" class="btn btn-danger waves-effect">  <i data-feather='copy'></i></a>
                  <a href="" target="_blank" id="whatsapp" class="btn btn-danger waves-effect">  <i data-feather='message-circle'></i></a>
                  <a target="_blank" href="" class="btn btn-danger waves-effect" id="url_link">  <i data-feather='eye'></i></a>
                  <a href="javascript:;" class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></a>
                  <a href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                </div>
              </div> 
              
            </section>
          </form>  
        </div>  
      </div>
    </div>



@endsection
 
<script>
    var input = document.querySelector("#phone");
      window.intlTelInput(input,({
        preferredCountries: ["ae"],
      }));
      
      
          $('.iti__flag-container').click(function() { 
              var countryCode = $('.iti__selected-flag').attr('title');
              var countryCode = countryCode.replace(/[^0-9]/g,'')
              $('#phone').val("");
              $('#phone').val("+"+countryCode+" "+ $('#phone').val());
          });
      });
  </script>
  
@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
 
@section('page-script')
  {{-- Page js files --}}
<script src="{{ asset('js/scripts/pages/manage-booking-list.js') }}"></script> 
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
<script src="{{ asset('js/scripts/pages/account-invoice-add.js') }}"></script>  
<!-- <script src="{{ asset('js/scripts/pages/app-payment_payments-list.js') }}"></script> -->
<!-- <script src="{{ asset('js/scripts/pages/invoice_popup_part.js') }}"></script>  -->
<script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
   

@endsection
