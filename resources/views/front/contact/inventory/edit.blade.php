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
        <form class="update-new-inventory modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post">
 
        <div class="card-header">
                  <h4 style="font-size: 1.486rem;"><b>Edit Inventory</b></h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Update</button>
                </div>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section id="multiple-column-form">
                      <div class="row">
                        <div class="col-12">
                          <div class="card"> 
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="brand_name"><b>Brand Name</b></label>
                                      <input
                                        type="text"
                                        id="brand_name"
                                        class="form-control"
                                        value="{{$inventory[0]->brand_name}}"
                                        placeholder="Brand Name"
                                        name="brand_name"   
                                      />
                                    </div>
                                  </div>
                                  <input type="hidden" id="inventory_updated_id" class="form-control" value="{{$inventory[0]->id}}" placeholder="Name" name="inventory_updated_id" /> 
                                 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="model_name"><b>Model Name</b></label>
                                      <input
                                        type="text"
                                        id="model_name"
                                        class="form-control"
                                        value="{{$inventory[0]->model_name}}"
                                        placeholder="Model Name"
                                        name="model_name"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="img_path"><b>Image</b></label>
                                      <input
                                        type="file"
                                        id="img_path"
                                        class="form-control"
                                        value="{{$inventory[0]->img}}"
                                        name="img_path"
                                      />
                                    </div>
                                  </div> 
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="type"><b>Type</b></label>
                                      <input
                                        type="text"
                                        id="inventory_type"
                                        class="form-control"
                                        name="inventory_type"
                                        value="{{$inventory[0]->inventory_type}}" 
                                        placeholder="Type"
                                      />
                                    </div>
                                  </div>  
                                  <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                      <label class="form-label" for="status-column"><b>Status</b></b></label>
                                      <div class="mb-1">
                                        <select class="form-select" id="status" name="status">
                                          <option {{ $inventory[0]->status == '1' ? 'selected' : '' }} value="1">Enable</option>
                                          <option {{ $inventory[0]->status == '2' ? 'selected' : '' }} value="2">Disable</option>
                                        </select>
                                      </div>
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
 <script src="{{ asset('js/scripts/pages/app-inventory-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 