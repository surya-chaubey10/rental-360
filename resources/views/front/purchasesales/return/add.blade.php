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
               <form class=" pt-0 form-block form-block" autocomplete="off" id="" >  
                <div class="card-header">
                  <h3><b>Create Purchase Return</b></h3>       
                  <button  id="" name="" type="submit" class="btn btn-danger me-1 ">Submit</button>    
                </div>  
              </div>  
           
              <div class="card-body">
                <section id="multiple-column-form">   
                  <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="po-name-column"><b>Return Reason*</b></label>    
                        <input
                          type="text"
                          id=""
                          class="form-control"
                          value=""
                          name=""   
                        />
                      </div>
                    </div> 
					
					
					
					 <div class="col-md-6 col-6">
                      <div class="mb-2">
                        <label class="form-label" for="products-name-column"><b>Supplier*</b> </label>   
                       <select class="form-select"   id=""   value="" name="" aria-label="Default select example">
					   <option value="volvo">Volvo</option>
                      <option value="saab">Saab</option>
                      <option value="vw">VW</option>
                      <option value="audi" selected>Audi</option>  
                      </select>
                      </div>
                    </div>
					
					
					
					 <div class="col-md-12 col-12">  
                      <div class="mb-2">
                        <label class="form-label" for="products-name-column"><b>Select products*</b> </label>   
                       <select class="form-select"   id=""   value="" name="" aria-label="Default select example">
					   <option value="volvo">Volvo</option>
                      <option value="saab">Saab</option>
                      <option value="vw">VW</option>
                      <option value="audi" selected>Audi</option>  
                      </select>
                      </div>
                    </div>


					
                    <div class="col-md-12 col-12" >      
                      <div class="mb-2">
                        <label  class="form-label" for="note-name-column"><b>Note</b></label>  
                    <textarea class="form-control" rows="3" id="" name=""  
                     placeholder=""   >
		             </textarea>
                      </div>
                    </div>  
					
					
					
				    <div class="col-md-6 col-6">  
                      <div class="mb-2">
                        <label for="startDate"><b>Return Date</b></label>
                        <input id="startDate" class="form-control" type="date" />   
                      </div>
                    </div> 

					
					 <div class="col-md-6 col-6">  
                      <div class="mb-2">
                        <label class="form-label" for=""><b>Status</b></label>    
                       <select class="form-select"   id=""   value="" name="status_type_name" aria-label="Default select example"> 
					  <option>Active</option>
                      <option>Inactive</option> 
                      </select>
                      </div>
                    </div> 
					

                    <input type="hidden" id="purchases_updated_id" class="form-control" value="" placeholder="Name" name="purchases_updated_id" /> 
                                   
                 
                   </section>   
                   <div style=" margin-left:93%;">
                  <button type="button" class="btn btn-dark class-right">Reset</button>  </div>             
				
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

 