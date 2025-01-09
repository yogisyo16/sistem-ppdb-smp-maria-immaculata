@extends('layouts.panitia.role-panitia.nav-role-panitia')

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
        @foreach ($userSiswa as $siswa)
        <form method="POST" action="{{ route('createWawancaraPanitiaIntiSubmit', $siswa->user_id) }}">
            @csrf
            <h4>Jadwal Wawancara</h4>
            <hr>
            <div class="mb-2">
                <div class="mx-2 mb-3 d-flex">
                    <h6>Nama Siswa : {{ $siswa->nama_lengkap }}</h6>
                </div>
                <div class="mx-2 mb-3 d-flex">
                    <h6>Jalur Pendaftaran : {{ $siswa->hasil_jalur_pendaftaran }}</h6>
                </div>
                <div class="mx-2 mb-3 row">
                    <select class="form-select" name="nama_pewawancara" aria-label="Default select example">
                        <option selected value="">Penanggung Jawab Wawancara :</option>
                        @foreach ($userWawancara as $wawancara)
                            <option value="{{ $wawancara->name }}">{{ $wawancara->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mx-2 mb-3">
                    <label for="tgl_wawancara" class="form-label">
                        Tanggal Wawancara
                    </label>
                    <input type="date" class="form-control" id="tgl_wawancara" name="tgl_wawancara" min="2014-01-01" max="2070-12-31">
                </div>
            </div>
            <div class="col-md-2 mx-2 mb-3">
                <label for="waktu_wawancara" class="form-label">Waktu Wawancara</label>
                <input type="time" class="form-control" id="waktu_wawancara" name="waktu_wawancara">
            </div>
            <div class="btn-group">
                <a href="{{ route('homePanitiaIntiShow') }}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @endforeach
    </div>
@endsection