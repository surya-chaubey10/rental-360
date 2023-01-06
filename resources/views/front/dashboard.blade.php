@extends('layouts.main')
@section('title', 'Dashboard')
 

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}"> -->

@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

  @endsection
  
  <style>
  .box-custom {
    text-align: right;
}
.box-custom b, .box-custom h5 {
    display: block;
    float: none!important;
}
.card{
	margin-bottom: 1rem !important;
	height: 100%;
}
.custom-div {
	justify-content: end;
    padding-right: 1.5rem;
}
.custom-padding{
	    padding: 0 1.5rem !important;
}
.custom-setting{
	font-size: 1.7rem !important;
    margin-top: 6rem !important;
}
  </style>

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
      <div class="card card-congratulations img-height">
        <div class="card-body text-center">
          <img
            src="{{asset('images/elements/decore-left.png')}}"
            class="congratulations-img-left"
            alt="card-img-left"
          />
          <img
            src="{{asset('images/elements/decore-right.png')}}"
            class="congratulations-img-right"
            alt="card-img-right"
          />
          <div class="avatar avatar-xl bg-primary shadow">
            <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div>
          </div>    
          <div class="text-center">
            <h1 class="mb-1 custom-setting text-white">Welcome {{$org->org_name}}</h1>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->

    <div class="col-xl-9 col-lg-3 col-md-6 col-12 mt-1 mb-1"">
      <div class="card card-statistics ">
        <div class="card-header">
       
        </div>
            <div class="btn-group mt-md-0 mt-1 size custom-div" role="group" aria-label="Basic radio toggle button group" style="margin-left:40%"    id="myBtnContainer">
               <a class="btn1 active" for="radio_option1" onclick="filterSelection('Today')">Today</a>
                <a class="btn1" onclick="filterSelection('1D')" for="radio_option2">1D</a>  
                <a class="btn1" onclick="filterSelection('1W')" for="radio_option3">1W</a>
                <a class="btn1" onclick="filterSelection('1M')" for="radio_option3">1M</a>
                <a class="btn1" onclick="filterSelection('3M')" for="radio_option3">3M</a>
                <a class="btn1" onclick="filterSelection('6M')" for="radio_option3">6M</a>
                <a class="btn1" onclick="filterSelection('1Y')" for="radio_option3">1Y</a>
                <a class="btn1" onclick="filterSelection('MTD')" for="radio_option3">MTD</a>
                <div class="d-flex align-items-center" style="margin-left:23px;">
                  <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                  </div> 
            </div>
        <div class="card-body statistics-body filterDiv Today custom-padding" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>       
                        @php     $tran=App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count();             @endphp                                           
                        <h5 class=""><b>{{ (isset($tran) ? $tran : '0') }}</b></h5> 
                        <h5 style="text-align:end;">Transaction  </h5>
                   
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b style="float:right" class="text-danger">No.</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
						</div>
                </div>  
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('cart_amount')}}</h5>
                        <h5>Collection</h5>
                      
						</div>
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
						<b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
						<h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('Balance')}}</h5>
                        <h5>Libilities</h5>
                    </div>
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
      <!-- ============= -->
       <!-- 1D============= -->
		<div class="card-body statistics-body custom-padding filterDiv 1D" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                   <div class="box-custom">
                        <b class="text-danger">No.</b>       
                        @php     $tran=App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count();             @endphp                                           
                        <h5 class=""><b>{{ (isset($tran) ? $tran : '0') }}</b></h5> 
                        <h5 style="text-align:end;">Transaction </h5>
                    </div>  
                    <!-- <div class="my-1">
                        <b style="float:right" class="text-danger">No.</b><br>                                           
                    
                       <h5 style="float:right" class="">{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->count() }}</h5>
                       <h5 class=""><b>{{ (isset($tran) ? $tran : '0') }}</b></h5> 
                        <h5 style=" text-align:end;">Transaction <br/> </h5> -->
                        <!-- {{number_format($transanction_no)}} -->
                    <!--</div>   -->
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       
                   
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('cart_amount')}}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                         </div>
                       
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('cart_amount')}}</h5>
                        <h5>Collection</h5>
                        </div>
                        
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    
                    
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereDate('created_at', Carbon\Carbon::today())->sum('Balance')}}</h5>
                        <h5>Libilities</h5>
                        
                        <!-- {{(isset($liability->Balance) ? number_format($liability->Balance,2) : '0.00')}} -->
                    </div>  
					</div>
              </div> 
            </div>
          </div>
        </div>
        </div>
      </div>
      <!-- ============= -->
 <!-- ============== -->
 <div class="card-body statistics-body custom-padding filterDiv 1W" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>                                           
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                   
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at',
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum( 'cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                    </div>
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="float:right; white-space:nowrap;">Collection</h5>
                     </div>   
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subWeek()->startOfWeek(), Carbon\Carbon::now()])->sum('Balance'); }}</h5>
                    <h5>Libilities</h5>
                      </div>  
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 <!-- ============== -->
 <div class="card-body statistics-body filterDiv custom-padding 1M" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>                                           
                    
                       <h5 class="">{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                        
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       
                   
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                    </div>  
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style=" white-space:nowrap;">Collection</h5>
                    </div>  
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                        
                        
                    
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', 
                            [Carbon\Carbon::now()->subMonth()->startOfMonth(), Carbon\Carbon::now()])->sum('Balance'); }}</h5>
                        <h5>Libilities</h5>
                      </div>  
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 <!-- ============== -->
 <div class="card-body statistics-body filterDiv custom-padding 3M" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>
                       <h5 class="">{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                     </div>   
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Collection</h5>
                      </div>  
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                        
                        
                    
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(3), Carbon\Carbon::now()])->sum('Balance'); }}</h5>
                        <h5>Libilities</h5>
                      </div>  
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 <!-- ============== -->
 <div class="card-body statistics-body filterDiv custom-padding 6M" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>                                           
                       <h5 class="">{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                   
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                       </div>   
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1"">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Collection</h5>
                      </div>  
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereBetween('created_at', [Carbon\Carbon::now()->subMonth(6), Carbon\Carbon::now()])->sum('Balance'); }}</h5>
                    <h5>Libilities</h5>
                      </div>  
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 <!-- ============== -->
 <div class="card-body statistics-body filterDiv custom-padding 1Y" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>                                          
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                   
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('cart_amount'); }}</h5>
                        <h5 style=" white-space:nowrap;">Booking</h5>
                       </div> 
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Collection</h5>
                       </div> 
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('Balance'); }}</h5>
                    <h5>Libilities</h5>
                       </div> 
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 <!-- ============== -->
 <div class="card-body statistics-body filterDiv custom-padding MTD" id="Today">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9 "> 
                    <div class="box-custom">
                        <b class="text-danger">No.</b>                                           
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->count(); }}</h5>
                        <h5 style="text-align:end;">Transaction</h5>
                   
                    </div>  
                    </div>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
             <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/money.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Booking</h5>
                       </div> 
                </div>  
              </div> 
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/calender.jpg')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                        <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                   
                       <h5>{{ App\Models\Transaction::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('cart_amount'); }}</h5>
                        <h5 style="white-space:nowrap;">Collection</h5>
                         </div>
                </div>  
              </div> 
            </div>
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1"">
          <div class="card shadow-none border cursor-pointer border border-danger">
            <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3"> 
                <div class="d-flex justify-content-between">
                    <img src="{{asset('images/icons/dashbord/download.png')}}" alt="google drive" height="38" />
                </div>
                </div>

                <div class="col-md-9"> 
                    <div class="box-custom">
                    <b class="text-danger">{{($currency->org_currency == 1 ? 'AED' : ($currency->org_currency == 2 ? 'USD' : ($currency->org_currency == 3 ? 'EUR' : '')))}}</b>
                    <h5>{{ App\Models\GeneralLedger::select('manage_bookings')->where('organisation_id',getUser()->organisation_id)->whereYear('created_at', now()->year)->sum('Balance'); }}</h5>
                    <h5>Libilities</h5>
                      </div>  
                   
                    </div>  
              </div> 
            </div>
          </div>
        </div>
      
        </div>
      </div>
 <!-- ============== -->
 
    </div>
  </div>
  </div>
  </div>

  <!-- ============= -->
  <div class="row">
    <div class="card">
        <br>
          <div class="row">
            <div class="col-md-6">
             <h4 style="font-size: 1.486rem;">Recent Activity</h4>
            </div>
            <div class="col-md-6 ">
              <div style="float:right; color:red">	
				<a href="" data-bs-toggle="modal" data-bs-target="#datepicker"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar" viewBox="0 0 64 64"><g fill="red"><path d="M49.6 54H14.4C12 54 10 52 10 49.6V17.3c0-2.4 1.6-4.4 3.7-4.4h2.2v2.9h-2.2c-.3 0-.7.6-.7 1.5v32.3c0 .8.7 1.5 1.5 1.5h35.2c.8 0 1.5-.7 1.5-1.5V17.3c0-.9-.5-1.5-.7-1.5h-2.2v-2.9h2.2c2 0 3.7 2 3.7 4.4v32.3C54 52 52 54 49.6 54"/><path d="M20.3 18.8c-.8 0-1.5-.7-1.5-1.5v-5.9c0-.8.7-1.5 1.5-1.5s1.5.7 1.5 1.5v5.9c-.1.8-.7 1.5-1.5 1.5m23.4 0c-.8 0-1.5-.7-1.5-1.5v-5.9c0-.8.7-1.5 1.5-1.5s1.5.7 1.5 1.5v5.9c0 .8-.7 1.5-1.5 1.5M24.7 12.9h14.6v3H24.7zM12.9 21.7h38.2v3H12.9zM45.2 27.6h2.9v2.9h-2.9zM39.3 27.6h3v2.9h-3zM33.5 27.6h2.9v2.9h-2.9zM27.6 27.6h2.9v2.9h-2.9zM21.7 27.6h3v2.9h-3zM45.2 33.5h2.9v2.9h-2.9zM39.3 33.5h3v2.9h-3zM33.5 33.5h2.9v2.9h-2.9zM27.6 33.5h2.9v2.9h-2.9zM21.7 33.5h3v2.9h-3zM15.9 33.5h2.9v2.9h-2.9zM45.2 39.3h2.9v3h-2.9zM39.3 39.3h3v3h-3zM33.5 39.3h2.9v3h-2.9zM27.6 39.3h2.9v3h-2.9zM21.7 39.3h3v3h-3zM15.9 39.3h2.9v3h-2.9zM39.3 45.2h3v2.9h-3zM33.5 45.2h2.9v2.9h-2.9zM27.6 45.2h2.9v2.9h-2.9zM21.7 45.2h3v2.9h-3zM15.9 45.2h2.9v2.9h-2.9z"/></g></svg>
				</a>
              </div>
            </div>
          </div>
             <hr>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="true">Recent Booking</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-payments-tab" data-bs-toggle="pill" data-bs-target="#pills-payments" type="button" role="tab" aria-controls="pills-payments" aria-selected="false">Payment</button>
                </li> -->
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-invoice-tab" data-bs-toggle="pill" data-bs-target="#pills-invoice" type="button" role="tab" aria-controls="pills-invoice" aria-selected="false">Invoices</button>
                </li>
                
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-fleet-tab" data-bs-toggle="pill" data-bs-target="#pills-fleet" type="button" role="tab" aria-controls="pills-fleet" aria-selected="false">Fleet</button>
                </li>

                <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-transaction-tab" data-bs-toggle="pill" data-bs-target="#pills-transaction" type="button" role="tab" aria-controls="pills-transaction" aria-selected="false">Transaction</button>
                </li>
               
            </ul>
            <div class="tab-content" id="pills-tabContent" >
              <div class="tab-pane fade show active" id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab">  
                <div class="card-datatable table-responsive pt-0">  
                @php $space="     "; @endphp

                  <table class=" table">
                  <!-- manage-booking-table -->
                    <thead class="table-light">
                      <tr> 
                        
                        <th>Booking</th> 
                        <th>customer</th>
                        <th>Status</th>  
                        <th>vehicle</th>
                        <th>pickup/drop-off</th> 
                        <th>Agent</th> 
                        <th>Amount</th> 
                      </tr> 
                    </thead> 
                    <tbody>
                    <tr>
                       
                        @foreach($bookinglist as $bookinglist_data)
                        <tr>
                       <td style="font-weight:bold;"><a href="tabinvoice/{{$bookinglist_data->id}}" >1000{{$bookinglist_data->id}}
                       <p>@if($bookinglist_data->driver_id==1)
                       Self Drive
                        @elseif($bookinglist_data->driver_id==2)
                        Car with Driver
                        @else
                        Limousine
                        @endif
                        </a> </p></td>
                       <td style="font-weight:bold;">{{$bookinglist_data->fullname}}</td>
                       @if($bookinglist_data->status==1)
                       <td  ><span class="badge rounded-pill badge-light-success me-1">Paid</span> </td>
                       @else
                       <td ><span class="badge rounded-pill badge-light-warning me-1">Pending</span></td>
                       @endif
                       <td style="font-weight:bold;">{{$bookinglist_data->brand_name}}</td>
                       <td style="font-weight:bold;"><p>{{$bookinglist_data->pickup_address}}</p><p> {{$bookinglist_data->dropoff_address}}</p></td>
                       <td> @if($bookinglist_data->image==NULL)

                       <img src="/public/company/logo/202210190637logo.jpg" class="congratulations-img-right" alt="card-img-right" style="border-radius: 50%;" height="37" width="40">
                     
                        @else
                        <img src="/public/company/logo/202210190637logo.jpg " class="congratulations-img-right" alt="card-img-right" style="border-radius: 50%;" height="37" width="40">
                       @endif
                     </td>
                     
                       <td style="font-weight:bold;">{{isset($bookinglist_data->totalDeductions) ? $bookinglist_data->totalDeductions : '0' }}</td>
                       </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>  
              </div>

              <div class="tab-pane fade show " id="pills-payments" role="tabpanel" aria-labelledby="pills-booking-tab">
                  <div class="card-datatable table-responsive">
                    <table class="invoice-list-table1 table">
                      <thead>
                        <tr>
                          <th>INVOICE ID</th>
                          <th>DESCRIPTION</th>
                          <th>CURRENCY </th>
                          <th>TOTAL</th>
                          <th>STATUS</th>
                          <th>TYPE</th>
                          <th>ADDEON</th>
                          <th>ADDEBY</th>
                          <th>SYNC WITH BOOKING</th> 
              
                        </tr>
                      </thead> 
                    </table>
                  </div>
              </div>

              <div class="tab-pane fade show " id="pills-fleet" role="tabpanel" aria-labelledby="pills-fleet-tab">
                  <div class="card-datatable table-responsive pt-0">
                    <table class="offer-list-table table">
                      <thead class="table-light">
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>Brand</th>
                          <th>Model</th>
                          <th>Service Type</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
              </div>

              <div class="tab-pane fade show " id="pills-invoice" role="tabpanel" aria-labelledby="pills-invoice-tab">
                 <div class="col-12">
                <div class="card invoice-list-wrapper">
                    <div class="card-datatable table-responsive">
                    <table class="expenses-table table">
                    <thead class="table-light">
                      <tr>  
                        <th>REF</th>
                        <th>NAME</th>
                        <th>TYPE</th> 
                        <th>PAYMENT METHOD</th> 
                        <th>CURRENCY</th> 
                        <th>AMOUNT</th> 
                        <th>DATE&TIME</th> 
                        <th>STATUS</th>
                       
                      </tr> 
                    </thead> 
                  </table>
                  </div>
                 </div>
                </div> 
              </div>

              <div class="tab-pane fade show " id="pills-transaction" role="tabpanel" aria-labelledby="pills-transaction-tab">
                 <div class="col-12">
                <div class="card invoice-list-wrapper">
                    <div class="card-datatable table-responsive">
                    <table class="transaction-list-table table">
                        <thead>
                        <tr>
                        
                          
                            <th>REF </th>
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
                </div>
              </div>
           </div>
     </div> 

  </div>
  <div class="row">
       <div class="card">
         <div class="card header">
             <h4 style="font-size: 1.486rem; margin-top: 2%;">Fleet Collection</h4>
          </div>
           <div class="tab-content" id="pills-tabContent" >
              <div class="tab-pane fade show active" id="pills-reservefleet" role="tabpanel" aria-labelledby="pills-reservefleet-tab">  
                <div class="card-datatable table-responsive pt-0" style='margin-top: -2%;'> 
                  <table class="reservefleet-table table ">
                    <thead class="table-light">
                      <tr> 
                        <th>Booking</th> 
                        <th>Car SKU</th> 
                        <th>Customer</th> 
                        <th>Brand</th>  
                        <th>Model</th>
                        <th>Pickup Date</th> 
                        <th>Drop-off Date</th> 
                        <th>Action</th> 
                      </tr> 
                    </thead> 
                  </table>
                </div>  
              </div>

           </div>
        </div> 

  </div>
 
 
 <?php /* ?>
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
              <span class="btn btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></span>
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
                      <p id="address" class="m-0 pac-target-input" placeholder="Enter a location" autocomplete="off">
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
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="shipping_charges"> </span></div>
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




<section class="app-user-view-account">
<div class="row">  
  <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">    
    <div class="card"> 
      <!-- <div class="card-body">  -->
      <form class="update-new-vendor modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">            
           
         </div>
         <div class="modal fade show " id="trans" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="padding-right: 5px;" >
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content" style="width:90%; margin-left:5%">  
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <label for="" id="statusss_label" class="label label-lg bg-light-success label-inline"></label>
                 <span id="transactionss_type"></span> <span id="transactionsss_referance"></span>
              </h5>
              <span class="btn btn-light-danger font-weight-bold float-right fa fa-close" data-dismiss="modal"></span>
              <button   type="reset" style="float: right;" data-bs-dismiss="modal" class="btn btn-danger mb-1 waves-effect">X</button>
                      


          </div>
          <div class="modal-body">
              <ul class="list-group" style="border-radius: 0px">
                  <li class="list-group-item active" style="font-size: 15px; font-weight:bold">#<span id="transactionss_id"></span> : Rental 360</li>
              </ul>
              <div class="row">
                  <div class="col-md-8 col-lg-8">
                      <ul class="list-group" style="border-radius: 0px">
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Amount</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cart_amountss_currency"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Cart Id</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_cartss_id"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item" id="customer_inovice_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Status</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transactionsss_status"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Response Code</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_respss_msg"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Date:</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transactionss_date"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row" id="invoice_li">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice #</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoicess_no"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item " id="invoice_ref_li">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Invoice Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_invoicess_ref"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Customer Ref</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transaction_customerss_ref"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Description</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="transactionss_description"></span></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Card Scheme</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="cardss_scheme"></span></div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="list-group-item">
                              <div class="row">
                                  <div class="col-md-6 col-lg-6">
                                      <div class="row">
                                          <div class="col-md-6 col-lg-6 col-sm-6"><strong for="">Payment Description</strong></div>
                                          <div class="col-md-6 col-lg-6 col-sm-6"><span for="" id="payment_descriptionsss" style="font-size: 10px;"></span></div>
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
                              <tbody id="tbodyss">
                            
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
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="discountsss"></span></div>
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
                                        <div class="col-md-9 col-lg-4 col-sm-9"><span for="" id="grand_totalxxx"></span></div>
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

<?php */ ?>

 <!-- Modal to add new user starts-->

    <!-- Modal to add new user Ends-->
	
	<div class="modal fade" id="datepicker" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id='calendar'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	
	
	
<script>
filterSelection("Today")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show1");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show1");
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn1");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

<script>  
		

		// Clander Javascript Dashboard 
		
		document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        var formBlock = $('.btn-form-block');
             formSection = $('.form-block'), 
            newUserForm = $('.add-manage-booking-invoice');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          dayMaxEvents: 5,
          editable:false,
          selectable: true,
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          }

        });

        calendar.render();

	  });
	  
	    
	  </script>

<style>
.filterDiv {
  display: none;
}

.modal.show .modal-dialog {
	background-color:#ffffff;
}
.show1 {
  display: block;
}

.btn1:hover {
  /*background-color: red;*/
}

.btn1.active {
  text-decoration: underline;
  color: red;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn1:hover {

  color: red;
}

.btn1 {
  border: none;
  outline: none;
   
  cursor: pointer;
}


</style>

<!-- Top marchent script ==========================================================-->


<style>
.filterDivTop {
  display: none;
}

.showTop {
  display: block;
}

.btnTop:hover {
  /*background-color: red;*/
}

.btnTop.active {
  text-decoration: underline;
  color: red;
}

.btn1
  {
    margin-left:14px;
  }
  .btnTop
  {
    margin-left:14px;
  }
/* Style the active class, and buttons on mouse-over */
.active, .btnTop:hover {

  color: red;
}

.btnTop {
  border: none;
  outline: none;
   
  cursor: pointer;
}

</style>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="https://www.w3schools.com/lib/w3.js"></script>
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
  <script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <!-- <script src="{{ asset('js/scripts/pages/dashboard-analytics.js') }}"></script> -->
  <script src="{{ asset('js/scripts/pages/transaction-list.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/dashboard-invoice-list.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/recent-activity-list.js') }}"></script>
 

   {{-- <script src="{{ asset('js/scripts/pages/app-invoice-list.js') }}"></script> --}}
  <script src="{{ asset('js/scripts/pages/app-dashboard_payments-list.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-reservefleet-list.js') }}"></script>
  <script src="{{ asset('js/scripts/cards/card-analytics.js') }}"></script>

@endsection

<!-- _____________________ -->

<style type="text/css">
    .img-height{
      /*height: 300px;*/
      margin-bottom: 20px;
    }
    /*.content-body{
      margin-bottom: 30px;
    }*/
</style>