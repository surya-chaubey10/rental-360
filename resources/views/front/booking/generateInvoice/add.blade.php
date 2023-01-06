@extends('layouts.main')
@section('title', 'Generate Invoice')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection

@section('content')
    <section class="app-user-list">
       
        <!-- list and filter start -->
        <div class="card">
            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in new-invoice-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                    <form class="add-invoice-user modal-content pt-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Add Payment For Booking</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="user-role">Income Type</label>
                                <select id="user-role" class="select2 form-select">
                                    <option value="">Select Type</option>
                                    <option value="author">Ordinary Income</option>
                                    <option value="admin">Capital Gain Income</option>
                                    <option value="editor">Tax-exempt Income</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="user-role">Type Of Day</label>
                                <select id="user-role1" class="select2 form-select">
                                    <option value="subscriber">Select</option>
                                    <option value="subscriber">Weekdays</option>
                                    <option value="editor">Weekend Days</option>
                                    <option value="subscriber">Holidays</option>
                                    <option value="editor">All Days</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" >Trip Mileage(km)</label>
                                <input type="text" id="basic-icon-default-email" class="form-control"
                                     name="user-email" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" >Waiting time(in minutes)</label>
                                <input type="text" id="basic-icon-default-contact" class="form-control"
                                     name="user-contact" />
                            </div>
                            <div class="mb-1">
                            <label for="validationCustomUsername" class="form-label">Total Tax(%)</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">%</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="">
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>
                            <div class="mb-1">
                            <label for="validationCustomUsername" class="form-label">Total Tax Charges</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">₹</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="">
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>
                            <div class="mb-1">
                            <label for="validationCustomUsername" class="form-label">Amount</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">₹</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="">
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>
                            <div class="mb-1">
                            <label for="validationCustomUsername" class="form-label">Total Amount</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">₹</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="">
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" >Date</label>
                                <input type="date" id="date" class="form-control"
                                     name="date" />
                            </div>

                            <button type="submit" class="btn btn-danger me-1 data-submit">Generate Invoice</button>
                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal to add new user Ends-->
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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/app-generate-invoice.js') }}"></script>
@endsection
