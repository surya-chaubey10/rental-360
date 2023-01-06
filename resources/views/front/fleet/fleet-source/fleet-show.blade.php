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
<style>
  .toggle {

-webkit-appearance: none;

-moz-appearance: none;

appearance: none;

width: 62px;

height: 32px;

display: inline-block;

position: relative;

border-radius: 50px;



outline: none;

border: none;

cursor: pointer;

background-color: red;

transition: background-color ease 0.3s;

}



.toggle:before {

content: "";

display: block;

position: absolute;

z-index: 20;

width: 28px;

height: 28px;

background: #fff;

left: 0px;

top: 2px;

border-radius: 50%;

font: 10px/28px Helvetica;

text-transform: uppercase;

font-weight: bold;

text-indent: -22px;

word-spacing: 10px;

color: #fff;

text-shadow: -1px -1px rgba(0,0,0,0.15);

white-space: nowrap;

box-shadow: 0 1px 2px rgba(0,0,0,0.2);

transition: all cubic-bezier(0.3, 1.5, 0.7, 1) 0.3s;

}



.toggle:checked {

background-color: #4CD964;

}



.toggle:checked:before {

left: 32px;

}



  </style>
<section class="app-user-list">
  <!-- list and filter start -->
  @include('errors.alert')
  <div class="card">
    <div class="row card-body border-bottom">
      <h4 class="card-title"><b>Fleet List</b></h4>


      <div class="col-lg-12 col-sm-12">
        <a href="{{route('fleet-list')}}" class="btn btn-xs btn-danger" style="float: right; margin-top: -45px;" >Create Fleet</a>
       </div>
       <div class="col-lg-10 col-sm-12">
        <a class="btn btn-xs btn-success" data-bs-toggle ="modal" data-bs-target ="#exampleModalFleet" style="float: right; margin-top: -45px;" >Import Fleet</a>
     </div>
    </div>
    <div class="card-datatable table-responsive pt-0" >
      <table class="offer-list-table table">
        <thead class="table-light">
          <tr >
            <!-- <th>#</th> -->
            <th>Image</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Service Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
 
{{--  Model import Fleet  --}}
<div class="modal fade" id="exampleModalFleet" tabindex="-1" aria-labelledby="exampleModalFleetTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalFleetTitle">Import Fleet</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <section>
      <form action="{{url('/importfleets')}}" method="POST" enctype="multipart/form-data">

      @csrf
      <div class="modal-body">
              <div class="container">
              <div class="row">
                  <div class="col-md-12">
                  <div class="form-group">
                      <label class="control-label">Upload File</label>
                      <div class="preview-zone hidden">
                      <div class="box box-solid">
                          <div class="box-header with-border">
                          <div><b>Preview</b></div>
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-danger btn-xs remove-preview">
                              <i class="fa fa-times"></i> Reset The Field
                              </button>
                          </div>
                          </div>
                          <div class="box-body"></div>
                      </div>
                      </div>
                      <div class="dropzone-wrapper">
                      <div class="dropzone-desc">
                          <i class="glyphicon glyphicon-download-alt"></i>
                          <p>Drop file here or click to upload</p>
                             <spam>(CSV or XLSX or XLS) </spam>
                      </div>
                      <input type="file" name="file" class="dropzone">
                      </div>
                  </div>
                  </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary pull-right">Upload</button>
                  </div>
              </form>
          </section>

    </div>
  </div>
</div>
</div>
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
 <script src="{{ asset('js/scripts/pages/app-fleetshow-list.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
