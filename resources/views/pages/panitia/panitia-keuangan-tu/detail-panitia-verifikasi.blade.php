@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="{{ asset('css/keuangan-style.css') }}">
@endsection

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <li class="sidebar-item">
        <a href="{{ route('homePanitiaKeuanganShow') }}" class="sidebar-link">
            <i class="material-icons">
                home
                <span>Home</span>
            </i>
        </a>
    </li>
@endsection

@section('content-space')
    <div class="container mt-4 mb-4">
        <form method="POST" action="{{ route('validasiBuktiSubmit', $pendaftaran[0]->user_id) }}">
            @csrf
            <h4>Verifikasi Bukti Pembayaran</h4>
            <div class="mb-2">
                <div class="mx-2 mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Calon Siswa:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $pendaftaran[0]->nama_lengkap }}">
                    </div>
                </div>
                <div class="mx-2 mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">File Bukti Pembayaran:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $pendaftaran[0]->file_bukti_pembayaran_pendaftaran }}">
                        <img class="validasi-img" src="{{ asset('storage/' . $pendaftaran[0]->file_bukti_pembayaran_pendaftaran) }}" alt="">
                    </div>
                </div>
                <div class="mx-2 mb-3 row">
                    <select class="form-select" name="isValid" aria-label="Default select example">
                        <option selected value="Menunggu">Validasi Bukti Pembayaran</option>
                        <option value="Valid">Valid</option>
                        <option value="Tidak Valid">Tidak Valid</option>
                    </select>
                </div>
            </div>
            <div class="btn-group">
                <a class="btn btn-warning" href="{{ route('homePanitiaKeuanganShow') }}">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <hr>
        </form>
    </div>
@endsection