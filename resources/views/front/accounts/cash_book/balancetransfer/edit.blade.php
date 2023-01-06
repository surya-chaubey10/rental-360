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
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
 
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <form class="add-manage-booking modal-content pt-0 form-block invoice-repeater" autocomplete="off" id="booking_form" method="post">
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;">Edit Balance Transfer</h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">save </button>
                </div><hr> 
        
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                            
                                <div class="row">
                                <div class="col-md-12">
                                <div class="mb-1">
                                      <label class="form-label" for="pickup_date_time-column">Transfer Reason*</label>
                                      <input type="text" id="transfer" class="form-control" value="" placeholder="Regular Transfer" name="pickup_date_time" /> 
                                    </div>
                                    </div>
                                    
                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle-column">From Account*</label>
                                      <div class="mb-1">
                                      <input type="text" id="transfer" class="form-control" value="" placeholder="Cash[CASH-0001]" name="pickup_date_time" />
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle-column">To Account*</label>
                                      <div class="mb-1">
                                      <input type="text" id="transfer" class="form-control" value="" placeholder="Dutch Bangla Bank" name="pickup_date_time" readonly/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle-column">Available Balance</label>
                                      <div class="mb-1">
                                      <input type="text" id="transfer" class="form-control" value="" placeholder="666455" name="pickup_date_time" readonly/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_vehicle-column">Amount</label>
                                      <div class="mb-1">
                                      <input type="text" id="transfer" class="form-control" value="" placeholder="1000" name="pickup_date_time" />
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="pickup_date_time-column">Date</label>
                                      <input type="date" id="pickup_date_time" class="form-control" value="" name="pickup_date_time" /> 
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="mb-1">
                                      <label class="form-label" for="select_driver-column">Status</label>
                                      <div class="mb-1">
                                        <select class="form-select dropdown-toggle" id="select_driver" name="select_driver">
                                          <option value="Active"> Active</option>
                                           
                                        </select>
                                      </div>
                                    </div>
                                  </div>
  
                                  </div><div class="col-md-12">
                                     <label class="form-label" for="note-column">Note</label>
                                       <textarea
                                          class="form-control"
                                          id="note"
                                          rows="3"
                                          name="note"
                                          placeholder=" "
                                        ></textarea>
                                   </div>  
                                 </div>
                                  
                                 <div class="card-header">
                  <h4 style="font-size: 1.486rem;"></h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-secondary waves-effect"><i data-feather='rotate-cw'></i> &nbsp; Reset  </button>
                </div>
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
      </div> 
      </form>
      <!-- /Invoice table -->
    </div>
    <!--/ User Content -->
  </div>
</section>
<!--   -->
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
  <script src="{{ asset('js/scripts/pages/balance-transfer-list.js') }}"></script>  
  <script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 