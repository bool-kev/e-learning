@props(['root'])
@extends('base_bootstrap')
@section('style')
     <!-- Favicons -->
  <link href="{{asset('images/favicon.png')}}" rel="icon">
  <link href="{{asset('images/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  @vite('resources/frontend/css/root.css')
@endsection

@section('content')
    

<body>

    @if ($root??false)
        <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
          <div data-aos="fade-in">
            <div class="hero-logo">
              <img class="" src="{{asset('images/logo.png')}}" alt="Imperial">
            </div>
    
            <h1>Bien SENSEI E-SCHOOL </h1>
            <h2>Vous etes? <span class="typed" data-typed-items="beautiful graphics, functional websites, working mobile apps"></span></h2>
            <div class="actions">
              <a href="#about" class="btn-get-started">enseignant</a>
              <a href="#services" class="btn-services">eleve</a>
            </div>
          </div>
        </div>
      </section><!-- End Hero -->
    @endif
  
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">
  
        {{-- <a href="index.html" class="logo mr-auto"><img src="{{asset('images/logo.png')}}" alt=""></a> --}}
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1 class="logo mr-auto"><a href="index.html">SENSEI Learning</a></h1> 
  
        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="#hero">Acceuil</a></li>
            <li><a class="nav-link scrollto" href="#about">A propos</a></li>
            
            <li><a class="nav-link scrollto" href="#contact">Contactez nous</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
  
      </div>
    </header><!-- End Header -->
  
    <main id="main">
        {{$slot}}
    </main><!-- End #main -->
</body>
   @if (true)
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
   @endif
  
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    
  
  </body>
@endsection

@section('script')
  @vite('resources/frontend/js/root.js')
@endsection