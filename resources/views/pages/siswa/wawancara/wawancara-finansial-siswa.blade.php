@extends('layouts.siswa.nav-siswa-ppdb')
@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/seleksi-style.css') }}">
@endsection
@section('content-space')
<div class="container-fluid">
    <div class="row container mt-4 mb-2 d-flex justify-content-center container-bg-seleksi">
        @foreach ($check_finansial as $item)
            @if ($item == null)
                <div class="mt-2 d-flex justify-content-center">
                    Harap menunggu data dimasukkan
                </div>
            @else
                <div class="row">
                    <div class="mt-2 d-flex justify-content-center">
                        <h4>Pembayaran Sekolah</h4>
                    </div>
                </div>
                <hr>
                <div class="mt-4 mb-4">
                    <div class="mx-2">
                        <label for="hls_udp">Pembayaran UDP: {{ $item->hsl_udp }}</label>
                    </div>
                    <div class="mx-2 mt-4">
                        <label for="hsl_spp">Pembayaran SPP: {{ $item->hsl_spp }}</label>
                    </div>
                    <div class="mx-2 mt-4">
                        <label for="hsl_ups">Pembayaran UPS: {{ $item->hsl_ups }}</label>
                    </div>
                    <div class="mx-2 mt-4">
                        <label for="hsl_uang_seragam">Uang Seragam: {{ $item->hsl_uang_seragam }}</label>
                    </div>
                    <div class="mx-2 mt-4">
                        <label for="hsl_uang_kegiatan">Uang Kegiatan: {{ $item->hsl_uang_kegiatan }}</label>
                    </div>
                    <div class="mx-2 mt-4">
                        <label for="hsl_uang_alat">Uang Alat: {{ $item->hsl_uang_alat }}</label>
                    </div>
                    <hr>
                    <div class="mx-2 mt-4">
                        <label for="total_tunai">Total Biaya: {{ $item->total_uang }}</label>
                    </div>
                    <hr>
                    <div class="mx-2 mt-4">
                        <label for="total_tunai">Total yang sudah dibayar: {{ $item->total_dibayar }}</label>
                    </div>
                    <hr>
                    <div class="mx-2 mt-4">
                        <label for="total_tunai">Total biaya yang harus dibayar: {{ $item->total_tunai }}</label>
                    </div>
                    <hr>
                </div>
            @endif
        @endforeach
        <div class="btn-for-jadwal">
            @if ($seragam[0]->pengambilan_seragam == null)
                <h4>Harap Menunggu Jadwal Pengambilan Seragam</h4>            
            @else
                <a href="{{ route('siswaSeragamShow', $wawancara_finansial[0]->user_id) }}" class="btn btn-primary">Jadwal Pengambilan Seragam</a>
            @endif
        </div>
    </div>
</div>
@endsection