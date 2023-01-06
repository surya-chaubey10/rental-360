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
          <option value=" " ></option>
            @foreach($roless as $roles)
            
             <option value="{{$roles->id}}" >{{$roles->role_name}}</option>
            @endforeach
        </select>   
        </div>
        <div class="col-8 text-end">
        <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Update</button>
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
        @foreach($role as $key=> $menu)
            
        <tr>
          <td>
            <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
             <input class="form-check-input"  type="checkbox" value="{{$role[$key]->admin_menu_id}}" data-id="{{$role[$key]->admin_menu_name}}" data-value="{{$role[$key]->id}}" name="menu_name[]" id="menu_id" checked readonly/>
             <input type="hidden" id="updated_id" class="form-control" value="{{$role[$key]->id}}" placeholder="Name" name="updated_id" /> 
                <label class="form-check-label" for="inlineCheckbox1" value="{{$role[$key]->admin_menu_name}}" name="menu_names[]" id="menu_ids">{{$role[$key]->admin_menu_name}}</label>
             </div>
            </div>
          </td>
          <td>     
   
          @foreach($menu->role_sub_menu as  $submenu)
              
          <div class="d-flex align-items-center"> 
            <div class="form-check-inline">
                <input class="form-check-input" type="checkbox" data-id="{{$role[$key]->admin_menu_id}}" value="{{$submenu->admin_sub_menu_id}}" data-value="{{$submenu->admin_submenu_name}}" name="submenu_name[]" id="submenu_id" checked/>
                <input type="hidden" id="updated_id_submenu" class="form-control" value="{{$submenu->id}}" placeholder="Name" name="updated_id_submenu" />  
                 <label class="form-check-label mb-1" for="inlineCheckbox2" value="{{$submenu->admin_submenu_name}}" name="submenu_names[]" id="submenu_ids">{{$submenu->admin_submenu_name}}</label>
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
  <script src="{{ asset('js/scripts/pages/app-role_permision-edit.js') }}"></script>  
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection
 
