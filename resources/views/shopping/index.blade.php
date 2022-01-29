<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@stack('title')</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">  
	<link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/toastr.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/images/ico/favicon.ico') }}">
    
    @stack('styles')
	
</head><!--/head-->

<body>
	@include('shopping.layouts.header')

    @yield('content')

    @include('shopping.layouts.footer')
    @include('shopping.layouts.wishlist')
    <script src="{{ asset('/js/jquery.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('/js/price-range.js') }}"></script>
    <script src="{{ asset('/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/toastr.js') }}"></script>
    <script>
        
    </script>
    @stack('styles')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('js')
    @stack('wishlist-js')
</body>
</html>