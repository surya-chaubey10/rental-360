@extends('layouts.main')
@section('title', '')
 
    
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
 
      <section class="app-user-view-account">
        <div class="row"> 
          <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0"> 
            <div class="card"> 
              <div class="card-body"> 
                <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="post">
 
                  <div class="card-header">
                      <h4 style="font-size: 1.486rem;">Copy Link</h4>
                      <a href="" class="text-secondary" style="float: right; margin-top: -45px;" > <i data-feather='x'></i></a>
                  </div>
                  <hr> 
        
                  <section id="multiple-column-form">
                    <div class="modal-body">
                      <h3>Link</h3>
                        <p id="Link"></p>
                        <p>
                        <a href="" rel="nofollow" class="text-secondary"> https://secure.paytabs.com/payment/request/invoice/1943473/4488146F27064431BB6F7EDA402A11</a>
                      </p>
                    </div>

                    <div class="card-body"> 
                      <div class="icon-wrapper"  height= 40px; width= 60px; >  
                        <button class="btn btn-danger waves-effect">  <i data-feather='copy'></i></button>
                        <button class="btn btn-danger waves-effect" style="font-size: 24px;">  <i class="fa fa-whatsapp"></i></button>
                        <button class="btn btn-danger waves-effect"> <i data-feather='message-square'></i></button>
                        <button class="btn btn-danger waves-effect"> <i data-feather='mail'></i></button>
                      </div>
                    </div>

                    <div class="card-header">
                      <h4 style="font-size: 1.486rem;"></h4>
                     <button  id="submit" name="submit" type="submit" class="btn btn-secondary waves-effect">  Close  </button>
                    </div>
                  </section>
                </form> 
              </div>
            </div> 
          </div>
        </div>  
      </section> 
@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/accounts-list.js') }}"></script>  
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 