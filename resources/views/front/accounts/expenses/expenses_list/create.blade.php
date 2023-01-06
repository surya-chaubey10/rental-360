@extends('layouts.main')
@section('title', '')
 
 
@section('offer-category-style')
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
      <div class="card">  
              <div class="card-body border-bottom">
               <form class="add-expenses modal-content pt-0 form-block form-block" autocomplete="off" id="addexpenses" method="post" enctype="multipart/from-data" > 
                <div class="card-header">
                  <h4 >Create an Expense </h4>
                  <a  href="{{route('expenses-list')}}" id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</a>
                </div> 
              </div> 
           
              <div class="card-body">
                <section id="multiple-column-form"> 
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="expense_reason-column">Expense Reason</label>
                        <select class="form-select" id="expense_reason" name="expense_reason">
                        <option  value=" "> </option>
                            <option  value="1">Car </option>
                            <option  value="2">Other </option>
                            
                          </select>
                      </div>
                    </div>

                    <div class="col-md-6 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="category_name-column">Category Name</label>
                        <div class="mb-1">
                          <select class="form-select" id="category_name" name="category_name">
                          <option  value=" "> Select a Category</option>
                            <option  value="1"> Rental</option>
                            <option  value="2">Other </option>
                            
                          </select>
                        </div>
                      </div>
                    </div>   

                    <div class="col-md-6 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="account-column">Account</label>
                        <div class="mb-1">
                          <select class="form-select" id="account" name="account">
                          <option  value=" "> </option>
                            <option  value="1">Axis Bank</option>
                            <option  value="2">Other </option>
                            
                          </select>
                        </div>
                      </div>
                    </div>   

                    <div class="col-md-6 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="available_balance-column">Available Balance</label>
                        <div class="mb-1">
                          <input class="form-control" id="available_balance" name="available_balance" type="text" placeholder="0" readonly="readonly">
                           
                        </div>
                      </div>
                    </div>   
                    
                    <div class="col-md-4 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="amount-column">Amount</label>
                        <div class="mb-1">
                          <input type="number" class="form-select" id="amount" name="amount" >
                            
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-4 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="cheque_no-column">Cheque No</label>
                        <div class="mb-1">
                          <input type="text" class="form-select" id="cheque_no" name="cheque_no">
                             
                        </div>
                      </div>
                    </div>  
                    <input type="hidden" id="updated_id" class="form-control" value="" placeholder="Name" name="updated_id" /> 
                                   
                   <div class="col-md-4 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="voucher_no-column">Voucher No</label>
                        <div class="mb-1">
                          <input type="text" class="form-select" id="voucher_no" name="voucher_no">
                            
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-12 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="description-column"> Note</label>
                        <div class="mb-1">
                          <textarea
                            class="form-control"
                            id="description"
                            rows="3"
                            name="description"
                            placeholder=" "
                          ></textarea>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-4 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="expense_date-column">Date</label>
                        <div class="mb-1">
                          <input class="form-select" id="expense_date" name="expense_date" type="date">
                            
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-4 col-12"> 
                      <div class="mb-1">
                        <label class="form-label" for="status-column">Status</label>
                        <div class="mb-1">
                          <select class="form-select" id="status" name="status">
                            <option  value="1">Active</option>
                            <option  value="2">Inactive</option> 
                          </select>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-4 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="expense_image-column"> Image</label>
                        <input
                          type="file"
                          id="expense_image-column"
                          class="form-control"
                          value=""
                          placeholder=" Image"
                          name="expense_image"   
                        />
                      </div>
                    </div>
                    <p align="right">
            <button   class="btn btn-secondary" type="reset" class="col-1 btn btn-outline-secondary" data-bs-dismiss="modal text text-right" >Reset</button>
                    </p>
                </section>  
      </form> 
    </div> 
  </div>
</section>   
@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}   
 <script src="{{ asset('js/scripts/pages/expenses-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

