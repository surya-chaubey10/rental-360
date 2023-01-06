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
    <title>@yield('title') Rental 360</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">




    <!-- BEGIN: Theme CSS-->
	
    <link rel="stylesheet" href="{{ asset('css/core.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/admin-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/base/pages/authentication.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}" />

    @yield('page-style')

    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>

<body class="vertical-layout vertical-menu-modern blank-page" data-menu="vertical-menu-modern" data-col="blank-page"
    data-framework="laravel" data-asset-path="{{ asset('/') }}">

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                {{-- Include Startkit Content --}}
                @yield('content')
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>

</html>
