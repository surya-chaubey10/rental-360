@extends('layouts.public_main') 


@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">

@endsection

<style>

#sig-canvas {
  border: 3px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
.loadering{
    position: absolute;
    top:0px;
    right:0px;
    width:100%;
    height:100%;
    background-color:#0000008a;
    /* background-image:url({{asset('public/images/loadings.gif')}}); */
    background-size:190px;
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;
}


.toast-message {
   color: white !important;
   
}

</style>


@section('content') 
<section class="app-vendor-list">
    
    <div class="card" style="height: 100%;"> 

        <div class="card-body">
        <div class="loadering" style="display: none;"></div>

            @if($company->agreement_status == 0)
            <form class="form" id="formvirtual" action="" method="post">
                @csrf
                <div class="border-bottom mt-2 mt-3"> 
                    <h4 class="mb-3"><b>Online Merchant Service Agreement</b></h4>
                </div>


                <div class="mt-3 mb-3">
                    <input class="form-check-input " type="checkbox" name="terms" id="terms" required=""> 
                    <b>I have read and agreed with the Rental360 
                    <a href="/public/agreement/merchant-services-agreement.pdf" download="merchant-services-agreement.pdf"> term &amp; conditions.</a></b>
                </div>

                <div class=" " id="agree_options" style="display: none;">

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="agree_option" value="OTP">
                        <label class="form-check-label">
                            Verify By Mobile (***{{ substr($company->org_contact_person_number, -4) }})
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="" id="otp" >
                                <div class="">
                                    <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">
                                    <label class="font-size-h6 font-weight-bolder text-dark"><b>OTP Code (Sent on your registered mobile number)</b></label><br>

                                    <div class="row mt-2 mb-2">
                                        <div class="col-3">
                                        <input class="form-control" type="text" maxlength="4" minlength="4" id="otp_input" name="otp" required="">

                                        <span class="text-danger font-weight-bolder text-hover-danger pt-5" id="otp"></span>
                                        </div>
                                        <div class="col-4">
                                        <button id="btnCounter" class="btn btn-success btn-md " onclick="return false;" type="button" disabled="">Resend <span id="count"></span></button>
                                        </div>
                                    
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>


                    <b>OR</b>
                    <div class="form-check mt-1 mb-3">
                        <input class="form-check-input" type="radio" name="agree_option" value="E-Signature">
                        <label class="form-check-label">
                            E-Signature
                        </label>

                    </div>
                </div>
                <!--begin::Form group-->

                <div class="form-group" id="e-signature" style="display: none;">
                    <canvas class="mb-1" id="sig-canvas" width="620" height="160">
		 			   Your browser not support, please use another browser.
		 		    </canvas>
                    <br/>
                    <button id="sig-clearBtn" class="btn btn-danger btn-sm mb-2" onclick="return false;">Clear Signature</button>
                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                    

                </div>
                <!--end::Form group-->
                <!--begin::Action-->
                    <button type="button" id="submit" class="btn btn-danger " disabled="disabled">Accept</button>
                <!--end::Action-->
            </form>
            @elseif($company->org_status == 1)
            <div class=" d-inline ">
                <div class="mt-5 text-center">
                    <img src="{{asset('public/images/check-correct.gif')}}" alt="" height="127px">
                    <h1 class="mt-3"><b>Your account is approved.</b></h1>
                </div>
            </div>
            @endif

		</div>



    </div>
    <!-- list and filter end -->
</section> 
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

@endsection
<script>

    var app_path = '{{ env("APP_PATH") }}'
</script>


@section('page-script')
  {{-- Page js files --}}
    <script src="{{ asset('js/scripts/pages/signature.js') }}"></script>

  <script src="{{ asset('js/scripts/pages/app-mail-contract.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection







