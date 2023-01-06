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
    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
          <form class="update-page1-brand modal-content pt-0 form-block" autocomplete="off" id="updated_idd" method="post" enctype="multipart/form-data">
          <input type="hidden" value="{{$brand}}" id="brand_id" class="form-control" name="brand_id" />
          <input type="hidden" value="{{$model}}" id="model_id" class="form-control" name="model_id" />
          <input type="hidden" value="{{$get_data->id}}" id="updated_id" class="form-control" name="updated_id" />
          <input type="hidden" value="{{$get_data->type}}" id="type_id" class="form-control" name="type_id" />
            <div class="card-header">
              <h4 style="font-size: 1.750rem; margin-left:-2%;"><b>Fleet</b></h4>
                      
            </div>
            <hr>
                 <div class="row fleetpage1">
                      <div class="row" > 
                        <div class="col-md-12">
                          <div class="input-field">
                            <label class="active">Images</label>
                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                          </div>
                        </div>
                     </div> 
                    <br>
                        <div class="row" style="margin: 2% 0 0 -1%;">
                         <div class="col-md-12">
                           <div class="mb-1">
                              <label class="control-label" for="description-column">Meta Description</label>
                              <div class="mb-1">
                                <textarea class="form-control" id="description" rows="3" name="description" value="">{{$get_data->mega_discription}}</textarea>
                              </div>
                            </div>
                         </div> 
                      </div>

                        <div class="row  ">
                          <div class="accordion-item  ">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" style="margin: 0 0 0 -1%" data-bs-target="#accordionTwo" aria-expanded="false"
                            aria-controls="accordionTwo">  Features </button>
                            </h2>     
                                <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
                                    <div class="row" style="font-size:12px;">
                                        @for($i=0; count($features) > $i; $i++)  
                                       
                                        <div class="  col-md-4 col-md-4">                       
                                          <input class="form-check-input12" type="checkbox" name="chechbox[]" id="inlineCheckbox1" value="{{$features[$i]->id}}" {{in_array($features[$i]->id,$feature) ? 'checked' : '' }} >
                                          <label class="form-check-label" for="inlineCheckbox1"> {{$features[$i]->feature_name}}</label>
                                        </div>
                                        @endfor                              
                                    </div>
                                </div>
                          </div>
                          <div class="mb-1" style="margin-top:2%">
                            <label class="form-label" for="exampleFormControlTextarea1">Booking Conditions</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bookingconditions" value="">{{$get_data->booking_conditions}}</textarea>
                          </div>  
                        </div> 
                          <hr>
						  
						  
                          <div class="row">
                    <div class="col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                      <label class="form-label"for="startdate"><b>Insurance Provider</b></label>
                       <select  value=""  class="select2 form-select brand-name" id="insurance_provider" name="insurance_provider" >
                       <option {{ $get_data->insurance_provider ==1 ? 'selected' : '' }} value="1">Oman</option>
						            <option {{ $get_data->insurance_provider ==2 ? 'selected' : '' }} value="2">AXA Insurance</option>
						            <option {{ $get_data->insurance_provider ==3 ? 'selected' : '' }} value="3">Al Sagr</option>
                        <option {{ $get_data->insurance_provider ==4 ? 'selected' : '' }} value="4">Al Fujairah National Insurance Company</option> 
                        <option {{ $get_data->insurance_provider ==5 ? 'selected' : '' }} value="5">Noor Takaful Insurance</option>   
                        <option {{ $get_data->insurance_provider ==6 ? 'selected' : '' }} value="6">Adamjee Insurance</option>   
                        <option {{ $get_data->insurance_provider ==7 ? 'selected' : '' }} value="7">Tokio Marine Insurance</option>   
                        <option {{ $get_data->insurance_provider ==8 ? 'selected' : '' }} value="8">Abu Dhabi National Takaful</option>   
                        <option {{ $get_data->insurance_provider ==9 ? 'selected' : '' }} value="9">Salama Takaful Insurance</option>   
                        <option {{ $get_data->insurance_provider ==10 ? 'selected' : '' }} value="10">RSA Insurance</option> 
                        <option {{ $get_data->insurance_provider ==11 ? 'selected' : '' }} value="11">Others</option> 
                          
                       </select>        
                      </div>
                      </div>
                    </div>      

                    					  
							   
							
                      <div class=" col-md-6 col-sm-12 mb-2">
                      <div class="input-group">
                      <div class=" col-md-12 ">
                       <label class="form-label" for="drop_off_date_time-column"><b>Insurance Expire Date</b></label>
                         <input type="date" name="insurance_Expire_date" id="insurance_Expire_date" class="form-control" value="{{$get_data->insurance_Expire_date}}"" placeholder="Date"  min="<?php echo date('Y-m-d'); ?>" />  
                        </div>
				            	</div>  
				            	</div>  
				            	</div>  

                  <div class="row">
                    <h6 style="font-size: 1.0rem;">Documents</h6>

                    <div class=" col-md-6 col-sm-12 mb-2">
                    <div class=" col-md-12 ">
                                <label class="form-label" for="form-control"><b>Mulkiya-Front</b></label>
                      @if($get_data->documents)
                       <a target="_blank" href="{{ asset('/public/images/fleet_documents/'.$get_data->documents  )}}"> Show</a>
                       @endif
                       <input type="hidden" value="{{$get_data->documents}}" id="type_id" class="form-control" name="select1" />
                      <div class="input-group">
                       <input type="file" class="form-control" aria-describedby="button-addon2" name="document" value="">
                      </div>
                    </div>
                    </div>

                    <div class=" col-md-6 col-sm-12 mb-2">
                    <div class=" col-md-12 ">
                                <label class="form-label" for="form-control"><b>Mulkiya-Back</b></label>
                      @if($get_data->documents2)
                       <a target="_blank" href="{{ asset('/public/images/fleet_documents/'.$get_data->documents2  )}}"> Show</a>
                       @endif
                       <input type="hidden" value="{{$get_data->documents2}}" id="type_id" class="form-control" name="select2" />
                      <div class="input-group">
                       <input type="file" class="form-control" aria-describedby="button-addon2" name="document1" value="">
                      </div>
                    </div>
                    </div>

                    <div class=" col-md-6 col-sm-12 mb-2">
                      @if($get_data->documents3)
                       <a target="_blank" href="{{ asset('/public/images/fleet_documents/'.$get_data->documents3  )}}"> Show</a>
                       @endif
                       <input type="hidden" value="{{$get_data->documents3}}" id="type_id" class="form-control" name="select3" />
                      <div class="input-group">
                       <input type="file" class="form-control" aria-describedby="button-addon2" name="document2" value="">
                      </div>
                    </div>

                    <div class=" col-md-6 col-sm-12 mb-2">
                      @if($get_data->documents4)
                       <a target="_blank" href="{{ asset('/public/images/fleet_documents/'.$get_data->documents4  )}}"> Show</a>
                       @endif
                       <input type="hidden" value="{{$get_data->documents4}}" id="type_id" class="form-control" name="select4" />
                      <div class="input-group">
                       <input type="file" class="form-control" aria-describedby="button-addon2" name="document3" value="">
                      </div>
                    </div>
                  
                  </div>  
                </div>
                     <div class="row fleetpage2" style="display:none">
                            <div class="demo-inline-spacing">
                              <h3>Type</h3>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  name="RadioOptions" id="inlineRadio1"  value="1" {{$get_data->type==1 ? 'checked' : 'checked' }} />
                                <label class="form-check-label" for="inlineRadio4">Owned</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions" id="inlineRadio2" value="2" {{$get_data->type==2 ? 'checked' : '' }} />
                                <label class="form-check-label" for="inlineRadio2">Managed</label>
                              </div>
                            </div>
                            <hr style="margin-top:1%;">
                            <br>

                            <div class="row Ownership-Info" style="display:none">
                              <h4 class="card-title">Ownership Info</h4>
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="credit-card">Owner Name</label>
                                <input  type="text" class="form-control" id="owner_name" value="{{$get_data->owner_name}}" name="owner_name"/>
                              </div>

                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="phone-number">Phone</label>
                                <div class="input-group input-group-merge">
                                  <input type="number" class="form-control" id="phone_number" value="{{$get_data->phone}}" name="phone_number" />
                                </div>
                              </div>

                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="date">Email</label>
                                <input type="email" class="form-control"  id="email" value="{{$get_data->email}}" name="email" placeholder="demo@gmail.com" />
                              </div>

                              <div class="4 col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="time">Billing Email</label>
                                <input type="email" class="form-control" id="billing_email" value="{{$get_data->billing_email}}" name="billing_email" placeholder="demo@gmail.com"/>
                              </div>
                            </div>
                              <div class="row">
                                <h4>Car Info</h4>
                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="numeral-formatting">SKU</label>
                                <input type="text" class="form-control sku_num" id="sku" value="{{ isset($last_code) ? $last_code : ''; }}" name="sku" readonly />
                                <!-- <label class="form-label" id="alert_message" style="color:red;display:none;">This sku name is already exists</label> -->
                                <input type="hidden" class="form-control sku_no"  value="{{ isset($last_code) ? $last_code : ''; }}" />
                                </div>

                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Year">Year</label>
                                  <input type="text" class="form-control" id="year" value="{{$get_data->car_year}}" name="year" />
                                </div>

                               <div class=" col-md-6 col-sm-12 mb-2">
                                 <label class="form-label" for="Service">Service Type *</label>
                                 <select class="form-select" id="service_type" name="service_type" aria-invalid="false">
                                    <option {{ $get_data->car_service_type ==1 ? 'selected' : '' }} value="1">Self Drive</option>
                                    <option {{ $get_data->car_service_type ==2 ? 'selected' : '' }} value="2">Car with Driver</option>
                                    <option {{ $get_data->car_service_type ==3 ? 'selected' : '' }} value="3">Limousine</option>
                                  </select>
                               </div>
      
                                <div class="col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Colors">Color</label>
                                  <input type="text" class="form-control"  id="color" name="color" value="{{$get_data->car_color}}"/>
                                </div>
                                <div class=" col-md-3 col-sm-6 mb-2">
                                  <label class="form-label" for="Number">Prefix</label>
                                  <input  type="text" oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*?)\..*/g, '$a');"  class="form-control prefix_no" id="prefix" name="prefix" value="{{$letters}}" maxlength="2" readonly />
                                </div>

                                <div class=" col-md-3 col-sm-6 mb-2">
                                  <label class="form-label" for="Number">Number Plate</label>
                                  <input  type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');" class="form-control num_plate" id="number_plate" name="number_plate" value="{{$numbers}}" readonly />
                                </div>

                                <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Chasis">Chasis Number</label>
                                  <input type="text" class="form-control" id="chasis" name="chasis" value="{{$get_data->car_chasis_number}}"/>
                                </div>

                                <h4>Details</h4>
                                <div class="col-md-6  ">
                                  <label class="form-label" for="allowed">Allowed KM</label>
                                  <input type="text" class="form-control" id="allowed" name="allowed" value="{{$get_data->allowed_distance}}" required/>
                                </div>

                               <!-- <div class=" col-md-6 col-sm-12 mb-2">
                                  <label class="form-label" for="Unit">Unit</label>
                                  <input type="text" class="form-control" id="unit" name="unit" value="{{$get_data->unit}}"/>
                                </div>-->  
                              </div><br>

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
                                          <!-- <th></th> -->
                                        </tr>
                                      </thead>
                                        <tbody>
                                       
                                            @if(!empty($get_data_details))
                                           
                                              <tr id='addr0'>
                                              <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                        <option  value="1">Hourly</option>
                                                       
                                              </select></td>
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="0"  placeholder='Price' value="{{$get_data_details[0]->unit_price}}" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');" name='vat[]' data-vat="0" placeholder='Vat' value="{{$get_data_details[0]->vat}}" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_0" placeholder='Sub Total' value="{{$get_data_details[0]->subtotal}}" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="{{$get_data_details[0]->deposit}}" class="form-control"/>
                                            </td>
                                         
                                            </tr>

                                            <tr id='addr1'>
                                              <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                              <option  value="2">Daily</option>

                                                   
                                              </select></td>
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="1"  placeholder='Price' value="{{$get_data_details[1]->unit_price}}" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');" name='vat[]' data-vat="1" placeholder='Vat' value="{{ $get_data_details[1]->vat}}" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_1" placeholder='Sub Total' value="{{$get_data_details[1]->subtotal}}" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="{{ $get_data_details[1]->deposit}}" class="form-control"/>
                                            </td>
                                            
                                            </tr>

                                            <tr id='addr2'>
                                              <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                     
                                                        <option value="3">Weekly</option>
                                                        
                                              </select></td>
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="2"  placeholder='Price' value="{{ $get_data_details[2]->unit_price}}" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');" name='vat[]' data-vat="2" placeholder='Vat' value="{{ $get_data_details[2]->vat}}" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_2" placeholder='Sub Total' value="{{ $get_data_details[2]->subtotal}}" class="form-control" readonly />
                                            </td>
                                            <td>
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="{{ $get_data_details[2]->deposit}}" class="form-control"/>
                                            </td>
                                           
                                            </tr>

                                            <tr id='addr3'>
                                              <td> <select class="form-control select2 material"  name="material[]" aria-invalid="false" style="width: 100%;">
                                                     
                                                        <option  value="4">Monthly</option>
                                                     
                                              </select></td>
                                            <td>
                                            <input type="text" name='unit_price[]' data-unit="3"  placeholder='Price' value="{{ $get_data_details[3]->unit_price}}" class="form-control price_key"/>
                                            </td>
                                            <td>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$a');" name='vat[]' data-vat="3" placeholder='Vat' value="{{ $get_data_details[3]->vat}}" class="form-control vat_key"/>
                                            </td>
                                            <td>
                                              <input type="text" name='sub_total[]' id="total_3" placeholder='Sub Total' value="{{ $get_data_details[3]->subtotal}}" class="form-control" readonly />
                                            </td>
                                            <td> 
                                            <input type="text" name='deposite[]' placeholder='Deposite' value="{{ $get_data_details[3]->deposit}}" class="form-control"/>
                                            </td>
                                            </tr>
                                            @endif
                                             
                                        </tbody>
                                    </table>
                                  </div> 
                                  <input type="hidden" value="{{count($get_data_details)!=0 ? count($get_data_details) : 1 }}" id="rowcount" class="form-control"/>
                                </div>
                           
                              </div>
                              <br><br><br>
                            <div class="row" style="margin-top:2%">
                              <h4>Others Info</h4>
                              <h6>Add Ons</h6>
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Child">Child seats and others (Price in AED)</label><br>
                                <input type="text" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="child_sheet" name="child_sheet" value="{{$get_data->child_seat}}" />
                              </div> 
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Insurance">Insurance (Price in AED)</label>
                                <input type="text" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="insurance" name="insurance" value="{{$get_data->insurence}}" />
                              </div> 
                              <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Additional">Additional Kms (Price in AED)</label>
                                <input type="text" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="additional" name="additional" value="{{$get_data->additional_distance}}" />
                              </div>
                              
                               <div class=" col-md-6 col-sm-12 mb-2">
                                <label class="form-label" for="Additional">Status</label>
                                <select class="form-select" id="status" name="status" aria-invalid="false">
                                    <option {{ $get_data->status ==1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $get_data->status ==2 ? 'selected' : '' }} value="2">Inactive</option>                                  
                                  </select>
                              </div>
                           </div>
                          
                    </div>
                    <div class="col-sm-9 offset-sm-3 Previous" style="margin-left:42%;margin-top:4%; display:none;">
                      <input class="btn btn-success priviouspage" id="id12" readonly value="Previous"> 
                      <button type="submit" class="btn btn-danger me-1 btn-form-block submitshow waves-effect waves-float waves-light" disabled="disabled" >Update</button>
                    </div>
                    <div class="col-sm-9 offset-sm-3 Next" style="margin-left:42%;margin-top: 4%;">
                      <input class="btn btn-success nextpage" id="id1" readonly value="Next"> 
                      <button type="submit"  class="btn btn-danger me-1 btn-form-block submitshow waves-effect waves-float waves-light" disabled="disabled" >Update</button>
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
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}

 <script src="{{ asset('js/scripts/pages/app-storefleet-list.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 