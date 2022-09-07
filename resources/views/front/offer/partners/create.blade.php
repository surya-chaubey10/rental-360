@extends('layouts.main')
@section('title', '')
 
 
@section('offer-category-style')
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
               <form class="add-offer-partner modal-content pt-0 form-block form-block" autocomplete="off" id="addofferpartner" method="post"> 
                <div class="card-header">
                  <h4 >Create Partners</h4>
                  <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save</button>
                </div> 
              </div> 
           
              <div class="card-body">
                <section id="multiple-column-form"> 
                  <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="user-name-column">Partner Name</label>
                        <input
                          type="text"
                          id="user-name-column"
                          class="form-control"
                          value=""
                          placeholder="Partner Name"
                          name="partner_name"   
                        />
                      </div>
                    </div>
                    <input type="hidden" id="vendor_updated_id" class="form-control" value="" placeholder="Name" name="vendor_updated_id" /> 
                                   
                    <div class="col-md-12 col-12">
                      <div class="mb-1">
                        <label class="form-label" for="status-column">Status</label>
                        <div class="mb-1">
                          <select class="form-select" id="status" name="status">
                            <option  value="1">Enable</option>
                            <option  value="2">Disable</option>
                            
                          </select>
                        </div>
                      </div>
                    </div>         
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
 <script src="{{ asset('js/scripts/pages/offer-partners-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 