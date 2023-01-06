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
        <h4 class="card-title"><b>Payroll Details</b></h4>
        <a href="{{route('invoice-save')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Print</a>

        <button class="dt-button btn btn-primary btn-add-record ms-2" style="float: right; margin-top: -45px;" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span>Print</span></button>

    </div><!-- card-body -->

    <div class="card-body border-bottom">

        <div class="col-xl-12 col-md-12 col-12">
        <div class="card invoice-preview-card">

            <!-- Address and Contact starts -->
            <div class="card-body invoice-padding pt-0">
            <div class="row invoice-spacing">

                <div class="col-xl-8 p-0">
                            <div>
                            <div class="logo-wrapper">

                                <h3 class="text-primary invoice-logo">MYRIDE</h3>
                            </div>
                            <p class="card-text mb-25"><b>Ultimate Sales, Inventory, Accounting Management System</b></p>
                            <p class="card-text mb-25"><b>Phone:</b>0170000000</p>
                            <p class="card-text mb-0"><b>Email:</b>support@codeshape.net</p>
                            <p class="card-text mb-0"><b>Address:</b>Ground Floor, Road# 24, House# 339, New DOHS,</br>
                            Mohakhali, Dhaka-1206 Bangladesh</p>
                            </div>
                </div>

                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                    <h6 class="mb-2"><b>Employee Details<b></h6>
                    <table>
                        <tbody>
                        <tr>
                            <td class="fw-bold">EMP ID</td>
                            <td>AS-2</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">EMP Name</td>
                            <td>Carla Bender</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Department</td>
                            <td>Sales</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Designation</td>
                            <td>Sales Manager</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            </div>
            <!-- Address and Contact ends -->
            <div class="card-datatable table-responsive pt-0">
            <table class="offer-list-table table">
                <thead class="table-light">
                <tr>
                    <th>EMPLOYEE</th>
                    <th>MONTH</th>
                    <th>PAID</th>
                    <th>ACCOUNT</th>
                    <th>CHEQUE NO</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                    <th>CREATED BY</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="fw-bold">Regular Transfer</td>
                    <td class="fw-bold">February</td>
                    <td class="fw-bold">$12300.00</td>
                    <td class="fw-bold">IBBL - 0002</td>
                    <td class="fw-bold">CN- 4325</td>
                    <td><span class="badge rounded-pill badge-light-success text-capitalized">Active</span></td>
                    <td class="fw-bold">14 JUl,2022 </td>
                    <td class="fw-bold">Super Admin</td>
                </tr>
                </tbody>
            </table>
            </div>
            <br><br><br>
        <div class="row invoice-spacing">
            <div class="col-xl-6 p-0">
            </div>
            <div class="col-xl-6 p-0 mt-xl-0 mt-2" >
                 <table align="center" style="margin-right: 79px;" >
                    <tbody>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Present Salary</span></td>
                        <td>$11500.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Deduction Amou:</span>nt</td>
                        <td>- $0</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Mobile Bill:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Food Bill:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Bonus:</span> </td>
                       <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Commission:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Advance:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Festival Bonus:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Travel Allowance(TA):</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><span class="fw-bold">Other:</span></td>
                        <td>+$100.00</td>
                    </tr>
                    <tr>
                        <td class="pe-5"><b>Total</b></td>
                        <td>= $12300.00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <hr>
            <a href="{{route('payroll-list')}}" class="dt-button btn btn-secondary btn-add-record ms-2" style="float: right; float: right;margin-top: 20px; margin-right: 50px;" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span>Go Back</span></a>
        </div>
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
 <!-- <script src="{{ asset('js/scripts/pages/app-user-list.js') }}"></script>  -->
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
