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
               <form class="add-service-type modal-content pt-0 form-block form-block" autocomplete="off" id="addvehicleservice" method="post"> 
                <div class="card-header">
                  <h4 >General</h4>   
                <a href="javascrip:;" id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save Setting</a> 
                </div>  
              </div>  
           
              <div class="card-body">
                <section id="multiple-column-form">   
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Company Name</label>
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="service_type_name"   
                        />
                      </div>
                    </div> 
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Company Main Domain</label> 
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="service_type_name"   
                        />
                      </div>
                    </div> 
					
					
					<div class="col-md-12 col-12">
					 <div class="mb-2">
					  <label class="form-label" for="inlineRadio1">RTL Admin Area[Right to Left]</label> </br> 
					<div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option1">
					 <label class="form-label" for="inlineRadio1">Yes</label> 
                      </div>
					   <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option1">
					    <label class="form-label" for="inlineRadio1">No</label>  
                       </div>
					 </div>
					</div>  
					
					
					<div class="col-md-12 col-12">
					 <div class="mb-2">
					  <label class="form-label" for="inlineRadio1">RTL Customer Area[Right to Left]</label> </br> 
					<div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
					 <label class="form-label" for="inlineRadio1">Yes</label> 
                      </div>
					   <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
					    <label class="form-label" for="inlineRadio1">No</label>  
                       </div>
					 </div>
					</div>
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Allowed file types</label> 
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Time Formate</label>
                       <select class="form-select"   id="service-name-column"   value="" name="general_type_name" aria-label="Default select example">
                         
                      </select>
                      </div>
                    </div>


                     <div class="col-md-12 col-12" >         
                      <div class="mb-2">
                        <label  class="form-label" for="brand-name-column"></label>     
                      <p>These information will be displayed on invoices/estimates/payments and other PDF documents where company info is reqiured 
					  <br>
				     </p>
                      </div>
                    </div>					
					
					
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Company Name</label>  
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Address</label> 
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">City</label>
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">State</label>
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Country</label>  
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Zip Code</label> 
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="general_type_name"   
                        />
                      </div> 
                    </div> 
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column">Phone</label>
                        <input
                          type="text"
                          id="general-name-column"
                          class="form-control"
                          value=""
                          placeholder=""
                          name="general_type_name"   
                        />
                      </div>
                    </div> 
					
					
					  <div class="col-md-12 col-12" >         
                      <div class="mb-2">
                        <label  class="form-label" for="general_name-column"></label>     
                      <p>Additional Company Information to diplay on invoices and estimates
					  <br>
				     </p>
                      </div>
                    </div>

				 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column"></label>   
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value="VAT No: ABG1038492"
                          placeholder="Service Name"
                          name="general_type_name"    
                        />
                      </div>
                    </div> 

                  <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column"></label>  
                        <input
                          type="text"
                          id=""
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name=""   
                        />
                      </div>
                    </div> 	
					
					
					 <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="general-name-column"></label>   
                        <input
                          type="text"
                          id="general-name-column" 
                          class="form-control"
                          value=""
                          placeholder="General Name"
                          name=""   
                        />
                      </div>
                    </div> 	

                   <div class="col-md-12 col-12">
                      <div class="mb-2">
                        <label class="form-label" for="service-name-column"></label> 
                        <input
                          type="text"
                          id="service-name-column"
                          class="form-control"
                          value=""
                          placeholder="Service Name"
                          name="service_type_name"   
                        />
                      </div>
                    </div> 						
                
                    <div class="col-md-12 col-12" >      
                      <div class="mb-2">
                        <label  class="form-label" for="brand-name-column">Company Information Formate(PDF and HTML)</label>
                    <textarea class="form-control" rows="3" id="brand-name-column" name="brand_description" 
                    placeholder="brand_description_name"   >
		             </textarea>
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

 