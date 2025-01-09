@extends('layouts.panitia.role-panitia.nav-role-panitia')

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
        <h4>Nama Akun: {{ $user->nama_lengkap }}</h4>
    </div>
    @endforeach
    <table class="table table-bordered">
        @foreach ($pendaftaran as $daftar)
        <tr>
            <th><h4>Informasi Pribadi</h4></th>
            <th>{{ $users[0]->name }}</th>
        </tr>
        <tr>
            <th>Nama Lengkap:</th>
            <td>{{ $daftar->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir:</th>
            <td>{{ $daftar->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir:</th>
            <td>{{ $daftar->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Nomor HP:</th>
            <td>{{ $daftar->nohp }}</td>
        </tr>
        <tr>
            <th>Anak ke:</th>
            <td>{{ $daftar->anak_ke }}</td>
        </tr>
        <tr>
            <th>Jumlah Saudara:</th>
            <td>{{ $daftar->jumlah_saudara }}</td>
        </tr>
        <tr>
            <th>Kelamin:</th>
            <td>{{ $daftar->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Agama:</th>
            <td>{{ $daftar->agama }}</td>
        </tr>
        <tr>
            <th>Jalur Pendaftaran:</th>
            <td>{{ $daftar->jalur_pendaftaran }}</td>
        </tr>
        <tr>
            <th>Alamat Tinggal C1/KK:</th>
            <td>{{ $daftar->alamat_tinggal_c1_kk }}</td>
        </tr>
        <tr>
            <th>Alamat Tinggal Sekarang:</th>
            <td>{{ $daftar->alamat_tmpt_tinggal }}</td>
        </tr>
        <tr>
            <th><h4 class="mt-4">Informasi Asal Sekolah</h4></th>
            <th></th>
        </tr>
        <tr>
            <th>NISN:</th>
            <td>{{ $daftar->nisn }}</td>
        </tr>
        <tr>
            <th>Nama Sekolah SD:</th>
            <td>{{ $daftar->nama_sekolah_sd }}</td>
        </tr>
        <tr>
            <th>Alamat Sekolah SD:</th>
            <td>{{ $daftar->alamat_sekolah_sd }}</td>
        </tr>
        <tr>
            <th><h4 class="mt-4">Nilai Rapor SD</h4></th>
            <th></th>
        </tr>
        <tr>
            <th>Nilai Rapot Matematika Kelas V Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_matematika_klsv_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot Bhs.Indonesia Kelas V Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_bhsindo_klsv_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPA Kelas V Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_ipa_klsv_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPS Kelas V Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_ips_klsv_smt1 }}</td>
        </tr>
        <tr>
            <th>Rata - Rata Kelas V Semester 1</th>
            <td><b> {{ ($daftar->nilai_rapot_matematika_klsv_smt1 + $daftar->nilai_rapot_bhsindo_klsv_smt1 +  $daftar->nilai_rapot_ipa_klsv_smt1 + $daftar->nilai_rapot_ips_klsv_smt1)/4 }} </b></td>
        </tr>
        <tr>
            <th>Nilai Rapot Matematika Kelas V Semester 2:</th>
            <td>{{ $daftar->nilai_rapot_matematika_klsv_smt2 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot Bhs.Indonesia Kelas V Semester 2:</th>
            <td>{{ $daftar->nilai_rapot_bhsindo_klsv_smt2 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPA Kelas V Semester 2:</th>
            <td>{{ $daftar->nilai_rapot_ipa_klsv_smt2 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPS Kelas V Semester 2:</th>
            <td>{{ $daftar->nilai_rapot_ips_klsv_smt2 }}</td>
        </tr>
        <tr>
            <th>Rata - Rata Kelas V Semester 2</th>
            <td><b> {{ ($daftar->nilai_rapot_matematika_klsv_smt2 + $daftar->nilai_rapot_bhsindo_klsv_smt2 +  $daftar->nilai_rapot_ipa_klsv_smt2 + $daftar->nilai_rapot_ips_klsv_smt2)/4 }} </b></td>
        </tr>
        @if ($daftar->nilai_rapot_bhsindo_klsvi_smt1 != null)
        <tr>
            <th>Nilai Rapot Matematika Kelas VI Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_matematika_klsvi_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot Bhs.Indonesia Kelas VI Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_bhsindo_klsvi_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPA Kelas VI Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_ipa_klsvi_smt1 }}</td>
        </tr>
        <tr>
            <th>Nilai Rapot IPS Kelas VI Semester 1:</th>
            <td>{{ $daftar->nilai_rapot_ips_klsvi_smt1 }}</td>
        </tr>
        <tr>
            <th>Rata - Rata Kelas VI Semester 1</th>
            <td><b> {{ ($daftar->nilai_rapot_matematika_klsvi_smt1 + $daftar->nilai_rapot_bhsindo_klsvi_smt1 +  $daftar->nilai_rapot_ipa_klsvi_smt1 + $daftar->nilai_rapot_ips_klsvi_smt1)/4 }} </b></td>
        </tr>
        @endif
        @if ($daftar->is_diy == 1)
        @if($daftar->nilai_literasi_membaca_aspd != null)
        <tr>
            <th><h4 class="mt-4">Nilai ASPD DIY</h4></th>
            <th></th>
        </tr>
        <tr>
            <th>Nilai Membaca:</th>
            <td>{{ $daftar->nilai_literasi_membaca_aspd }}</td>
        </tr>
        <tr>
            <th>Nilai Numerasi:</th>
            <td>{{ $daftar->nilai_literasi_numerasi_aspd }}</td>
        </tr>
        <tr>
            <th>Nilai Sains:</th>
            <td>{{ $daftar->nilai_literasi_sains_aspd }}</td>
        </tr>
        @endif
        @endif
        <tr>
            <th><h4 class="mt-4">Informasi Orang Tua/Wali </h4></th>
            <th></th>
        </tr>
        @if ($daftar->nama_ayah != null)
        <tr>
            <th>Nama Ayah:</th>
            <td>{{ $daftar->nama_ayah }}</td>
        </tr>
        <tr>
            <th>Email Ayah:</th>
            <td>{{ $daftar->email_ayah }}</td>
        </tr>
        <tr>
            <th>Alamat Tempat Tinggal Ayah:</th>
            <td>{{ $daftar->alamat_ayah }}</td>
        </tr>
        <tr>
            <th>No Telpon Ayah:</th>
            <td>{{ $daftar->no_telpon_ayah }}</td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir Ayah:</th>
            <td>{{ $daftar->pendidikan_terakhir_ayah }}</td>
        </tr>
        <tr>
            <th>Pekerjaan Ayah:</th>
            <td>{{ $daftar->pekerjaan_ayah }}</td>
        </tr>
        <tr>
            <th>Penghasilan Ayah:</th>
            <td>{{ $daftar->penghasilan_ayah }}</td>
        </tr>
        @endif
        @if ($daftar->nama_ibu != null)
        <tr>
            <th>Nama Ibu:</th>
            <td>{{ $daftar->nama_ibu }}</td>
        </tr>
        <tr>
            <th>Email Ibu:</th>
            <td>{{ $daftar->email_ibu }}</td>
        </tr>
        <tr>
            <th>Alamat Tempat Tinggal Ibu:</th>
            <td>{{ $daftar->alamat_ibu }}</td>
        </tr>
        <tr>
            <th>No Telpon Ibu:</th>
            <td>{{ $daftar->no_telpon_ibu }}</td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir Ibu:</th>
            <td>{{ $daftar->pendidikan_terakhir_ibu }}</td>
        </tr>
        <tr>
            <th>Pekerjaan Ibu:</th>
            <td>{{ $daftar->pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <th>Penghasilan Ibu:</th>
            <td>{{ $daftar->penghasilan_ibu }}</td>
        </tr>
        @endif
        @if ($daftar->nama_wali != null)
            <tr>
            <th>Nama Wali:</th>
            <td>{{ $daftar->nama_wali }}</td>
        </tr>
        <tr>
            <th>Alamat Tempat Tinggal Wali:</th>
            <td>{{ $daftar->alamat_wali }}</td>
        </tr>
        <tr>
            <th>No Telpon Wali:</th>
            <td>{{ $daftar->no_telpon_wali }}</td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir Wali:</th>
            <td>{{ $daftar->pendidikan_terakhir_wali }}</td>
        </tr>
        <tr>
            <th>Pekerjaan Wali:</th>
            <td>{{ $daftar->pekerjaan_wali }}</td>
        </tr>
        <tr>
            <th>Penghasilan Wali:</th>
            <td>{{ $daftar->penghasilan_wali }}</td>
        </tr>
        @endif
        <tr>
            <th>File Bukti Pendaftaran</th>
            @if ($daftar->file_bukti_pembayaran_pendaftaran != null)
                <td><img src="{{ asset('storage/' . $daftar->file_bukti_pembayaran_pendaftaran) }}" alt="File Image"></td>
            @else
                <td>Belum Mengupload</td>
            @endif
        </tr>
        <tr>
            <th>Download PDF</th>
            <td><a href="{{ route('generatePDF', $daftar->user_id) }}" class="btn btn-primary" target="_blank">Download</a></td>
        </tr>
        @endforeach
    </table>
</div>
@endsection