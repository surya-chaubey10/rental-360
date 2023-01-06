  <nav
      class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl jsdhhfjsdhf">
      <div class="navbar-container d-flex content">
          <div class="bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav d-xl-none">
                  <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                              data-feather="menu"></i></a></li>
              </ul>
            <!--   <ul class="nav navbar-nav bookmark-icons">
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/email') }}"
                          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon"
                              data-feather="mail"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/chat') }}"
                          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon"
                              data-feather="message-square"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/calendar') }}"
                          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon"
                              data-feather="calendar"></i></a></li>
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/todo') }}"
                          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon"
                              data-feather="check-square"></i></a></li>
              </ul>
              <ul class="nav navbar-nav">
                  <li class="nav-item d-none d-lg-block">
                      <a class="nav-link bookmark-star">
                          <i class="ficon text-warning" data-feather="star"></i>
                      </a>
                      <div class="bookmark-input search-input">
                          <div class="bookmark-input-icon">
                              <i data-feather="search"></i>
                          </div>
                          <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0"
                              data-search="search">
                          <ul class="search-list search-list-bookmark"></ul>
                      </div>
                  </li>
              </ul> -->
          </div>
          @php  $unreadnotification= superadminNotifications(); $notifications=superadminallNotifications(); @endphp
          <ul class="nav navbar-nav align-items-center ms-auto">
              <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                          data-feather="sun"></i></a></li>
              <li class="nav-item dropdown dropdown-notification me-25">
                  <a class="nav-link all-notification" data-bs-toggle="dropdown">
                      <i class="ficon " data-feather="bell"></i>
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
                              <div class="list-item d-flex align-items-start">
                                  <div class="me-1">
                                      <div class="avatar">
                                          <img src="{{ asset('images/portrait/small/avatar-s-15.jpg') }}" alt="avatar"
                                              width="32" height="32">
                                      </div>
                                  </div>
                                  <div class="list-item-body flex-grow-1">
                                      <p class="media-heading"><span class="fw-bolder">{{$notifications[$i]->messages}}.</span></p>
                                      <small class="notification-text" style="float: right; color:#fd6b6b;">{{ Carbon\Carbon::parse($data['time'])->diffForHumans() }}</small>
                                  </div>
                              </div>
                          </a>
                          @endfor

                        @for($i=0; count($unreadnotification) > $i; $i++)
                        <input type="hidden" id="readable" class="form-control readable" name=readable_id[] value="{{$unreadnotification[$i]->id}}" />
                        @endfor
                        @endif
                      </li>
                      </form>
                  </ul>
              </li>
              <li class="nav-item dropdown dropdown-user">
                  <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user"
                      href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
                      <div class="user-nav d-sm-flex d-none">
                          <span class="user-name fw-bolder">
                              @if (Auth::guard('admin_user'))
                                  {{ Auth::guard('admin_user')->user()->fullname }}
                              @else
                                  John Doe
                              @endif
                          </span>
                          <span class="user-status">
                              SuperAdmin
                          </span>
                      </div>
                      <span class="avatar">
                          <img class="round"
                              src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}"
                              alt="avatar" height="40" width="40">
                          <span class="avatar-status-online"></span>
                      </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                      <h6 class="dropdown-header">Manage Profile</h6>
                      <div class="dropdown-divider"></div>
                      <!-- <a class="dropdown-item"
                          href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0)' }}">
                          <i class="me-50" data-feather="user"></i> Profile
                      </a>
                      <a class="dropdown-item" href="#">
                          <i class="me-50" data-feather="settings"></i> Settings
                      </a> -->
                      <a class="dropdown-item" href="{{ route('super.change.password.show') }}">
                          <i class="me-50" data-feather="key"></i> Change Password
                      </a>
                      @if (Auth::guard('admin_user'))
                          <a class="dropdown-item" href="{{ route('super.logout') }}">
                              <i class="me-50" data-feather="power"></i> Logout
                          </a>
                      @else
                          <a class="dropdown-item"
                              href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                              <i class="me-50" data-feather="log-in"></i> Login
                          </a>
                      @endif
                  </div>
              </li>
          </ul>
      </div>
  </nav>

  {{-- Search Start Here --}}
  <ul class="main-search-list-defaultlist d-none">
      <li class="d-flex align-items-center">
          <a href="javascript:void(0);">
              <h6 class="section-label mt-75 mb-0">Files</h6>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
              <div class="d-flex">
                  <div class="me-75">
                      <img src="{{ asset('images/icons/xls.png') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">Two new item submitted</p>
                      <small class="text-muted">Marketing Manager</small>
                  </div>
              </div>
              <small class="search-data-size me-50 text-muted">&apos;17kb</small>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
              <div class="d-flex">
                  <div class="me-75">
                      <img src="{{ asset('images/icons/jpg.png') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">52 JPG file Generated</p>
                      <small class="text-muted">FontEnd Developer</small>
                  </div>
              </div>
              <small class="search-data-size me-50 text-muted">&apos;11kb</small>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
              <div class="d-flex">
                  <div class="me-75">
                      <img src="{{ asset('images/icons/pdf.png') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                      <small class="text-muted">Digital Marketing Manager</small>
                  </div>
              </div>
              <small class="search-data-size me-50 text-muted">&apos;150kb</small>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
              <div class="d-flex">
                  <div class="me-75">
                      <img src="{{ asset('images/icons/doc.png') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">Anna_Strong.doc</p>
                      <small class="text-muted">Web Designer</small>
                  </div>
              </div>
              <small class="search-data-size me-50 text-muted">&apos;256kb</small>
          </a>
      </li>
      <li class="d-flex align-items-center">
          <a href="javascript:void(0);">
              <h6 class="section-label mt-75 mb-0">Members</h6>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
              <div class="d-flex align-items-center">
                  <div class="avatar me-75">
                      <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">John Doe</p>
                      <small class="text-muted">UI designer</small>
                  </div>
              </div>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
              <div class="d-flex align-items-center">
                  <div class="avatar me-75">
                      <img src="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">Michal Clark</p>
                      <small class="text-muted">FontEnd Developer</small>
                  </div>
              </div>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
              <div class="d-flex align-items-center">
                  <div class="avatar me-75">
                      <img src="{{ asset('images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">Milena Gibson</p>
                      <small class="text-muted">Digital Marketing Manager</small>
                  </div>
              </div>
          </a>
      </li>
      <li class="auto-suggestion">
          <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
              <div class="d-flex align-items-center">
                  <div class="avatar me-75">
                      <img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="png" height="32">
                  </div>
                  <div class="search-data">
                      <p class="search-data-title mb-0">Anna Strong</p>
                      <small class="text-muted">Web Designer</small>
                  </div>
              </div>
          </a>
      </li>
  </ul>

  {{-- if main search not found! --}}
  <ul class="main-search-list-defaultlist-other-list d-none">
      <li class="auto-suggestion justify-content-between">
          <a class="d-flex align-items-center justify-content-between w-100 py-50">
              <div class="d-flex justify-content-start">
                  <span class="me-75" data-feather="alert-circle"></span>
                  <span>No results found.</span>
              </div>
          </a>
      </li>
  </ul>
  {{-- Search Ends --}}
  <!-- END: Header-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
   $(document).ready(function(){
    $(".all-notification").click(function (e) {
    e.preventDefault();
    
    let formData = new FormData($('#myForm')[0])

      $.ajax({
              url: '/storeadmin/notification-change', // JSON file to add data,
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

});

</script>