@extends('layouts.main')        
@section('title', '')  
 
 
@section('front-style')         
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
 
<section class="app-user-view-account form-block" >
  <div class="row">      
    <div class="card">  
        <div class="card-body "> 
          <form class=" pt-0 update-role-form " autocomplete="off" id="role_form"  method="post">  
          @csrf
            <input type="hidden" id="smenuid" value="" name="smenu">
          <div class="card-header">
              <h3><b>Update Role</b></h3>                
            </div>  
              <hr>     
              
              <div class="row">                 
                <div class="col-md-6 col-6">      
                <div class="mb-2">
                  <label class="form-label" for="products-name-column"><b>Role Name</b> </label>  
                  <input  id="role_name" class="form-control" value="{{$data->role_name}}" name="role_name" type="text"/>
                </div> 
                </div>
            
                <div class="col-md-6 col-6">
                <div class="mb-2">
                  <label class="form-label" for="name-column"><b>Status</b> </label>      
                  <select class="form-select"   id="status"   value="status" name="status" aria-label="Default select example">
                  <option {{ $data->status==1 ? 'selected':''}} value="1">Active </option> 
                  <option {{ $data->status==2 ? 'selected':''}} value="2">Inactive </option> 
                  </select>
                </div> 
                </div>  

                <input    id="updated_id" class="form-control" value="{{$data->id}}" name="updated_id" type="hidden"/>

              </div>
          </form> 
          
         <div class="table-responsive mt-2 mb-4 border-bottom">
            <table class="table">
                <thead>
                  <tr>
                    <th>MODULE</th>
                    <th>SUBMODULE</th>
                      
                  </tr>
                </thead>
                <tbody>
                    @foreach($menus as $key => $menu)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="form-check-inline">
                            <input class="form-check-input module" data-id="{{$key}}" name="menu[]" type="checkbox"
                              id="menu" value="{{$menu->id}}" {{ in_array($menu->id, $inserted_menu) ? 'checked' : '' }} readonly />
                            <label class="form-check-label" for="menu">{{$menu->name}}</label>
                          </div>
                        </div>
                      </td>
                      <td>
                        @foreach($menu->sub_menu as $sub_menu)
                        <div class="d-flex align-items-center">
                          <div class="form-check-inline">
                            <input class="form-check-input sub_module{{$key}}" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="sub_menu" value="{{$sub_menu->id}}" {{ in_array($sub_menu->id, $inserted_subMenu) ? 'checked' : '' }} readonly/>
                            <label class="form-check-label mb-1" for="sub_menu">{{$sub_menu->name}}</label>
                          </div>
                        </div>
                        @endforeach
                      </td>
                    </tr>
                    @endforeach

                </tbody>
            </table> 
          </div>

        <div class="text-center">
          <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Update Role</button>  
        </div>

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
  <script src="{{ asset('js/scripts/pages/superadmin-update-role.js') }}"></script> 
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>  
@endsection

 