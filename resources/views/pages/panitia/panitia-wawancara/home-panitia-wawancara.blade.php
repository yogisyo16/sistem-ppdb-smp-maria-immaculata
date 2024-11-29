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
        <a href="{{ route('homePanitiaWawancaraShow') }}" class="sidebar-link">
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
            <h5>List wawancara siswa</h5>
            <table class="table display" id="wawancaraTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Tanggal Wawancara</th>
                        <th scope="col">Form Pendaftaran</th>
                        <th scope="col">Wawancara Finansial</th>
                        <th scope="col">Wawancara Murid</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($wawancara != null)
                        @foreach ($wawancara as $no=>$wawancarasiswa)
                            <tr class="
                                @if ($wawancarasiswa->total_tunai == 'Rp. 0')
                                    table-success
                                @elseif($wawancarasiswa->total_tunai == null && $wawancarasiswa->penilaian_wawancara_anak == 'belum ada nilai')
                                    table-secondary
                                @elseif($wawancarasiswa->penilaian_wawancara_anak == 'belum ada nilai')
                                    table-warning
                                @elseif($wawancarasiswa->total_tunai == null)
                                    table-warning
                                @endif
                            "
                            >
                                <td scope="row">{{ $no+1 }}</td>
                                <td>{{ $wawancarasiswa->nama_lengkap }}</td>
                                <td>{{ $wawancarasiswa->tgl_wawancara }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalPendaftaran1">
                                        Pendaftaran
                                    </button>
                                </td>
                                <td><a href="{{ route('wawancaraFinansialDetailShow', $wawancarasiswa->user_id) }}" class="btn btn-info">Input Data</a></td>
                                <td><a href="{{ route('wawancaraMuridDetailShow', $wawancarasiswa->user_id) }}" class="btn btn-info">Input Data</a></td>
                                <td>
                                    {{-- {{ $wawancarasiswa->total_tunai }} --}}
                                    @if ($wawancarasiswa->total_tunai == 'Rp. 0')
                                        <span class="badge text-bg-success">Lunas</span>
                                    @elseif($wawancarasiswa->total_tunai == null && $wawancarasiswa->penilaian_wawancara_anak == 'belum ada nilai')
                                        <span class="badge text-bg-secondary">Belum di proses</span>
                                    @elseif($wawancarasiswa->penilaian_wawancara_anak == 'belum ada nilai')
                                        <span class="badge text-bg-warning">Belum Lunas</span>
                                    @elseif($wawancarasiswa->total_tunai == null)
                                        <span class="badge text-bg-warning">Belum Memasukkan Pembayaran</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </section>
    <div class="modal fade" id="ModalPendaftaran1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Informasi Pribadi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    @foreach ($wawancara as $user)
                    <div class="d-flex justify-content-center mb-4">
                        <h4>Nama Akun: {{ $user->name }}</h4>
                    </div>
                    @endforeach
                    <table class="table table-bordered">
                        @foreach ($wawancara as $pendaftaran)
                        <tr>
                            <th>Nama Lengkap:</th>
                            <td>{{ $pendaftaran->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir:</th>
                            <td>{{ $pendaftaran->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir:</th>
                            <td>{{ $pendaftaran->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP:</th>
                            <td>{{ $pendaftaran->nohp }}</td>
                        </tr>
                        <tr>
                            <th>Anak ke:</th>
                            <td>{{ $pendaftaran->anak_ke }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Saudara:</th>
                            <td>{{ $pendaftaran->jumlah_saudara }}</td>
                        </tr>
                        <tr>
                            <th>Kelamin:</th>
                            <td>{{ $pendaftaran->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Agama:</th>
                            <td>{{ $pendaftaran->agama }}</td>
                        </tr>
                        <tr>
                            <th>Jalur Pendaftaran:</th>
                            <td>{{ $pendaftaran->jalur_pendaftaran }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Tinggal C1/KK:</th>
                            <td>{{ $pendaftaran->alamat_tinggal_c1_kk }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Tinggal Sekarang:</th>
                            <td>{{ $pendaftaran->alamat_tmpt_tinggal }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" data-bs-target="#ModalPendaftaran2" data-bs-toggle="modal">Next</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalPendaftaran2" aria-hidden="true" aria-labelledby="ModalPendaftaran2" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Informasi Asal Sekolah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>NISN:</th>
                        <td>{{ $pendaftaran->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Nama Sekolah SD:</th>
                        <td>{{ $pendaftaran->nama_sekolah_sd }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Sekolah SD:</th>
                        <td>{{ $pendaftaran->alamat_sekolah_sd }}</td>
                    </tr>
                    <tr>
                        <th><h4 class="mt-4">Nilai Rapor SD</h4></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Nilai Rapot Matematika Kelas V Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_matematika_klsv_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot Bhs.Indonesia Kelas V Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_bhsindo_klsv_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPA Kelas V Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ipa_klsv_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPS Kelas V Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ips_klsv_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot Matematika Kelas V Semester 2:</th>
                        <td>{{ $pendaftaran->nilai_rapot_matematika_klsv_smt2 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot Bhs.Indonesia Kelas V Semester 2:</th>
                        <td>{{ $pendaftaran->nilai_rapot_bhsindo_klsv_smt2 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPA Kelas V Semester 2:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ipa_klsv_smt2 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPS Kelas V Semester 2:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ips_klsv_smt2 }}</td>
                    </tr>
                    @if ($pendaftaran->nilai_rapot_bhsindo_klsvi_smt1 != null)
                        <tr>
                        <th>Nilai Rapot Matematika Kelas VI Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_matematika_klsvi_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot Bhs.Indonesia Kelas VI Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_bhsindo_klsvi_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPA Kelas VI Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ipa_klsvi_smt1 }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rapot IPS Kelas VI Semester 1:</th>
                        <td>{{ $pendaftaran->nilai_rapot_ips_klsvi_smt1 }}</td>
                    </tr>
                    @endif
                    @if ($pendaftaran->is_diy == 1)
                    <tr>
                        <th><h4 class="mt-4">Nilai ASPD DIY</h4></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Nilai Membaca:</th>
                        <td>{{ $pendaftaran->nilai_literasi_membaca_aspd }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Numerasi:</th>
                        <td>{{ $pendaftaran->nilai_literasi_numerasi_aspd }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Sains:</th>
                        <td>{{ $pendaftaran->nilai_literasi_sains_aspd }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#ModalPendaftaran1" data-bs-toggle="modal">Back</button>
                <button class="btn btn-primary" data-bs-target="#ModalPendaftaran3" data-bs-toggle="modal">Next</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalPendaftaran3" aria-hidden="true" aria-labelledby="ModalPendaftaran3" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Informasi Orang Tua/Wali/h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    @if ($pendaftaran->nama_ayah != null)
                    <tr>
                        <th>Nama Ayah:</th>
                        <td>{{ $pendaftaran->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Email Ayah:</th>
                        <td>{{ $pendaftaran->email_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Tempat Tinggal Ayah:</th>
                        <td>{{ $pendaftaran->alamat_ayah }}</td>
                    </tr>
                    <tr>
                        <th>No Telpon Ayah:</th>
                        <td>{{ $pendaftaran->no_telpon_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Terakhir Ayah:</th>
                        <td>{{ $pendaftaran->pendidikan_terakhir_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ayah:</th>
                        <td>{{ $pendaftaran->pekerjaan_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Ayah:</th>
                        <td>{{ $pendaftaran->penghasilan_ayah }}</td>
                    </tr>
                    @endif
                    @if ($pendaftaran->nama_ibu != null)
                    <tr>
                        <th>Nama Ibu:</th>
                        <td>{{ $pendaftaran->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Email Ibu:</th>
                        <td>{{ $pendaftaran->email_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Tempat Tinggal Ibu:</th>
                        <td>{{ $pendaftaran->alamat_ibu }}</td>
                    </tr>
                    <tr>
                        <th>No Telpon Ibu:</th>
                        <td>{{ $pendaftaran->no_telpon_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Terakhir Ibu:</th>
                        <td>{{ $pendaftaran->pendidikan_terakhir_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ibu:</th>
                        <td>{{ $pendaftaran->pekerjaan_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Ibu:</th>
                        <td>{{ $pendaftaran->penghasilan_ibu }}</td>
                    </tr>
                    @endif
                    @if ($pendaftaran->nama_wali != null)
                        <tr>
                        <th>Nama Wali:</th>
                        <td>{{ $pendaftaran->nama_wali }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Tempat Tinggal Wali:</th>
                        <td>{{ $pendaftaran->alamat_wali }}</td>
                    </tr>
                    <tr>
                        <th>No Telpon Wali:</th>
                        <td>{{ $pendaftaran->no_telpon_wali }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Terakhir Wali:</th>
                        <td>{{ $pendaftaran->pendidikan_terakhir_wali }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Wali:</th>
                        <td>{{ $pendaftaran->pekerjaan_wali }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Wali:</th>
                        <td>{{ $pendaftaran->penghasilan_wali }}</td>
                    </tr>
                    @endif
                    {{-- <tr>
                        <th>Download PDF</th>
                        <td><a href="{{ route('generatePDF', $pendaftaran->user_id) }}" class="btn btn-primary" target="_blank">Download</a></td>
                    </tr> --}}
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#ModalPendaftaran2" data-bs-toggle="modal">Back</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('script-js')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="{{ asset('js/table-filter.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#wawancaraTable').DataTable();
        } );
    </script>
@endsection