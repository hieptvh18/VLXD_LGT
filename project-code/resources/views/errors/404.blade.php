<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>404 Page | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-404.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column  bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-404 p-0 m-0 height-100vh">
                    <div class="row">
                        <!-- 404 -->
                        <div class="col s12 center-align white">
                            <img src="{{ asset('app-assets/images/gallery/error-2.png') }}" class="bg-image-404"
                                alt="">
                            <h1 class="error-code m-0">404</h1>
                            <h6 class="mb-2">BAD REQUEST</h6>
                            <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4"
                                href="{{ route('client.home')}}">Back
                                TO Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('app-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/custom-script.js') }}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>
