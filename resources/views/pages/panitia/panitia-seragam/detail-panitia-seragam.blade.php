@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <li class="sidebar-item">
        <a href="{{ route('homePanitiaSeragamShow') }}" class="sidebar-link">
            <i class="material-icons">
                home
                <span>Home</span>
            </i>
        </a>
    </li>
@endsection

@section('content-space')
    <div class="container mt-4">
        <form method="POST" action="{{ route('seragamJadwalSubmit', $seragam[0]->user_id) }}">
            @csrf
            <h4 class="mx-2">Tanggal Pengambilan Seragam : {{ $seragam[0]->nama_lengkap }}</h4>
            <hr>
            {{-- Tanggal Pengambilan Seragam --}}
            <div class="mx-2 mb-3">
                <label for="pengambilan_seragam" class="form-label">Pengambilan Seragam</label>
                <input type="date" class="form-control" name="pengambilan_seragam" id="pengambilan_seragam">
            </div>
            <div class="mx-2 mb-3">
                <label for="waktu_pengambilan_seragam" class="form-label">Waktu Pengambilan Seragam</label>
                <input type="time" class="form-control" id="waktu_pengambilan_seragam" name="waktu_pengambilan_seragam">
            </div>
            <div class="btn-group">
                <a href="{{ route('homePanitiaSeragamShow') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
@endsection