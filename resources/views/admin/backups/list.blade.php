@extends('layouts.main')
@section('title', '')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> -->
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
  
  <div class="card"><!-- card start -->

    <div class="card-body border-bottom mb-1">

    <div class="demo-inline-spacing">

    <div class=" col-xl-6 col-md-6 col-6">
    <h6><small><strong class="text-danger">Note:</strong> Due to limited execution time and memory available to PHP, backing up very large databses may not be possible. 
    If your database is very large you might need to backup directly from your SQL server via the command line, or have your server admin do it 
    for you if you do not have root privileges.</small></h6>
    </div>
    
    <div class=" col-xl-2 col-md-2 col-2">
    
    <a href="{{route('backup-list')}}" class="btn btn-xs btn-secondary " style="float: right; margin-top: -45px;" >Auto Backup</a>

    </div>

    <div class=" col-xl-3 col-md-3 col-3">
   
    <a href="{{route('backup-list')}}" class="btn btn-xs btn-danger " style="float: right; margin-top: -45px;" >Create Database Backup</a>
    </div>

 
    
    </div><!-- demo-inline-spacing-end -->

    </div><!-- card-body-end -->

            
        <div class="card-datatable table-responsive pt-0">
            <table class="backup-list-table table">
                <thead class="table-light">
                <tr>
                    <th>BACKUP</th>
                    <th>BACKUP SIZE</th>
                    <th>DATE</th>
                    <th>OPTION</th>
                </tr>
                </thead>
            </table>
        </div>


  </div><!-- card end -->
  
</section>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> -->
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script> -->
  <!-- <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> -->
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
 <script src="{{ asset('js/scripts/pages/app-backup.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
 
@endsection
