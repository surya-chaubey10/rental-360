@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')

<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title"><b>Edit Invoice Payment</b></h4>
        <a href="{{route('invoice-save')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Submit</a>

    </div><!-- card-body -->

    <div class="card-body border-bottom">

        <div class="row"><!--top-row-start-->

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                    <label class="form-label" for="dateTo">Invoice No *</label>
                    <input type="text" class="form-control" id="dateTo" placeholder="AI-6" readonly>
                </div>
                </div>

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                    <label class="form-label" for="dateTo">Invoice Total</label>
                    <input type="text" class="form-control" id="dateTo" placeholder="0" readonly>
                </div>
                </div>

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                    <label class="form-label" for="dateTo">Total Due</label>
                    <input type="text" class="form-control" id="dateTo" placeholder="0" readonly>
                </div>
                </div>

                <div class="col-xl-6 col-md-6 col-6">
                <div class="mb-1">
                        <label class="form-label" for="dateTo">Account *</label>
                        <select class="form-select" id="account" name="account" placeholder="Select">
                            <option>Select an account</option>
                            <option>Account 1</option>
                            <option>Account 2</option>
                            <option>Account 3</option>
                        </select>
                </div>
                </div>


                <div class="col-xl-3 col-md-3 col-3">
                <div class="mb-1">
                    <label class="form-label" for="checkNo">Cheque No</label>
                    <input type="text" class="form-control" id="checkNo" placeholder="">
                </div>
                </div>

                <div class="col-xl-3 col-md-3 col-3">
                <div class="mb-1">
                    <label class="form-label" for="receiptNo">Receipt No</label>
                    <input type="text" class="form-control" id="receiptNo" placeholder="">
                </div>
                </div>

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                    <label class="form-label" for="receiptNo">Payment Amount *</label>
                    <input type="text" class="form-control" id="receiptNo" placeholder="">
                </div>
                </div>

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                    <label class="form-label" for="paymentDate">Payment Date</label>
                    <input type="date" class="form-control" id="paymentDate" placeholder="0">
                </div>
                </div>

                <div class="col-xl-4 col-md-4 col-4">
                <div class="mb-1">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status" placeholder="Select">
                            <option>Active</option>
                            <option>Inactive</option>

                        </select>
                </div>
                </div>

                <div class="col-xl-12 col-md-12 col-12">
                <div class="mb-5">
                        <label class="form-label" for="noteTextarea">Note</label>
                        <textarea class="form-control" id="noteTextarea" rows="3" placeholder=""></textarea>
                </div>
                </div>



        </div><!--top-row-end-->
        
        <div class="mb-4">
        <a href="{{route('invoice-edit')}}" class="btn btn-xs btn-secondary" style="float: right; margin-top: -45px;" >Reset</a>
        </div>



    </div><!-- card-body -->
  </div><!-- card end -->

  

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
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-user-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
