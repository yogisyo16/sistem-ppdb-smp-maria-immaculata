@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
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
    <section class="container-fluid mt-4 text-center">
        <div class="d-flex justify-content-start">
            <a href="{{ route('homePanitiaIntiShow') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="mt-2 d-flex justify-content-center">
        @foreach ($wawancara as $item)
            <div class="row text-center">
                <h4>Jadwal Wawancara : {{ $item->nama_lengkap }}</h4>
                <hr>
                <div class="mt-4 mb-2">
                    <h5>Nama Pewawancara : {{ $item->nama_pewawancara }}</h5>
                    <h5>Tanggal Wawancara : {{ $item->tgl_wawancara }}</h5>
                    <h5>Waktu Wawancara : {{ date('H:i', strtotime($item->waktu_wawancara)) }}</h5>
                    <h5>Tempat Wawancara : SMP Maria Immaculata</h5>
                </div>
            </div>
        @endforeach
        </div>
        <div class="mt-2 mb-4">
            <h4>Hasil Wawancara</h4>
            <hr>
            <a href={{ route('viewWawancaraFinansialPanitiaIntiShow', $wawancara[0]->user_id) }}" class="btn btn-info">Wawancara Finansial</a>
            <a href="{{ route('viewWawancaraMuridPanitiaIntiShow', $wawancara[0]->user_id) }}" class="btn btn-info">Wawancara Murid</a>
        </div>
    </section>
@endsection

@section('script-js')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="{{ asset('js/table-filter.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#daftarTable').DataTable();
            $('#myTable').DataTable();
        } );
    </script>
@endsection