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
 
<section class="app-user-view-account">
  
      <div class="card">  
              <div class="card-body border-bottom"> 
               <form class="modal-content pt-0 form-block form-block" autocomplete="off" id=""> 
               <div class="card-body border-bottom">
                <div class="card-header">
               
                  <h4 ><b>Cron Jobs<b></h4>    
                  <a  href="javascript:;" name="submit1" type="submit1" class="btn btn-danger me-1 ">Save Setting</a>
                </div>  
                </div>  
              
             
                    <div class="col-md-12 col-12" >         
                      <div class="mb-2">
                        <label  class="form-label" for="brand-name-column"></label>     
                      <p>CRON COMMAND:wget -q -o- https//perform.com/democron/index
					          <br>
				                       <a href="http://localhost:8000/product/1">Run Cron Manually</a></p>
                      </div>
                    </div>
                    
					

					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="ftuy">Hour of day to perform automatic operations</label>   
                        <input class="form-control" type="number" id="quantity" name="" min="1" max="24">   
                      </div> 
                    </div>   
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="ftuy">How much emails to send per hour</label>  
                        <input
                          type="number" 
                          id="service-name-column"
                          class="form-control"
                          value=""
                          name="service_type_name"
                          min="0" max="1000"						  
                        />
                      </div> 
                    </div>  
					
					
                    <input type="hidden" id="service_updated_id" class="form-control" value="" placeholder="Name" name="service_updated_id" /> 
                                   
                  
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
 <script src="{{ asset('js/scripts/pages/service-list.js') }}"></script>    
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>  
@endsection

 