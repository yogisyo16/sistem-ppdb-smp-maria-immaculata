@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="{{ asset('css/panitia-style.css') }}">
@endsection

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <li class="sidebar-item">
        <a href="{{ route('homePanitiaIntiShow') }}" class="sidebar-link">
            <i class="material-icons">
                home
                <span>Home</span>
            </i>
        </a>
    </li>
@endsection

@section('content-space')
<div class="container mt-4">
    <div class="mb-4 mt-2">
        <a href="{{ route('viewWawancaraPanitiaIntiShow', $wawancaramurid[0]->user_id) }}" class="btn btn-primary">Back</a>
    </div>
@if ($wawancaramurid[0]->penilaian_wawancara_anak == 0 && $wawancaramurid[0]->catatan_wawancara_anak == null)
    <div class="d-flex justify-content-center">
        <h4>Belum ada data</h4>
    </div>
@else
    <div class="row">
        <h4 class="mx-2">Hasil Wawancara Murid {{ $wawancaramurid[0]->nama_lengkap }}</h4>
        <hr>
        {{-- penilaian_wawancara_anak --}}
        <div class="mx-2 mb-3">
            <label for="penilaian_wawancara_anak" class="form-label">Penilaian Wawancara Murid</label>
            <input type="text" readonly class="form-control" id="penilaian_wawancara_anak" value="{{ $wawancaramurid[0]->penilaian_wawancara_anak }}">
        </div>
        {{-- catatan_wawancara_anak --}}
        <div class="mx-2 mb-3">
            <label for="catatan_wawancara_anak" class="form-label">Catatan Wawancara Murid</label>
            <textarea readonly class="form-control" id="catatan_wawancara_anak">{{ $wawancaramurid[0]->catatan_wawancara_anak }}</textarea>
        </div>
    </div>
@endif
</div>
@endsection