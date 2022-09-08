@extends('layouts.main') 

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
@endsection

@section('content')
 
  <div class="row">
    <div class="col-12">
      <div class="card"> 
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th></th> 
              <th></th>
              <th>customer</th>
              <th>pickup address</th>
              <th>drop-off address</th>
              <th>pickup date&time</th>
              <th>dropoff date&time</th> 
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
    
</div> 
</div>

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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/tables/table-datatables-basic-copy.js') }}"></script>
   
@endsection
