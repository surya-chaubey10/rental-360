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
               <form class="add-expense-subcategory modal-content pt-0 form-block form-block" autocomplete="off" id="addexpense-subcategory" method="post" enctype="multipart/from-data" > 
                <div class="card-header">
                  <h4 >Create an Expense Sub Category </h4>
                  <a href="{{route('expense-subcategory-list')}}"  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</a>
                </div> 
              </div> 
           
              <div class="card-body">
                <section id="multiple-column-form"> 
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="subcategory_name-column">Name</label>
                        <input type="text" class="form-select" id="subcategory_name" name="subcategory_name">
                        
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="category_name-column">Category Name</label>
                        <select   class="form-select" id="category_name" name="category_name">
                        <option  value=" ">Select a category</option>
                        <option  value="1">New category</option>
                            <option  value="2">Inactive</option> 
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-12"> 
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
                    
                   
                    
                    <p align="right">
            <button   class="btn btn-secondary" type="reset" class=" btn btn-outline-secondary" data-bs-dismiss="modal text text-right" >Reset</button>
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
 <script src="{{ asset('js/scripts/pages/expense-subcategory-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

