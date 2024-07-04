@php
    use App\Models\Faculte;
    use App\Models\Matiere;
@endphp
@props(['facultes' => Faculte::all(), 'matiere'=>new Matiere()])
@extends('base_bootstrap')
@section('tite')
    Interface admin
@endsection
@section('style')
    <style>
        .active {
            border-color: rgb(72, 49, 197);
            color: black;
        }
        .rounded-pill.active{
            background-color: rgb(87, 139, 182) !important;
        }
        .rounded-pill.active span{
            color: white !important;
        }
    </style>
    <!-- Custom fonts for this template-->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <!-- Custom styles for this template-->
    @vite('resources/backend/css/sb-admin-2.css')
@endsection
@section('content')

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar"
                style="width: 22rem !important;">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.root') }}">
                    <div class="sidebar-brand-text mx-3 d-inline">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="cursor: default">
                        <i class="fas fa-fw fa-tachometer-alt fs-3"></i>
                        <span class="fs-2">Matieres</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">



                <!-- Nav Item - Pages Collapse Menu -->

                @foreach ($facultes as $faculte)
                    <li class="nav-item" style="overflow: hidden;">
                        <a class="nav-link " href="{{ route('admin.faculte.index', $faculte) }}">
                            <i class="bi bi-book-half"></i>
                            <span @class([
                                'fs-6',
                                'active' => $faculte->libelle === $matiere->faculte?->libelle,
                            ])>{{ Str::limit($faculte->libelle, 15) }}</span>
                        </a>
                    </li>
                @endforeach

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"><i class="bi bi-chevron-left"></i></button>
                </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color: rgba(165, 142, 142,.25);" >

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="bi bi-list"></i>
                        </button>

                        <!-- Topbar Search -->

                        @if ($matiere->id)
                        <form class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search w-50">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form class="form-inline mt-2 mx-3 w-50 d-none d-md-block">
                            <div class="input-group w-100">
                                <div class="mb-3 form-floating">
                                    <select name="niveau" id="niveau-md" class="form-select w-75">
                                        @foreach ($matiere->faculte->classes ?? [] as $niveau)
                                            <option value="{{ $niveau->id }}" @selected($matiere->niveau_id === $niveau->id)>
                                                {{ $niveau->libelle }}</option>
                                        @endforeach
                                    </select>
                                    <label for="niveau" class="niveau">Niveau</label>
                                    <script>
                                        document.querySelector('#niveau-md').addEventListener('change', (e) => {
                                            let url = `{{ route('admin.index', ['faculte' => $matiere->faculte, 'niveau' => 'LEVEL']) }} `;
                                            url = url.replace('LEVEL', e.target.selectedOptions[0].value);
                                            document.location = url;
                                        })
                                    </script>
                                </div>

                            </div>
                        </form>
                        @else
                            <a href="{{route('admin.root')}}" class="">Gestion des cours</a>
                        @endif



                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-search text-black"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown" id="bi-search">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="bi bi-search "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            {{-- @dd(request()->route()->getName()) --}}
                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link" href="#" id="userDropdown" role="button" title="gestion des utilisateur" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                    <i class="bi bi-people fs-3 text-black"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <a href="{{route('admin.eleve.index')}}" class="dropdown-item @if(str_starts_with(request()->route()->getName(),'admin.eleve'))active @endif">Eleves</a>
                                    <a href="{{route('admin.enseignant.index')}}" class="dropdown-item @if(str_starts_with(request()->route()->getName(),'admin.enseignant'))active @endif">Enseignant</a>
                                </ul>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <div class="btn-group">
                                    <a type="button" class="nav-link  dropdown-toggle me-2 text-black" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Action
                                    </a>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form class="dropdown-item" action="{{route('admin.enseignant.logout')}}" method="post">
                                            @csrf
                                            <i class="bi bi-box-arrow-left text-danger"></i>
                                            <input type="submit" value="Logout">
                                        </form>
                                    </ul>
                                </div>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">

                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <form action="" method="get" class="d-block d-md-none">
                            <div class="row justify-content-around">
                                @if ($matiere->id)
                                    <div class="col-8">
                                        <div class="form-group form-floating">
                                            <select name="niveau" id="niveau" class="form-select">
                                                @foreach ($matiere->faculte->classes ?? [] as $niveau)
                                                    <option value="{{ $niveau->id }}" @selected($matiere->niveau_id === $niveau->id)>{{ $niveau->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="niveau" class="niveau">Niveau</label>
                                            <script>
                                                document.querySelector('#niveau').addEventListener('change', (e) => {
                                                    let url = `{{ route('admin.index', ['faculte' => $matiere->faculte, 'niveau' => 'LEVEL']) }} `;
                                                    url = url.replace('LEVEL', e.target.selectedOptions[0].value);
                                                    document.location = url;
                                                })
                                            </script>
                                        </div>
                                    </div>
                                @endif
                    
                            </div>
                        </form>
                        {{ $slot }}
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="bi bi-arrow-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </body>
@endsection
@section('script')
    <!-- Bootstrap core JavaScript-->
    @vite(['resources/js/jquery.min.js'])

    <!-- Custom scripts for all pages-->
    @vite(['resources/backend/js/sb-admin-2.min.js', 'resources/backend/js/script.js'])
@endsection
