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
<section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">New subscriber</h4>
          <button type="reset" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>

        </div>
        <hr>
        <div class="card-body">
          <form class="form">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-column"> Email</label>
                  <input type="text" id="first-name-column" class="form-control" placeholder="Email" name="fname-column">
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="last-name-column">First Name</label>
                  <input type="text" id="last-name-column" class="form-control" placeholder="First Name" name="lname-column">
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="city-column">Last Name</label>
                  <input type="text" id="city-column" class="form-control" placeholder="Last Name" name="city-column">
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="country-floating">Address</label>
                  <input type="text" id="country-floating" class="form-control" name="country-floating" placeholder="Address">
                </div>
              </div>
           
              <div style="margin-left:90%;" >
                    <button  id="reset" name="reset" type="reset" class="btn btn-secondary me-1 btn-form-block" ><i class="fa fa-rotate-right"></i> &nbsp Reset</button>
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
  <script src="{{ asset('js/scripts/pages/subscribers1.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 