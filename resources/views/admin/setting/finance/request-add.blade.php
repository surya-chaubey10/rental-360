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
  <div class="row"> 
      <div class="card">  
              <div class="card-body border-bottom">  
               <form class="add-brand-type modal-content pt-0 form-block form-block" autocomplete="off" id="addvehiclebrand" method="post">  
                <div class="card-header">
                  <h4 >Request </h4>    
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Send</button>
                </div>  
              </div>  
           
              <div class="card-body">
                <section id="multiple-column-form">  
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Release For*</label> 
                        <input
                          type="text"
                          id="request-name-column"
                          class="form-control"
                          value=""
                          name=""   
                        />
                      </div> 
                    </div> 
					
					
					
					 <div class="col-md-6 col-6"> 
                      <div class="mb-2"> 
                        <label class="form-label"  for="vendor-name-column">Vendor Name*</label>    
                      <select class="form-select" data-mini="true" name="vendor_name"  aria-label="Default select example"> 
					  <option value="raj"> </option>
					  <option value="arun"> </option>
					  <option value="surya"> </option> 
					  </select> 
                      </div>
                    </div> 
					
					
					 <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Amount*</label>  
                        <input
                          type="text"
                          id="request-name-column"
                          class="form-control"
                          value=""
                          name="request-name-column"   
                        />
                      </div>
                    </div> 
					
					 <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="file">Attachments*</label> 
                        <input
                          type="file"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name=""   
                        />
                      </div>
                    </div> 
					
					
					 <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="file">Comments*</label>  
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          name=""   
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

 