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
    <section class="container-fluid mt-4">
        <div class="col mb-4 sistem-ppdb">
            <div class="header-tahun-ajaran">
                <h5>Calon Siswa Tahun Ajaran</h5>
                <select id="tahunAjaranSelect" class="form-select tahun-ajaran" aria-label="Default select example">
                    <option value="{{ $periodic->last()->tahun_ajaran }}" selected>Pilih Periode</option>
                @foreach ($periodic as $periode)
                    <option value="{{ $new_period =$periode->tahun_ajaran }}">{{ $periode->tahun_ajaran }}</option>
                @endforeach
                </select>
            </div>
            <hr>
            <table class="table display text-center" id="daftarTable">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama Akun</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Form Pendaftaran</th>
                        <th scope="col">Dokumen</th>
                        <th scope="col">Verifikasi</th>
                        <th scope="col">Seleksi</th>
                        <th scope="col">Wawancara</th>
                        <th scope="col">Seragam</th>
                        <th scope="col">Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sistem as $no=>$ppdb)
                    <tr class="
                    @if($countPeriode > 0)
                        @if($ppdb->tahun_ajaran != $periodic->last()->tahun_ajaran)
                            table-secondary
                        @else
                            @if($ppdb->isValid == 'Valid')
                                @if ($seragam[0]->user_id == $ppdb->user_id)
                                    @if($seragam[0]->seragam_senin == 1 && $seragam[0]->seragam_selasa == 1 && $seragam[0]->seragam_rabu == 1 && $seragam[0]->seragam_kamis == 1 && $seragam[0]->seragam_jumat == 1)
                                        table-success
                                    @elseif($seragam[0]->seragam_senin == null && $seragam[0]->seragam_selasa == null && $seragam[0]->seragam_rabu == null && $seragam[0]->seragam_kamis == null && $seragam[0]->seragam_jumat == null)
                                        table-warning
                                    @else
                                        table-primary
                                    @endif
                                @else
                                    table-warning
                                @endif
                            @elseif($ppdb->isValid == 'Menunggu')
                                table-warning
                            @else
                                table-danger
                            @endif
                        @endif
                    @endif
                    "
                    @if($countPeriode > 1)
                        @if($ppdb->tahun_ajaran != $periodic->last()->tahun_ajaran)
                            readonly
                        @endif
                    @endif 
                    >
                        <td>{{ $no+1 }}</td>
                        <td>{{ $ppdb->name }}</td>
                        <td>{{ $ppdb->nama_lengkap }}</td>
                        <td>
                            <a href="{{ route('pendaftaranDetailShow', $ppdb->user_id) }}" class="btn btn-info">Detail</a>
                        </td>
                        <td>
                            @if ($ppdb->file_foto_terbaru != null)
                                <a href="{{ route('dokumenDetailShow', $ppdb->user_id) }}" class="btn btn-info">Detail</a>
                            @else
                                Belum ada dokumen di upload
                            @endif
                        </td>
                        <td>
                            @if ($ppdb->isValid == 'Valid')
                                <span class="badge text-bg-success">{{ $ppdb->isValid }}</span>
                            @elseif($ppdb->isValid == 'Menunggu')
                                <span class="badge text-bg-secondary">{{ $ppdb->isValid }}</span>
                            @else
                                <span class="badge text-bg-danger">{{ $ppdb->isValid }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($ppdb->isValid == 'Valid')
                                @if ($ppdb->isLulus == 'Lulus')
                                    <span class="badge text-bg-success">Lanjut</span>
                                @else
                                    <a href="{{ route('seleksiSiswaPanitiaIntiDetailShow', $ppdb->user_id) }}" class="btn btn-info">Detail</a>
                                @endif
                            @elseif($ppdb->isValid == 'Tidak Valid' || $ppdb->isValid == 'Menunggu')
                                <span class="badge text-bg-secondary">Menunggu</span>
                            @endif
                        </td>
                        <td>
                        @if ($ppdb->isLulus == 'Lulus')
                            <a href="{{ route('createWawancaraPanitiaInti', $ppdb->user_id) }}" class="btn btn-info">Jadwal</a>
                        @else
                            <span class="badge text-bg-secondary">Menunggu</span>
                        @endif
                        </td>
                        <td>
                            @if($checkSeragam == false)
                                @if ($seragam[0]->user_id == $ppdb->user_id)
                                    @if ($seragam[0]->seragam_senin == null && $seragam[0]->seragam_selasa == null && $seragam[0]->seragam_rabu == null && $seragam[0]->seragam_kamis == null && $seragam[0]->seragam_jumat == null && $seragam[0]->pengambilan_seragam == null)
                                        <span class="badge text-bg-secondary">Belum ada jadwal</span>
                                    @elseif ($seragam[0]->seragam_senin == 1 && $seragam[0]->seragam_selasa == 1 && $seragam[0]->seragam_rabu == 1 && $seragam[0]->seragam_kamis == 1 && $seragam[0]->seragam_jumat == 1)
                                        <span class="badge text-bg-success">Sudah lengkap</span>
                                    @elseif($seragam[0]->seragam_senin == null && $seragam[0]->seragam_selasa == null && $seragam[0]->seragam_rabu == null && $seragam[0]->seragam_kamis == null && $seragam[0]->seragam_jumat == null && $seragam[0]->pengambilan_seragam != null)
                                        <span class="badge text-bg-warning">Belum diambil</span>
                                    @else
                                        <span class="badge text-bg-warning">Belum lengkap</span>
                                    @endif
                                @else
                                    <span class="badge text-bg-secondary">Menunggu</span>
                                @endif
                            @else
                                <span class="badge text-bg-secondary">Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $ppdb->tahun_ajaran}}</td>
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
            $('#daftarTable').DataTable();
            $('#myTable').DataTable();
        } );
    </script>
@endsection