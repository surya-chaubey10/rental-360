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
            <h4 class="card-title"><b>Invoice Payment Details</b></h4>

            <button class="dt-button btn btn-primary btn-add-record ms-2" style="float: right; margin-top: -45px;" tabindex="0" aria-controls="DataTables_Table_0" type="button"><i data-feather="printer"></i><span>  Print</span></button>

        </div><!-- card-body -->

        <div class="card-body border-bottom">


            <!-- Address and Contact starts -->
            <div class="row invoice-spacing">

                <div class="col-xl-8 p-0">
                            <div>
                            <div class="logo-wrapper">

                                <h3 class="text-primary invoice-logo">MYRIDE</h3>
                            </div>
                            <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                            <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                            <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                </div>

                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                    <h6 class="mb-2">Supplier Details:</h6>
                    <table>
                        <tbody>
                        <tr>
                            <td class="pe-1">Supplier ID</td>
                            <td><span class="fw-bold">AS-2</span></td>
                        </tr>
                        <tr>
                            <td class="pe-1">Supplier Nmame</td>
                            <td>Carla Bender</td>
                        </tr>
                        <tr>
                            <td class="pe-1">Company Name</td>
                            <td>Richardan Inc</td>
                        </tr>
                        <tr>
                            <td class="pe-1">Email</td>
                            <td>jondoe@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="pe-1">Contact No.</td>
                            <td>+1 (546) 502-644</td>
                        </tr>
                        <tr>
                            <td class="pe-1">Address</td>
                            <td>Eus prefendis aut</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- Address and Contact ends -->

            <hr class="invoice-spacing">

            <h6 class="mb-2"><b>Payment Details</b></h6>

        </div><!-- card-body -->


        <div class="table-responsive border-bottom">
        <table class="table">
            <thead>
                <tr>
                <th class="text-nowrap">INVOICE NO</th>
                <th class="text-nowrap">INVOICE DATE</th>
                <th class="text-nowrap">INVOICE TOTAL</th>
                <th class="text-nowrap">PAID AMOUNT</th>
                <th class="text-nowrap">ACCOUNT</th>
                <th class="text-nowrap">PAYMENT DATE</th>
                </tr>
            </thead>
            <tbody>

                <tr class="">
                <td class="py-1">
                    <p class="card-text ">APP-5</p>
                </td>
                <td class="py-1">
                    <p class="card-text ">30th Apr, 2022</p>
                </td>
                <td class="py-1">
                    <p class="card-text ">$28836.50</p>
                </td>
                <td class="py-1">
                    <p class="card-text ">$35000.50</p>
                    
                </td>
                <td class="py-1">
                    <p class="card-text ">Dutch Bangala Bank[DBBL-003]</p>
                    
                </td>
                <td class="py-1">
                    <p class="card-text ">14th Jul, 2022</p>
                    
                </td>
                </tr>
            </tbody>
        </table>
        </div><!-- table-responsive -->

        <div class="row">
            <div class="col-xl-8 p-0 ">
            <div class="card-body " >

            <div class="table-responsive border-bottom">
            <table class="table">
                <thead>
                    <tr>
                    <th class="py-1">CHEQUE NO</th>
                    <th class="py-1">RECEIPT NO</th>
                    <th class="py-1">NOTE</th>
                    <th class="py-1">CREATED BY</th>
                    <th class="py-1">STATUS</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                    <td class="py-1">
                        <p class="card-text text-nowrap">CN-001</p>
                    </td>
                    <td class="py-1">
                        <p class="card-text text-nowrap">No-001</p>
                    </td>
                    <td class="py-1">
                        <p class="card-text text-nowrap">----</p>
                    </td>
                    <td class="py-1">
                        <p class="card-text text-nowrap">Super Admin</p>
                        
                    </td>
                    <td class="py-1">
                        <p class="card-text text-nowrap badge bg-light-success">Active</p>
                        
                    </td>

                    </tr>
                </tbody>
            </table>
            </div><!-- table-responsive -->

            </div><!-- card-body -->
            </div><!-- xl-8 -->

            <div class="col-xl-4 p-0 ">
            <div class="card-body " >


                <table>
                    <tbody>
                    <tr style="margin-bottom: 20px;">
                        <td class="pe-1">Subtotal:</td>
                        <td style="float: right;" ><span class="fw-bold">$58600.00</span></td>
                    </tr>
                    <tr>
                        <td class="pe-1">Cost of Return Product:</td>
                        <td style="float: right;"><span class="fw-bold">-$11235.00</span></td>
                    </tr>
                    <tr>
                        <td class="pe-1">Discount:</td>
                        <td style="float: right;"><span class="fw-bold">$28</span</td>
                    </tr>
                    <tr>
                        <td class="pe-1">Transport:</td>
                        <td style="float: right;"><span class="fw-bold">$0</span></td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="pe-1">Tax:</td>
                        <td style="float: right;"><span class="fw-bold">21%</span></td>
                    </tr>
                    <tr class="text-black">
                        <td class="pe-1 "><span class="fw-bold">Total</span></td>
                        <td style="float: right;"><span class="fw-bold">$1690</span></td>
                    </tr>
                    <tr class="text-success">
                        <td class="pe-1"><span class="fw-bold">Total Paid</span></td>
                        <td style="float: right;"><span class="fw-bold">-$1690</span></td>
                    </tr>
                    <tr class="text-danger">
                        <td class="pe-1"><span class="fw-bold">Due</span></td>
                        <td style="float: right;"><span class="fw-bold">$64460.00</span></td>
                    </tr>
                    <tr class="text-secondary">
                        <td class="pe-1"><span class="fw-bold">Account Payable:</span></td>
                        <td style="float: right;"><span class="fw-bold">$6163.50</span></td>
                    </tr>
                    </tbody>
                </table>

            </div><!-- card-body -->
            </div><!-- xl-8 -->
        </div>

        <div class=" card-body border-top">


        <a href="{{route('invoice-list')}}" class="btn btn-secondary ms-2" style="float: right;" type="button"><span>Go Back</span></a>

        </div>



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
