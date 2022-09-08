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
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <form class="add-new-offer modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
                <div class="card-header">
                  <h4 style="font-size: 1.750rem;"><b>Add Offer</b></h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button>
                </div>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="offer_category"><b>Offer Category</b></label>
                                        <select class="form-select" id="offer_category" name="offer_category">
                                          <option>Select</option>
                                          @foreach($offercategory as $offercategory) 
                                          <option  {{$offercategory->id == $offer->offer_category_id ? 'selected' : ''  }} value="{{$offercategory->id}}">{{$offercategory->category_name}}</option>
                                         @endforeach
                                        </select>                                     
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="image_path"><b>Image</b></label>
                                      <input
                                        type="file"
                                        id="image_path"
                                        class="form-control"
                                        value=""
                                        name="image_path"
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="vehicle"><b>Vehicle</b></label>
                                      <select class="form-select" id="vehicle" name="vehicle">
                                          <option>Select</option>
                                          @foreach($vehicle as $vehicle) 
                                          <option {{$vehicle->id == $offer->vehicle_id ? 'selected' : ''  }} value="{{$vehicle->id}}">{{$vehicle->vehicle_name}}</option>
                                         @endforeach
                                        </select>                
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="startdate"><b>Start Date</b></label>
                                      <input
                                        type="date"
                                        id="startdate"
                                        class="form-control"
                                        name="startdate"
                                        value="{{$offer->startdate}}" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="enddate"><b>End Date</b></label>
                                      <input
                                        type="date"
                                        id="enddate"
                                        class="form-control"
                                        name="enddate"
                                        value="{{$offer->enddate}}"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="starttime"><b>Start Time</b></label>
                                      <input
                                        type="time"
                                        id="starttime"
                                        class="form-control"
                                        name="starttime"
                                        value="{{$offer->starttime}}" 
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="endtime"><b>End Time</b></label>
                                      <input
                                        type="time"
                                        id="endtime"
                                        class="form-control"
                                        name="endtime"
                                        value="{{$offer->endtime}}" 
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="discount_type"><b>Discount Type</b></label>
                                      <select class="form-select" id="discount_type" name="discount_type" >
                                          <option>Select Type</option>
                                          <option {{$offer->discount_type == '1' ? 'selected' : ''  }} value="1">Percentage</option>
                                          <option {{$offer->discount_type == '2' ? 'selected' : ''  }} value="2">Amount</option>
                                        </select>     
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="minimum"><b>Minimum</b></label>
                                      <input
                                        type="text"
                                        id="minimum"
                                        class="form-control"
                                        name="minimum"
                                        value="{{$offer->minimum_value}}" 
                                        placeholder="Minimum"
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="maximum"><b>Maximum</b></label>
                                      <input
                                        type="text"
                                        id="maximum"
                                        class="form-control"
                                        name="maximum"
                                        value="{{$offer->maximum_value}}" 
                                        placeholder="Maximum"
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="status-column"><b>Status</b></b></label>
                                        <select class="form-select" id="status" name="status">
                                          <option {{$offer->status == '1' ? 'selected' : ''  }} value="1">Enable</option>
                                          <option {{$offer->status == '2' ? 'selected' : ''  }} value="2">Disable</option>
                                        </select>
                                    </div>
                                  </div>
                               </div>
                             </div>
                          </div>
                        </div>
                      </div>
                   </section> 
                </div> 
            </div> 
           </div>
        </div>  
      </div> 
      </form>
      <!-- /Invoice table -->
    </div>
    <!--/ User Content -->
  </div>
</section>
<!--   -->
@endsection  

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-offer-list.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 