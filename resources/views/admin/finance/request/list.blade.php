@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
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
      <h4 class="card-title"><b>Request</b></h4>
        <a href="{{route('request-add')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Add New</a>
    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="request-list-table table">
        <thead class="table-light">
          <tr>
            
            <th>DATE</th>
            <th>VENDOR NAME</th>
            <th>CURRENT BALANCE</th>
            <th>Withdraw Fees</th>
            <th>AMOUNT REQUESTED</th>
            <th>BALANCE AFTER REQUEST</th>
            <th>ACTION</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Request</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="row">
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Vendor Name </label>
                                  <input type="text"  id="vendor_id" class="form-control" value=""  placeholder=" " name="vendor_id" /> 
                                  <input type="hidden"  id="org_id" class="form-control" value=""  placeholder=" " name="org_id" /> 
                                  <input type="hidden"  id="accepted_id" class="form-control" value="1"  placeholder=" " name="accepted_id" />
                                  <input type="hidden"  id="request_id" class="form-control" value=""  placeholder=" " name="id" />
                                  <input type="hidden"  id="debit_id" class="form-control" value="1"  placeholder=" " name="debit_id" />
                                </div>
                              </div> 

                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Balance</label>
                                  <input readonly type="text"  id="balance_id" class="form-control" value=""  placeholder=" " name="balance_id" /> 

                                </div>
                              </div>

                             
                        
                               
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Amount</label>
                                  <input readonly type="number" id="amount_id" class="form-control" value="" placeholder='0.00' name="amount" /> 

                                </div>
                              </div>
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Comments</label>
                                  <input type="text" id="description" class="form-control" value="" placeholder=" " name="description" /> 

                                </div>
                              </div>
                               
                              <div class="col-md-6 col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="file">Attachment</label>
                                  <input type="file" id="image" class="form-control" value="" placeholder="" name="image" /> 

                                </div>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Send </button>
                            <button type="reset" class="btn btn-outline-secondary cancel"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
              <!-- Modal to add new model Ends-->

               <!-- Modal to add new model starts-->
          <div class="modal new-reject-modal fade" id="modals-removeslide">
                <div class="modal-dialog" style="width: 60%;  margin: 10% 0 0 34%;" >
                    <form class="add-Queck-Payment modal-content pt-0 " autocomplete="off" id="form_model_reject" method="post"  enctype="multipart/from-data" > 
                        <div class="modal-header mb-1"> 
                            <h5 class="modal-title" id="exampleModalLabel">Reason</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="row">
                               <div class="col-12">
                                <div class="mb-1">
                                  <label class="form-label" for="full_name-column">Comments</label>
                                  <textarea type="text" id="message" class="form-control" value="" placeholder=" " name="message"> </textarea>
                                  <input type="hidden"  id="id" class="form-control" value=""  placeholder=" " name="id" />
                                  <input type="hidden"  id="accepted" class="form-control" value="2"  placeholder=" " name="accepted" />
                                </div>
                                </div>
                              </div>

                            <button type="submit" class="btn btn-primary me-1 data-submit form-block btn-form-block" id="submit">Send </button>
                            <button type="reset" class="btn btn-outline-secondary cancels"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
              <!-- Modal to add new model Ends-->

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
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  
@endsection

@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-request-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
