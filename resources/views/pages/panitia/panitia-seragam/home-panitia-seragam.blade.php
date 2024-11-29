@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/panitia-style.css') }}">
@endsection

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem item
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
    <section class="container-fluid mt-4">
        <div class="col mb-4 siswa-mendaftar">
            <h5>List Siswa</h5>
            <table class="table display" id="seragamTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Tanggal Pengambilan Seragam</th>
                        <th scope="col">Detail Pengambilan</th>
                        <th scope="col">Status Pengambilan Seragam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seragam as $no=>$item)
                    <tr class="
                        @if ($item->seragam_senin == null && $item->seragam_selasa == null && $item->seragam_rabu == null && $item->seragam_kamis == null && $item->seragam_jumat == null)
                            
                        @elseif ($item->seragam_senin == 1 && $item->seragam_selasa == 1 && $item->seragam_rabu == 1 && $item->seragam_kamis == 1 && $item->seragam_jumat == 1)
                            table-success
                        @else
                            table-warning
                        @endif
                    ">
                        <td>{{ $no+1 }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>
                            @if ($item->pengambilan_seragam == null)
                                <a href="{{ route('seragamDetailShow', $item->user_id) }}" class="btn btn-info">Buat Tanggal</a>
                            @else
                                {{ $item->pengambilan_seragam }}
                            @endif
                        </td>
                        <td>
                            @if ($item->pengambilan_seragam == null)
                                Belum ada data
                            @else
                                <a href="{{ route('seragamBajuShow', $item->user_id) }}" class="btn btn-info">Detail</a>
                            @endif
                        </td>
                        <td>
                            @if ($item->seragam_senin == null && $item->seragam_selasa == null && $item->seragam_rabu == null && $item->seragam_kamis == null && $item->seragam_jumat == null && $item->pengambilan_seragam == null)
                                <span class="badge text-bg-secondary">Belum ada jadwal</span>
                            @elseif ($item->seragam_senin == 1 && $item->seragam_selasa == 1 && $item->seragam_rabu == 1 && $item->seragam_kamis == 1 && $item->seragam_jumat == 1)
                                <span class="badge text-bg-success">Sudah lengkap</span>
                            @elseif($item->seragam_senin == null && $item->seragam_selasa == null && $item->seragam_rabu == null && $item->seragam_kamis == null && $item->seragam_jumat == null && $item->pengambilan_seragam != null)
                                <span class="badge text-bg-warning">Belum diambil</span>
                            @else
                                <span class="badge text-bg-warning">Belum lengkap</span>
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
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="{{ asset('js/table-filter.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#seragamTable').DataTable();
        } );
    </script>
@endsection