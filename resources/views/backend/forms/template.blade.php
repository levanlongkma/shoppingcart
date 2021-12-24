<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href=" {{asset('backend/assets/img/apple-icon.png')}} ">
	<link rel="icon" type="image/png" href="{{ asset('backend/assets/img/favicon.png ')}}">
	<title>
		Form
	</title>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	{{-- Alpine --}}
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
	<!-- Nucleo Icons -->
	<link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
	<link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
	<link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
	<!-- CSS Files -->
	<link id="pagestyle" href="{{ asset('backend/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="">
	@yield('content')
<!--   Core JS Files   -->
<script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/css/nucleo-svg.css') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script>
	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
	var options = {
		damping: '0.5'
	}
	Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('backend/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>