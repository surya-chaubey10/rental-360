@php  
$org= org_details();  
$user = getUser();
$org_sidebar = org_sidebar();
$user_sidebar = user_sidebar();
@endphp


<style>
.copyright {
    padding: 2rem;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: end;
    position: absolute;
    bottom: 0px;
	justify-content: center;
}
.footer-logo{
	width: 50%;
    object-fit: contain;
	margin-bottom: 0.5rem;
	}
	.mt-custom-1rem{
		margin-top: 1.9rem !important;
	}
</style>
<div
  class="main-menu menu-fixed menu-light menu-accordion menu-shadow"
  data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{ route('org.dashboard') }}">
          <span class="brand-logo">
            @if(isset($org->org_logo))
            <img
                src="/public/company/logo/{{$org->org_logo}}"
                class="congratulations-img-right"
                alt="card-img-right"
                style="border-radius: 50%;" height="37" width="40"
            />
            @else

            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
              <defs>
                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                  <stop stop-color="#000000" offset="0%"></stop>
                  <stop stop-color="#FFFFFF" offset="100%"></stop>
                </lineargradient>
                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                  <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                  <stop stop-color="#FFFFFF" offset="100%"></stop>
                </lineargradient>
              </defs>
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                  <g id="Group" transform="translate(400.000000, 178.000000)">
                    <path class="text-primary" id="Path"
                      d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                      style="fill:currentColor"></path>
                    <path id="Path1"
                      d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                      fill="url(#linearGradient-1)" opacity="0.2"></path>
                    <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                      points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                    <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                      points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                      points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                  </g>
                </g>
              </g>
            </svg>

            @endif
          </span>
         
            
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
            data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
    <div class="main-menu-content mt-custom-1rem">   


  @if($user->usertype == 4)



        @foreach($user_sidebar as $menu)

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item {{(count($menu->role_sub_menu) > 0 ? 'has-sub' : '')}}" style="">
            <a href="{{isset($menu->admin_menu->url) ? URL::to($menu->admin_menu->url) : 'javascript:void(0)'}}" class="d-flex align-items-center" target="_self">
                    <?php if($menu->admin_menu_id == 4) {  ?> 
                    <span class="iconify" data-icon="carbon:car" style="color: #423e3e;" width="35" height="35"></span> 
                    <?php }else{ ?>  
                    <i data-feather='{{$menu->admin_menu->icon}}'></i>
                    <?php } ?>
                    <span class="menu-title text-truncate">{{$menu->admin_menu->name}}</span>
                </a>

                @if(count($menu->role_sub_menu) > 0)

                    @foreach($menu->role_sub_menu as $sub_menu)

                    <ul class="menu-content">

                        <li>
                            <a href="{{isset($sub_menu->admin_sub_menu->url) ? URL::to($sub_menu->admin_sub_menu->url) : 'javascript:void(0)'}}" class="d-flex align-items-center" target="_self">
                                <i data-feather='circle'></i>
                                <span class="menu-item text-truncate">{{$sub_menu->admin_sub_menu->name}}</span>
                            </a>
                        </li>

                    </ul>
                    @endforeach
                @endif

            </li>

        </ul>

        @endforeach

    
    @else
      @foreach($org_sidebar as $menu)

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item {{(count($menu->org_sub_menu) > 0 ? 'has-sub' : '')}}" style="">
            <a href="{{isset($menu->admin_menu->url) ? URL::to($menu->admin_menu->url) : 'javascript:void(0)'}}" class="d-flex align-items-center" target="_self">
                    <?php if($menu->admin_menu_id == 4) {  ?> 
                    <span class="iconify" data-icon="carbon:car" style="color: #423e3e;" width="35" height="35"></span> 
                    <?php }else{ ?>  
                    <i data-feather='{{$menu->admin_menu->icon}}'></i>
                    <?php } ?>
                    <span class="menu-title text-truncate">{{$menu->admin_menu->name}}</span>
                </a>

                @if(count($menu->org_sub_menu) > 0)

                    @foreach($menu->org_sub_menu as $sub_menu)

                    <ul class="menu-content">

                        <li>
                            <a href="{{isset($sub_menu->admin_sub_menu->url) ? URL::to($sub_menu->admin_sub_menu->url) : 'javascript:void(0)'}}" class="d-flex align-items-center" target="_self">
                                <i data-feather='circle'></i>
                                <span class="menu-item text-truncate">{{$sub_menu->admin_sub_menu->name}}</span>
                            </a>
                        </li>

                    </ul>
                    @endforeach
                @endif

            </li>

        </ul>

      @endforeach
    @endif

<div class="copyright" bis_skin_checked="1">
	  <img src="/public/company/logo/logo-360.png" class="footer-logo" alt="footer-logo" />
	  Rental 360 ©️ 2022
	  </div>		
    </div>

</div>
<!-- END: Main Menu-->

<script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>