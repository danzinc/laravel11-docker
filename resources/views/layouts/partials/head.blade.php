<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">
<title>{{ config('app.name')}} | @yield('title')</title> <!-- jsvectormap css -->
<!-- Layout config Js -->
<script src={{ asset('assets/js/layout.js') }}></script>
<!-- Bootstrap Css -->
<link href={{ asset('assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href={{ asset('assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href={{ asset('assets/css/app.min.css') }} rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href={{ asset('assets/css/custom.min.css') }} rel="stylesheet" type="text/css" />
<link href={{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}rel="stylesheet" type="text/css" />
<!--Swiper slider css-->
<link href={{ asset('assets/libs/swiper/swiper-bundle.min.css') }}rel="stylesheet" type="text/css" />
