@extends('layouts.siswa.nav-siswa-ppdb')
@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/seleksi-style.css') }}">
@endsection
@section('content-space')
<div class="container-fluid">
    <div class="row container mt-4 mb-2 d-flex justify-content-center container-bg-seleksi">
        @foreach ($wawancara as $item)
            <div class="mt-2 d-flex justify-content-center">
                <div class="row text-center">
                    <h4>Jadwal Wawancara</h4>
                </div>
            </div>
            <hr>
            <div class="mt-4 d-flex justify-content-center">
                <div class="row">
                    <h5>Nama Pewawancara : {{ $item->nama_pewawancara }}</h5>
                    <h5>Tanggal Wawancara : {{ $item->tgl_wawancara }}</h5>
                    <h5>Waktu Wawancara : {{ date('H:i', strtotime($item->waktu_wawancara)) }} WIB</h5>
                    <h5>Tempat Wawancara : SMP Maria Immaculata</h5>
                    @if ($item->hsl_udp != null)
                        <a href="{{ route('hasilWawancaraFinansialShow', $item->user_id) }}" class="btn btn-primary">Hasil Wawancara</a>
                    @else
                        <a href="https://maps.app.goo.gl/ZrQ579DHrCSyzMk58" target="_blank" class="btn btn-info">Lokasi</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection