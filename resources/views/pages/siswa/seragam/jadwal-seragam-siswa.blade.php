@extends('layouts.siswa.nav-siswa-ppdb')
@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/seleksi-style.css') }}">
@endsection
@section('content-space')
<div class="container-fluid">
    <div class="row container mt-4 mb-2 d-flex justify-content-center container-bg-seleksi">
        @foreach ($seragam as $item)
            <div class="mt-2 d-flex justify-content-center">
                <div class="row text-center">
                    <h4>Jadwal Wawancara</h4>
                </div>
            </div>
            <hr>
            <div class="mt-4 mb-4 d-flex justify-content-center">
                <div class="row">
                    <h5>Tanggal Wawancara : {{ $item->pengambilan_seragam }}</h5>
                    <h5>Waktu Wawancara : {{ date('H:i', strtotime($item->waktu_pengambilan_seragam)) }} WIB</h5>
                    <h5>Tempat Wawancara : SMP Maria Immaculata</h5>
                    {{-- <a href="https://maps.app.goo.gl/ZrQ579DHrCSyzMk58" target="_blank" class="btn btn-info">Lokasi</a> --}}
                </div>
            </div>
            <hr>
            <div class="mt-4 mb-2 d-flex justify-content-start">
                <div class="row">
                    <h5>Seragam Hari Senin : 
                        @if ($item->seragam_senin == null)
                            Belum Diambil
                        @else
                            Sudah Diambil
                        @endif
                    </h5>
                    <h5>
                        Seragam Hari Selasa : 
                        @if ($item->seragam_selasa == null)
                            Belum Diambil
                        @else
                            Sudah Diambil
                        @endif
                    </h5>
                    <h5>
                        Seragam Hari Rabu :
                        @if ($item->seragam_rabu == null)
                            Belum Diambil
                        @else
                            Sudah Diambil
                        @endif
                    </h5>
                    <h5>
                        Seragam Hari Kamis :
                        @if ($item->seragam_kamis == null)
                            Belum Diambil
                        @else
                            Sudah Diambil
                        @endif
                    </h5>
                    <h5>
                        Seragam Hari Jumat :
                        @if ($item->seragam_jumat == null)
                            Belum Diambil
                        @else
                            Sudah Diambil
                        @endif
                    </h5>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="btn-group">
            <a href="{{ route('hasilWawancaraFinansialShow', $seragam[0]->user_id) }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('dokumenKelulusanShow', $seragam[0]->user_id) }}" class="btn btn-primary">Upload Berkas Kelulusan</a>
        </div>
    </div>
</div>
@endsection