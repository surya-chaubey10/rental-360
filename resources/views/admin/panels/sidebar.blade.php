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
</style>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{route('super.dashboard')}}">
                    <span class="brand-logo">
                         
                    </span>
                    <h2 class="brand-text">Rental 360</h2>
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
    <div class="main-menu-content">   
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{route('super.dashboard')}}" class="d-flex align-items-center" target="_self">
                    <i data-feather='home'></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('company-list')}}" class="d-flex align-items-center" target="_self">
                    <i data-feather='trello'></i>
                    <span class="menu-title text-truncate">Companies</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('booking-list') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather='calendar'></i>
                    <span class="menu-title text-truncate">Booking</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('subscription-list') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather='shield'></i>
                    <span class="menu-title text-truncate">Subscription Plans</span>
                    
                </a>

            </li>
            <li class="nav-item has-sub" style="">
                <a href="javascript:void(0)" class="d-flex align-items-center" target="_self">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate">Finances</span>
                </a>
                <ul class="menu-content">


                    <li>
                        <a href="{{ route('request-list') }}" class="d-flex align-items-center" target="_self">
                            <i data-feather='circle'></i>
                            <span class="menu-item text-truncate">Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('company-general-leader') }}" class="d-flex align-items-center" target="_self">
                            <i data-feather='circle'></i>
                            <span class="menu-item text-truncate">Journal Entries</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('inventory-list') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather='truck'></i>
                    <span class="menu-title text-truncate">Inventory</span>
                </a>
            </li>
                        <li class="nav-item">
                <a href="{{ route('superadminrole-list') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather='user-check'></i>
                    <span class="menu-title text-truncate">Role</span>
                </a>
            </li>
                        <li class="nav-item">
                <a href="{{ route('superadminuser-list') }}" class="d-flex align-items-center" target="_self">
                    <i data-feather='user'></i>
                    <span class="menu-title text-truncate">User</span>
                </a>
            </li>

        </ul>
		<div class="copyright" bis_skin_checked="1">
			<img src="/public/company/logo/logo-360.png" class="footer-logo" alt="footer-logo" />
			Rental 360 ©️ 2022
		</div>		
    </div>
    </div>
</div>

<!-- END: Main Menu-->
