<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPDB SMP Maria Immaculata</title>
    {{-- Bootsrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage-style.css') }}">
    @yield('css-site')

    {{-- Google Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="main-area gradient-custom-4">
        @if(Auth::check())
        <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-dark" id="navbar-top">
            <div class="sidebar-logo">
                <img class="img-imex" src="{{ asset('image/logoPutihImex.png') }}" alt="">
            </div>
            <div class="container-fluid row">
                <div class="col col-sm-4">
                    <h2>Hello {{ Auth::user()->name }}!</h2>
                    <h5>Selamat datang calon murid SMP Maria Immaculata</h5>
                </div>
                <div class="col col-sm-2">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="material-icons">
                                    account_circle
                                    <span>{{ Auth::user()->name }}</span>
                                </i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logoutUser') }}">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid my-2">
            <div class="container-md">
                <div class="col mx-2 text-center">
                    <span id="badge-for-progress-1" class="badge rounded-pill badge-for-progress-1 mx-2 my-3 {{ in_array(Route::currentRouteName(), ['pendaftaranSiswaShowPage1', 'pendaftaranSiswaShowPage2', 'pendaftaranSiswaShowPage3']) ? 'text-bg-light' : 'text-bg-secondary' }}">Form Pendaftaran</span>
                    <span id="badge-for-progress-2" class="badge rounded-pill badge-for-progress-2 mx-2 my-3 {{ in_array(Route::currentRouteName(), ['dokumenSiswaShow1', 'dokumenSiswaShowPage2']) ? 'text-bg-light' : 'text-bg-secondary' }}">Upload Dokumen</span>
                    <span id="badge-for-progress-3" class="badge rounded-pill badge-for-progress-3 text-bg-secondary mx-2 my-3 {{ in_array(Route::currentRouteName(), ['seleksiSiswaShow']) ? 'text-bg-light' : 'text-bg-secondary' }}">Menunggu Hasil Seleksi</span>
                    <span id="badge-for-progress-4" class="badge rounded-pill badge-for-progress-4 text-bg-secondary mx-2 my-3 {{ in_array(Route::currentRouteName(), ['jadwalWawancaraSiswaShow']) ? 'text-bg-light' : 'text-bg-secondary' }}">Jadwal Wawancara</span>
                    <span id="badge-for-progress-4" class="badge rounded-pill badge-for-progress-4 text-bg-secondary mx-2 my-3 {{ in_array(Route::currentRouteName(), ['hasilWawancaraFinansialShow']) ? 'text-bg-light' : 'text-bg-secondary' }}">Hasil Wawancara</span>
                    <span id="badge-for-progress-4" class="badge rounded-pill badge-for-progress-4 text-bg-secondary mx-2 my-3 {{ in_array(Route::currentRouteName(), ['siswaSeragamShow']) ? 'text-bg-light' : 'text-bg-secondary' }}">Jadwal Pengambilan Seragam</span>
                    <span id="badge-for-progress-5" class="badge rounded-pill badge-for-progress-4 text-bg-secondary mx-2 my-3 {{ in_array(Route::currentRouteName(), ['dokumenKelulusanShow']) ? 'text-bg-light' : 'text-bg-secondary' }}">Upload Dokumen Kelulusan</span>
                </div>
                @yield('content-space')
            </div>
        </div>
        @endif
    </div>
    {{-- Sweet Alert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Bootsrap JS--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    {{-- Custom Js --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('namespace-js')
</body>
</html>