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
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card"> 
        <div class="card-body"> 
        <form class="add-update-lead modal-content pt-0 form-block"  autocomplete="off" id="fud_idd" method="post" enctype="multipart/form-data"> 
            {{ csrf_field() }}
              <div class="row">

                <div class="col-xl-6 col-md-6 col-6" >
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">General</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Requirement</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Social</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-timeline-tab" data-bs-toggle="pill" data-bs-target="#pills-timeline" type="button" role="tab" aria-controls="pills-timeline" aria-selected="false">TimeLine</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-comments-tab" data-bs-toggle="pill" data-bs-target="#pills-comments" type="button" role="tab" aria-controls="pills-comments" aria-selected="false">Comments</button>
                  </li>
                  </ul>
                </div> 

                <div class="col-xl-6 col-md-6 col-6"  role="presentation" > 

                </div>

              </div>
                 
               
              <input type="hidden" value="{{$leads_data->id}}" id="updated_id" class="form-control" name="updated_id" />
              <input type="hidden" value="{{$leads_data->model}}" id="model" class="form-control"  />
              <input type="hidden" value="{{$leads_data->vehicle}}" id="brand" class="form-control"  />

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">  
                      <div class="card-body">
                        <form class="form">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="first-name-column">First Name</label>
                                <input
                                  type="text"
                                  id="first-name-column"
                                  class="form-control"
                                  placeholder="First Name"
                                  value="{{$leads_data->first_name}}"
                                  name="first_name"
                                  readonly
                                />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="last-name-column">Last Name</label>
                                <input
                                  type="text"
                                  id="last-name-column"
                                  class="form-control"
                                  placeholder="Last Name"
                                  name="last_name"
                                  value="{{$leads_data->last_name}}"
                                  readonly
                                />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="mobile-column">Mobile</label>
                                <input type="number" id="mobile-column" class="form-control" placeholder="mobile" name="mobile"  value="{{$leads_data->mobile}}" readonly />
                              </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="email-id-column">Email</label>
                                <input
                                  type="email"
                                  id="email-id-column"
                                  class="form-control"
                                  name="email"
                                  value="{{$leads_data->email}}"
                                  placeholder="Email"
                                  readonly
                                />
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="source-column">Source</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control" value="{{$leads_data->source == 1 ? 'Social Media' : ($leads_data->source == 2 ? 'Google' : ( $leads_data->source == 3 ? 'Direct' : ( $leads_data->source == 4 ? 'Other' : '' ) ) )}}" readonly>

                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="assigned-column">Assigned (Optional)</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control" value="{{isset($user_name->fullname) ? $user_name->fullname :''}}" readonly>

                                </div>
                              </div>
                            </div><div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="status-column">Status</label>
                                <div class="mb-1">
 
                                  <input type="text" class="form-control" value="{{$leads_data->status == 0 ? 'Pending' : ($leads_data->status == 1 ? 'Qualified' : ( $leads_data->status == 2 ? 'Disqualified' : ( $leads_data->status == 3 ? 'Contacted' : ( $leads_data->status == 4 ? 'Propasal Sent' : ($leads_data->status == 5 ? 'Converted' : '') ) ) ) )}}" readonly>

                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="tags-column">Tags</label>
                                <input
                                  type="text"
                                  id="tags-column"
                                  class="form-control"
                                  placeholder=" "
                                  value="{{$leads_data->tags}}"
                                  name="tag"
                                  readonly
                                />
                              </div>

                          </div>
                        
                      </div>
                    </div>
                </div>


                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                   
                     <div class="card-body">
                        <form class="form">
                          <div class="row">
                            <div class="col-md-4 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="type-column">Type</label>
                                <div class="mb-1">

                                  <input type="text" class="form-control" value="{{$leads_data->type == 1 ? 'Self Drive' : ($leads_data->type == 2 ? 'Car with Driver' : ( $leads_data->type == 3 ? 'Limousine' : '' ) )}}" readonly>

                                </div> 
                              </div>
                            </div>
                            <div class="col-md-4 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="vehicle-column">Vehicle</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control" value="{{isset($brand_name->brand_name) ? $brand_name->brand_name : ''}}" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 col-12">
                              <div class="mb-1">
                                <label class="form-label" for="model-column">Model</label>
                                <div class="mb-1">
                                <input type="text" class="form-control" value="{{$model_name ? $model_name->model_name : ''}}" readonly>
                                </div> 
                              </div>
                            </div>
                            <div class="col-md-4 col-4">
                              <div class="mb-1">
                                <label class="form-label" for="from">From</label>

                                <input class="form-control"  type="text" value="{{$leads_data->from}}" readonly> 
                              </div>
                            </div>
                            <div class="col-md-4 col-4">
                              <div class="mb-1">
                                <label class="form-label" for="to">To</label>

                                <input class="form-control"  type="text" value="{{$leads_data->to}}" readonly> 

                              </div>
                            </div>
                            <div class="col-md-4 col-4">
                              <div class="mb-1">
                                <label class="form-label" for="note-column">Note</label>
                                <div class="mb-1">

                                  <input class="form-control"  type="text" value="{{$leads_data->note}}" readonly >

                                </div>
                              </div>
                            </div>
                          </div>
                      
                      </div>
                    </div>


                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">
                      <div class="col-12">
                        <div class="card"> 
                          <div class="card-body">
                            
                              <div class="row"> 
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="twitter">Twitter</label>
                                    <input
                                      type="text"
                                      id="twitter"
                                      class="form-control"
                                      placeholder="Twitter"
                                      value="{{$leads_data->twitter}}"
                                      name="twitter"
                                      readonly
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">  
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <input
                                      type="text"
                                      id="facebook"
                                      class="form-control"
                                      placeholder="Facebook"
                                      value="{{$leads_data->facebook}}"
                                      name="facebook"
                                      readonly
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="instagram-floating">Instagram</label>
                                    <input
                                      type="text"
                                      id="instagram-floating"
                                      class="form-control"
                                      value="{{$leads_data->instagram}}"
                                      name="instagram"
                                      placeholder="Instagram"
                                      readonly
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="github-column">Github</label>
                                    <input
                                      type="text"
                                      id="github-column"
                                      class="form-control"
                                      value="{{$leads_data->github}}"
                                      name="github"
                                      placeholder="Github"
                                      readonly
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="codepen-id-column">Codepen</label>
                                    <input
                                      type="codepen"
                                      id="codepen-id-column"
                                      class="form-control"
                                      value="{{$leads_data->codepen}}"
                                      name="codepen"
                                      placeholder="Codepen"
                                      readonly
                                    />
                                  </div>
                                </div>
                                <div class="col-md-4 col-12">
                                  <div class="mb-1">
                                    <label class="form-label" for="slack-id-column">Slack</label>
                                    <input
                                      type="slack"
                                      id="slack-id-column"
                                      class="form-control"
                                      value="{{$leads_data->slack}}"
                                      name="slack"
                                      placeholder="slack"
                                      readonly
                                    />
                                  </div>
                                </div> 
                              </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-timeline" role="tabpanel" aria-labelledby="pills-timeline-tab">
                    <div class="row">
                      <div class="col-12">
                        <div class="card"> 
                          <div class="card-body">
                            
                          <div class="card card-user-timeline">

                              <div class="card-body">
                                <ul class="timeline ms-50">

                                
                                @foreach($logs as $log)
                                <li class="timeline-item">
                                  <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                  <div class="timeline-event">

                                    <h6>{{$log->log}}</h6>

                                  </div>
                                </li>
                                @endforeach

                                </ul>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab">
                    <div class="row">
                      <div class="col-12">
                        <div class="card"> 
                          <div class="card-body">
                            <div class="card card-user-comments">
                              <div class="card-body">
                                <ul class="timeline ms-50">
                                  @if(!empty($return))
                                    @for($i=0;count($return) > $i; $i++)
                                      <li class="timeline-item">
                                        <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                        <div class="timeline-event">
                                          <h6>{{$return[$i]['comments']}}</h6>
                                          <div class="avatar-wrapper">
                                            <div class="avatar me-1">
                                              <span class="avatar-content">{{$return[$i]['name']}}</span>
                                            </div>
                                            <span class="avatar-content" style="float: right;">{{$return[$i]['time']}}</span>
                                          </div>
                                        </div> 
                                      </li>
                                    @endfor
                                  @endif  
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

            </div> 
          </div>
        </div>  
      </div> 
      </form>
      <!-- /Invoice table -->
    </div>
    <!--/ User Content -->
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

 <script src="{{ asset('js/scripts/pages/app-leads-add.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
@endsection

 