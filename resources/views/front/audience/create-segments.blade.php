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
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
 

<!-- Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
        
        <div class="card-header">
       
          <h4 class="card-title">Create Segments </h4>
          <button type="reset" class="btn btn-primary me-1">Submit</button>
          
        </div>
        <div class="card-body">
          <form class="form">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-column"> Name *</label>
                  <input
                    type="text"
                    id="first-name-column"
                    class="form-control"
                    placeholder=" Name"
                    name="fname-column"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="last-name-column">How to combine the condition *</label>
                  <select class="form-select"  id="disabledSelect">
              <option>All</option>
              <option>Total</option>
              <option>Hole</option>
            </select>
                </div>
              </div>
              
              <div class="card-body">
              <h5>Conditions</h5>
          <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
              <label class="form-label" for="credit-card"></label>
              <select class="form-select"  id="disabledSelect">
              <option>Email</option>
              <option>Total</option>
              <option>Hole</option>
            </select>
            </div>
          
            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
              <label class="form-label" for="phone-number"></label>
              <div class="input-group input-group-merge">
              
               <select class="form-select"  id="disabledSelect">
              <option>Equal</option>
              <option>Total</option>
              <option>Hole</option>
            </select>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
              <label class="form-label" for="date"></label>
              <input
                    type="text"
                    id="first-name-column"
                    class="form-control"
                    placeholder=" Name"
                    name="fname-column"
                  />
            </div>
              <div class="col-12">
               
                <button type="reset" class="btn btn-primary me-1">Add conditions</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
            @endsection  
   @section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
   
  {{-- data table --}} 
 
@endsection
 
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/segments1.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 