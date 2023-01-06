@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection


<style>

.color-invoice-custom{
		background-color: #0A0A44 !important;
		color: #cac8c8 !important;
		padding: 0 2rem !important;
	}
	.incoice-custom-border{
		border: 1px solid;
		padding: 1rem 0rem;
	}
	.color-invoice-custom h3, .color-invoice-custom h4{
		color: #cac8c8 !important;
		margin: 0px !important;
		font-size: 12px;
		font-weight: bold;
	}

	.div_view {
		border: 0px !important;
		background-color: #0a0a44 !important;
		color: #fff !important;
	}
	.bg-remove .list-group-item{
		background-color: #fff0 !important;
		color: #ffffff !important;
	}
	.color-white tr td {
		color: #fff !important;
	}
	.color-invoice-custom h4{
		color:#fff !important;
	}
	.color-invoice-custom label{
		color:#fff !important;
	}
	.color-white_custom span, .color-white_custom strong{
		color:#fff !important;
	}
</style>

@section('content') 
<section class="expenses-list"> 
  <!-- list and filter start -->
  <div class="card"> 
      <div class="card-body border-bottom">
        <div class="card-header"> 
          <h4 ><b>Invoice List</b></h4>
          <span class="glyphicon glyphicon-refresh"></span> 
          <a href="{{route('add-invoice')}}" class="btn btn-danger" >Create</a> 
      </div>
      </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="expenses-table table">
        <thead class="table-light table-sm me-3">
          <tr>  
            <th>REF</th>
            <th>NAME</th>
            <th>TYPE</th> 
            <th>PAYMENT METHOD</th> 
            <th>CURRENCY</th> 
            <th>AMOUNT</th> 
            <th>DATE&TIME</th> 
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr> 
        </thead> 
      </table>
    </div>
   
       <div class="modal" id="invoice_preview_popup" tabindex="-1" aria-labelledby="#invoice_preview_popup" aria-hidden="true" >
         <div class="modal-dialog modal-dialog-centered modal-lg"> 
            <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
             <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="">
              <div class="modal-header">
                <h4 style="font-size: 1.486rem;">Copy Link</h4>
                <button  type="reset" style="float: right; margin-top: -45;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
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
                </div> 
                <div class="card-body">  
                  <div class="icon-wrapper"  height= 40px; width= 60px; >   -->
                     <a target="_blank" href="" rel="nofollow"    id="payment_link" style="color: red;"> </a>
                     <div class="icon-wrapper"  height= 40px; width= 60px; style="margin-top: 3%;">  
                    <a title="Copy" href="javascript:;" id="url_copy" class="btn btn-danger waves-effect">  <i data-feather='copy'></i></a>
                    <a title="Whatsapp" href="" target="_blank" id="whatsapp" class="btn btn-danger waves-effect">   <i class="fa fa-whatsapp" style="font-size:24px"></i></a>
                    <a  title="Payment"target="_blank" href="" class="btn btn-danger waves-effect" id="url_link">  <i data-feather='eye'></i></a>
                    <a title="Message" href="javascript:;" class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></a>
                    <a title="Mail" href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
                  </div>
                </div> 
                <!-- <div class="card-footer"> 
                  <button type="reset" class="btn btn-sm btn-outline-danger" style="float:right; margine-top:2%;" data-bs-dismiss="modal">Cancel</button>
                </div>  -->
              </section>
              </form>  
            </div>   
          </div>
        </div>

  
  <!-- list and filter end -->
  </div>

 
    <div class="modal fade show " id="detais" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="width: 63%; margin-left: 20%;">  
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    <label for="" id="status_label" class="label label-lg bg-light-success label-inline"> </label>
                    <span id="transaction_type"> </span> <span id="transaction_referance"> </span>
                    </h5>
                    <button   type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-11 col-md-11 col-12" style="width: 100%;">
                          <section class="invoice-add-wrapper prev-invoice">
                            <div class="row invoice-add incoice-custom-border">
                              <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding color-invoice-custom">
								<div class="col-md-12 text-center">
									<h2 style="color:#fff;text-transform: uppercase; font-size: 40px; margin-top: 1rem;">Invoice</h2>
								</div>
                                  <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div class="col-md-8">
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
                                      <div class="mt-md-0">
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
                                    </div>
									
									
									
									
                                    <div class="invoice-number-date mt-md-2 mt-2 col-md-4 field-wraps">
										<div class="row row-bill-to invoice-spacing">
												<!--h6 class="mb-1">Bill To:</h6-->
												<div class="row align-items-center mb-1">
													<div class="col-md-5 ">
														<h4 class="pe-1">NAME:</h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
														<strong id="name1"> </strong>
													</div>
                                                </div>
													
												<div class="row align-items-center mb-1">
													<div class="col-md-5">
														<h4 class="pe-1">ADDRESS:</h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
														<strong id="address"></strong>
													</div>
												</div>
												
												<div class="row align-items-center mb-1">
												    <div class="col-md-5">
														<h4 class="pe-1">PHONE:</h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
														<strong id="phone1"></strong>
													</div>
												</div>
												
												<div class="row align-items-center mb-1">
												    <div class="col-md-5">
														<h4 class="pe-1">EMAIL:</h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
														<strong id="email1"></strong>
													</div>
												</div>
												
												
												<div class="row align-items-center mb-1">
												     <div class="col-md-5">
													<h4 class="invoice-title">Invoice: </h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
													  <input type="text" class="invoice_id div_view"  value="" readonly />
													</div>
												</div>
												
												<div class="row align-items-center mb-1">
												     <div class="col-md-5">
													<h4 class="title">Date : </h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
													  <input type="text" class="invoice_date div_view" value="" readonly />
													</div>
												</div>
												
												<div class="row align-items-center mb-1">
												     <div class="col-md-5">
													<h4 class="title"><b>Agents:</b></h4>
													</div>
													<div class="col-md-7 input-group-merge invoice-edit-input-group">
													  {{(isset($org->org_name) ? $org->org_name : '')}}
													</div>
												</div>
										</div>
										
										
									  
									  
                                    </div>
									
									
									
                                  </div>
                                </div>
                                
                                <div class="card-body invoice-padding color-invoice-custom">
								
								<hr class="invoice-spacing" />
                                    <div class="row row-bill-to invoice-spacing">
                                        <div class="col-xl-6 p-0 ps-xl-2 mt-xl-0 mt-2">
                                        </div>
                                    </div>
                                    <!-- <div id="bill-to" class="col-md-4 col-lg-4" style="margin:-8% 0% 10% 75%;">
                                        <p id="refund_p" class="sdsd"><b>Refund:</b>
                                            <button class="btn btn-danger btn-sm" id="refund_btn"> <i data-feather='minus-square'></i>
                                            <input type="hidden" id="hidden_cart_id">
                                            <input type="hidden" id="hidden_cart_amount">
                                            <input type="hidden" id="hidden_tran_ref">
                                            <input type="hidden" id="hidden_id">
                                            <input type="hidden" id="hidden_email">
                                            <input type="hidden" id="hidden_name">
                                            <input type="hidden" id="hidden_phone">
                                            <input type="hidden" id="hidden_currency">
                                            <input type="hidden" id="hidden_booking">
                                            <input type="hidden" id="hidden_invoice_id">
                                            <input type="hidden" id="hidden_total_amount">
                                            <input type="hidden" id="hidden_tran_type">
                                            </button>
                                        </p>
                                        <p id="refunded" class="text-color:danger"><b>Refunded</b>   
                                        </p>
                                    </div>  -->
                                </div>
                                <div class="card-body invoice-padding color-invoice-custom">      
                                    <fieldset style="margin: 26px 0 1px -1px;">
                                        <legend>Invoice Items:</legend>
                                        <div class="row" id="table_row">
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <table class="table table-bordered table-sm color-white">
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
                                            <div class="d-flex color-white_custom" id="list_to_hide">
                                                <div class="col-md-8 col-lg-8 col-sm-12"></div>
                                                <div class="col-md-4 col-lg-4 col-sm-12">

                                                        <div class="row align-items-center mt-1 mb-1">
															<div class="col-md-5 col-lg-5 col-sm-5">
															<strong for="">Sub Total</strong>
															</div>
															
                                                            <div class="col-md-7 col-lg-7 col-sm-7">
															<span for="" id="sub_total"> </span>
															</div>
                                                        </div>
                                                    
													
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-5 col-lg-5 col-sm-5">
															<strong for="">Discount</strong>
															</div>
                                                            <div class="col-md-7 col-lg-7 col-sm-7">
															<span for="" id="discount"> </span>
															</div>
                                                        </div>
                                                    
													
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-5 col-lg-5col-sm-5"><strong for="">Delivery Charges</strong></div>
                                                            <div class="col-md-7 col-lg-7 col-sm-7"><span for="" id="shipping_charges"> </span></div>
                                                        </div>
                                                    
													
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-5 col-lg-5 col-sm-5"><strong for="">Grand Total</strong></div>
                                                            <div class="col-md-7 col-lg-7 col-sm-7"><span for="" id="grand_totalsss"> </span></div>
                                                        </div>

                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="card-body invoice-padding color-invoice-custom">
                                    <div class="row invoice-sales-total-wrapper">
                                        <!--div class="col-md-3 order-md-1 order-2 mt-md-0 mt-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <label for="agents" class="form-label"><b>Agents:</b></label>
                                                <input type="text" class="form-control col-md-4" id="agents" value=" {{(isset($org->org_name) ? $org->org_name : '')}}" readonly placeholder=" " />
                                            </div>
                                        </div-->
                                        <!-- <div class="col-md-9 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                            <p class="invoice-total-title">Subtotal:   </p>
                                            </div>
                                            <div class="invoice-total-item">
                                            <p class="invoice-total-title">Discount:   </p>
                                            </div>
                                            <div class="invoice-total-item">
                                            <p class="invoice-total-title">Promotion:   </p>
                                            </div>
                                            <div class="invoice-total-item">
                                            <p class="invoice-total-title">Delivery Charge:  </p>
                                            </div>
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                            <p class="invoice-total-title">Grand Total:  </p>
                                            </div>
                                        </div>
                                       </div> -->
                                    </div>
                                </div>
                                <div class="card-body invoice-padding color-invoice-custom"> 
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="mb-2">
                                        <label for="note" class="form-label fw-bold">Note:</label>
                                        {{(isset($get_data->note) ? $get_data->note : '')}}
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
  <!-- Create Navbar Menu Modal-->
  <div class="modal fade" id="charg_form" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Charge Form</h5>
                <button data-bs-dismiss="modal" class="btn btn btn-primary font-weight-bold btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="amount">Amount<small id="note" style="font-size: 13px" class="text-danger"></small></label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" autofocus/>
                        <span class="form-text text-danger" id="amount_error"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description">Reason</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter Reason" />
                        <span class="form-text text-danger" id="description_error"></span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="">Supporting document</label>
                        <input type="file" class="form-control" name="support_doc" id="support_doc" />
                        <span class="form-text text-danger" id="support_doc_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><span class="svg-icon svg-icon-md fa fa-close"></span> Close</button> -->
                <button type="button" class="btn btn-primary font-weight-bold" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span>&nbsp&nbspCharge Payment</button>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="manage" tabindex="-1" aria-hidden="true">   
    <div class="modal-header bg-transparent">
    </div>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">  
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33"> Manage Transaction</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div><hr>
        <div class="modal-body">
          <input type="hidden" name="mt_getuuid" value="" id="mt_getuuid">
          <input type="hidden" name="mt_getinvoiceuuid" value="" id="mt_getinvoiceuuid">

          <label>Enter Transaction number</label>
          <div class="mb-1">   
              <input type="text" class="form-control" name="tn_number" id="tn_number" placeholder="Adjust Payment">
          </div> 
        </div> 
        <div class="modal-footer"> 
          <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="tn_submit" class="btn btn-danger">Submit</button> 
        </div>
      </div>
    </div>
  </div>

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/account-invoice-list.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection
