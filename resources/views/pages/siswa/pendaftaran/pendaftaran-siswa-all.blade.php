@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
<div class="container-fluid " id="form-container">
    <form method="POST" action="{{ route('pendaftaranSiswaShowPage1SaveData') }}" class="container form-control mt-4 mb-2" enctype="multipart/form-data" >
        @csrf
        <div id="page-1" class="form-section">
            <h4>Data Diri Calon Murid</h4>
            <div class="mb-2 gradient-custom-3">
                <hr>
                {{-- Text for Name --}}
                <div class="mx-2 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                </div>
                @error('nama_lengkap')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Date for Tanggal Lahir --}}
                <div class="col-md-2 mx-2 mb-3">
                    <label for="tanggal_lahir" class="form-label">
                        Tanggal Lahir
                        <div class="tooltip-custom">
                            <span class="tooltiptext-custom">Tanggal Lahir Calon Murid</span>
                            <span class="material-symbols-outlined">
                                help
                            </span>
                        </div>
                    </label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" min="2008-01-01" max="2070-12-31" >
                </div>
                @error('tanggal_lahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Input for Tempat Lahir--}}
                <div class="mx-2 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input class="form-control" name="tempat_lahir" id="tempat_lahir" cols="5" rows="3"></input>
                </div>
                @error('tempat_lahir')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- text for Nomor Telpon --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nohp" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" minlength="10" maxlength="14" onkeypress="return isNumber(event)">
                </div>
                @error('nohp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Text for Anak ke & Text for Jumlah Saudara --}}
                {{-- Text for Anak ke--}}
                <div class="row g-2">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="anak_ke" class="form-label">Anak Ke</label>
                        <input type="text" class="form-control" id="anak_ke" name="anak_ke" onkeypress="return isNumber(event) ">
                    </div>
                    {{-- Text for Jumlah Saudara--}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="jumlah_saudara" class="form-label">Jumlah Saudara</label>
                        <input type="text" class="form-control" id="jumlah_saudara" name="jumlah_saudara" onkeypress="return isNumber(event)">
                    </div>
                </div>
                {{-- Select for Jenis Kelamin --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                        <option selected value="">Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        </select>
                    </select>
                </div>
                {{-- Select for Agama --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="agama">
                        <option selected value="">Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                {{-- Radio for Jalur Pendaftaran --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>
                    <select class="form-select" name="jalur_pendaftaran" id="jalur_pendaftaran">
                        <option selected value="">Jalur Pendaftaran</option>
                        <option value="Akademik">Prestasi Akademik</option>
                        <option value="NonAkademik">Prestasi : Sains, Olahraga dan Seni</option>
                        <option value="Reguler">Reguler</option>
                    </select>
                </div>

                <hr class="my-4">
                
                <h5 class="mb-4 mx-2">Alamat</h5>

                {{-- Text Area for Tempat Tinggal KK--}}
                <div class="mx-2 mb-3">
                    <label for="alamat_tinggal_c1_kk" class="form-label">Alamat Tempat Tinggal sesuai C1/KK</label>
                    <textarea class="form-control" name="alamat_tinggal_c1_kk" id="alamat_tinggal_c1_kk" cols="5" rows="3"></textarea>
                </div>
                {{-- Text Area for Tempat Tinggal Sekarang --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_tmpt_tinggal" class="form-label">Alamat Tempat Tinggal</label>
                    <textarea class="form-control" name="alamat_tmpt_tinggal" id="alamat_tmpt_tinggal" cols="5" rows="3"></textarea>
                </div>
                <hr>
            </div>
        </div>
        <div id="page-2" class="form-section hidden">
            <h4>Informasi Sekolah Dasar</h4>
            <div class="mb-2 gradient-custom-3">
                <hr>
                {{-- Text for NISN --}}
                <div class="mx-2 mb-3">
                    <label for="nisn" class="form-label">NISN(Nomor Induk Siswa Nasional)</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" onkeypress="return isNumber(event)">
                </div>
        
                {{-- Text for Nama Sekolah SD --}}
                <div class="mx-2 mb-3">
                    <label for="nama_sekolah_sd" class="form-label">Nama SD</label>
                    <input type="text" class="form-control" id="nama_sekolah_sd" name="nama_sekolah_sd">
                </div>
        
                {{-- Option Daerah Sekolah --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="is_diy" class="form-label">Asal Sekolah</label>
                    <select class="form-select" name="is_diy" id="is_diy">
                        <option selected value="">Asal Sekolah</option>
                        <option value="1">Sekolah wilayah DIY</option>
                        <option value="0">Sekolah diluar wilayah DIY</option>
                    </select>
                </div>
        
                {{-- Textarea for Alamat Sekolah SD --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_sekolah_sd" class="form-label">Alamat SD</label>
                    <textarea class="form-control" name="alamat_sekolah_sd" id="alamat_sekolah_sd" cols="5" rows="3"></textarea>
                </div>
        
                {{-- Select for Status Sekolah SD --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="status_sekolah_sd" class="form-label">Status SD</label>
                    <select class="form-select" name="status_sekolah_sd" id="status_sekolah_sd">
                        <option selected value="">Status Sekolah</option>
                        <option value="Swasta">Swasta</option>
                        <option value="Negeri">Negeri</option>
                    </select>
                </div>
                <hr>
                {{-- Input Group for Nilai SD Kelas 5 Semester 1  --}}
                <h5 class="mb-4 mx-2">Nilai Rapot Kelas V Semester 1</h5>
                <div class="row g-4">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_matematika_klsv_smt1" class="form-label">Matematika</label>
                        <input type="text" class="form-control" id="nilai_rapot_matematika_klsv_smt1" name="nilai_rapot_matematika_klsv_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    @error('nilai_rapot_matematika_klsv_smt1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_bhsindo_klsv_smt1" class="form-label">Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsv_smt1" name="nilai_rapot_bhsindo_klsv_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    @error('nilai_rapot_bhsindo_klsv_smt1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ipa_klsv_smt1" class="form-label">IPA</label>
                        <input type="text" class="form-control" id="nilai_rapot_ipa_klsv_smt1" name="nilai_rapot_ipa_klsv_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    @error('nilai_rapot_ipa_klsv_smt1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ips_klsv_smt1" class="form-label">IPS</label>
                        <input type="text" class="form-control" id="nilai_rapot_ips_klsv_smt1" name="nilai_rapot_ips_klsv_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    @error('nilai_rapot_ips_klsv_smt1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input Group for Nilai SD Kelas 5 Semester 2  --}}
        
                <h5 class="my-4 mx-2">Nilai Rapot Kelas V Semester 2</h5>
                <div class="row g-4">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_matematika_klsv_smt2" class="form-label">Matematika</label>
                        <input type="text" class="form-control" id="nilai_rapot_matematika_klsv_smt2" name="nilai_rapot_matematika_klsv_smt2" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_bhsindo_klsv_smt2" class="form-label">Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsv_smt2" name="nilai_rapot_bhsindo_klsv_smt2" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ipa_klsv_smt2" class="form-label">IPA</label>
                        <input type="text" class="form-control" id="nilai_rapot_ipa_klsv_smt2" name="nilai_rapot_ipa_klsv_smt2" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ips_klsv_smt2" class="form-label">IPS</label>
                        <input type="text" class="form-control" id="nilai_rapot_ips_klsv_smt2" name="nilai_rapot_ips_klsv_smt2" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                </div>
        
                {{-- Input Group for Nilai SD Kelas 6 Semester 1  --}}
        
                <h5 class="my-4 mx-2">Nilai Rapot Kelas VI Semester 1</h5>
                <div class="row g-4">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_matematika_klsvi_smt1" class="form-label">Matematika</label>
                        <input type="text" class="form-control" id="nilai_rapot_matematika_klsvi_smt1" name="nilai_rapot_matematika_klsvi_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_bhsindo_klsvi_smt1" class="form-label">Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsvi_smt1" name="nilai_rapot_bhsindo_klsvi_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ipa_klsvi_smt1" class="form-label">IPA</label>
                        <input type="text" class="form-control" id="nilai_rapot_ipa_klsvi_smt1" name="nilai_rapot_ipa_klsvi_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_rapot_ips_klsvi_smt1" class="form-label">IPS</label>
                        <input type="text" class="form-control" id="nilai_rapot_ips_klsvi_smt1" name="nilai_rapot_ips_klsvi_smt1" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                </div>
                <h5 class="my-4 mx-2">Nilai ASPD</h5>
                <div class="mx-2">Bagian ini tidak perlu diisi jika tidak bersekolah di DIY</div>
                <div class="row-g3">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_literasi_membaca_aspd" class="form-label">Literasi Membaca</label>
                        <input type="text" class="form-control" id="nilai_literasi_membaca_aspd" name="nilai_literasi_membaca_aspd" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_literasi_numerasi_aspd" class="form-label">Literasi Numerasi</label>
                        <input type="text" class="form-control" id="nilai_literasi_numerasi_aspd" name="nilai_literasi_numerasi_aspd" min="1" max="100" maxLength="3" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="nilai_literasi_sains_aspd" class="form-label">Literasi Sains</label>
                        <input type="text" class="form-control" id="nilai_literasi_sains_aspd" name="nilai_literasi_sains_aspd"  onkeypress="return isNumber(event)">
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div id="page-3" class="form-section hidden">
            <h4>Informasi Orang Tua</h4>
            <div class="mb-2 gradient-custom-3">
                <hr>
                <h5 class="mx-2">Informasi Ayah</h5>
                <hr>
                {{-- Text for Name Ayah --}}
                <div class="mx-2 mb-3">
                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                </div>
                {{-- Email for Email Ayah --}}
                <div class="mx-2 mb-3">
                    <label for="email_ayah" class="form-label">Email Ayah</label>
                    <input type="email" class="form-control" id="email_ayah" name="email_ayah">
                </div>
                {{-- Textare for Alamat Ayah --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_ayah" class="form-label">Alamat Ayah</label>
                    <textarea class="form-control" name="alamat_ayah" id="alamat_ayah" cols="5" rows="3"></textarea>
                </div>
                {{-- No Telpon, Pendidikan Terakhir dan Pekerjaan Ayah --}}
                <div class="row g-4">
                {{-- Text for No Telpon Ayah --}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="no_telpon_ayah" class="form-label">Nomor Telpon</label>
                        <input type="text" class="form-control" id="no_telpon_ayah" name="no_telpon_ayah" minlength="10" maxlength="13" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="pendidikan_terakhir_ayah" id="pendidikan_terakhir_ayah">
                            <option selected value="">Pendidikan Terakhir</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD/Sederajat">SD/Sederajat</option>
                            <option value="SMP/Sederajat">SMP/Sederajat</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="Diploma III/SM">Diploma III/SM</option>
                            <option value="Diploma IV/S1">Diploma IV/S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="penghasilan_ayah" class="form-label">Penghasilan 1 Bulan</label>
                        <select class="form-select" name="penghasilan_ayah" id="penghasilan_ayah">
                            <option selected value="">Penghasilan 1 Bulan</option>
                            <option value="< 1.000.000"> < Rp. 1.000.000</option>
                            <option value="1.000.000 - 2.500.000">Rp. 1.000.000 - Rp. 2.500.000</option>
                            <option value="2.500.000 - 3.500.000">Rp. 2.500.000 - Rp. 3.500.000</option>
                            <option value="3.500.000 - 5.000.000">Rp. 3.500.000 - Rp. 5.000.000</option>
                            <option value="> 5.000.000"> > Rp. 5.000.000</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h5 class="mx-2">Informasi Ibu</h5>
                <hr>
                {{-- Text for Name ibu --}}
                <div class="mx-2 mb-3">
                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                </div>
                {{-- Email for Email ibu --}}
                <div class="mx-2 mb-3">
                    <label for="email_ibu" class="form-label">Email Ibu</label>
                    <input type="email" class="form-control" id="email_ibu" name="email_ibu">
                </div>
                {{-- Textare for Alamat ibu --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_ibu" class="form-label">Alamat Ibu</label>
                    <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" cols="5" rows="3"></textarea>
                </div>                                        
                {{-- No Telpon, Pendidikan Terakhir dan Pekerjaan ibu --}}
                <div class="row g-3">
                    {{-- Text for No Telpon ibu --}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="no_telpon_ibu" class="form-label">Nomor Telpon</label>
                        <input type="text" class="form-control" id="no_telpon_ibu" name="no_telpon_ibu" minlength="10" maxlength="13" onkeypress="return isNumber(event)">
                    </div>
                    {{-- Radio Pendidikan Terakhir Ibu --}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pendidikan_terakhir_ibu" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="pendidikan_terakhir_ibu" id="pendidikan_terakhir_ibu">
                            <option selected value="">Pendidikan Terakhir</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD/Sederajat">SD/Sederajat</option>
                            <option value="SMP/Sederajat">SMP/Sederajat</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="Diploma III/SM">Diploma III/SM</option>
                            <option value="Diploma IV/S1">Diploma IV/S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    {{-- Text for Pekerjaan Ibu --}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="penghasilan_ibu" class="form-label">Penghasilan 1 Bulan</label>
                        <select class="form-select" name="penghasilan_ibu" id="penghasilan_ibu">
                            <option selected value="">Penghasilan 1 Bulan</option>
                            <option value="< 1.000.000"> < Rp. 1.000.000</option>
                            <option value="1.000.000 - 2.500.000">Rp. 1.000.000 - Rp. 2.500.000</option>
                            <option value="2.500.000 - 3.500.000">Rp. 2.500.000 - Rp. 3.500.000</option>
                            <option value="3.500.000 - 5.000.000">Rp. 3.500.000 - Rp. 5.000.000</option>
                            <option value="> 5.000.000"> > Rp. 5.000.000</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h5 class="mx-2">Informasi Wali</h5>
                <hr>
                {{-- Text for Name wali --}}
                <div class="mx-2 mb-3">
                    <label for="nama_wali" class="form-label">Nama Wali</label>
                    <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                </div>
                {{-- Textare for Alamat wali --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_wali" class="form-label">Alamat Wali</label>
                    <textarea class="form-control" name="alamat_wali" id="alamat_wali" cols="5" rows="3"></textarea>
                </div>
                {{-- No telpon, Pendidikan Terakhir dan Pekerjaan wali --}}
                <div class="row g-3">
                    {{-- Text for No Telpon wali --}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="no_telpon_wali" class="form-label">Nomor Telpon</label>
                        <input type="text" class="form-control" id="no_telpon_wali" name="no_telpon_wali" minlength="10" maxlength="13" onkeypress="return isNumber(event)">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pendidikan_terakhir_wali" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="pendidikan_terakhir_wali" id="pendidikan_terakhir_wali">
                            <option selected value="">Pendidikan Terakhir</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD/Sederajat">SD/Sederajat</option>
                            <option value="SMP/Sederajat">SMP/Sederajat</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="Diploma III/SM">Diploma III/SM</option>
                            <option value="Diploma IV/S1">Diploma IV/S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="pekerjaan_wali" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali">
                    </div>
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="penghasilan_wali" class="form-label">Penghasilan 1 Bulan</label>
                        <select class="form-select" name="penghasilan_wali" id="penghasilan_wali">
                            <option selected value="">Penghasilan 1 Bulan</option>
                            <option value="< 1.000.000"> < Rp. 1.000.000</option>
                            <option value="1.000.000 - 2.500.000">Rp. 1.000.000 - Rp. 2.500.000</option>
                            <option value="2.500.000 - 3.500.000">Rp. 2.500.000 - Rp. 3.500.000</option>
                            <option value="3.500.000 - 5.000.000">Rp. 3.500.000 - Rp. 5.000.000</option>
                            <option value="> 5.000.000"> > Rp. 5.000.000</option>
                        </select>
                    </div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="buktiPembayaran" class="form-label">Bukti Pembayaran</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, image/" type="file" id="buktiPembayaran" name="file_bukti_pembayaran_pendaftaran">
                </div>
                <hr>
            </div>
            <button type="submit" class="btn btn-primary mt-2 form-pendaftaran-siswa">Selanjutnya</button>
        </div>
        <button id="back-btn" class="btn btn-primary mt-2">Kembali</button>
        <button id="next-btn" class="btn btn-primary mt-2">Selanjutnya</button>
    </form>
</div>
@endsection
@section('namespace-js')
    <script src="{{ asset('js/pendaftaran-siswa.js') }}"></script>
@endsection