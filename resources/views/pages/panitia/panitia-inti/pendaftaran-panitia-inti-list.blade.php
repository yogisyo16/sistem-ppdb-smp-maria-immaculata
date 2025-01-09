@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/panitia-style.css') }}">
@endsection

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <ul class="sidebar-nav" class="expand">
        <li class="sidebar-item">
            <a href="{{ route('homePanitiaIntiShow') }}" class="sidebar-link">
                <i class="material-icons">
                    home
                    <span>Home</span>
                </i>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('pendaftaranListShow') }}" class="sidebar-link">
                <i class="material-icons">
                    assignment
                    <span>Pendaftaran Siswa</span>
                </i>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="material-icons">
                    upload_file
                    <span>Dokumen Siswa</span>
                </i>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="material-icons">
                    check_circle
                    <span>Verifikasi</span>
                </i>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="material-icons">
                    date_range
                    <span>Wawancara</span>
                </i>
            </a>
        </li>
    </ul>
@endsection

@section('content-space')
    <section class="container-fluid mt-4">
        <div class="col mb-4 siswa-mendaftar">
            <h5>Siswa yang mendaftar</h5>
            <table class="table display" id="listDaftarTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Asal SD</th>
                        <th scope="col">File Bukti Pembayaran</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaran as $no=>$daftar)
                    <tr>
                            <td scope="row">{{ $no+1 }}</td>
                            <td>{{ $daftar->nama_lengkap }}</td>
                            <td>{{ $daftar->nama_sekolah_sd }}</td>
                            @if ($daftar->file_bukti_pembayaran_pendaftaran == null)
                                <td>Belum mengupload bukti pembayaran</td>
                            @else
                                <td>{{ $daftar->file_bukti_pembayaran_pendaftaran == null ? 'Belum mengupload' : $daftar->file_bukti_pembayaran_pendaftaran }}</td>
                            @endif
                            <td>
                                <a href="{{ route('pendaftaranDetailShow', $daftar->user_id) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('script-js')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="{{ asset('js/table-filter.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#listDaftarTable').DataTable();
        } );
    </script>
@endsection