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
          <form class="add-page1-brand modal-content pt-0 form-block" autocomplete="off" id="form_idd" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{isset($brand) ? $brand :''}}"id="brand_id" class="form-control" name="brand_id" />
            <input type="hidden" value="{{isset($model) ? $model :''}}" id="model_id" class="form-control" name="model_id" />
            <input type="hidden" value="" id="inventory_id" class="form-control" name="inventory_id" />
                <div class="card-header"> 
                  <h4 style="font-size: 1.750rem; margin-left: -2%;"><b>Inventory</b></h4>
                  
                </div>
                <hr> 
                <div class="col-md-12">
                  <div class="input-field">
                    <label class="active">Image</label> 
                    <div class="input-images-1" style="padding-top: .5rem;">  
                    </div>
                  </div>
                </div>
                <br>
                <div class="row" style="margin:2% 0 0 -1%">
                  <div class="col-md-12">
                    <div class="mb-1">
                      <label class="control-label" for="description-column">Meta Description</label>
                      <div class="mb-2"> 
                          <textarea class="form-control" id="description" rows="3" name="description" value=""></textarea>                             
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="row  ">
                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="control-label" for="description-column">Inventory Type</label>
                      <div class="mb-2"> 
                      <input class="form-control" type="text"  name="inventory_type" id="inventory_type" value="">
                       <!-- <select class="select2 form-select" id="inventory_type" name="inventory_type" >
                          <option value="1">Rental Car</option>
                          <option value="2">Other</option>
                       </select>                               -->
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="control-label" for="description-column">Status</label>
                      <div class="mb-2"> 
                       <select class="select2 form-select" id="status" name="status" >
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                       </select>                              
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
                      @foreach($features as $teast)  
                        <div class="col-md-3 col-md-4">                       
                          <input class="form-check-input" type="checkbox" name="chechbox[]" id="inlineCheckbox1" value="{{$teast->id}}">
                          <label class="form-check-label" for="inlineCheckbox1"> {{$teast->feature_name}}</label>
                        </div>
                      @endforeach  
                    </div>
                  </div>
                </div>
              </div>
            <div class="text-center">
              <button  type="submit" id="submit" class="btn btn-danger me-1 btn-form-block submitshow  waves-effect waves-float waves-light" >Submit</button>
            </div>
            </div>
            
          </form>
        </div>
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

 <script src="{{ asset('js/scripts/pages/app-inventoryshow-list.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 