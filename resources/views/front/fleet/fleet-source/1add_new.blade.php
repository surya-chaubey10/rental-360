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
  <link rel="stylesheet" href="{{ asset('vendors/css/image-uploader.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection
<style>
  .iti {
    width: 100%;
  }
</style>
@section('content')
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
          <form class="add-page1-brand modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">
          @if($inventory_data->count() > 0)  
              <input type="hidden" value="{{$inventory_data[0]->brand_id}}" id="brand_id" class="form-control" name="brand_id" />
              <input type="hidden" value="{{$inventory_data[0]->model_id}}" id="model_id" class="form-control" name="model_id" />
              <input type="hidden" value="{{$inventory_data[0]->id}}" id="inventory_id" class="form-control" name="inventory_id" />
          @else  
                 <input type="hidden" value="{{$brand}}" id="brand_id" class="form-control" name="brand_id" />
                <input type="hidden" value="{{$model}}" id="model_id" class="form-control" name="model_id" />
                <input type="hidden" value="" id="inventory_id" class="form-control" name="inventory_id" />
          @endif  
            <div class="card-header">
              <h4 style="font-size: 1.750rem; margin-left: "><b>Fleet</b></h4>
              
            </div>
            <hr>
                 <div class="row fleetpage1">
                      <div class="row" >
                        <div class="col-md-12">
                          <div class="input-field">
                            <label class="active">Image</label>
                            <div class="input-images-1" style="padding-top: .5rem;"></div>   
                          </div>
                        </div>
                     </div> 
                    <br>
                        <div class="row" style="margin:2% 0 0 -1%">
                         <div class="col-md-12">
                           <div class="mb-1">
                              <label class="control-label" for="description-column">Meta Description</label>
                              <div class="mb-2">
                              @if($inventory_data->count() > 0)  
                                  <textarea class="form-control" id="description" rows="3" name="description" value="">{{ $inventory_data[0]->meta_description}}</textarea>
                              @else  
                                  <textarea class="form-control" id="description" rows="3" name="description" value=""></textarea>
                              @endif  
                                
                              </div>
                            </div>
                         </div> 
                      </div>

                        <div class="row  ">
                          <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" style="margin: 0 0 0 -1%;"  data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false"
                            aria-controls="accordionTwo">  Features </button>
                            </h2>     
                                <div id="accordionTwo" class="accordion-collapse collapse show"  aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
                                    <div class="row" style="font-size:12px;">
                                    @if($inventory_data->count() > 0)  
                                        @php
                                          $values = explode(',',$inventory_data[0]->feature_id);
                                        @endphp
                                        @foreach($features as $teast)  
                                        <div class="col-md-3 col-md-4">                       
                                          <input class="form-check-input" {{in_array($teast->id,$values) ? 'checked' : ''}}  type="checkbox" name="chechbox[]" id="inlineCheckbox1" value="{{$teast->id}}">
                                          <label class="form-check-label" for="inlineCheckbox1"> {{$teast->feature_name}}</label>
                                        </div>
                                        @endforeach  
                                    @else  
                                        @foreach($features as $teast)  

                                        <div class="col-md-3 col-md-4">                       
                                          <input class="form-check-input" type="checkbox" name="chechbox[]" id="inlineCheckbox1" value="{{$teast->id}}">
                                          <label class="form-check-label" for="inlineCheckbox1"> {{$teast->feature_name}}</label>
                                        </div>

                                         @endforeach  
                                    @endif  
                                        
                                    </div>
                                </div>
                          </div>
                          </div>
                          <div class="row" style="margin-top: 2%;">
                          <div class="mb-1">
                            <label class="form-label" for="exampleFormControlTextarea1">Booking Conditions</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name="bookingconditions" value=""></textarea>
                          </div>  

                        </div> 
                          <hr>





                          <div class="row">
                    <div class="col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                      <label class="form-label" for="startdate"><b>Insurance Provider</b></label><br>
                       <select class="select2 form-select brand-name" id="insurance_provider" name="insurance_provider">
                        <option value="1">Oman</option>
                        <option value="2">AXA Insurance</option>  
                        <option value="3">Al Sagr</option> 
                        <option value="4">Al Fujairah National Insurance Company</option>
                        <option value="5">Noor Takaful Insurance</option>   
                        <option value="6">Adamjee Insurance</option>   
                        <option value="7">Tokio Marine Insurance</option>   
                        <option value="8">Abu Dhabi National Takaful</option>   
                        <option value="9">Salama Takaful Insurance</option>   
                        <option value="10">RSA Insurance</option>   
                        <option value="11">Others</option>  
                       </select>  
                      </div>
                      </div>
                    </div>
                    
                  
                    <div class=" col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                      <label class="form-label" for="drop_off_date_time-column"><b>Insurance Expire Date</b></label> 
                           <input type="date" name="insurance_Expire_date" id="insurance_Expire_date" class="form-control" value="" placeholder="Date" min="<?php echo date('Y-m-d'); ?>" /> 
                      </div>
                    </div>           
                  </div>  
                </div>
						  
						  
                     <!-- <div class="col-md-6 col-12">  
                     <div class=" col-md-12 ">
                      <label class="select2-selection select2-selection--single" for="startdate"><b>Insurance Provider</b></label>
                       <select class="select2 form-select brand-name" id="insurance_provider" name="insurance_provider" style="width:;" >
                        <option value="1">Bajaj Allianz Life Insurance Co. Ltd.	</option>
                        <option value="2">SBI Life Insurance Co. Ltd.	</option>  
                        <option value="3">TATA-AIA Life Insurance Co. Ltd.</option> 
                        <option value="4">Max Life Insurance Co. Ltd	</option>
                        <option value="5">HDFC Life Insurance Co. Ltd	</option>   
                       </select>      
                      </div>   
                      </div>   
                       <div class="col-md-6 col-12">  
                        <div class="mb-1">
                          <label class="form-label" for="drop_off_date_time-column">Insurance Expire Date</label> 
                           <input type="date" name="insurance_Expire_date" id="insurance_Expire_date" class="form-control" value="" placeholder="Date" min="<?php echo date('Y-m-d'); ?>" /> 
                          </div>
					   </div>   -->

                  <div class="row">
                    <h6 style="font-size: 1.0rem;">Documents</h6>
                    <div class="col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                                <label class="form-label" for="form-control"><b>Mulkiya-Front</b></label>
                       <input type="file" class="form-control" aria-describedby="button-addon2" name="document" value="">
                      </div>
                      </div>
                    </div>
                    <div class=" col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                                <label class="form-label" for="form-control"><b>Mulkiya-Back</b></label>
                        <input type="file" class="form-control" aria-describedby="button-addon2"name="document1" value="">
                      
                      </div>
                    </div>
                    </div>
                    <div class=" col-md-6 col-sm-12 mb-2">
                    <label class="form-label" for="form-control"><b>Other Documents</b></label>
                      <div class="input-group">
                        
                        <input type="file" class="form-control" aria-describedby="button-addon2" name="document2" value=""> 
                      </div>
                    </div>
                    <div class=" col-md-6 col-sm-12 mb-2">
                    <label class="form-label" for="form-control"><b>Other Documents</b></label>
                      <div class="input-group">
                   
                        <input type="file" class="form-control"  aria-describedby="button-addon2"name="document3" value="">
                      </div>
                    </div>           
                  </div>  
                </div>
                     <div class="row fleetpage2" style="display:none">
                            <div class="demo-inline-spacing">
                              <h3>Type</h3>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  name="RadioOptions" id="inlineRadio1"  value="1" checked />
                                <label class="form-check-label" for="inlineRadio4">Owned</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions" id="inlineRadio2" value="2" />
                                <label class="form-check-label" for="inlineRadio2">Managed</label>
                              </div>
                            </div>
                               <hr style="margin-top:2%">
                            <br>

                            <div class="row Ownership-Info" style="display:none">
                              <h4 class="card-title">Ownership Info.</h4>
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="credit-card">Owner Name</label>
                                <input  type="text" class="form-control" id="owner_name" value="" name="owner_name"/>
                              </div>

                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="phone-number">Phone</label>
                                <div class="input-group input-group-merge">
                                  <input type="tel" class="form-control" id="phone_number" value="" name="phone_number" />
                                </div>
                              </div>

                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="date">Email</label>
                                <input type="email" class="form-control"  id="email" value="" name="email" placeholder="demo@gmail.com" />
                              </div>

                              <div class="4 col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="time">Billing Email</label>
                                <input type="email" class="form-control" id="billing_email" value="" name="billing_email" placeholder="demo@gmail.com"/>
                              </div>
                            </div>
                              <div class="row">
                                <h4>Car Info.</h4> 
                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="numeral-formatting">SKU</label>
                                 <input type="text" class="form-control sku_num" id="sku" value="{{ isset($last_code) ? $last_code : ''; }}" name="sku" readonly />
                                 <span class="form-text text-danger" id="sku_error"></span>
                                 <!-- <label class="form-label" id="alert_message" style="font-size: 14px;color:red">This sku name is already exists</label> -->
                                 <input type="hidden" class="form-control sku_no"  value="{{ isset($last_code) ? $last_code : ''; }}" />
                              </div>

                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Year">Year</label>
                                  <input type="text" class="form-control" id="year" value="" name="year" />
                                </div>
 
                               <div class=" col-md-6 col-sm-12 mb-2">
                                 <label class="form-label" for="Service">Service Type *</label>
                                 <select class="form-select" id="service_type" name="service_type" aria-invalid="false">
                                    <option value="1">Self Drive</option>
                                    <option value="2">Car with Driver</option>
                                    <option value="3">Limousine</option>
                                  </select>
                               </div>
       
                                <div class="col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Colors">Color</label>
                                  <input type="text" class="form-control"  id="color" name="color" value=""/>
                                </div>

                                <div class=" col-md-3 col-sm-6 mb-2">
                                  <label class="form-label" for="Number">Prefix</label>
                                  <input   type="text" class="form-control prefix_no" id="prefix" oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*?)\..*/g, '$a');" name="prefix" value="" maxlength="2" />
                                  
                                </div>
                                <div class=" col-md-3 col-sm-6 mb-2">
                                  <label class="form-label" for="Number">Number Plate</label>
                                  <input  type="number" class="form-control num_plate" id="number_plate" name="number_plate" value="" />
                                </div>

                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Chasis">Chasis Number</label>
                                  <input type="text" class="form-control" id="chasis" name="chasis" value=""/>
                                </div>

                                <h4>Details</h4>
                                <div class="col-md-6  ">
                                  <label class="form-label" for="allowed">Allowed KM.</label>
                                  <input type="text" class="form-control" id="allowed" name="allowed" value="" required/>  
                                </div>
                              </div> 

                             <div class="container">
                               <div class="row">
                                 <h4 class="card-title">Pricing</h4>
                                 <div class="col-md-12 column">
                                   <table class="table table-bordered table-hover" id="tab_logic" style="margin-left:0%;width: 100%;">
                                      <thead class="table-light">
                                        <tr>
                                          <th style="width:20%;">Description</th>
                                          <th>Unit Price</th>
                                          <th>VAT - % calculation</th>
                                          <th>Sub Total</th>
                                          <th>Deposit</th>
                                          
                                        </tr>
                                      </thead>
                                        <tbody>
                                          <tr id='addr0'>
                                            <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                        <option value="1">Hourly</option>
                                                         
                                              </select></td>
                                              
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="0"  placeholder='Price' value="0" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');"type="text" name='vat[]' data-vat="0" placeholder='Vat' value="0" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_0" placeholder='Sub Total' value="0" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="0" class="form-control"/>
                                            </td>
                                            <!-- <td></td> -->
                                            </tr>
                                            <tr id='addr1'>
                                            <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                        <option value="2">Daily</option>
                                                         
                                              </select></td>
                                              
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="1"  placeholder='Price' value="0" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');"type="text" name='vat[]' name='vat[]' data-vat="1" placeholder='Vat' value="0" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_1" placeholder='Sub Total' value="0" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="0" class="form-control"/>
                                            </td>
                                            <!-- <td></td> -->
                                            </tr>
                                            <tr id='addr2'>
                                            <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                    <option value="3">Weekly</option>
                                                         
                                              </select></td>
                                              
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="2"  placeholder='Price' value="0" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');"type="text" name='vat[]'  name='vat[]' data-vat="2" placeholder='Vat' value="0" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_2" placeholder='Sub Total' value="0" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="0" class="form-control"/>
                                            </td>
                                            <!-- <td></td> -->
                                            </tr>
                                            <tr id='addr3'>
                                            <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                        <option value="4">Monthly</option>
                                                         
                                              </select></td>
                                              
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="3"  placeholder='Price' value="0" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');"type="text" name='vat[]'  name='vat[]' data-vat="3" placeholder='Vat' value="0" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_3" placeholder='Sub Total' value="0" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="0" class="form-control"/>
                                            </td>
                                            <!-- <td></td> -->
                                            </tr>                        
                                        </tbody>
                                    </table>
                                  </div> 
                                  <input type="hidden" value="1" id="rowcount" class="form-control"  />
                                </div>
                                <!-- <a herf="#" id="add_row" class="btn btn-primary add_row" style="float:left;margin-right:0%;margin-top:1%;">Add</a> -->
                              </div>
                              
                            <div class="row" style="margin-top:2%"> 
                               <h4>Others Info</h4>
                              <h6 style="margin-top:1%">Add Ons</h6>
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Child" >Child seats and others (Price in AED) </label><br>
                                <input  type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="child_sheet" name="child_sheet" value="" />
                              </div>
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Insurance">Insurance (Price in AED)</label>
                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="insurance" name="insurance" value="" />
                              </div> 
                              <div class=" col-md-6 col-sm-12 mb-2" >
                                <label class="form-label" for="Additional" >Additional Kms (Price in AED)</label>   
                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  id="additional" name="additional" value="" />
                              </div>

                              <div class=" col-md-6 col-sm-12 mb-2">
                                 <label class="form-label" for="Service">Status</label>
                                 <select class="form-select" id="Status" name="Status" aria-invalid="false">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>                                  
                                  </select>
                               </div>



                           </div>
                           
                    </div>
                    <div class="col-sm-9 offset-sm-3 Previous" style="margin-left:30%;margin-top:1%; display:none;">
                      <input class="btn btn-success priviouspage" id="id12" readonly value="Previous"> 
                      <button type="submit" id="submit" class="btn btn-danger me-1 btn-form-block submitshow  waves-effect waves-float waves-light" disabled="disabled" >Submit</button>
                    </div>
                    <div class="col-sm-9 offset-sm-3 Next" style="margin-left:30%;margin-top:1%;">
                      <input class="btn btn-success nextpage" id="id1" readonly value="Next"> 
                      <button type="submit" id="submit" class="btn btn-danger me-1 btn-form-block submitshow  waves-effect waves-float waves-light" disabled="disabled" >Submit</button>
                    </div>
                    
          </form>
         <!-- /Invoice table -->
        </div>
        <!--/ User Content -->
      </div>
    </div>
  </div>
</section>
<!--   -->
@endsection  
 

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/image-uploader.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
      
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}

 <script src="{{ asset('js/scripts/pages/app-storefleet-list.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 