@extends('layouts.panitia.role-panitia.nav-role-panitia')
@section('css-table')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/panitia-style.css') }}">
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
    <section class="container-fluid mt-4">
        <div class="col mb-4 siswa-mendaftar">
            <h5>Menunggu Verifikasi</h5>
            <hr>
            <table class="table" id="tableValidasi">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">File Pembayaran</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $no=>$bayar)
                    <tr class = "
                        @if ($bayar->isValid == 'Valid')
                            table-success
                        @elseif($bayar->isValid == 'Tidak Valid')
                            table-warning
                        @else
                            table-light
                        @endif
                    ">
                        <td scope="row">{{ $no+1 }}</td>
                        <td>{{ $bayar->nama_lengkap }}</td>
                        <td>{{ $bayar->email }}</td>
                        <td>
                            @if ($bayar->itHasFile == true)
                            <a href="{{ route('validasiBuktiShow', $bayar->user_id) }}" class="btn btn-info">Detail</a>
                            @else
                            <a href="{{ route('validasiBuktiShow', $bayar->user_id) }}" class="btn btn-info" disabled>Detail</a>
                            @endif
                        </td>
                        <td>
                            @if ($bayar->itHasFile == true)
                                @if ($bayar->isValid == 'Valid')
                                <span class="badge text-bg-success">Sudah di Validasi</span>
                                @elseif($bayar->isValid == 'Tidak Valid')
                                <span class="badge text-bg-warning">Tidak bisa di Validasi</span>
                                @else
                                <span class="badge text-bg-light">Menunggu Validasi</span>
                                @endif
                            @else
                                <span class="badge text-bg-light">Belum ada file</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('script-js')
    <script src="{{ asset('js/panitia-keuangan.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="{{ asset('js/table-filter.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#tableValidasi').DataTable();
        } );
    </script>
@endsection