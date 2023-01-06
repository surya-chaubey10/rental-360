
	@if(Session::has('NotPermission')) 
     <input id="universalnot_permission" type="hidden" value="{{ Session::get('NotPermission') }}">		  
   @endif 
   <?php 
   $allSessions = session()->all();
       /*  dd($allSessions); */
        ?>
`  <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl" >
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
         </ul>
		 <ul class="left-home-icon">
          <li class="home-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"  height="24" viewBox="0 0 24 24"><path fill="#6e6b7b" d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"/></svg></li>
		  <li class="home-text">Dashboard</li>
         </ul>
         <!-- @php  $startdate= getallCompanyactiity(); $lastdate=getallCompanyactiity() @endphp
        <ul class="nav navbar-nav bookmark-icons" style="margin-left:45px;">
         <li class="nav-item dropdown dropdown-language"> 
          <a class="nav-link all-activity" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
          <i class="ficon" data-feather="clock"></i>    
           <span class="badge rounded-pill bg-danger  ">{{count($lastdate)}}</span>  
             </a> 
             <ul class="dropdown-menu dropdown-menu-media " style="width:393px;" >
            <li class="dropdown-menu-header" >
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">Activity</h4>
                <div class="badge rounded-pill badge-light-primary current_unread">{{count($lastdate)}} New</div>   
              </div>
            </li>
           
             <li class=" media-list" id="myDIV" >
               @if($lastdate)
               @for($i=0; count($lastdate) > $i; $i++)
               @php  $startdate['time']= $startdate [$i]->created_at; @endphp          
              <ul class="timeline ms-10" style="margin-left:2rem; ">
                  <li class="timeline-item " style="height:58px">
                  <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                  <div class="list-item-body flex-grow-1" style="min-height: 0rem;margin-top: 24px;     margin-left:-14px;">
                  
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
        
      <!--   <ul class="nav navbar-nav bookmark-icons">
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/email') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/chat') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/calendar') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/todo') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
        </ul> -->
     <!--    <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link bookmark-star">
              <i class="ficon text-warning" data-feather="star"></i>
            </a>
            <div class="bookmark-input search-input">
              <div class="bookmark-input-icon">
                <i data-feather="search"></i>
              </div>
              <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
              <ul class="search-list search-list-bookmark"></ul>
            </div>
          </li>
        </ul> -->


        
      </div>
      <ul class="nav navbar-nav align-items-center ms-auto">
      @php  $startdate= getallCompanyactiity(); $lastdate=getallCompanyactiity() @endphp
        <ul class="nav navbar-nav bookmark-icons" style="margin-left:45px;">
         <li class="nav-item dropdown dropdown-language"> 
          <a class="nav-link all-activity" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
          <i class="ficon" data-feather="clock"></i>    
          <!-- <span class="badge rounded-pill bg-danger  ">{{count($lastdate)}}</span> -->
             </a> 
             <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end  " style="width:393px;" >
            <li class="dropdown-menu-header" >
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">Activity</h4>
                <!-- <div class="badge rounded-pill badge-light-primary current_unread">{{count($lastdate)}} New</div>  -->
              </div>
            </li>
           
             <li class=" media-list" id="myDIV" >
               @if($lastdate)
               @for($i=0; count($lastdate) > $i; $i++)
               @php  $startdate['time']= $startdate [$i]->created_at; @endphp          
              <ul class="timeline ms-10" style="margin-left:2rem; ">
                  <li class="timeline-item timeline-custom" style="padding-bottom: 5px;">
                  <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                  <div class="list-item-body flex-grow-1" style="min-height: 0rem;margin-top: 24px;     margin-left:-14px;">
                  
                    <p class="media-heading"><span class="fw-bolder">{{$lastdate[$i]->messages}}.</span></p>
                    <small class="notification-text" style="margin-left:67%; color:#fd6b6b;" > {{ Carbon\Carbon::parse($startdate['time'])->diffForHumans() }}</small> 
                  </div>
                  </li>
                  <!--hr-->
               </ul>
               @endfor
              @endif
            </li>  
           </ul>
          </li> 
        </ul>
        <li class="nav-item dropdown dropdown-language" style="float:left;"> 
          <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
          <i class="flag-icon flag-icon-us"></i>
            <span class="selected-language">Activity</span>
          </a> 
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
            <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
            <i class="flag-icon flag-icon-us"></i> English
            </a> 
            <!-- <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
              <i class="flag-icon flag-icon-fr"></i> French
            </a> 
             <a class="dropdown-item" href="{{ url('lang/de') }}" data-language="de">
              <i class="flag-icon flag-icon-de"></i> German
            </a> 
            <a class="dropdown-item" href="{{ url('lang/pt') }}" data-language="pt">
              <i class="flag-icon flag-icon-pt"></i> Portuguese
            </a>  -->
          </div> 
        </li>
		<!-- <li class="nav-item dropdown dropdown-language"> 
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="none" fill-rule="evenodd" stroke="#6e6b7b" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12a2 2 0 0 1-2 2H4l-4 4V2a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z" transform="translate(1 1)"/></svg>
        </li>
		<li class="nav-item"> 
			<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" data-name="Layer 1" viewBox="0 0 64 64"><path fill="#6e6b7b" d="M32 56a24 24 0 1 1 24-24 24 24 0 0 1-24 24zm0-44a20 20 0 1 0 20 20 20 20 0 0 0-20-20z"/><path fill="#6e6b7b" d="M42 34H32a2 2 0 0 1-2-2V18a2 2 0 0 1 4 0v12h8a2 2 0 0 1 0 4z"/></svg>
        </li>
		<li class="nav-item"> 
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="checkmark-square"><path fill="#6e6b7b" d="M20 11.83a1 1 0 0 0-1 1v5.57a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V5.6a.6.6 0 0 1 .6-.6h9.57a1 1 0 1 0 0-2H5.6A2.61 2.61 0 0 0 3 5.6v12.8A2.61 2.61 0 0 0 5.6 21h12.8a2.61 2.61 0 0 0 2.6-2.6v-5.57a1 1 0 0 0-1-1z"/><path fill="#6e6b7b" d="M10.72 11a1 1 0 0 0-1.44 1.38l2.22 2.33a1 1 0 0 0 .72.31 1 1 0 0 0 .72-.3l6.78-7a1 1 0 1 0-1.44-1.4l-6.05 6.26z"/></g></g></svg>
        </li>
		<li class="nav-item"> 
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6e6b7b" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><circle cx="11.854" cy="11.854" r="9" fill="none" stroke="#6e6b7b" stroke-miterlimit="10" stroke-width="2"/><path fill="none" stroke="#6e6b7b" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M18.451 18.451l7.695 7.695"/></svg>
        </li>				 -->
        @php  $unreadnotification= getNotifications(); $notifications=getallNotifications();  $user= getUser();  $org= org_details();@endphp
        <li class="nav-item dropdown dropdown-notification me-25">
          <a class="nav-link all-notification" data-bs-toggle="dropdown">
            <i class="ficon" data-feather="bell"></i>
            <span class="badge rounded-pill bg-danger badge-up curr_unread">{{count($unreadnotification)}}</span>
          </a>  
          
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                <div class="badge rounded-pill badge-light-primary current_unread">{{count($unreadnotification)}} New</div> 
              </div>
            </li>
            <form id="myForm" method="post">
            <li class="scrollable-container media-list">
              @if($notifications)
              @for($i=0; count($notifications) > $i; $i++)
              @php  $data['time']= $notifications[$i]->created_at; @endphp
              <a class="d-flex" href="javascript:void(0)">
              <!-- <a href="{{$notifications[$i]->url}}{{$notifications[$i]->notification_id}}"> -->
             
                <div class="list-item d-flex align-items-start">
                  <div class="me-1">
                    <div class="avatar">
                      <img src="{{ asset('images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32" height="32">
                    </div>
                  </div>
               
                  <div class="list-item-body flex-grow-1">
                    <p class="media-heading float-left"><span class="fw-bolder">{{$notifications[$i]->messages}}.</span>
                    <small class="notification-text" style="float: right; color:#fd6b6b;" >{{ Carbon\Carbon::parse($data['time'])->diffForHumans( null ,true, true); }}</small> </p>
                  </div>
                </div>
              <!-- </a> -->
              </a>
              @endfor

              @for($i=0; count($unreadnotification) > $i; $i++)
              <input type="hidden" id="readable" class="form-control readable" name=readable_id[] value="{{$unreadnotification[$i]->id}}" />
              @endfor
              @endif
            </li>
            </form>
            <!-- <li class="dropdown-menu-footer">
              <a class="btn btn-primary w-100" href="javascript:void(0)">Read all notifications</a>
            </li> -->
          </ul> 
        </li> 
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
            <div class="user-nav d-sm-flex d-none">
              <span class="user-name fw-bolder">
              @php  $user= getUser();  $org= org_details(); @endphp
                {{( isset($org->org_name) ? $org->org_name : '' )}}
              </span>
             
            </div>
            <span class="avatar">
            @if(isset($org->org_logo))
            <img
                src="/public/company/logo/{{$org->org_logo}}"
                class="congratulations-img-right"
                alt="card-img-right"
                height="40" 
                width="40"
            />
            @else
              <img class="round" src="{{ asset('/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40">
            @endif
              <span class="avatar-status-online"></span>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <h6 class="dropdown-header">Manage Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="user"></i> Profile
            </a>
            <a class="dropdown-item" href="{{ route('change.password.show') }}">
              <i class="me-50" data-feather="user"></i> Change Password
            </a>
            <a class="dropdown-item" href="#">
              <i class="me-50" data-feather="settings"></i> Settings
            </a>
            @if (Auth::check())
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="me-50" data-feather="power"></i> Logout
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
              @csrf
            </form>
            @else
            <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="log-in"></i> Login
            </a>
            @endif
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- END: Header-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
   $(document).ready(function(){
    $(".all-notification").click(function (e) {
    e.preventDefault();
    
    let formData = new FormData($('#myForm')[0])

      $.ajax({
              url: '/notification-change-status', // JSON file to add data,
              type: 'POST',
              dataType: 'json',
              data: formData,
              contentType: false,
              processData: false,
              success: function (data) {
                $('.current_unread').html(data.data+" new");
                $('.curr_unread').html(data.data);
              },
              error: function (data) {

              }
          })   
      
   });

   @if(Session::has('NotPermission'))
   alert("hello");
    var toster1=jq('#universalnot_permission').val();
    if(toster1!=''){
        Swal.fire({
          
          icon: 'error',
          title: ''+toster1,
          showConfirmButton: false,
          timer: 2000
            })
        }
         {{ Session::forget('NotPermission') }}
        
    @endif

});

</script>
<script>
function myFunction() {
  const element = document.getElementById("content");
  element.scrollIntoView();
}


</script>
<style>
#myDIV {
    height: 314px;
    width: 387px;
  overflow: auto;

}

#content {
  margin:500px;
  height: 800px;
  width: 2000px;
}
.timeline-custom{
  border-bottom: 1px solid #ebe9f1;	
}
</style>