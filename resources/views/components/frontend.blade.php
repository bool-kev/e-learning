@props([
  'chapitre'=>new App\Models\Chapitre(),
  'facultes'=>request()->user()->eleve->niveau->test->load('chapitres','faculte'),
  'user'=>request()->user()
])
@extends('base_bootstrap')
@section('title')
    
@endsection
@section('style')
  <style>
    .active{
        color:black !important;
    }
  
    .display{
      margin-left:50px !important;
    }
    .link{
      margin-left:10px !important;
    }
    .nav-item.active{
      color: blue !important;
      text-decoration: underline !important;
    }
  </style>
    @vite('resources/frontend/css/style.css')
@endsection

@section('content')
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center ">
        <img src="assets/img/logo.png" alt="">
        
        
        <span class="d-none d-lg-block">E-learning</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn fs-3 text-black d-md-none"></i>
    </div><!-- End Logo -->

    <div class="col-6 display ">
      <ul class="nav nav-underline " >
        <li class="nav-item ">
          <a class="nav-link text-black " href="{{--route('facultes',$chapitre)--}}">Cours</a>
        </li>
        <li class="nav-item link  @if(! $chapitre->id)active @endif">
          <a class="nav-link text-black" href="@if($chapitre->id){{route('user.eval.index',$chapitre->matiere)}} @else # @endif">Evaluations</a>
        </li>
      </ul>
    </div>
    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0 bi bi-person-circle" href="#" data-bs-toggle="dropdown">
            <!-- <img src="{{asset('images/card.jpg')}}" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$user->nom}}</span>
          </a><!-- End Profile Iamge Icon -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
 
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar bg-primary ">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
          <i class="bi bi-grid"></i>
          <span class="fs-3 fw-bold text-black">Matières</span>
      </li><!-- End Dashboard Nav -->
      @foreach ($facultes as $faculte)
        <li class="nav-item @if($loop->first) active @endif ">
          <a class="nav-link collapsed bg-primary" data-bs-target="#components-nav-{{$faculte->id}}" data-bs-toggle="collapse" href="#">
            <i class="bi bi-book-half text-light"></i><span @class(['text-light','active'=>$chapitre->matiere?->faculte->id===$faculte->faculte->id])>{{$faculte->faculte->libelle}}</span><i class="bi bi-chevron-down ms-auto text-light"></i>
          </a>
          
          <ul id="components-nav-{{$faculte->id}}" @class(['nav-content collapse','show'=>$chapitre->matiere?->faculte->id===$faculte->faculte->id]) data-bs-parent="#sidebar-nav">
            <li>
              @foreach ($faculte->chapitres as $chap )
                <a href="{{route('user.cours.list',['matiere'=>$faculte,'chapitre'=>$chap])}}">
                  <i class="bi bi-chat-dots-fill text-light"></i><span @class([ 'text-light','active'=>$chapitre->id===$chap->id])>{{ $chap->titre }}</span>
                </a>
              @endforeach
              
            </li>
          </ul>
          @endforeach
        
        </li><!-- End Components Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">{{ $slot }}</main> 

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 
  <!-- Template Main JS File -->

</body>
@endsection
@section('script')
  @vite(['resources/frontend/js/main.js'])
@endsection