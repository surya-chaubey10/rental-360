@extends('layouts.main') 
<style>/* Code By Webdevtrick ( https://webdevtrick.com ) */
  .container {
    padding: 50px 10%;
  }
  
  .box {
    position: relative;
    background: #ffffff;
    width: 100%;
  }
  
  .box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
    border-bottom: 1px solid #f4f4f4;
    margin-bottom: 10px;
  }
  
  .box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
  }
  
  .dropzone-wrapper {
    border: 2px dashed #91b0b3;
    color: #92b0b3;
    position: relative;
    height: 150px;
  }
  
  .dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
    width: 40%;
    top: 50px;
    font-size: 16px;
  }
  
  .dropzone,
  .dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 150px;
    cursor: pointer;
    opacity: 0;
  }
  
  .dropzone-wrapper:hover,
  .dropzone-wrapper.dragover {
    background: #ecf0f5;
  }
  
  .preview-zone {
    text-align: center;
  }
  
  .preview-zone .box {
    box-shadow: none;
    border-radius: 0;
    margin-bottom: 0;
  }
  
  .btn-primary {
		background-color: crimson;
		border: 1px solid #212121;
   }
  .padding-custom-22{
		padding: 1rem 2rem !important;
  }
  .feather{
	    height: 1.8rem !important;
		width: 1.8rem !important;
  }
  </style>
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection

@section('content') 
{{-- <div class="row">   --}}
<div class="card"> 
    <div class="card-body border-bottom padding-custom-22 mb-1 mt-1">
      
      <h4 ><b>Leads</b></h4>

        <div style="float:right; margin: -72px 160px; font-size: 74px;" > 
            <b><i data-feather='archive'></i></b>
            <i data-feather='user'></i>
            <i data-feather='list'></i>
            <i data-feather='align-left'></i>
            <a class="btn btn-icon " data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i data-feather='upload-cloud' ></i></a>
            <i data-feather='filter'></i>

         <!-- startactivity -->
            <!-- @php  $startdate= getallCompanyactiity(); $lastdate=getallCompanyactiity() @endphp
        <ul class="nav  bookmark-icons " style="margin-left: -39px; margin-top: -29%;">
         <li class="nav-item dropdown dropdown-language"> 
          <a class="nav-link all-activity" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
          <i class="ficon" data-feather="activity"></i>
          <span class="badge rounded-pill bg-danger  ">0</span>
           </a> 
            <ul class="dropdown-menu dropdown-menu-media " style="width:460px;" >
            <li class="dropdown-menu-header" >
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">Activity</h4>
                <div class="badge rounded-pill badge-light-primary current_unread">{{count($lastdate)}} New</div> 
              </div>
            </li>
            <hr>
           <li class=" media-list" id="myDIV" >
               @if($lastdate)
               @for($i=0; count($lastdate) > $i; $i++)
               @php  $startdate['time']= $startdate [$i]->created_at; @endphp          
              <ul class="timeline ms-10" style="margin-left:2rem;">
                  <li class="timeline-item ">
                  <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                  <div class="list-item-body flex-grow-1" style="min-height: 0rem;">
                  
                    <p class="media-heading"><span class="fw-bolder">{{$lastdate[$i]->messages}}.</span></p>
                    <small class="notification-text" style="margin-left:67%; color:#fd6b6b;" > {{ Carbon\Carbon::parse($startdate['time'])->diffForHumans() }}</small> 
                  </div>
                  </li>
                  <hr>
               </ul>
               @endfor
              @endif
            </li>  
           </ul>
          </li> 
         </ul> -->
         <!-- endactivity -->
        </div>
      <a href="{{route('leads-create')}}" class="btn btn-danger" style="float: right; margin-top: -32px;" >Create Leads</a> 
    </div>

<section class="app-leads-list"> 
  <div class="card-datatable table-responsive pt-0">
    <table class="leads-list-table table">
      <thead class="table-light">
        <tr>
       
          <th>Name</th>
          <th>Contact</th>
          <th>Date</th>
          <th>Source</th>
          <th>Assigned</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</section> 
<div class="vertical-modal-ex">
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Import Leads</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <section>
          <form action="{{url('/importleads')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
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
                                 <spam>(CSV or XLSX) </spam>
                          </div>
                          <input type="file" name="leads_details" class="dropzone">
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

  <div class="modal fade" id="leadsChangeStatus" tabindex="-1" aria-hidden="true">
    
      <div class="modal-header bg-transparent">
      </div>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Change Status</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><hr>
        
          <form action="{{url('/change-status')}} " method="post">
            {{ csrf_field() }}
            <div class="modal-body">
             <input type="hidden" name="updateid" value="" id="updateid">
              <label>Status </label>
              <div class="mb-1"> 
                <select class="form-control" name="change_status" id="change_status">
                  <Option value="0">Pending</Option>
                  <Option value="1">Qualified</Option>
                  <Option value="2">Disqualified</Option>
                  <Option value="3">Contacted</Option>
                  <Option value="4">Proposal sent</Option>
                  <Option value="5">Converted</Option>
                </select>
              </div> 
            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Submit</button>
            </div>
          </form>
        </div>
      </div>
    
</div>

<div class="modal fade" id="leadsComment" tabindex="-1" aria-hidden="true">
    
    <div class="modal-header bg-transparent">
    </div>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Comments</h4>
        </div><hr>
        <form action="{{url('/update-comment')}}" method="post">
          {{ csrf_field() }}
          <div class="modal-body">
           <input type="hidden" name="update_id" value="" id="update_id">
           <input type="hidden" name="user_id" value="" id="user_id">
            <div class="mb-1"> 
            <label>Comment </label>
            <textarea type="text" class="form-control" name="comment" value="" id="comment"></textarea>
            </div> 
            <div class="card-body comments">
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Submit</button>
          </div>
        </form>
      </div>
    </div>
   
</div>


</div>
{{-- </div> --}}
@endsection 

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  {{-- <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> --}}
  <script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  {{-- <script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script> --}}
  <script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/app-leads-list.js') }}"></script>

  <script src="{{ asset('js/scripts/pages/leads-status-part.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
 <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
@endsection


<script>
function myFunction() {
  const element = document.getElementById("content");
  element.scrollIntoView();
}

</script>
<style>
#myDIV {
    height: 314px;
    width: 453px;
  overflow: auto;

}

#content {
  margin:500px;
  height: 800px;
  width: 2000px;
}
</style>