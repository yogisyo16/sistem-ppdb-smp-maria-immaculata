@extends('layouts.user-auth.nav-many-user')

@section('front-space')
@if ($rolecount > 0)
<section class="container-fluid mt-4">
    <h5 class="text-center">Hello {{ Auth::user()->name }}!</h5>
    <div class="col mt-5 pt-5 d-flex align-content-center justify-content-center">
        @foreach ($roles as $role)
        <div class="card mb-2 mx-2"">
            <div class="card-body">
                <h5 class="card-title">{{ $role }}</h5>
                @if ($role == 'admin')
                    <p>Masuk ke halaman dashboard admin</p>
                    <a href="{{ route('adminShowhome') }}" class="btn btn-primary">Masuk</a>
                @elseif ($role == 'inti')
                    <p>Masuk ke halaman dashboard panitia inti</p>
                    <a href="{{ route('homePanitiaIntiShow') }}" class="btn btn-primary">Masuk</a>
                @elseif ($role == 'keuangan')
                    <p>Masuk ke halaman dashboard Panitia Keuangan</p>
                    <a href="{{ route('homePanitiaKeuanganShow') }}" class="btn btn-primary">Masuk</a>
                @elseif ($role == 'wawancara')
                    <p>Masuk ke halaman dashboard Panitia Wawancara</p>
                    <a href="{{ route('homePanitiaWawancaraShow') }}" class="btn btn-primary">Masuk</a>
                @elseif ($role == 'seragam')
                    <p>Masuk ke halaman dashboard Panitia Seragam</p>
                    <a href="{{ route('homePanitiaSeragamShow') }}" class="btn btn-primary">Masuk</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif
@endsection
