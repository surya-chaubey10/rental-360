
@php $configData =   [
    "theme" => "light",
    "layoutTheme" => "light",
    "sidebarCollapsed" => false,
    "showMenu" => true,
    "layoutWidth" => "boxed",
    "verticalMenuNavbarType" => "navbar-floating",
    "navbarClass" => "floating-nav",
    "navbarColor" => "",
    "horizontalMenuType" => "navbar-floating",
    "horizontalMenuClass" => "floating-nav",
    "footerType" => "footer-static",
    "sidebarClass" => "",
    "bodyClass" => "",
    "pageClass" => "",
    "pageHeader" => true,
    "blankPage" => false,
    "blankPageClass" => "",
    "contentLayout" => "default",
    "sidebarPositionClass" => "default-sidebar-position",
    "contentsidebarClass" => "default-sidebar",
    "mainLayoutType" => "vertical",
    "defaultLanguage" => "en",
    "direction" => "ltr",
    ]

@endphp
<!DOCTYPE html>



<html class="loading {{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
    lang="@if (session()->has('locale')) {{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }} @endif"
    data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
    @if ($configData['theme'] === 'dark') data-layout="dark-layout" @endif>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="organisation_id" content="{{ Auth::user()->organisation_id }}">
    @endauth
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="myRiding">
    <meta name="author" content="hardik">
    <title>@yield('title') Rental 360</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
@isset($configData['mainLayoutType'])
    @extends($configData['mainLayoutType'] === 'horizontal' ? 'layouts.mailhorizontalLayoutMaster' : 'layouts.mailhorizontalLayoutMaster')
@endisset
