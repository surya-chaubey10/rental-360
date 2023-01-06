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

<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title"><b>Create Push Notifications</b></h4>
        <a href="{{route('communication-save')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Submit</a>

    </div><!-- card-body -->

    <div class="card-body border-bottom">


        <div class="mb-1">
            <label class="form-label" for="typeInput">Type</label>
            <select class="form-select" id="typeInput">
              <option>Type 1</option>
              <option>Type 2</option>
              <option>Type 3</option>
            </select>
        </div>



            <label class="form-label" for="typeChecbox">Status of driver</label>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">All</label>
            </div>

            <div class="form-check mt-1">
              <input class="form-check-input " type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">Active</label>
            </div>

            <div class="form-check mt-1">
              <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">In review ( profile completed )</label>
              
            </div>

            <div class="form-check mt-1">
              <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">In review ( profile completed )</label>
              
            </div>

            <div class="form-check mt-1">
              <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">In review ( profile completed )</label>
              
            </div>

            <div class="form-check mt-1">
              <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              <label class="form-check-label" for="Checkbox1">Inactive</label>
              
            </div>



        <div class="mb-1 mt-1">
            <label class="form-label" for="typeInput">Company</label>
            <select class="form-select" id="typeInput">
              <option>All</option>
              <option>Company 1</option>
              <option>Company 2</option>
              <option>Company 3</option>
            </select>
        </div>


        <div class="mb-1">
            <label class="form-label" for="typeInput">Send to</label>
            <select class="form-select" id="typeInput">
              <option>All drivers</option>
              <option>driver 1</option>
              <option>driver 2</option>
              <option>driver 3</option>
            </select>
        </div>

        <div class="mb-1">
            <label class="form-label" for="typeInput">App version</label>
            <select class="form-select" id="typeInput">
              <option>version 3.5</option>
              <option>version 1.2</option>
              <option>version 2.2</option>
              <option>version 3.2</option>
            </select>
        </div>

        <div class="mb-1">
            <label class="form-label" for="typeInput">Platform</label>
            <select class="form-select" id="typeInput">
              <option>All</option>
              <option>Platform 1</option>
              <option>Platform 2</option>
              <option>Platform 3</option>
            </select>
        </div>

        <div class="mb-1">
            <label class="form-label" for="typeInput">Content Type</label>
            <select class="form-select" id="typeInput">
              <option>HTML</option>
              <option>html 1</option>
              <option>html 2</option>
              <option>html 3</option>
            </select>
        </div>

        <div class="mb-1">
            <label class="form-label" for="typeInput">Language</label>
            <select class="form-select" id="typeInput">
              <option>Single Language</option>
              <option>Language 1</option>
              <option>Language 2</option>
              <option>Language 3</option>
            </select>
        </div>

        <div class="mb-1">
            <label class="form-label" for="typeInput">Subject</label>
            <select class="form-select" id="typeInput">
              <option>All Subject</option>
              <option>Subject 1</option>
              <option>Subject 2</option>
              <option>Subject 3</option>
            </select>
        </div>

        <div class="mb-1">
                <label class="form-label" for="exampleFormControlTextarea1">Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Textarea"></textarea>
        </div>

        <div class="form-check mb-1">
          <label class="form-check-label" for="Checkbox1">Send to new user until </label>
          <input class="form-check-input" type="checkbox" id="Checkbox1" value="checked" checked="">
              
        </div>

        <div class="text-center">
          <button type="button" class="btn btn-success">Send</button>
          <button type="button" class="btn btn-danger">Cancel</button>
        </div>




    </div><!-- card-body -->
  </div><!-- card end -->

  

  <!-- list and filter end -->
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
 <script src="{{ asset('js/scripts/pages/app-user-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
