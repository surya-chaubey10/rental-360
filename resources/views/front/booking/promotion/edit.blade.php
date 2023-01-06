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
 
<section class="app-user-view-account form-block" >
  <div class="row">      
    <div class="card">  
        <div class="card-body "> 
               <form class=" pt-0 update-promotion-form " autocomplete="off" id="promotion_form"  method="post">  
                <div class="card-header">
                  <h3><b>Update Promotion</b></h3>                
                     
                   </div>  
                   <hr>     
                  <div class="row" >                 
					           <div class="col-md-6 col-6">      
                      <div class="mb-2">
                        <label class="form-label" for="products-name-column"><b>From Date</b> </label>      
                        <input    id="from_date" class="form-control" value="{{$data->from_date}}" name="from_date" type="date"min="<?php echo date('Y-m-d'); ?>" />
                      </div> 
                    </div>

                    <div class="col-md-6 col-6">
                      <div class="mb-2">
                      <label class="form-label" for="products-name-column"><b>To Date</b> </label>      
                      <input    id="to_date" class="form-control"name="to_date" value="{{$data->to_date}}" type="date" min="<?php echo date('Y-m-d'); ?>"  />
                      </div>
                    </div> 
                    <input type="hidden" id="updated_id" class="form-control" value="{{$data->id}}"  name="updated_id" />     

                    <div class="col-md-6 col-6">   
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Code</b></label> 
                        <input
                          type="text"
                          id="promotion_code"
                          class="form-control"
                          value="{{$data->promotion_code}} "
                          name="promotion_code"					  
                        readonly />     
                      </div>
                    </div> 

                    <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="name-column"><b>Status</b> </label>      
                       <select class="form-select"   id="status"   value="status" name="status" aria-label="Default select example">
                       <option {{ $data->status==1 ? 'selected':''}} value="1">Active </option> 
                       <option {{ $data->status==2 ? 'selected':''}} value="2">Inactive </option> 
                      </select>
                      </div>
                    </div>   

                    
                    <div class="col-md-6 col-6">     
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Type</b></label> 
                        <select class="form-select"   id="promotion_type"   value="promotion_type" name="promotion_type" aria-label="Default select example">
                       <option {{ $data->promotion_type==1 ? 'selected':''}} value="1">Flat </option> 
                       <option {{ $data->promotion_type==2 ? 'selected':''}} value="2">Percentage </option> 
                      </select>
                      </div>
                    </div>
                     
                    
                    <div class="col-md-6 col-6">     
                      <div class="mb-2"> 
                        <label for="startDate"><b>Promotion Value</b></label> 
                        <input
                          type="number"
                          id="promotion_value"
                          class="form-control"
                          value="{{$data->promotion_value}}"
                          name="promotion_value"					  
                        />     
                      </div>
                 
                      <div>
                    <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block" style="margin-left: -14%;;">Update Promotion</button>  
                    </div>    
                    </div>

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
  <script src="{{ asset('js/scripts/pages/app-update-promotion.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>  
@endsection

 