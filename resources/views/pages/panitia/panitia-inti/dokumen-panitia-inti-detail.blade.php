@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('css-table')
    <link rel="stylesheet" href="{{ asset('css/dokumen-view.css') }}">
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
    <div class="container mt-5">
        <a href="{{ route('homePanitiaIntiShow') }}" class="btn btn-primary">Back</a>
        @foreach ($pendaftaran as $user)
        <div class="d-flex justify-content-center mb-4">
            <h4>Dokumen: {{ $user->nama_lengkap }}</h4>
        </div>
        @endforeach
        <table class="table table-bordered">
            @foreach ($dokumens as $dokumen)
                <tr>
                    <th>File Foto Terbaru:</th>
                    <td>
                        <img class="img-view" src="{{ asset('storage/' . $dokumen->file_foto_terbaru) }}" alt="">
                        
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $dokumen->file_foto_terbaru) }}" download="File_foto_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                    </td>
                </tr>
                <tr>
                    <th>File Kartu Keluarga:</th>
                    <td>
                        <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_kartu_keluarga) }}" alt=""></iframe>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $dokumen->file_kartu_keluarga) }}" download="File_kartu_keluarga_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                    </td>
                </tr>
                <tr>
                    <th>File Akta Kelahiran:</th>
                    <td>
                        <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_akta_kelahiran) }}" alt=""></iframe>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $dokumen->file_akta_kelahiran) }}" download="File_akta_kelahiran{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                    </td>
                </tr>
                @if ($dokumen->file_ktp_orang_tua_ayah != null)
                    <tr>
                        <th>File KTP Ayah:</th>
                        <td>
                            <img class="img-view" src="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_ayah) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_ayah) }}" download="Foto_ktp_orang_tua_ayah{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_ktp_orang_tua_ibu != null)
                    <tr>
                        <th>File KTP Ibu:</th>
                        <td>
                            <img class="img-view" src="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_ibu) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_ibu) }}" download="Foto_ktp_orang_tua_ibu{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_ktp_orang_tua_wali != null)
                    <tr>
                        <th>File KTP Wali:</th>
                        <td>
                            <img class="img-view" src="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_wali) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_ktp_orang_tua_wali) }}" download="Foto_ktp_orang_tua_wali{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>File Rapot Kelas V Semester 1:</th>
                    <td>
                        <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_rapor_kelasv_semester1) }}" alt=""></iframe>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $dokumen->file_rapor_kelasv_semester1) }}" download="File_rapot_kelasV_1{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                    </td>
                </tr>
                <tr>
                    <th>File Rapot Kelas V Semester 2:</th>
                    <td>
                        <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_rapor_kelasv_semester2) }}" alt=""></iframe>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $dokumen->file_rapor_kelasv_semester2) }}" download="File_rapot_kelasV_2{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                    </td>
                </tr>
                @if ($dokumen->file_rapor_kelasvi_semester1)
                    <tr>
                        <th>File Rapot Kelas VI Semester 1:</th>
                        <td>
                            <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_rapor_kelasvi_semester1) }}" alt=""></iframe>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_rapor_kelasvi_semester1) }}" download="File_rapot_kelasVI_1{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_sertifikat_aspd != null)
                    <tr>
                        <th>File Sertifikat ASPD:</th>
                        <td>
                            <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_sertifikat_aspd) }}" alt=""></iframe>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_sertifikat_aspd) }}" download="File_Sertifikat_ASPD{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_sertifikat_kejuaraan != null)
                    @foreach ($dokumen->file_sertifikat_kejuaraan as $item)
                        <tr>
                            <th>File Sertifikat Kejuaraan:</th>
                            <td>
                                <iframe class="file-view" src="{{ asset('storage/' . $item) }}" alt=""></iframe>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $item) }}" download="File_Sertifikat_{{ uniqid() }}_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if($dokumen->file_kms_kip != null)
                    <tr>
                        <th>File KMS/KIP:</th>
                        <td>
                            <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_kms_kip) }}" alt=""></iframe>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_kms_kip) }}" download="File_KMS_KIP_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_surat_keterangan_lulus != null)
                    <tr>
                        <th>File Kelulusan Sekolah :</th>
                    </tr>
                @endif
                @if ($dokumen->file_surat_keterangan_lulus != null)
                    <tr>
                        <th>File Surat Keterangan Lulus</th>
                        <td>
                            <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_surat_keterangan_lulus) }}" alt=""></iframe>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_surat_keterangan_lulus) }}" download="File_Kelulusan_Sekolah_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
                @if ($dokumen->file_ijazah != null)
                    <tr>
                        <th>File Ijazah SD :</th>
                        <td>
                            <iframe class="file-view" src="{{ asset('storage/' . $dokumen->file_ijazah) }}" alt=""></iframe>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $dokumen->file_ijazah) }}" download="File_Ijazah_SD_{{ $dokumen->nama_lengkap }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection