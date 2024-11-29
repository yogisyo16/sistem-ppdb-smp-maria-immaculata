@extends('layouts.siswa.nav-siswa-ppdb')
@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/seleksi-style.css') }}">
@endsection
@section('content-space')
<div class="container-fluid">
    <div class="row container mt-4 mb-2 d-flex justify-content-center container-bg-seleksi">
        @foreach ($seleksi as $data)
            @if ($data->isLulus == 'Menunggu')
                <div class="mt-2 d-flex justify-content-center">
                    <div class="row text-center">
                        <h4>Terima kasih sudah mendaftar</h4>
                        <h5>Silahkan menunggu hasil seleksi</h5>
                    </div>
                </div>
            @elseif ($data->isLulus == 'Tidak Lulus')
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="80px" viewBox="0 0 24 24" width="80px" fill="#75FB4C"><rect fill="none" height="24" width="24"/><path d="M22,5.18L10.59,16.6l-4.24-4.24l1.41-1.41l2.83,2.83l10-10L22,5.18z M19.79,10.22C19.92,10.79,20,11.39,20,12 c0,4.42-3.58,8-8,8s-8-3.58-8-8c0-4.42,3.58-8,8-8c1.58,0,3.04,0.46,4.28,1.25l1.44-1.44C16.1,2.67,14.13,2,12,2C6.48,2,2,6.48,2,12 c0,5.52,4.48,10,10,10s10-4.48,10-10c0-1.19-0.22-2.33-0.6-3.39L19.79,10.22z"/></svg>
                <div class="mt-2 d-flex justify-content-center">
                    <h4>Maaf Kamu belum diterima</h4>
                </div>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="80px" viewBox="0 0 24 24" width="80px" fill="#75FB4C"><rect fill="none" height="24" width="24"/><path d="M22,5.18L10.59,16.6l-4.24-4.24l1.41-1.41l2.83,2.83l10-10L22,5.18z M19.79,10.22C19.92,10.79,20,11.39,20,12 c0,4.42-3.58,8-8,8s-8-3.58-8-8c0-4.42,3.58-8,8-8c1.58,0,3.04,0.46,4.28,1.25l1.44-1.44C16.1,2.67,14.13,2,12,2C6.48,2,2,6.48,2,12 c0,5.52,4.48,10,10,10s10-4.48,10-10c0-1.19-0.22-2.33-0.6-3.39L19.79,10.22z"/></svg>
                <div class="mt-2 d-flex justify-content-center">
                    <h4>Selamat Kamu diterima di jalur pendaftaran 
                        @if ( $data->hasil_jalur_pendaftaran  == 'Reguler')
                            Reguler
                        @elseif( $data->hasil_jalur_pendaftaran  == 'Akademik')
                            Prestasi Akademik
                        @elseif( $data->hasil_jalur_pendaftaran  == 'NonAkademik')
                            Prestasi : Sains, Olahraga dan Seni
                        @endif
                    </h4>
                </div>
            @if ($wawancara != null)
                @foreach ($wawancara as $siswaWawancara)
                    <a href="{{ route('jadwalWawancaraSiswaShow', Auth::user()->id) }}" class="btn btn-primary">Jadwal Wawancara</a>
                @endforeach
            @else
                <div class="mt-2 d-flex justify-content-center">
                    <h4>Harap Menunggu Jadwal Wawancara</h4>
                </div>
            @endif
            @endif
        @endforeach
        <hr>
        <div class="mt-2 d-flex justify-content-center">
            <div class="row text-center">
                <h4>Jumlah Siswa yang sudah mendaftar</h4>
                <p>Jumlah siswa yang mendaftar di jalur Reguler : {{ $jalur_reguler }}</p>
                <p>Jumlah siswa yang mendaftar di jalur Prestasi Akademik : {{ $jalur_akademik }}</p>
                <p>Jumlah siswa yang mendaftar di jalur Prestasi : Sains, Olahraga dan Seni : {{ $jalur_nonakademik }}</p>
            </div>
        </div>
    </div>
    {{-- //Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah anda sudah yakin?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Form pendaftaran akan kami simpan</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary form-pendaftaran-siswa" onclick="submitForm('{{ route('pendaftaranSiswaSubmit') }}')">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection