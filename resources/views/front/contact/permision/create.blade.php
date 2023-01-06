@extends('layouts.main')
@section('title', '')
 
 
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel='stylesheet' href="{{ asset('vendors/css/animate/animate.min.css') }}">

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
  
<div class="card">
<div class="card-body">
<form class="add-new-user modal-content pt-0 form-block" autocomplete="off" id="form_idd1" method="post" enctype="multipart/form-data">
   
<div class="d-flex align-items-center mb-2"> 
      <div class="form-check-inline col-4 ">
          <label class="form-check-label" for="inlineCheckbox1" >Role</label>
          <select class="form-control" name="role_name" id="role_id">
          <option value=""> </option>
            @foreach($role as $role)
             <option value="{{$role->id}}">{{$role->role_name}}</option>
            @endforeach
        </select>
        </div>  
        <div class="col-8 text-end">
        <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Submit</button>
      </div>
      </div>  
            
  <div class="table-responsive">
  <table class="table">
      <thead>
        <tr>
          <th>MODULE</th>
          <th>SUBMODULE</th>
            
        </tr>
      </thead>
      <tbody>
        @foreach($org_menu as $key=> $menu)
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input inp"  type="checkbox" value="{{$org_menu[$key]->admin_menu->id}}" name="menu_name[]" id="menu_id" data-id="{{$org_menu[$key]->admin_menu->name}}" data-value="{{$org_menu[$key]->id}}" readonly/>
                
                <label class="form-check-label " for="inlineCheckbox1" value="{{$org_menu[$key]->admin_menu->name}}" name="menu_names[]" id="menu_ids"  data-id="">{{$org_menu[$key]->admin_menu->name}}</label>
             </div>
            </div>
          </td>
          <td>    

          @foreach($menu->org_sub_menu as  $submenu)
          <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input  submodule" type="checkbox" data-id="{{$org_menu[$key]->admin_menu->id}}" value="{{$submenu->admin_sub_menu->id}}" data-value="{{$submenu->admin_sub_menu->name}}" name="submenu_name[]" id="submenu_id" />
                   
                 <label class="form-check-label mb-1 " for="inlineCheckbox2" value="{{$submenu->admin_sub_menu->name}}" name="submenu_names[]" id="submenu_ids" data-id="">{{$submenu->admin_sub_menu->name}}</label>
              </div>   
            </div> 
         @endforeach    
              </td>
         </tr>
         @endforeach
      </tbody>
    </table>
  </div>
</form>
</div>
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
  <script src="{{ asset('js/scripts/pages/app-role_permision-list.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- <script>
$(document).ready(function() {
  var ckbox = $("input[name='menu_name']");
  var chkId = '';
  $('input').on('click', function() {
    
    if (ckbox.is(':checked')) {
      $("input[name='menu_name']:checked").each ( function() {
   			chkId = $(this).val() + ",";
        chkId = chkId.slice(0, -1);
 	  });
      
    }     
  });
});
</script> -->
