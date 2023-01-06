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
<link rel="stylesheet" href="{{ asset('vendors/css/intel/intlTelInput.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
@endsection
<style>
    .iti {
        width: 100%;
    }
    {{--  form i {
        margin-left: 200px;
        margin-down: -200px;
        cursor: pointer;
    }  --}}
</style>
@section('content')

<section class="app-user-view-account">
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card px-1">
                <div class="card-body px-1">
                    <form class="update-new-user modal-content pt-0 form-block" autocomplete="off" id="form_idd1"
                        method="post" enctype="multipart/form-data">
                        <div class="card-header">
                            <h4 style="font-size: 1.486rem;">Edit User</h4>
                            <button id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block">Save</button>
                        </div>
                        <hr>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="d-flex">
                                    @if($admin_user->image !='')
                                    <img src="{{ asset('images/users_images/' . $admin_user->image  )}}"
                                        id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image"
                                        height="100" width="100" />
                                    @else
                                    <img src="{{asset('public/images/portrait/small/defaultPic.jpg')}}"
                                        id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image"
                                        height="100" width="100" />
                                    @endif
                                    <!-- upload and reset button -->
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <h4>{{$admin_user->fullname}}</h4>
                                            {{-- <button type="file" id="upload_pic"
                                                class="btn btn-sm btn-danger mb-75   btn-file">Update</button> --}}
                                            <label for="account-upload" class="btn btn-sm btn-danger mb-75 me-75">Upload</label>
                                            <input type="file" id="account-upload" hidden accept="image/*" name="image" />
                                            <button type="button" id="account-reset" class="btn btn-sm btn-outline-primary mb-75">Reset</button>
                                        </div>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <section id="multiple-column-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <input type="hidden" id="user_updated_id" class="form-control" value="{{$admin_user->id}}" placeholder="Name" name="user_updated_id" />
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label"
                                                                    for="last-name-column">Name</label>
                                                                <input type="text" id="last-name-column" class="form-control" value="{{$admin_user->fullname}}" placeholder="Full Name" name="fullname" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label"
                                                                    for="email-column">Email(Username)</label>
                                                                <input type="text" id="email-column" class="form-control" value="{{$admin_user->email}}" placeholder="Email" name="email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="password-column">Password
                                                                </label>
                                                                 <div class="input-group-text" style="  height: 39px; padding:1px"> <input type="password"  id="password" class="form-control" value="{{$admin_user->user_password}}" placeholder="password" name="password" /> <i class="bi bi-eye-slash" id="togglePassword"></i></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label"
                                                                    for="status-column">Status</label>
                                                                <div class="mb-1">
                                                                    <select class="form-select" id="status"
                                                                        name="status">
                                                                        <option {{ $admin_user->status == '1' ? 'selected' : '' }} value="1">Active{{ $admin_user->status }} </option>
                                                                        <option {{ $admin_user->status == '2' ? 'selected' : '' }} value="2">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="user_types">User
                                                                    Role</label>
                                                                <div class="mb-1">
                                                                    <select class="form-select" id="role_id"
                                                                        name="role">
                                                                        @foreach($user_types as $user_type)
                                                                        <option {{ $admin_user->roleId == $user_type->id ? 'selected' : '' }} value="{{$user_type->id}}"> {{$user_type->role_name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="Contact">Contact</label>
                                                                <input type="tel" id="contact" class="form-control" name="contact" value="{{$admin_user->mobile}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card" style=" border-style: ridge;">
                                                <div class="card-header border-bottom">
                                                    <h4 class="card-title">Permission</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table text-nowrap text-center border-bottom" >
                                                        <thead>
                                                            <tr>
                                                            <th class="text-start">MODULE</th>
                                                            <th>READ</th>
                                                            <th>CREATE</th>
                                                            <th>EDIT</th>
                                                            <th>DELETE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="submenupermision_data" >
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
         <!-- /Invoice table -->
    </div>
       <!--/ User Content -->

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
<script src="{{ asset('js/scripts/pages/app-update_adminuser-list.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>

@endsection
