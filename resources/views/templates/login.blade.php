
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Human Resource Development BPR Sejahtera Artha Sembada" name="description" />
  <meta content="hris" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">
  <title>{{ config('app.name')}} | Login</title> <!-- jsvectormap css -->
  <!-- Layout config Js -->
  <script src="assets/js/layout.js"></script>
  <!-- Bootstrap Css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <!-- custom Css-->
  <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
  <!--Swiper slider css-->
  <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @stack('style')
</head>

<body>
    
  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
      <div class="bg-overlay"></div>
      <!-- auth page bg -->
      <div class="auth-page-content overflow-hidden pt-lg-5">
        @yield('container')
          <!-- end container -->
      </div>

      <!-- footer -->
      <footer class="footer galaxy-border-none">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="text-center">
                          <p class="mb-0">&copy;
                              <script>document.write(new Date().getFullYear())</script> {{ config('app.name')}}. Crafted with <i class="mdi mdi-heart text-danger"></i> by me
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
      <!-- end Footer -->
  </div> 
    <script>
      $(function(){
        $('form').on('submit', function(){
          $(':input[type="submit"]').prop('disabled', true);
        })
      })
  </script>
  @stack('script')
  @include('sweetalert::alert') 
</body>

</html>
