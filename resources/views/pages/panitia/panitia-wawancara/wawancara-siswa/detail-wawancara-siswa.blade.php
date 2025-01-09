@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <li class="sidebar-item">
        <a href="{{ route('homePanitiaWawancaraShow') }}" class="sidebar-link">
            <i class="material-icons">
                home
                <span>Home</span>
            </i>
        </a>
    </li>
@endsection

@section('content-space')
    <div class="container mt-4">
        <form method="POST" action="{{ route('wawancaraMuridDetailSubmit', $wawancara[0]->id) }}">
            @csrf
            <h4 class="mx-2">Hasil Wawancara Murid {{ $wawancara[0]->nama_lengkap }}</h4>
            <hr>
            {{-- penilaian_wawancara_anak --}}
            <div class="mx-2 mb-3">
                <label for="penilaian_wawancara_anak" class="form-label">Penilaian Wawancara Murid</label>
                <input type="text" class="form-control" name="penilaian_wawancara_anak" id="penilaian_wawancara_anak" value="{{ $wawancara[0]->penilaian_wawancara_anak }}">
            </div>
            {{-- catatan_wawancara_anak --}}
            <div class="mx-2 mb-3">
                <label for="catatan_wawancara_anak" class="form-label">Catatan Wawancara Murid</label>
                <textarea type="" class="form-control" name="catatan_wawancara_anak" id="catatan_wawancara_anak">{{ $wawancara[0]->catatan_wawancara_anak }}</textarea>
            </div>
            <div class="btn-group">
                <a href="{{ route('homePanitiaWawancaraShow') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
@endsection