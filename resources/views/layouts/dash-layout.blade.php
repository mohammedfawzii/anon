<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link href="{{asset('assets/dashboard/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/dashboard/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/dashboard/css/style.css')}}" rel="stylesheet">
</head>

<body>
<!-- End Header -->
<x-header-dash/>

  <!-- ======= Sidebar ======= -->
  <x-side-dash/>
<!-- End Sidebar-->

  <main id="main" class="main">


    @yield('content')


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <x-footer-dash/>
<!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="{{asset('assets/dashboard/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/dashboard/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/dashboard/js/main.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Slick JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</body>

</html>
