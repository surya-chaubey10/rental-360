<!doctype html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Myride is for the riding.">
    <meta name="keywords" content="ride">
    <meta name="author" content="HARDIK">
    <title>@yield('title') - My Ride</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}" />
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating    footer-static default" data-open="click" data-menu="vertical-menu-modern" data-col="default" data-framework="laravel" data-asset-path="{{ asset('/') }}">
    <!-- BEGIN: Header-->
    @include('panels.navbar')
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <!-- @if((isset($configData['showMenu']) && $configData['showMenu'] === true)) -->
    @include('panels.sidebar')
    <!-- @endif -->
    <!-- END: Main Menu-->
    <div class="app-content content {{ $configData['pageClass'] }}">
        <!-- BEGIN: Header-->
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        @if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
        <div class="content-area-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
            <div class="{{ $configData['sidebarPositionClass'] }}">
                <div class="sidebar">
                    {{-- Include Sidebar Content --}}
                    @yield('content-sidebar')
                </div>
            </div>
            <div class="{{ $configData['contentsidebarClass'] }}">
                <div class="content-wrapper">
                    <div class="content-body">
                        {{-- Include Page Content --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="content-wrapper">
            {{-- Include Breadcrumb --}}
            @include('panels.breadcrumb')

            <div class="content-body">
                {{-- Include Page Content --}}
                @yield('content')
            </div>
        </div>
        @endif

    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('panels/scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

</body>

</html>