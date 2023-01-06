@extends('layouts.main')        
@section('title', '')  
 
 
@section('front-style')         
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
 
<section class="app-user-view-account form-block">
  <div class="row"> 
      <div class="card">  
              <div class="card-body border-bottom"> 
               <form class=" pt-0 add-promotion-form " autocomplete="off" id="promotion_form"  method="post">  
                <div class="card-header">
                  <h3><b>Create Promotion</b></h3>                
                   </div>  
                   <hr>     
                  <div class="row">                 
					           <div class="col-md-6 col-6">      
                      <div class="mb-2">
                        <label class="form-label" for="products-name-column"><b>From Date</b> </label>      
                        <input    id="startDate" class="form-control" name="from_date" type="date"min="<?php echo date('Y-m-d'); ?>" />
                      </div> 
                    </div>

                    <div class="col-md-6 col-6">
                      <div class="mb-2">
                      <label class="form-label" for="products-name-column"><b>To Date</b> </label>      
                      <input    id="startDate" class="form-control"name="to_date" type="date" min="<?php echo date('Y-m-d'); ?>"  />
                      </div>
                    </div> 
                    

                    <div class="col-md-6 col-6">   
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Code</b></label> 
                        <input
                          type="text"
                          id=""
                          class="form-control"
                          value="{{$code}}"
                          name="promotion_code"					  
                        readonly />     
                      </div>
                    </div> 

                    <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="name-column"><b>Status</b> </label>      
                       <select class="form-select"   id=""   value="" name="status" aria-label="Default select example">
					            <option value="1">Active</option>
                      <option value="2">Inactive</option>
                      </select>
                      </div>
                    </div>   

                    
                    <div class="col-md-6 col-6">     
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Type</b></label> 
                        <select class="form-select"   id=""   value="" name="promotion_type" aria-label="Default select example">
					            <option value="1">Flat</option>
                      <option value="2">Percentage</option>
                      </select>
                      </div>
                    </div>
                     
                    <div class="col-md-6 col-6">     
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Value</b></label> 
                        <input
                          type="number"
                          id=""
                          class="form-control"
                          value=""
                          name="promotion_value"					  
                        />     
                      </div>
                      
                    </div>  
              <div>
              <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block" style="margin-left:47%;" >Submit</button>  

              </div>

                   </section>   
                   
                  <!-- <button type="button" class="btn btn-dark " style="float:right">Reset</button>                   -->
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
  <script src="{{ asset('js/scripts/pages/app-promotion.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script> 
  
@endsection

 