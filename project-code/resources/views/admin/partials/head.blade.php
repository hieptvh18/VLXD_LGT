    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="@yield('meta.description')">
    <meta name="keywords"
          content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <meta name="copyright" content="© Copyright 2024 Bất Động Sản Hà Nội Land Group
All Rights Reserved.">
    <meta name="language" content="{{ app()->getLocale() }}">
    <title>@yield('title', 'Admin')</title>

    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-tooltip.css') }}">

    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/select2/select2-materialize.css') }}" type="text/css">

    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/intro.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/form-select2.css') }}">

    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/custom/styles.css') }}">
    <!-- END: Custom CSS-->

{{--    style upload file --}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/dropify/css/dropify.min.css') }}">--}}

{{--    css editor--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/quill/quill.snow.css') }}">

{{--    link cnd checkEditor --}}
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

    @stack('css')
