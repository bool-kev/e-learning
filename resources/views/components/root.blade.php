@extends('base_bootstrap')

@section('style')
      <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
  @vite('resources/frontend/css/root.css')
  @endsection
@section('content')
  <body>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

        {{-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a> --}}
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1 class="logo mr-auto"><a href="index.html">Imperial</a></h1>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto " href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li><a class="nav-link scrollto" href="#services">Services</a></li>
            <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div>
    </header><!-- End Header -->

    <main id="main">

      <!-- ======= Breadcrumbs ======= -->
      <section class="breadcrumbs">
        <div class="container">

          

        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <div class="container d-flex justify-content-center p-3">
          {{$slot}}
        </div>
      </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              &copy; Copyright <strong>Imperial Theme</strong>. All Rights Reserved
            </div>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Imperial
            -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <!-- Template Main JS File -->

  </body>
    
@endsection

@section('script')
    @vite('resources/frontend/js/root.js')
@endsection