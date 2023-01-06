@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content')
              <section class="app-user-view-account">
                <div class="row">
                  <div class="card" style="height:520px;"> 
                    <div class="card-body"> 
                      <div class="card-header">
                        <h4  style="font-size: 1.750rem;"><b>Fleet</b></h4>
                        <button class="btn btn-danger add_button" id="my-input-id" disabled="disabled">{{ request()->route('uuid') ? 'Update Fleet' : 'Create Fleet' }}</button>
                      </div>
                      <hr>
                      <input type="hidden" value="{{ request()->route('uuid') ? $get_data->brand_id : 0 }}" id="selectbrand_id" class="form-control" name="selectbrand_id" />
                      <input type="hidden" value="{{ request()->route('uuid') ? $get_data->model_id : 0 }}" id="selectmodel_id" class="form-control" name="selectmodel_id" />
                      <input type="hidden" value="{{ request()->route('uuid') ? $get_data->uuid : '' }}" id="update_id" class="form-control" name="update_id" />

                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                             <div class="col-12">
                                <div class="card"> 
                                  <div class="card-body">
                                    <div class="row">  
                                      <div class="col-md-4 col-6">
                                        <div class="mb-1">
                                          <label class="form-label" for="startdate"><b>Brand</b></label>
                                          <select class="select2 form-select brand-name" id="brand_name" name="brand_name" >
                                          @if(request()->route('uuid'))
                                            @foreach($vehicle_brand as $brand)
                                              <option value="" ></option>
                                              <option value="{{$brand->id}}" {{$brand->id==$get_data->brand_id ? 'selected' : '' }} >{{$brand->brand_name}}</option>
                                              @endforeach
                                          @else
                                          <option value="" ></option>
                                            @foreach($vehicle_brand as $brand)
                                            <option  value="{{$brand->id}}" >{{$brand->brand_name}}</option>
                                            @endforeach
                                          @endif  
                                          </select>     
                                        </div>
                                      </div> 
                                      <div class="col-md-1 col-6">
                                        <div class="mb-1">
                                        <button type="button" class="btn btn-primary" style="margin-top:40%" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
                                        <i data-feather='plus-circle'></i>
                                        </button>
                                        </div>
                                      </div>                              
                                      <div class="col-md-4 col-6 select_model" style="display:none">
                                        <div class="mb-1">
                                          <label class="form-label" for="Default_Time_Zone"><b>Model</b></label>
                                          <select class="select2 form-select model-name" id="model_name" name="model_name"  >
                                          </select>   
                                        </div>
                                      </div>
                                      <div class="col-md-1 col-6 addmodel12" style="display:none" >
                                        <div class="mb-1">
                                        <button type="button" class="btn btn-primary" style="margin-top:40%" data-bs-toggle="modal" data-bs-target="#modals-addslide">
                                        <i data-feather='plus-circle'></i>
                                        </button>
                                        </div>
                                      </div> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>  
                        </div> 
                      </div>  
                  <!-- Modal to add new brand starts-->
                  <div class="modal new-user-modal fade" id="modals-slide-in">
                    <div class="modal-dialog">
                      <form class="add-vehicle-brand  modal-content pt-0 form-block form-block" autocomplete="off" id="addvehicle_brand" method="post" enctype="multipart/from-data" > 
                        <div class="modal-header mb-1">
                          <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                          <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">Brand Name</label>
                            <input type="text" id="brand_name" class="form-control" value="" placeholder="Brand Name"
                              name="brand_name" required />
                          </div>
                          <input type="hidden" value="0" id="service_type" class="form-control" name="service_type" />
                          <input type="hidden" value="1" id="status" class="form-control" name="status" />
                          <button type="submit" id="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary"
                              data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Modal to add new brand Ends-->
                  <!-- Modal to add new model starts-->
                      <div class="modal  new-model-modal fade" id="modals-addslide">
                        <div class="modal-dialog">
                          <form class="add-new-model modal-content pt-0 form-block1 btn-form-block2" autocomplete="off" id="form_model"   method="post" enctype="multipart/from-data" > 
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                              <h5 class="modal-title" id="exampleModalLabel">Add Model</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                              <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-contact">Model Name</label>
                                <input type="text" id="model_name" class="form-control" placeholder="" name="model_name" required />
                              </div>
                              <input type="hidden" value="" id="brandid" class="form-control" name="brand_id" />
                              <button type="submit" class="btn btn-primary me-1 data-submit" id="submit">Submit</button>
                              <button type="reset" class="btn btn-outline-secondary"
                                  data-bs-dismiss="modal">Cancel</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- Modal to add new model Ends-->
                    
                </div>
              </section>

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>
  
@endsection

@section('page-script')
  {{-- Page js files --}}
 <script src="{{ asset('js/scripts/pages/app-fleet-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
