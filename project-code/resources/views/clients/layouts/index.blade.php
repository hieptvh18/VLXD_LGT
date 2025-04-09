<!DOCTYPE html>
<html lang="vi">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    @include('clients.partials.head')
</head>

<body
    class="home page-template page-template-elementor_header_footer page page-id-8 wp-embed-responsive jkit-color-scheme theme-default elementor-default elementor-template-full-width elementor-kit-3 elementor-page elementor-page-8">
    <div id="page" class="jkit-template  site">

        @include('clients.partials.header')
        
        @yield('content')

        @include('clients.partials.footer')
    </div><!-- #page -->
    
    @include('clients.partials.script')
</body>

</html>
