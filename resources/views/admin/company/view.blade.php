@extends('layouts.main')
@section('title', '')
 
 
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
   
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 18px;
  }
  
  .switch input {display:none;}
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #737373;
    -webkit-transition: .4s;
    transition: .4s;
     border-radius: 34px;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
  }
  
  input:checked + .slider {
    background-color: #2ab934;
  }
  
  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }
  
  input:checked + .slider:before {
    -webkit-transform: translateX(12px);
    -ms-transform: translateX(12px);
    transform: translateX(33px);
  }
  
  /*------ ADDED CSS ---------*/
  .slider:after
  {
   content:'OFF';
   color: white;
   display: block;
   position: absolute;
   transform: translate(-50%,-50%);
   top: 50%;
   left: 50%;
   font-size: 10px;
   font-family: Verdana, sans-serif;
  }
  
  input:checked + .slider:after
  {  
    content:'ON';
  }
  .avatar .avatar-content .avatar-icon {
    height: 1.5rem !important;
    width: 1.5rem !important;
}

</style>
@section('content')
<section class="app-user-view-account">
 
 <section >
 <div class="col-xl-12 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
        <div class="d-flex align-items-center">
                 @if(isset($orgs_name->org_logo))
                  <div class="avatar me-50">
                    <img src="/company/logo/{{(isset($orgs_name->org_logo) ? $orgs_name->org_logo : '')}}" alt="Avatar" width="38" height="38">
                  </div>
                  @else
                  <div class="avatar me-50">
                      <img src="/company/logo/company.png" alt="Avatar" width="38" height="38"> 
                    </div>
                  @endif
                  <div class="more-info">
                    <h6 class="mb-0">{{(isset($orgs_name->org_name) ? $orgs_name->org_name : '')}}</h6>
                    <p class="mb-0">{{(isset($orgs_name->email) ? $orgs_name->email : '')}}</p>
                  </div>
                </div>
          <div class="d-flex align-items-center">
           
                  <div class="avatar-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 22 22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon" style="color:red;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                  </div>
              <span style="padding-left: 10px;" class="card-text font-small-6 me-5 mb-0" >{{(isset($orgs_name->fullname) ? $orgs_name->fullname : '')}}</span>
            </div>
         </div>
          
         
        <div class="card-body statistics-body">
		<div class="col-12 mt-2 mb-2" style="margin-left: 1.4rem;" bis_skin_checked="1">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon" style="color:#4a4ad8;"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                  </div>
                </div>
                <div class="my-auto">
                  <span class="fw-bolder mb-0">{{$fleet_size}}</span>
                  <p class="card-text font-small-3 mb-0">Fleet Size</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$booking}}</h4>
                  <p class="card-text font-small-3 mb-0">Booked</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="2.4em" height="2.4em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="feather feather-dollar-sign avatar-icon"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                  </div>
                </div> 
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$available}}</h4>
                  <p class="card-text font-small-3 mb-0">Available</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign avatar-icon"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$currency}}</h4>
                  <p class="card-text font-small-3 mb-0">Revenue</p>
                </div>
              </div>
            </div>
          </div>
		  </div>
        </div> 
      </div>
    </div>
</section>
 
<div class="row">
<div class="col-md-8">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
   
      <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-General-tab" data-bs-toggle="pill" data-bs-target="#pills-General" type="button" role="tab" aria-controls="pills-General" aria-selected="true">Basic Info</button>
      </li>
      <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-KYC-tab" data-bs-toggle="pill" data-bs-target="#pills-KYC" type="button" role="tab" aria-controls="pills-KYC" aria-selected="false">KYC</button>
      </li>
      <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-More_Information-tab" data-bs-toggle="pill" data-bs-target="#pills-More_Information" type="button" role="tab" aria-controls="pills-More_Information" aria-selected="false">Bookings</button>
      </li>
    
      <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-fleet-tab" data-bs-toggle="pill" data-bs-target="#pills-fleet" type="button" role="tab" aria-controls="pills-fleet" aria-selected="false">Fleet</button>
      </li>
        <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-Subscription-tab" data-bs-toggle="pill" data-bs-target="#pills-Subscription" type="button" role="tab" aria-controls="pills-Subscription" aria-selected="false">Accounts Statement</button>
      </li>
      <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-Permission-tab" data-bs-toggle="pill" data-bs-target="#pills-Permission" type="button" role="tab" aria-controls="pills-Permission" aria-selected="false">Permission</button>
      </li>
      
    </ul>  
    </div>
    <div class="col-md-4">
    <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect ml-auto" style=" border-radius: 5px; float: right;"> Edit</a>
      
    </div>
    </div>
    
   
  
    <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
  <div class="card-body">
    <form > 
      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-General" role="tabpanel" aria-labelledby="pills-General-tab">
                    <div class="card-header">
                    <h4 style="font-size: 1.486rem;">Basic Info</h4>
                    <!-- <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button> -->
              </div><hr>
    <section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
          <div class="card"> 
            <div class="card-body">
      
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="mb-1">
                <label class="form-label" for="company_name">Company Name</label>
                  <input
                    type="text"
                    id="company_name"
                    class="form-control"
                    value="{{(isset($orgs_name->org_name) ? $orgs_name->org_name : '')}}"
                    name="company_name" 
                    readonly   
                    />
              </div>
            </div>
                                                
        <div class="col-md-6 col-12">
          <div class="mb-1">
            <label class="form-label" for="company_logo">Email</label>
            <input
              type="text"
              id="company_logo" 
              class="form-control"
              value="{{(isset($orgs_name->email) ? $orgs_name->email : '' )}}"
              placeholder="Full Name"
              name="company_logo"
              readonly
                />
          </div>
        </div>

        <div class="col-md-6 col-12">
          <div class="mb-1">
            <label class="form-label" for="first_name">Company Phone</label>
            <input
              type="tel"
              id="first_name"
              class="form-control"
              value="{{(isset($orgs_name->org_phone) ? $orgs_name->org_phone : '')}}"
              name="first_name"   
              readonly
                />
          </div>
        </div>
                                                
      <!-- <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="admin_email">Address</label>
          <input
            type="text"
            id="admin_email"
            class="form-control"
            value="{{(isset($orgs_name->org_street1) ? $orgs_name->org_street1 : '')}}"
            name="admin_email"   
            readonly
                />
        </div>
      </div> -->
  
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="admin_phone">Office Address</label>
          <input
            type="text"
            id="admin_phone"
            class="form-control"
            value="{{(isset($orgs_name->org_city) ? $orgs_name->org_city : '')}}"
            name="admin_phone"
            readonly
              />
        </div>
      </div>
    <div class="col-md-6 col-12">
      <div class="mb-1 mt-1">
        <label class="form-label" for="password">Country  </label>
        <input
          type="text"
          class="form-control"
          value="{{(isset($orgs_name->name) ? $orgs_name->name : '')}}"
          name="country" 
          id="country"  
          readonly
            /> 
      </div>
    </div>
                                                
    <div class="col-md-6 col-12">
      <div class="mb-1 mt-1">
      <label class="form-label" for="confirm_password">Emirates</label>
      @if(isset($orgs_name->org_state))
        
       @if($orgs_name->org_state==1)
        <input  type="text" class="form-control" value="Abu Dhabi"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==2)
        <input  type="text" class="form-control" value="Dubai"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==3)
        <input  type="text" class="form-control" value="Sharjah"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==4)
        <input  type="text" class="form-control" value="Ajman"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==5)
        <input  type="text" class="form-control" value="Umm Al Quwain"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==6)
        <input  type="text" class="form-control" value="Ras Al Khaimah"  name="country" id="country" readonly   />
        @elseif($orgs_name->org_state==7)
        <input  type="text" class="form-control" value="Fujairah"  name="country" id="country" readonly   />
        @endif
        @else
        <input  type="text" class="form-control" value="{{isset($orgs_name->org_state) ? $orgs_name->org_state : ''}}"  name="country" id="country" readonly   />
        @endif
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="mb-1">
        <label class="form-label" for="website">Zip</label>
        <input
          type="text"
          id="website"
          class="form-control"
          value="{{(isset($orgs_name->org_postal) ? $orgs_name->org_postal : '')}}"
          name="website"   
          readonly  />
      </div>
    </div>
                                                
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="designation">Company Profile</label>
          @if(isset($orgs_name->company_profile))
          <input type="text" id="designation"  class="form-control" value="{{($orgs_name->company_profile == '1' ? 'Tokenise' : ($orgs_name->company_profile == '2' ? 'Normal' : ''))}}"  name="designation"   readonly  />
          @else
          <input type="text" id="designation"  class="form-control" value= ""  name="designation"   readonly  />
          @endif
        </div>
      </div>
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="gener_city">Brander Pay Page</label>
          @if(isset($orgs_name->branded_pay_1))
          <input  type="text"  id="gener_city" class="form-control"  value="{{($orgs_name->branded_pay_1 == '1' ? 'checked' : ($orgs_name->branded_pay_1 == '0' ? 'unchecked' : ''))}}"  name="gener_city" readonly />
          @else
          <input  type="text"  id="gener_city" class="form-control"  value=""  name="gener_city" readonly />
          @endif
        </div>
      </div>
                                                
    <div class="col-md-6 col-12">
      <div class="mb-1">
        <label class="form-label" for="gener_country">Branded Email</label>
        @if(isset($orgs_name->branded_pay_1))
        <input type="text"  id="gener_state" class="form-control"  value="{{($orgs_name->branded_pay_2 == '1' ? 'checked' : ($orgs_name->branded_pay_2 == '0' ? 'unchecked' : ''))}}"   name="gener_state"  readonly/>
        @else
        <input type="text"  id="gener_state" class="form-control"  value=""   name="gener_state"  readonly/>
        @endif
      </div>
    </div>


    <div class="col-md-6 col-12">
      <div class="mb-1">
        <label class="form-label" for="gener_state">Withdraw Limit [in Days]</label>
        <input  type="text" id="gener_state" class="form-control"  value="{{(isset($orgs_name->withdraw_limit) ? $orgs_name->withdraw_limit : '')}}" name="gener_state"  readonly  />
      </div>
    </div> 
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="gener_zip">Api Callback</label>
          <input type="text" id="api_key" class="form-control"  value="{{(isset($company->moreInfo->api_key) ? $company->moreInfo->api_key : '')}}" name="api_key" readonly />
        </div>
      </div>  
    </div>

  </div>
</div>
</div>
</div>
</section>  
                                       
    <section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
          <div class="card"> 
          <div class="card-header">
           <h4 style="font-size: 1.486rem;">Subscription</h4>
          </div>
  <div class="card-body">
  
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="mb-1">
        <label class="form-label" for="cars">Active Plan</label>
        <!-- <input type="text"  id="active_plan"  class="form-control" value="{{(isset($plans->plan_name) ? $plans->plan_name : '')}}"
            name="active_plan"  readonly /> -->
            <select class="form-select" id="billing_plan" name="billing_plan" disabled>
              @foreach($plans as $plan)
              <option {{$company->subscription->billing_plan == $plan->id ? 'selected' : ''}} value="{{$plan->id}}">{{$plan->plan_name}}</option> 
              @endforeach
          </select>
        </div>
      </div>
       
    
    <!-- <div class="col-md-6 col-12">
      <div class="mb-1">
        <label class="form-label" for="company_logo">Visa/Master Card Service Fee</label>
        @if(isset($orgs_name->payment_gateway))
        <input  type="text"  id="company_logo"  class="form-control" value="{{($orgs_name->payment_gateway == '1' ? 'Visa/Master' : ($orgs_name->payment_gateway == '2' ? 'Amex' : ($orgs_name->payment_gateway == '3' ? 'Binance Pay' : ($orgs_name->payment_gateway == '4' ? 'Spotii' : ($orgs_name->payment_gateway == '5' ? 'Tabby' : '')))))}}"  name="company_logo"  readonly />
        @else
        <input  type="text"  id="company_logo"  class="form-control" value=""  name="company_logo"  readonly />
        @endif 
      </div>
    </div> -->

  <!-- <div class="col-md-6 col-12">
    <div class="mb-1">
      <label class="form-label" for="first_name">American Express Service Fee</label>
      <input
        type="tel"
        id="first_name"
        class="form-control"
        value=""
        name="first_name"   
        readonly
          />
    </div>
  </div> -->
                                                
    <!-- <div class="col-md-6 col-12">
      <div class="mb-1">
        <label class="form-label" for="last_name">Fixed Cost</label>
        <input
          type="tel"
          id="last_name"
          class="form-control"
          value=""
          name="last_name"
          readonly
              />
      </div>
    </div> -->
      <div class="col-md-6 col-12">
        <div class="mb-1"> 
          <label class="form-label" for="last_name">Withdraw Fee</label>
          <input type="tel"  id="last_name"  class="form-control" value="{{(isset($orgs_name->withdrawal_amount) ? $orgs_name->withdrawal_amount : '')}}"  name="last_name"  readonly  />
        </div>
      </div>
      
    </div>

  </div>
</div>
</div>
</div>
</section>  

</div>

	<div class="tab-pane fade" id="pills-KYC" role="tabpanel" aria-labelledby="pills-KYC-tab">
	<h4 class="card-title ">KYC</h4>
    <hr>
    <p style="margin-left: 1rem;">Bank Details  : (Optional)</p>
	<section id="multiple-column-form">
    <div class="row">
      <div class="col-12">
        <div class="card"> 
          <div class="card-body"> 
            
  <div class="col-md-12 col-lg-12 mb-4">
      <table class="table table-bordered table-sm">
          <thead>
              <tr>
                  <th width="5%">Id</th>
                  <th>Bank Name</th>
                  <th>BIC/SWIFT</th>
                  <th>Account Name</th>
                  <th>Account no.</th>
                  <th>IBAN</th>
                  <th>Currency</th>
                  <th>Status</th>
                  <th>Action</th>
                 
              </tr>
          </thead>
      <tbody id="tbody">
      <input type="hidden" id="row_count" value="{{count($company->banks)}}">
          @foreach($company->banks as $key => $bank)
          
          <tr id="row_{{$bank->id}}">
                <td>{{$key+1}}<input type="hidden" name="d_id[]" value="{{$key+1}}"></td>
                <td>{{$bank->bank_name}}<input type="hidden" name="d_bank_name[]" value="{{$bank->bank_name}}"></td>
                <td>{{$bank->bic_code}}<input type="hidden" name="d_bic[]" value="{{$bank->bic_code}}"></td>
                <td>{{$bank->account_name}}<input type="hidden" name="d_account_name[]" value="{{$bank->account_name}}"></td>
                <td>{{$bank->account_no}}<input type="hidden" name="d_account_no[]" value="{{$bank->account_no}}"></td>
                <td>{{$bank->iban_code}}<input type="hidden" name="d_iban[]" value="{{$bank->iban_code}}"></td>
                <td>{{$bank->currency_id}}<input type="hidden" name="d_currency[]" value="{{$bank->currency_id}}"></td>
                <td>
                  @if($bank->status == 0)
                  <label class="label label-lg label-light-success label-inline">Pending</label> <input type="hidden" name="d_status[]" value="0"> 

                  @elseif($bank->status == 1)
                  <label class="label label-lg label-light-success label-inline">Accepted</label> <input type="hidden" name="d_status[]" value="1"> 

                  @else
                  <label class="label label-lg label-light-success label-inline">Rejected</label> <input type="hidden" name="d_status[]" value="2">
                  @endif
                </td>
                 <td>
                
                  @if($bank->status == 0)
                  <div class="text-nowrap">
                  <button value="{{$company->banks[$key]->id}}" bank="1" id="bank_check_approved" type="button" class="btn bank_check " style="color: #18b220;">
                   <i data-feather="check" style="width: 25px; height: 40px;"></i>
                  </button>
                  <button value="{{$company->banks[$key]->id}}" bank="2" id="bank_check_reject" type="button" class="btn mr-4 bank_check " style="color:#fa0707;"> 
                   <i data-feather="x" style="width: 25px; height: 40px;"></i>
                  </button>
                  </div>
                  @elseif($bank->status == 1)
                    <button type="button" id="bank_appr_id" class="btn mr-4"  style="color:#18b220;  ">Approved</button>
                   @elseif($bank->status == 2)
                    <button type="button" id="bank_rejec_id" class="btn mr-4" style="color:#fa0707; ">Rejected</button>
                   @endif
                  </td>
                  
            </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
<!-- list and filter end -->
</section> 
                                       
<section class="app-user-list">
<!-- list and filter start -->
 <!-- start master password submit -->

 <!-- This modal is used for owner document approve process. -->
  <div class="modal fade" id="ow_approve_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33"> Master Password</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">

            <div class="row mb-1">
            <div class="col-4">
             <input class="form-check-input" type="checkbox" id="ow_check">
              <label for="inlineCheckbox1">Non Expiry</label>
              </div>
  
             <div class="col-4 dates"> 
             <label>Expiry Date</label>                                      
              <input type="date" id='ow_date_input' name="trip-start"  value="" class="form-control click_date">
              <span class="form-text text-danger fw-bold" id="ow_date_input_error"></span>
             </div>
           
             </div>  

             <label>Enter Master Password</label>
              <div class="mb-1"> 
                  <input type="text" class="form-control" name="ow_master_password" id="ow_master_password" value="" placeholder="Password">
                  <span class="form-text text-danger fw-bold" id="ow_master_password_error"></span>
                  <input type="hidden" id="get_helper_password" value="<?php echo MasterPassword() ?>"></input>
              </div> 
            </div> 
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ow_appr_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for owner document approve process end here. -->

  <!-- This modal is used for business document approve process. -->
  <div class="modal fade" id="bu_approve_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33"> Master Password</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">

            <div class="row mb-1">
            <div class="col-4">
             <input class="form-check-input" type="checkbox" id="bu_check">
              <label for="inlineCheckbox1">Non Expiry</label>
              </div>
  
             <div class="col-4 dates"> 
             <label>Expiry Date</label>                                      
              <input type="date" id='bu_date_input' name="trip-start"  value="" class="form-control click_date">
              <span class="form-text text-danger fw-bold" id="bu_date_input_error"></span>
             </div>
           
             </div>  

             <label>Enter Master Password</label>
              <div class="mb-1"> 
                  <input type="text" class="form-control" name="bu_master_password" id="bu_master_password" value="" placeholder="Password">
                  <span class="form-text text-danger fw-bold" id="bu_master_password_error"></span>
                  <input type="hidden" id="get_helper_password" value="<?php echo MasterPassword() ?>"></input>
              </div> 
            </div> 
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="bu_appr_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for business document approve process end here. -->


  <!-- This modal is used for other document approve process. -->
  <div class="modal fade" id="ot_approve_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33"> Master Password</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">

            <div class="row mb-1">
            <div class="col-4">
             <input class="form-check-input" type="checkbox" id="ot_check">
              <label for="inlineCheckbox1">Non Expiry</label>
              </div>
  
             <div class="col-4 dates"> 
             <label>Expiry Date</label>                                      
              <input type="date" id='ot_date_input' name="ot_date_input"  value="" class="form-control click_date">
              <span class="form-text text-danger fw-bold" id="ot_date_input_error"></span>
             </div>
           
             </div>  

             <label>Enter Master Password</label>
              <div class="mb-1"> 
                  <input type="text" class="form-control" name="ot_master_password" id="ot_master_password" value="" placeholder="Password">
                  <span class="form-text text-danger fw-bold" id="ot_master_password_error"></span>
                  <input type="hidden" id="get_helper_password" value="<?php echo MasterPassword() ?>"></input>
              </div> 
            </div> 
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ot_appr_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for other document approve process end here. -->

  <!-- This modal is used for Bank approve process. -->
  <div class="modal fade" id="ban_approve_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33"> Master Password</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">

            <div class="row mb-1">
            <div class="col-4">
             <input class="form-check-input" type="checkbox" id="ban_check">
              <label for="inlineCheckbox1">Non Expiry</label>
              </div>
  
             <div class="col-4 dates"> 
             <label>Expiry Date</label>                                      
              <input type="date" id='ban_date_input' name="ban_date_input"  value="" class="form-control click_date">
              <span class="form-text text-danger fw-bold" id="ban_date_input_error"></span>
             </div>
           
             </div>  

             <label>Enter Master Password</label>
              <div class="mb-1"> 
                  <input type="text" class="form-control" name="ban_master_password" id="ban_master_password" value="" placeholder="Password">
                  <span class="form-text text-danger fw-bold" id="ban_master_password_error"></span>
                  <input type="hidden" id="get_helper_password" value="<?php echo MasterPassword() ?>"></input>
              </div> 
            </div> 
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ban_appr_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for Bank approve process end here. -->


 <!-- end master password submit -->


  <!-- start reject reason submit -->

  <!-- Modal is used for owner document when you click on wrong button start here. -->
  <div class="modal fade" id="ow_reject_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Reason</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">
             <label>Enter Reason</label>
              <div class="mb-1"> 
                  <textarea type="text" class="form-control" name="ow_reason" id="ow_reason" value="" placeholder="text"></textarea>
                  
              </div> 
            </div>   
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ow_reason_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for owner document when you click on wrong button end here. -->

  <!-- Modal is used for business document when you click on wrong button start here. -->
  <div class="modal fade" id="bu_reject_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Reason</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">
             <label>Enter Reason</label>
              <div class="mb-1"> 
                  <textarea type="text" class="form-control" name="bu_reason" id="bu_reason" value="" placeholder="text"></textarea>
                  
              </div> 
            </div>   
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="bu_reason_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for business document when you click on wrong button end here. -->

  <!-- Modal is used for other document when you click on wrong button start here. -->
  <div class="modal fade" id="ot_reject_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Reason</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">
             <label>Enter Reason</label>
              <div class="mb-1"> 
                  <textarea type="text" class="form-control" name="ot_reason" id="ot_reason" value="" placeholder="text"></textarea>
                  
              </div> 
            </div>   
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ot_reason_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for other document when you click on wrong button end here. -->

  <!-- Modal is used for Bank when you click on wrong button start here. -->
  <div class="modal fade" id="ban_reject_modal" tabindex="-1" aria-hidden="true">   
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Reason</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
         
            <div class="modal-body">
             <label>Enter Reason</label>
              <div class="mb-1"> 
                  <textarea type="text" class="form-control" name="ban_reason" id="ban_reason" value="" placeholder="text"></textarea>
                  
              </div> 
            </div>   
            <div class="modal-footer"> 
              <!-- <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button> -->
              <button type="button" id="ban_reason_submit" class="btn btn-danger">Submit</button> 
            </div>
        
        </div>
      </div>
    
  </div>
  <!-- Modal is used for Bank when you click on wrong button end here. -->


 <!-- end reject reason submit -->
 <div class="col-md-12 px-1">
<h4 style="font-size: 1.486rem;" class="mb-1">Document</h4>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Owner Documents</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bussiness Documents</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Others</button>
    </li>
  </ul>   
  </div>
                                            
   <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> 
     <section id="multiple-column-form">
      <div class="row">
       <div class="col-12">
        <div class="card"> 
         <div class="card-body">

    @if($company->kycDetail->ow_document1 || $company->kycDetail->ow_document2 || $company->kycDetail->ow_document3 || $company->kycDetail->ow_document4) 
    <div class="">
      <table class="table table-bordered table-sm text-center">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>File</th>
                <th>Type</th>
                <th>Actions</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody id="doc_body1">
        @if($company->kycDetail->ow_document1)
          <tr>
            <td>
            <a href="/public/company/docs/{{$company->kycDetail->ow_document1}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ow_document1}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>
           </td>
            <td>
              {{$company->kycDetail->ow_document1}}
            </td>
            <td>
          @if($company->kycDetail->ow_doc_type1 == 1)
              <span>Passport ID</span>
          @elseif($company->kycDetail->ow_doc_type1 == 2)
              <span>Resident ID - Front</span>
          @elseif($company->kycDetail->ow_doc_type1 == 3)
              <span>Resident ID - Back</span>
          @elseif($company->kycDetail->ow_doc_type1 == 4)
              <span>Other</span>
          @endif
            </td>

          <td nowrap="nowrap">
          @if(isset($doc123))
            
          @if($doc123->ow_doc_type1_status==1)
            <button id="pasitive" type="button" class="btn mr-4 open"  style="color:#18b220;">Approved</button>
          @elseif($doc123->ow_doc_type1_status==2) 
            <button id="negative" type="button" class="btn mr-4 open1" style="color:#fa0707; ">Rejected</button>
          @else
          <button value="1"  data="{{$company->id}}" data-id="1"  name="approved" id="approved" type="button" class="btn yes close" style="color: #18b220;">
             <i data-feather="check" style="width: 25px; height: 40px;"></i></button>
              
            <button value="1" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes close1" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;" ></i></button>
          @endif

          @else
            <button value="1" data="{{$company->id}}" data-id="1" name="approved" id="approved" type="button" class="btn yes close" style="color: #18b220;">
             <i data-feather="check" style="width: 25px; height: 40px;"></i></button>
              
            <button value="1" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes close1" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
 
          @endif
            </td>
            <td>
             @if($doc1->ow_doc_type1_status==1)
             @if($doc1->ow_doc_type1_expiry_date=="0000-00-00")
          <p>N/A</p>
          @else
              <p>{{isset($doc1->ow_doc_type1_expiry_date) ? $doc1->ow_doc_type1_expiry_date : ''}}</p>
              @endif
              @endif
              </td>
           </tr>
          @endif

      @if($company->kycDetail->ow_document2)
      <tr>
          <td>
          <a href="/public/company/docs/{{$company->kycDetail->ow_document2}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ow_document2}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

          </td>
          <td>
            {{$company->kycDetail->ow_document2}}
          </td>
          <td>
          @if($company->kycDetail->ow_doc_type2 == 1)
            <span>Passport ID</span>
          @elseif($company->kycDetail->ow_doc_type2 == 2)
            <span>Resident ID - Front</span>
          @elseif($company->kycDetail->ow_doc_type2 == 3)
            <span>Resident ID - Back</span>
          @elseif($company->kycDetail->ow_doc_type2 == 4)
            <span>Other</span>
          @endif
          </td>
          <td nowrap="nowrap">
        @if(isset($doc123))
           
          @if($doc123->ow_doc_type2_status==1)
           <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
          @elseif($doc123->ow_doc_type2_status==2) 
           <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
          @else
            <button value="2" data="{{$company->id}}" data-id="1" name="approved" id="approved" type="button" class="btn yes" style="color: #18b220;" >
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
             <button value="2" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
          @endif

        @else
        <button value="2" data="{{$company->id}}" data-id="1" name="approved" id="approved" type="button" class="btn yes" style="color: #18b220;" >
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
              <button value="2" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
              
        @endif
        <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
          </td>
          <td>
          @if($doc1->ow_doc_type2_status==1)
          @if($doc1->ow_doc_type2_expiry_date=="0000-00-00")
          <p>N/A</p>
          @else
              <p>{{isset($doc1->ow_doc_type2_expiry_date) ? $doc1->ow_doc_type2_expiry_date : ''}}</p>
              @endif
              @endif
              </td>
      </tr>
      @endif
                                                                  
    @if($company->kycDetail->ow_document3)
    <tr>
        <td>
        <a href="/public/company/docs/{{$company->kycDetail->ow_document3}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ow_document3}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

        </td>
        <td>
          {{$company->kycDetail->ow_document3}}
        </td>
        <td>
        @if($company->kycDetail->ow_doc_type3 == 1)
          <span>Passport ID</span>
        @elseif($company->kycDetail->ow_doc_type3 == 2)
          <span>Resident ID - Front</span>
        @elseif($company->kycDetail->ow_doc_type3 == 3)
          <span>Resident ID - Back</span>
        @elseif($company->kycDetail->ow_doc_type3 == 4)
          <span>Other</span>
        @endif
        </td>
        <td nowrap="nowrap">
        @if(isset($doc123))
        
        @if($doc123->ow_doc_type3_status==1)
          <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
        @elseif($doc123->ow_doc_type3_status==2) 
          <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
        @else
        <button value="3" data="{{$company->id}}" data-id="1" name="approved" type="button" id="approved" class="btn yes" style="color: #18b220;">
          <i data-feather="check" style="width: 25px; height: 40px;" ></i></button>
            
           <button value="3" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif

        @else
          <button value="3" data="{{$company->id}}" data-id="1" name="approved" id="approved"  type="button" class="btn yes" style="color: #18b220;" >
          <i data-feather="check" style="width: 25px; height: 40px;"></i></button>
            
           <button value="3" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
            
        @endif
        <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
        </td>
        <td>
        @if($doc1->ow_doc_type3_status==1)
        @if($doc1->ow_doc_type3_expiry_date=="0000-00-00")
          <p>N/A</p>
          @else
              <p>{{isset($doc1->ow_doc_type3_expiry_date) ? $doc1->ow_doc_type3_expiry_date : ''}}</p>
              @endif
              @endif
              </td>
    </tr>
    @endif

      @if($company->kycDetail->ow_document4)
      <tr>
         <td>
          <a href="/public/company/docs/{{$company->kycDetail->ow_document4}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ow_document4}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

          </td>
          <td>
            {{$company->kycDetail->ow_document4}}
          </td>
          <td>
          @if($company->kycDetail->ow_doc_type4 == 1)
            <span>Passport ID</span>
          @elseif($company->kycDetail->ow_doc_type4 == 2)
            <span>Resident ID - Front</span>
          @elseif($company->kycDetail->ow_doc_type4 == 3)
            <span>Resident ID - Back</span>
          @elseif($company->kycDetail->ow_doc_type4 == 4)
            <span>Other</span>
          @endif
          </td>
          <td nowrap="nowrap">
          @if(isset($doc123))
          
          @if($doc123->ow_doc_type4_status==1)
            <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
          @elseif($doc123->ow_doc_type4_status==2) 
            <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
          @else
          <button value="4" data="{{$company->id}}" data-id="1" name="approved" id="approved" type="button" class="btn yes" style="color: #18b220;" >
         <i data-feather="check" style="width: 25px; height: 40px;" ></i></button>
         <button value="4" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
          @endif

      @else
        <button value="4" data="{{$company->id}}" data-id="1" name="approved" id="approved"  type="button" class="btn yes appr" style="color: #18b220;" >
         <i data-feather="check" style="width: 25px; height: 40px;" ></i></button>
            
         <button value="4" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 yes recj" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
 
      @endif
      <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
          </td>
          <td>
          @if($doc1->ow_doc_type4_status==1)
         
          @if($doc1->ow_doc_type4_expiry_date=="0000-00-00")
          <p>N/A</p>
          @else
          <p>{{isset($doc1->ow_doc_type4_expiry_date) ? $doc1->ow_doc_type4_expiry_date : ''}}</p>
          @endif
          
        @endif  
        </td>
      </tr>
      @endif
     </tbody>
    </table>
   </div>
  @endif
  </div>
  </div>
  </div>
  </div> 
  </section> 
  </div>

    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

    <section id="multiple-column-form">
    <div class="row">
    <div class="col-12">
    <div class="card"> 
    <div class="card-body">

    @if($company->kycDetail->bu_document1 || $company->kycDetail->bu_document2 || $company->kycDetail->bu_document3 || $company->kycDetail->bu_document4) 
    <div class="">
    <table class="table table-bordered text-center bd">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>File</th>
        <th>Type</th>
        <th>Action</th>
        <th>Expiry Date</th>
    </tr>
    </thead>
    <tbody id="doc_body2">
    @if($company->kycDetail->bu_document1)
    <tr>
      <td>
      <a href="/public/company/docs/{{$company->kycDetail->bu_document1}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->bu_document1}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

      </td>
      <td>
        {{$company->kycDetail->bu_document1}}
      </td>
      <td>
      @if($company->kycDetail->bu_doc_type1 == 1)
        <span>License</span>
      @elseif($company->kycDetail->bu_doc_type1 == 2)
        <span>MoA</span>
      @elseif($company->kycDetail->bu_doc_type1 == 3)
        <span>Share certificate</span>
      @elseif($company->kycDetail->bu_doc_type1 == 4)
        <span>Tax Certificate</span>
      @elseif($company->kycDetail->bu_doc_type1 == 5)
        <span>Proof of Bank Account</span>
      @endif
      </td>
      <td nowrap="nowrap">
      @if(isset($doc123))

      @if($doc123->bu_doc_type1_status==1)
      <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
      @elseif($doc123->bu_doc_type1_status==2)
       <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
      @else
       <button type="button" value="{{$company->kycDetail->bu_doc_type1}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;" >
            <i data-feather="check" style="width: 25px; height: 40px;" ></i>
          </button>
          
          <button value="{{$company->kycDetail->bu_doc_type1}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif

      @else
        <button type="button" value="{{$company->kycDetail->bu_doc_type1}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;" >
            <i data-feather="check" style="width: 25px; height: 40px;" ></i>
          </button>
          
          <button value="{{$company->kycDetail->bu_doc_type1}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif
      <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
      </td>
      <td>
      @if($doc1->bu_doc_type1_status==1)
         
         @if($doc1->bu_doc_type1_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->bu_doc_type1_expiry_date) ? $doc1->bu_doc_type1_expiry_date : ''}}</p>
         @endif
         
       @endif 
      </td> 
    </tr>
    @endif

    @if($company->kycDetail->bu_document2)
    <tr>
    <td>
    <a href="/public/company/docs/{{$company->kycDetail->bu_document2}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->bu_document2}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

    </td>
    <td>
      {{$company->kycDetail->bu_document2}}
    </td>
    <td>
    @if($company->kycDetail->bu_doc_type2 == 1)
      <span>License</span>
    @elseif($company->kycDetail->bu_doc_type2 == 2)
      <span>MoA</span>
    @elseif($company->kycDetail->bu_doc_type2 == 3)
      <span>Share certificate</span>
    @elseif($company->kycDetail->bu_doc_type2 == 4)
      <span>Tax Certificate</span>
    @elseif($company->kycDetail->bu_doc_type2 == 5)
      <span>Proof of Bank Account</span>
    @endif
    </td>
    <td nowrap="nowrap">
    @if(isset($doc123))
      
    @if($doc123->bu_doc_type2_status==1)
      <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
    @elseif($doc123->bu_doc_type2_status==2)
      <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707;  ">Rejected</button>
    @else
      <button type="button" value="{{$company->kycDetail->bu_doc_type2}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
          <i data-feather="check" style="width: 25px; height: 40px;"></i>
        </button>
        
        <button value="{{$company->kycDetail->bu_doc_type2}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
    @endif

    @else
       <button type="button" value="{{$company->kycDetail->bu_doc_type2}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
          <i data-feather="check" style="width: 25px; height: 40px;"></i>
        </button>
        
        <button value="{{$company->kycDetail->bu_doc_type2}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
    @endif
    <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
    </td>
    <td>
    @if($doc1->bu_doc_type2_status==1)
         
         @if($doc1->bu_doc_type2_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->bu_doc_type2_expiry_date) ? $doc1->bu_doc_type2_expiry_date : ''}}</p>
         @endif
         
       @endif 
       </td> 
    </tr>
    @endif

  @if($company->kycDetail->bu_document3)
  <tr>
      <td>
      <a href="/public/company/docs/{{$company->kycDetail->bu_document3}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->bu_document3}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

      </td>
      <td>
        {{$company->kycDetail->bu_document3}}
      </td>
      <td>
      @if($company->kycDetail->bu_doc_type3 == 1)
        <span>License</span>
      @elseif($company->kycDetail->bu_doc_type3 == 2)
        <span>MoA</span>
      @elseif($company->kycDetail->bu_doc_type3 == 3)
        <span>Share certificate</span>
      @elseif($company->kycDetail->bu_doc_type3 == 4)
        <span>Tax Certificate</span>
      @elseif($company->kycDetail->bu_doc_type3 == 4)
        <span>Proof of Bank Account</span>
      @endif
      </td>
      <td nowrap="nowrap">
      @if(isset($doc123))
        
      @if($doc123->bu_doc_type3_status==1)
      <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
      @elseif($doc123->bu_doc_type3_status==2)
      <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
      @else
         <button type="button" value="{{$company->kycDetail->bu_doc_type3}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
          
          <button value="{{$company->kycDetail->bu_doc_type3}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif

      @else
        <button type="button" value="{{$company->kycDetail->bu_doc_type3}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
          
          <button value="{{$company->kycDetail->bu_doc_type3}}" data="{{$company->id}}" data-id="2" name="reject" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif
      <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
      </td>
      <td>
      @if($doc1->bu_doc_type3_status==1)
         
         @if($doc1->bu_doc_type3_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->bu_doc_type3_expiry_date) ? $doc1->bu_doc_type3_expiry_date : ''}}</p>
         @endif
         
       @endif  
       </td>
  </tr>
  @endif

      @if($company->kycDetail->bu_document4)
      <tr>
          <td>
          <a href="/public/company/docs/{{$company->kycDetail->bu_document4}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->bu_document4}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

          </td>
          <td>
            {{$company->kycDetail->bu_document4}}
          </td>
          <td>
          @if($company->kycDetail->bu_doc_type4 == 1)
            <span>License</span>
          @elseif($company->kycDetail->bu_doc_type4 == 2)
            <span>MoA</span>
          @elseif($company->kycDetail->bu_doc_type4 == 3)
            <span>Share certificate</span>
          @elseif($company->kycDetail->bu_doc_type4 == 4)
            <span>Tax Certificate</span>
          @elseif($company->kycDetail->bu_doc_type4 == 4)
            <span>Proof of Bank Account</span>
          @endif
          </td>
          <td nowrap="nowrap">
          @if(isset($doc123))
              
          @if($doc123->bu_doc_type4_status==1)
          <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
          @elseif($doc123->bu_doc_type4_status==2)
           <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
           @else
           <button type="button" value="{{$company->kycDetail->bu_doc_type4}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
              <button value="{{$company->kycDetail->bu_doc_type4}}" name="reject" data="{{$company->id}}" data-id="2" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>

          @endif
          
          @else
            <button type="button" value="{{$company->kycDetail->bu_doc_type4}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
              <button value="{{$company->kycDetail->bu_doc_type4}}" name="reject" data="{{$company->id}}" data-id="2" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
          @endif
          <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
          </td>
          <td>
          @if($doc1->bu_doc_type4_status==1)
         
         @if($doc1->bu_doc_type4_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->bu_doc_type4_expiry_date) ? $doc1->bu_doc_type4_expiry_date : ''}}</p>
         @endif
         
       @endif 
       </td> 
      </tr>
      @endif

      @if($company->kycDetail->bu_document5)
      <tr>
          <td>
          <a href="/public/company/docs/{{$company->kycDetail->bu_document5}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->bu_document5}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

          </td>
          <td>
            {{$company->kycDetail->bu_document5}}
          </td>  
          <td>
          @if($company->kycDetail->bu_doc_type5 == 1)
            <span>License</span>
          @elseif($company->kycDetail->bu_doc_type5 == 2)
            <span>MoA</span>
          @elseif($company->kycDetail->bu_doc_type5 == 3)
            <span>Share certificate</span>
          @elseif($company->kycDetail->bu_doc_type5 == 4)
            <span>Tax Certificate</span>
          @elseif($company->kycDetail->bu_doc_type5 == 5)
            <span>Proof of Bank Account</span>
          @endif
          </td>  
          <td nowrap="nowrap">
          @if(isset($doc123))
              
          @if($doc123->bu_doc_type5_status==1)
          <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
          @elseif($doc123->bu_doc_type5_status==2)
           <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
           @else
           <button type="button" value="{{$company->kycDetail->bu_doc_type5}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
              <button value="{{$company->kycDetail->bu_doc_type5}}" name="reject" data="{{$company->id}}" data-id="2" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>

          @endif
          
          @else
            <button type="button" value="{{$company->kycDetail->bu_doc_type5}}" name="approved" data="{{$company->id}}" data-id="1" id="approved" class="btn no" style="color: #18b220;">
                <i data-feather="check" style="width: 25px; height: 40px;"></i>
              </button>
              
              <button value="{{$company->kycDetail->bu_doc_type5}}" name="reject" data="{{$company->id}}" data-id="2" id="reject" type="button" class="btn mr-4 no" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
          @endif
          <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
          </td>
          <td>
          @if($doc1->bu_doc_type5_status==1)
         
         @if($doc1->bu_doc_type5_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->bu_doc_type5_expiry_date) ? $doc1->bu_doc_type5_expiry_date : ''}}</p>
         @endif
         @endif
         </td>
      </tr>
      @endif

    </tbody>
</table>
</div>
@endif
</div>
</div>
</div>
</div>
</section> 
</div>

  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  <section id="multiple-column-form">
  <div class="row">
  <div class="col-12">
  <div class="card"> 
  <div class="card-body">

  @if($company->kycDetail->ot_document1 || $company->kycDetail->ot_document2 || $company->kycDetail->ot_document3 || $company->kycDetail->ot_document4) 

  <div class="">
  <table class="table table-bordered text-center">
  <thead>
      <tr>
          <th>&nbsp;</th>
          <th>File</th>
          <th>Type</th>
          <th>Actions</th>
          <th>Expiry Date</th>
      </tr>
  </thead>
  <tbody id="doc_body3">
    @if($company->kycDetail->ot_document1)
    <tr>
        <td>
        <a href="/public/company/docs/{{$company->kycDetail->ot_document1}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ot_document1}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

        </td>
        <td>
          {{$company->kycDetail->ot_document1}}
        </td>
        <td>
          <span>{{$company->kycDetail->ot_doc_type1}}</span>

        </td>
        <td nowrap="nowrap">
        @if(isset($doc123))
           
        @if($doc123->ot_doc_type1_status==1)
        <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
        @elseif($doc123->ot_doc_type1_status==2)
        <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
        @else
          <button type="button" value="1" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
              <i data-feather="check" style="width: 25px; height: 40px;"></i>
            </button>
            
            <button value="1" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif
        @else
           <button type="button" value="1}" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
              <i data-feather="check" style="width: 25px; height: 40px;"></i>
            </button>
            
            <button value="1" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif
        <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
        </td>
        <td>
        @if($doc1->ot_doc_type1_status==1)
         
         @if($doc1->ot_doc_type1_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->ot_doc_type1_expiry_date) ? $doc1->ot_doc_type1_expiry_date : ''}}</p>
         @endif
         @endif
         </td>
    </tr>
    @endif

    @if($company->kycDetail->ot_document2)
    <tr>
        <td>
        <a href="/public/company/docs/{{$company->kycDetail->ot_document2}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ot_document2}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

        </td>
        <td>
          {{$company->kycDetail->ot_document2}}
        </td>
        <td>
          <span>{{$company->kycDetail->ot_doc_type2}}</span>

        </td>
        <td nowrap="nowrap">
        @if(isset($doc123))
           
        @if($doc123->ot_doc_type2_status==1)
          <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
        @elseif($doc123->ot_doc_type2_status==2)
          <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
        @else
           <button type="button" value="2" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
              <i data-feather="check" style="width: 25px; height: 40px;"></i>
            </button>
            
            <button value="2" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif
        @else
           <button type="button" value="2" name="approved" data="{{$company->id}}"data-id="1" id="other_data" class="btn not" style="color: #18b220;">
              <i data-feather="check" style="width: 25px; height: 40px;"></i>
            </button>
            
            <button value="2" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif
        <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
        </td>
        <td>
        @if($doc1->ot_doc_type2_status==1)
         
         @if($doc1->ot_doc_type2_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->ot_doc_type2_expiry_date) ? $doc1->ot_doc_type2_expiry_date : ''}}</p>
         @endif
         @endif
         </td>
    </tr>
    @endif

  @if($company->kycDetail->ot_document3)
  <tr>
      <td>
      <a href="/public/company/docs/{{$company->kycDetail->ot_document3}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ot_document3}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

      </td>
      <td>
        {{$company->kycDetail->ot_document3}}
      </td>
      <td>
        <span>{{$company->kycDetail->ot_doc_type3}}</span>

      </td>
      <td nowrap="nowrap">
      @if(isset($doc123))
         
      @if($doc123->ot_doc_type3_status==1)
        <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
      @elseif($doc123->ot_doc_type3_status==2)
        <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
      @else
         <button type="button" value="3" name="approved" data="{{$company->id}}"data-id="1" id="other_data" class="btn not" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
        
          <button value="3" data="{{$company->id}}" data-id="3" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif
      @else
         <button type="button" value="3" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
        
          <button value="3" data="{{$company->id}}" data-id="3" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
        @endif
      <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
      </td> 
      <td> 
      @if($doc1->ot_doc_type3_status==1)
         
         @if($doc1->ot_doc_type3_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->ot_doc_type3_expiry_date) ? $doc1->ot_doc_type3_expiry_date : ''}}</p>
         @endif
         @endif
         </td>
  </tr>
  @endif

  @if($company->kycDetail->ot_document4)
  <tr>
      <td>
      <a href="/public/company/docs/{{$company->kycDetail->ot_document4}}" target="_blank"><img src="/company/docs/{{$company->kycDetail->ot_document4}}" class="h-75px align-self-end img-border doc_image" width="100px" height="100px" alt=""></a>

      </td>
      <td>
        {{$company->kycDetail->ot_document4}}
      </td>
      <td>
        <span>{{$company->kycDetail->ot_doc_type4}}</span>

      </td>
      <td nowrap="nowrap">
      @if(isset($doc123))
      
      @if($doc123->ot_doc_type4_status==1)
      <button id="pasitive" type="button" class="btn mr-4 " style="color:#18b220;  ">Approved</button>
      @elseif($doc123->ot_doc_type4_status==2)
       <button id="negative" type="button" class="btn mr-4 " style="color:#fa0707; ">Rejected</button>
      @else
        <button type="button" value="4" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
          
          <button value="4" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif
      @else
         <button type="button" value="4" name="approved" data="{{$company->id}}" data-id="1" id="other_data" class="btn not" style="color: #18b220;">
            <i data-feather="check" style="width: 25px; height: 40px;"></i>
          </button>
          
          <button value="4" data="{{$company->id}}" data-id="2" name="reject" id="other" type="button" class="btn mr-4 not" style="color:#fa0707;">  <i data-feather="x" style="width: 25px; height: 40px;"></i></button>
      @endif
      <!-- <a href="/storeadmin/edit-company/{{$company->uuid}}" type="button" class="btn btn-primary btn-form-block waves-effect"> Edit</a> -->
      </td>
      <td>
      @if($doc1->ot_doc_type4_status==1)
         
         @if($doc1->ot_doc_type4_expiry_date=="0000-00-00")
         <p>N/A</p>
         @else
         <p>{{isset($doc1->ot_doc_type4_expiry_date) ? $doc1->ot_doc_type4_expiry_date : ''}}</p>
         @endif
         @endif
         </td>
     </tr>
     @endif
    </tbody>
    </table>
   </div>
  @endif
  </div>
  </div>
  </div>
  </div>
  </section> 
  </div>
  </div> 
  </section> 
  </div>

    <div class="tab-pane fade" id="pills-fleet" role="tabpanel" aria-labelledby="pills-fleet-tab">
      <section class="app-user-list">
               <div class="card">
          <div class="card-datatable table-responsive pt-0">
          <table class="fleets-list-table table">
            <thead class="table-light">
              <tr>
                
                <th>#</th>
                <th>IMAGE</th>
                <th>BRAND</th>
                <th>MODEL</th>
                <th>SERVICE TYPE</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!-- list and filter end -->
    </section> 
    </div>

                                    <!-- code remove -->
              
      <div class="tab-pane fade" id="pills-More_Information" role="tabpanel" aria-labelledby="pills-More_Information-tab">
      <section class="app-user-list">
<!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom mb-1">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Active</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-finished-tab" data-bs-toggle="pill" data-bs-target="#pills-finished" type="button" role="tab" aria-controls="pills-finished" aria-selected="false">Finished</button>
    </li>
</ul>

  <div class="demo-inline-spacing">
    
      </div><!-- demo-inline-spacing-end -->
    </div> <!--card-body-end -->

    <div class="tab-content" id="pills-tabContent">
    
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card-datatable table-responsive pt-0">
      <table class="booking-list-table1 table">
          <thead class="table-light">
          <tr>
              
              <th></th>
              <th>BOOKING#</th>
              <th>MERCHANT</th>
              <th>STATUS</th>
              <th>VEHICLE</th>
              <th>PICKUP/DROP OFF</th>
              <th>AIRPORT PICKUP</th>
              <th>AMOUNT</th>
              <th></th>
          </tr>
          </thead>
      </table>
  </div>
</div>
      
<div class="tab-pane fade" id="pills-finished" role="tabpanel" aria-labelledby="pills-finished-tab">
  <div class="card-datatable table-responsive pt-0">
    <table class="booking-list-table1 table">
        <thead class="table-light">
        <tr>
            <th></th>
            <th>BOOKING#</th>
            <th>MERCHANT</th>
            <th>STATUS</th>
            <th>VEHICLE</th>
            <th>PICKUP/DROP OFF</th>
            <th>AIRPORT PICKUP</th>
            <th>AMOUNT</th>
            <th></th>
        </tr>
        </thead>
    </table>
  </div>
</div>

  </div> 
</div>
            <!-- list and filter end -->
</section>
</div>

<div class="tab-pane fade" id="pills-Permission" role="tabpanel" aria-labelledby="pills-Permission-tab">
<section class="app-user-list">

<div class="card">
<div class="card-body">
  <div class="table-responsive">
  <table class="table">
      <thead>
        <tr>
          <th>MODULE</th>
          <th>SUBMODULE</th>
            
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
              <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly />
                  <label class="form-check-label" for="inlineCheckbox1">Dashboard</label>
                
              </div>
            </div>
          </td>
          <td>
            <!-- <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked"  readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1"> </label>
              </div>
            </div>
             -->
          </td>
          
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                  <label class="form-check-label" for="inlineCheckbox1">LEADS</label>
                
            </div>
            </div>
          </td>
          <td>
            <!-- <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked"  readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1"> </label>
              
            </div>
            </div> -->
            
          </td>  
          
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                    <input class="form-check-input"  type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                  <label class="form-check-label" for="inlineCheckbox1">Contacts </label>
                  
            </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1">Customer</label>
                
            </div>
            </div>
            
          </td>
          
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                  <label class="form-check-label" for="inlineCheckbox1">Fleet</label>
                
            </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1">Fleet</label>
              
            </div>
            </div>
            
          </td>
          
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                  <label class="form-check-label" for="inlineCheckbox1">Bookings</label>
                
            </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1">Manage Booking</label>
              
            </div>
            </div>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
              <label class="form-check-label mb-1" for="inlineCheckbox1">Booking Calender</label>
              
            </div>
            </div>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
              <label class="form-check-label mb-1" for="inlineCheckbox1">Promotion</label>
              
            </div>
            </div>
             
          </td>
          
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                  <label class="form-check-label" for="inlineCheckbox1">Accounts</label>
                
            </div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1">Invoice</label>
                
            </div>
            </div>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" style="border-color: black;" type="checkbox" id="inlineCheckbox1" value="checked" checked readonly/>
                <label class="form-check-label mb-1" for="inlineCheckbox1">Payment</label>
                
            </div>
            </div>
          </td>
          
        </tr>
        
      </tbody>
    </table>
  </div>
</div>
</div>
  
</section>
</div>

        <div class="tab-pane fade" id="pills-Subscription" role="tabpanel" aria-labelledby="pills-Subscription-tab">
        <section id="acounts_payment_list">
        <div class="row px-1">
		<div class="card">
        <br> 
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-asc-tab" data-bs-toggle="pill" data-bs-target="#pills-asc" type="button" role="tab" aria-controls="pills-asc" aria-selected="true"> Invoice</button>
           
          </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link " id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="false"> Payments</button>
           
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
                    <th class="col-1">AddedBy</th> 
                     
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
                   
                      <th>REF</th>
                      <th>NAME </th>
                      <th>TYPE</th>
                      <th>PAYMENT METHOD</th>
                      <th>AMOUNT</th>
                      <th>DATE&TIME</th>
                      <th>STATUS</th> 
                    </tr>
                  </thead>
                </table>
              </div>
              </div>

              <div class="tab-pane fade show " id="pills-asc" role="tabpanel" aria-labelledby="pills-asc-tab">
              <div class="card-datatable table-responsive">
                <table class="get_data_all table">
                  <thead>
                    <tr> 
                   
                      <th>ID</th>
                      <th>REF </th>
                      <th>NAME</th>
                      <th>TYPE</th>
                      <th>CARD TYPE</th>
                      <th>PAYMENT METHOD</th>
                      <th>STATUS</th> 
                      <th>AMOUNT</th> 
                      <th>ACTIONS</th> 
                    </tr>
                  </thead>
                </table>
              </div>
              </div>
   
           <div class="tab-pane fade show " id="pills-invoice" role="tabpanel" aria-labelledby="pills-booking-tab">
                 <div class="col-12">
                  <div class="row">
                 <div class="col-10">
                 <table class="table">
                        <h2 class="px-2">Account ID:{{$company->id}} </h2>
                      
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
                            <td> SBI</td>
                            <td>Manual</td>
                            <td>{{(isset($last_payout->debit) ? $last_payout->debit : '')}}</td>
                            <td>{{(isset($pending->Balance) ? $pending->Balance : '')}}</td> 
                            </tr>
                            <input type="hidden" id="available_balance" class="form-control available_balance" value="{{(isset($pending->Balance) ? $pending->Balance : '0')}}" />
                  </table>
                  </div>
                  <div class="col-2" style="margin: 4% 0 0 0;">
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
           <div class="modal  new-withdraw-modal fade" id="modals-withdraw">
            <div class="modal-dialog modal-xl" style="width: 60%;margin: 10% 0 0 25%;" >
                <form class="withdraw-Payment modal-content pt-0 " autocomplete="off" id="form_models" method="post"  enctype="multipart/from-data" > 
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="full_name-column">Requested Amount</label>
                              <input type="text" id="amount_request" class="form-control" value="" name="amount_request" /> 
                              <input type="hidden" id="current_balance" class="form-control"  name="current_balance" /> 

                            </div>
                          </div>
                          
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="phone-column">Requested Date</label>
                              <input type="date" id="request_date" class="form-control" value="" placeholder=" " name="request_date" /> 

                            </div>
                          </div>
                           
                        </div>

                        <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Save</button>
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
                                      <p class="card-text mb-0" id="adress1"></p>
                                      <p class="card-text mb-0" id="adress2" ></p>
                                      <p class="card-text mb-0" id="city"></p>
                                      <p class="card-text mb-0" id="street"></p>
                                    </div>
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
                                    <p><a href="javascript:;" rel="nofollow"  class="text-secondary"  id="payment_link"> </a> </p>
                                    <div class="icon-wrapper"  height= 40px; width= 60px; >  
                                      <a href="javascript:;"     id="url_copy" class="btn btn-danger waves-effect url_copy">  <i data-feather='copy'></i></a>
                                      <a href="" class="btn btn-danger waves-effect" id="my-link">  <i data-feather='message-circle'></i></a>
                                      <a target="_blank" id="make_payment" href="" class="btn btn-danger waves-effect">  <i data-feather='eye'></i></a>
                                      <button class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></button>
                                      <a href="javascript:;" id="mail_send" class="btn btn-danger waves-effect"> <i data-feather='mail'></i></a>
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
           
            <section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
      <!-- <div class="card-body">  -->
      <form class="update-new-vendor modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">            
           
         </div>
         <div class="modal fade show " id="detais" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content" style="width:90%; margin-left:5%">  
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <label for="" id="status_label" class="label label-lg bg-light-success label-inline"></label>
                 <span id="transaction_type"></span> <span id="transaction_referance"></span>
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
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amount_currency"></span></div>
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
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_status"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_resp_msg"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_date"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row" id="invoice_li">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_no"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item " id="invoice_ref_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_ref"></span></div>
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
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="payment_description" style="font-size: 10px;"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Type</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_type"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Month</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryMonth"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Year</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryYear"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>

                        </ul>
                  </div>
                  <div class="col-md-4 col-lg-4">
                  <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                      <p id="name" class="m-0"></p>
                      <p id="c_email" class="m-0"></p>
                      <p id="address" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off"> </p>
                      <p id="c_country" class="m-0"> </p> 
                      <p id="c_state" class="m-0"></p>
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
                              <tbody id="tbodys">
                            
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
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="sub_total"></span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Discount</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discount"></span></div>
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Delivery Charges</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_charges"></span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Grand Total</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_totalsss"></span></div>
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
</section>
<!--   -->
<!-- transaction popup -->
<section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
      <!-- <div class="card-body">  -->
      <form class=" modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">            
           
         </div>
         <div class="modal fade show " id="transaction_popup_show" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;">
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content" style="width:90%; margin-left:5%">  
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <label for="" id="status_labelss" class="label label-lg bg-light-success label-inline"></label>
                 <span id="transaction_typess"></span> <span id="transaction_referancess"></span>
              </h5>
            
              <button type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
                      


          </div>
          <div class="modal-body">
              <ul class="list-group" style="border-radius: 0px">
                  <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transaction_idss"></span> : Rental 360</li>
              </ul>
              <div class="row">
                  <div class="col-md-8 col-lg-8">
                      <ul class="list-group" style="border-radius: 0px">
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Amount</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amount_currencyss"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Cart Id</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_cart_idss"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item" id="customer_inovice_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Status</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_statusss"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_resp_msgss"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_datess"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row" id="invoice_li">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_noss"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item " id="invoice_ref_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoice_refss"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Customer Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_customer_refss"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Description</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_descriptionss"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Scheme</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_schemess"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Payment Description</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="payment_descriptionss" style="font-size: 10px;"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Type</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="card_typess"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Month</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryMonthss"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Expiry Year</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="expiryYearss"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>

                        </ul>
                  </div>
                  <div class="col-md-4 col-lg-4">
                  <h3 class="mt-5 mb-1"><b>Bill TO</b></h3>
                      <p id="namess" class="m-0"></p>
                      <p id="c_emailss" class="m-0"></p>
                      <p id="addressss" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off"> </p>
                      <p id="c_countryss" class="m-0"> </p> 
                      <p id="c_statess" class="m-0"></p>
                      <br>
                      <p id="refund_p" class="d-none"><b>Refund:</b>
                          <button class="btn btn-danger btn-sm" id="refund_btn"> <i class="fa fa-minus-square"></i>
                          <input type="hidden" id="hidden_cart_idss" value="MKX-96745">
                          <input type="hidden" id="hidden_cart_amountss" value="500.00">
                          <input type="hidden" id="hidden_tran_refss" value="TST2128500394932">
                          <input type="hidden" id="hidden_idss" value="722">
                          <input type="hidden" id="hidden_emailss" value="hamzaashraf160@gmail.com">
                          <input type="hidden" id="hidden_namess" value="Talha Talib">
                          <input type="hidden" id="hidden_phoness" value="+971">
                          <input type="hidden" id="hidden_currencyss" value="AED">
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
                              <tbody id="tbodysss">
                            
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
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="sub_totalss"></span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Discount</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discountss"></span></div>
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Delivery Charges</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_chargesss"></span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-4 col-sm-3"><strong for="">Grand Total</strong></div>
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_totalsssss"></span></div>
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
</section>
 <!-- end transaction popup -->

@endsection  

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
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script> -->
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-company-view.js') }}"></script>  
 <script src="{{ asset('js/scripts/pages/kycs-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/pages/kycs1-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/pages/app-superadmin-booking.js') }}"></script> 
 <script src="{{ asset('js/scripts/pages/app-superadmin-fleetshow-list.js') }}"></script>
 <script src="{{ asset('js/scripts/pages/account-superadmin-invoice-list.js') }}"></script>
 <script src="{{ asset('js/scripts/pages/app-superadmin-payment-transaction-list.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-superadmin-payment-payments-list.js') }}"></script>
  <!-- <script src="{{ asset('js/scripts/pages/app-payment_statement-list.js') }}"></script>  -->
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="crossorigin="anonymous"></script>
@endsection

