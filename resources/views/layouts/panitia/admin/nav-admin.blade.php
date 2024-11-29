<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPDB SMP Maria Immaculata</title>
    {{-- Bootsrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panitia-style.css') }}">
    @yield('css-site')
    
    {{-- Google Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    @if (Auth::check())
    <div class="wrapper">
        <aside id="sidebar" class="">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="material-icons">menu</i>
                </button>
                <div class="sidebar-logo">
                    <img class="img-imex" src="{{ asset('image/logoPutihImex.png') }}" alt="">
                </div>
            </div>            
            <ul class="sidebar-nav" class="">
                <li class="sidebar-item">
                    <a href="@yield('home-space')" class="sidebar-link">
                        <i class="material-icons">
                            home
                            <span>Home</span>
                        </i>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="@yield('add-account-space')" class="sidebar-link">
                        <i class="material-icons">
                            person_add
                            <span>Daftar Staff</span>
                        </i>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="@yield('add-periodic-space')" class="sidebar-link">
                        <i class="material-icons">
                            calendar_today
                            <span>Tahun Ajaran</span>
                        </i>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main-area">
            <nav class="navbar navbar-expand-lg bg-body-secondary" id="navbar-top">
                <div class="container-fluid row">
                    <div class="col col-sm-4">
                        <h2>Hello {{ Auth::user()->name }}</h2>
                        <h5>@yield('jenis-panitia')</h5>
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
                                    <li><h6 class="dropdown-header">Pilih Akun :</h6></li>
                                    @foreach ($roles as $role)
                                        @if ($role == 'admin')
                                            <li>
                                                <a href="{{ route('adminShowhome') }}" class="dropdown-item">
                                                    Admin
                                                </a>
                                            </li>
                                        @elseif ($role == 'inti')
                                            <li>
                                                <a href="{{ route('homePanitiaIntiShow') }}" class="dropdown-item">
                                                    Panitia Inti
                                                </a>
                                            </li>
                                        @elseif ($role == 'keuangan')
                                            <li>
                                                <a href="{{ route('homePanitiaKeuanganShow') }}" class="dropdown-item">
                                                    Panitia Keuangan
                                                </a>
                                            </li>
                                        @elseif ($role == 'wawancara')
                                            <li>
                                                <a href="{{ route('homePanitiaWawancaraShow') }}" class="dropdown-item">
                                                    Panitia Wawancara
                                                </a>
                                            </li>
                                        @elseif ($role == 'seragam')
                                            <li>
                                                <a href="#" class="dropdown-item">
                                                    Panitia Seragam
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('logoutUser') }}">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-md">
                @yield('content-space')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/staff-site.js') }}"></script>
    @yield('script-js')
    @endif
</body>
</html>
</body>
</html>