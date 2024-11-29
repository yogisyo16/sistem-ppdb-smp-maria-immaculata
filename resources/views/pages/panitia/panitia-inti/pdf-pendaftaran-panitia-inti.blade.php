<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF File</title>
    {{-- Bootsrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage-style.css') }}">
    
    {{-- Google Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container-md">
        <div class="container mt-5">
            @foreach ($users as $user)
            <div class="d-flex justify-content-center mb-4">
                <h4>Nama Akun: {{ $user->name }}</h4>
            </div>
            @endforeach
            <table class="table table-bordered">
                @foreach ($pendaftaran as $daftar)
                <tr>
                    <th><h4>Informasi Pribadi</h4></th>
                    <th></th>
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
                @endif
                @if ($daftar->is_diy == 1)
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
                    @if ($daftar->file_bukti_pembayaran_pendaftaran == null)
                        <td>Belum Mengupload</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="container-md mt-5">
        <div class="container mt-5">
            @foreach ($pendaftaran as $daftar)
            <img src="{{ public_path('storage/' . $daftar->file_bukti_pembayaran_pendaftaran) }}" alt="File Image">
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/staff-site.js') }}"></script>
</body>
</html>