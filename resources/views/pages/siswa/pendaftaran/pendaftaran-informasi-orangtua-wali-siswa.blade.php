@extends('layouts.siswa.nav-siswa-ppdb')

@section('css-site')
<link rel="stylesheet" href="{{ asset('css/pendaftaran-style.css') }}">
@endsection
@section('content-space')
<div class="container-fluid ">
    <form method="POST" class="container form-control mt-4 mb-2" enctype="multipart/form-data" id="form_pendaftaran_informasi_orangtua">
        @csrf
        @error('any')
            <div class="alert alert-danger">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <h4>Informasi Orang Tua dan wali</h4>
        <span id="informasi_orangtua_wali" class="form-text">
            *Wajib mengisi salah satu informasi yang tersedia
        </span>
        <div class="mb-2 gradient-custom-3">
            <hr>
            <h5 class="mx-2">Informasi Ayah</h5>
            <hr>
            {{-- Text for Name Ayah --}}
            <div class="mx-2 mb-3">
                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $formData['nama_ayah'] ?? '') }}">
            </div>
            {{-- Email for Email Ayah --}}
            <div class="mx-2 mb-3">
                <label for="email_ayah" class="form-label">Email Ayah</label>
                <input type="email" class="form-control" id="email_ayah" name="email_ayah" value="{{ old('email_ayah', $formData['email_ayah'] ?? '') }}">
            </div>
            {{-- Textare for Alamat Ayah --}}
            <div class="mx-2 mb-3">
                <label for="alamat_ayah" class="form-label">Alamat Ayah</label>
                <textarea class="form-control" name="alamat_ayah" id="alamat_ayah" cols="5" rows="3">{{ old('alamat_ayah', $formData['alamat_ayah'] ?? '') }}</textarea>
            </div>
            {{-- No Telpon, Pendidikan Terakhir dan Pekerjaan Ayah --}}
            <div class="row g-4">
            {{-- Text for No Telpon Ayah --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="no_telpon_ayah" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="no_telpon_ayah" name="no_telpon_ayah" minlength="10" maxlength="13" onkeypress="return isNumber(event)" value="{{ old('no_telpon_ayah', $formData['no_telpon_ayah'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir</label>
                    <select class="form-select" name="pendidikan_terakhir_ayah" id="pendidikan_terakhir_ayah">
                        <option selected value="">Pendidikan Terakhir</option>
                        <option value="Tidak Sekolah" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "Tidak Sekolah" ? 'selected' : '' }}>Tidak Sekolah</option>
                        <option value="SD/Sederajat" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "SD/Sederajat" ? 'selected' : '' }}>SD/Sederajat</option>
                        <option value="SMP/Sederajat" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "SMP/Sederajat" ? 'selected' : '' }}>SMP/Sederajat</option>
                        <option value="SMA/Sederajat" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "SMA/Sederajat" ? 'selected' : '' }}>SMA/Sederajat</option>
                        <option value="Diploma III/SM" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "Diploma III/SM" ? 'selected' : '' }}>Diploma III/SM</option>
                        <option value="Diploma IV/S1" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "Diploma IV/S1" ? 'selected' : '' }}>Diploma IV/S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "S2" ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir_ayah', $formData['pendidikan_terakhir_ayah'] ?? '') == "S2" ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $formData['pekerjaan_ayah'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="penghasilan_ayah" class="form-label">Penghasilan 1 Bulan</label>
                    <select class="form-select" name="penghasilan_ayah" id="penghasilan_ayah">
                        <option selected value="">Penghasilan 1 Bulan</option>
                        <option value="< 1.000.000" {{ old('penghasilan_ayah', $formData['penghasilan_ayah'] ?? '') == "< 1.000.000" ? 'selected' : '' }}> < Rp. 1.000.000</option>
                        <option value="1.000.000 - 2.500.000" {{ old('penghasilan_ayah', $formData['penghasilan_ayah'] ?? '') == "1.000.000 - 2.500.000" ? 'selected' : '' }}>Rp. 1.000.000 - Rp. 2.500.000</option>
                        <option value="2.500.000 - 3.500.000" {{ old('penghasilan_ayah', $formData['penghasilan_ayah'] ?? '') == "2.500.000 - 3.500.000" ? 'selected' : '' }}>Rp. 2.500.000 - Rp. 3.500.000</option>
                        <option value="3.500.000 - 5.000.000" {{ old('penghasilan_ayah', $formData['penghasilan_ayah'] ?? '') == "3.500.000 - 5.000.000" ? 'selected' : '' }}>Rp. 3.500.000 - Rp. 5.000.000</option>
                        <option value="> 5.000.000" {{ old('penghasilan_ayah', $formData['penghasilan_ayah'] ?? '') == "> 5.000.000" ? 'selected' : '' }}> > Rp. 5.000.000</option>
                    </select>
                </div>
            </div>
            <hr>
            <h5 class="mx-2">Informasi Ibu</h5>
            <hr>
            {{-- Text for Name ibu --}}
            <div class="mx-2 mb-3">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $formData['nama_ibu'] ?? '') }}">
            </div>
            {{-- Email for Email ibu --}}
            <div class="mx-2 mb-3">
                <label for="email_ibu" class="form-label">Email Ibu</label>
                <input type="text" class="form-control" id="email_ibu" name="email_ibu" value="{{ old('email_ibu', $formData['email_ibu'] ?? '') }}">
            </div>
            {{-- Textare for Alamat ibu --}}
            <div class="mx-2 mb-3">
                <label for="alamat_ibu" class="form-label">Alamat Ibu</label>
                <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" cols="5" rows="3">{{ old('alamat_ibu', $formData['alamat_ibu'] ?? '') }}</textarea>
            </div>                                        
            {{-- No Telpon, Pendidikan Terakhir dan Pekerjaan ibu --}}
            <div class="row g-3">
                {{-- Text for No Telpon ibu --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="no_telpon_ibu" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="no_telpon_ibu" name="no_telpon_ibu" minlength="10" maxlength="13" onkeypress="return isNumber(event)" value="{{ old('no_telpon_ibu', $formData['no_telpon_ibu'] ?? '') }}">
                </div>
                {{-- Radio Pendidikan Terakhir Ibu --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pendidikan_terakhir_ibu" class="form-label">Pendidikan Terakhir</label>
                    <select class="form-select" name="pendidikan_terakhir_ibu" id="pendidikan_terakhir_ibu">
                        <option selected value="">Pendidikan Terakhir</option>
                        <option value="Tidak Sekolah" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "Tidak Sekolah" ? 'selected' : '' }}>Tidak Sekolah</option>
                        <option value="SD/Sederajat" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "SD/Sederajat" ? 'selected' : '' }}>SD/Sederajat</option>
                        <option value="SMP/Sederajat" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "SMP/Sederajat" ? 'selected' : '' }}>SMP/Sederajat</option>
                        <option value="SMA/Sederajat" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "SMA/Sederajat" ? 'selected' : '' }}>SMA/Sederajat</option>
                        <option value="Diploma III/SM" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "Diploma III/SM" ? 'selected' : '' }}>Diploma III/SM</option>
                        <option value="Diploma IV/S1" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "Diploma IV/S1" ? 'selected' : '' }}>Diploma IV/S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "S2" ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir_ibu', $formData['pendidikan_terakhir_ibu'] ?? '') == "S2" ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
                {{-- Text for Pekerjaan Ibu --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $formData['pekerjaan_ibu'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="penghasilan_ibu" class="form-label">Penghasilan 1 Bulan</label>
                    <select class="form-select" name="penghasilan_ibu" id="penghasilan_ibu">
                        <option selected value="">Penghasilan 1 Bulan</option>
                        <option value="< 1.000.000" {{ old('penghasilan_ibu', $formData['penghasilan_ibu'] ?? '') == "< 1.000.000" ? 'selected' : '' }}> < Rp. 1.000.000</option>
                        <option value="1.000.000 - 2.500.000" {{ old('penghasilan_ibu', $formData['penghasilan_ibu'] ?? '') == "1.000.000 - 2.500.000" ? 'selected' : '' }}>Rp. 1.000.000 - Rp. 2.500.000</option>
                        <option value="2.500.000 - 3.500.000" {{ old('penghasilan_ibu', $formData['penghasilan_ibu'] ?? '') == "2.500.000 - 3.500.000" ? 'selected' : '' }}>Rp. 2.500.000 - Rp. 3.500.000</option>
                        <option value="3.500.000 - 5.000.000" {{ old('penghasilan_ibu', $formData['penghasilan_ibu'] ?? '') == "3.500.000 - 5.000.000" ? 'selected' : '' }}>Rp. 3.500.000 - Rp. 5.000.000</option>
                        <option value="> 5.000.000" {{ old('penghasilan_ibu', $formData['penghasilan_ibu'] ?? '') == "> 5.000.000" ? 'selected' : '' }}> > Rp. 5.000.000</option>
                    </select>
                </div>
            </div>
            <hr>
            <h5 class="mx-2">Informasi Wali</h5>
            <hr>
            {{-- Text for Name wali --}}
            <div class="mx-2 mb-3">
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ old('nama_wali', $formData['nama_wali'] ?? '') }}">
            </div>

            {{-- Textare for Alamat wali --}}
            <div class="mx-2 mb-3">
                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                <textarea class="form-control" name="alamat_wali" id="alamat_wali" cols="5" rows="3">{{ old('alamat_wali', $formData['alamat_wali'] ?? '') }}</textarea>
            </div>

            {{-- No telpon, Pendidikan Terakhir dan Pekerjaan wali --}}
            <div class="row g-3">
                {{-- Text for No Telpon wali --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="no_telpon_wali" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="no_telpon_wali" name="no_telpon_wali" minlength="10" maxlength="13" onkeypress="return isNumber(event)" value="{{ old('no_telpon_wali', $formData['no_telpon_wali'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pendidikan_terakhir_wali" class="form-label">Pendidikan Terakhir</label>
                    <select class="form-select" name="pendidikan_terakhir_wali" id="pendidikan_terakhir_wali">
                        <option selected value="">Pendidikan Terakhir</option>
                        <option value="Tidak Sekolah" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "Tidak Sekolah" ? 'selected' : '' }}>Tidak Sekolah</option>
                        <option value="SD/Sederajat" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "SD/Sederajat" ? 'selected' : '' }}>SD/Sederajat</option>
                        <option value="SMP/Sederajat" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "SMP/Sederajat" ? 'selected' : '' }}>SMP/Sederajat</option>
                        <option value="SMA/Sederajat" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "SMA/Sederajat" ? 'selected' : '' }}>SMA/Sederajat</option>
                        <option value="Diploma III/SM" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "Diploma III/SM" ? 'selected' : '' }}>Diploma III/SM</option>
                        <option value="Diploma IV/S1" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "Diploma IV/S1" ? 'selected' : '' }}>Diploma IV/S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "S2" ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir_wali', $formData['pendidikan_terakhir_wali'] ?? '') == "S2" ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="pekerjaan_wali" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $formData['pekerjaan_wali'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="penghasilan_wali" class="form-label">Penghasilan 1 Bulan</label>
                    <select class="form-select" name="penghasilan_wali" id="penghasilan_wali">
                        <option selected value="">Penghasilan 1 Bulan</option>
                        <option value="< 1.000.000" {{ old('penghasilan_wali', $formData['penghasilan_wali'] ?? '') == "< 1.000.000" ? 'selected' : '' }}> < Rp. 1.000.000</option>
                        <option value="1.000.000 - 2.500.000" {{ old('penghasilan_wali', $formData['penghasilan_wali'] ?? '') == "1.000.000 - 2.500.000" ? 'selected' : '' }}>Rp. 1.000.000 - Rp. 2.500.000</option>
                        <option value="2.500.000 - 3.500.000" {{ old('penghasilan_wali', $formData['penghasilan_wali'] ?? '') == "2.500.000 - 3.500.000" ? 'selected' : '' }}>Rp. 2.500.000 - Rp. 3.500.000</option>
                        <option value="3.500.000 - 5.000.000" {{ old('penghasilan_wali', $formData['penghasilan_wali'] ?? '') == "3.500.000 - 5.000.000" ? 'selected' : '' }}>Rp. 3.500.000 - Rp. 5.000.000</option>
                        <option value="> 5.000.000" {{ old('penghasilan_wali', $formData['penghasilan_wali'] ?? '') == "> 5.000.000" ? 'selected' : '' }}> > Rp. 5.000.000</option>
                    </select>
                </div>
            </div>
            <div class="mx-2 mb-3">
                <div class="col-auto">
                    <label for="file_bukti_pembayaran_pendaftaran" class="form-label">Bukti Pembayaran</label>
                    <div class="tooltip-custom">
                        <span class="tooltiptext-custom">
                            Bukti Pembayaran dapat dikosongkan.
                        </span>
                        <span class="material-symbols-outlined">
                            help
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, image/" type="file" id="file_bukti_pembayaran_pendaftaran" name="file_bukti_pembayaran_pendaftaran">
                </div>
                <div class="col-auto">
                    <span id="file_bukti_pembayaran_pendaftaranHelper" class="form-text">
                        Transfer ke rekening : BRI 0245-01-019053-53-1 a/n <b>SMP MARIA IMMACULATA CAB.KATAMSO</b>
                    </span>
                </div>
                <div class="form-text">{{ old('file_bukti_pembayaran_pendaftaran', $formData['file_bukti_pembayaran_pendaftaran'] ?? '') }}</div>
            </div>
            <hr>
        </div>
        <div class="btn-group" role="group" aria-label="Button Choose">
            <button type="button" class="btn btn-primary mt-2 form-pendaftaran-siswa" onclick="submitForm('{{ route('pendaftaranSiswaShowPage2Back') }}')">Kembali</butt>
            <button  type="button" class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>
        </div>
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah anda sudah yakin?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Form pendaftaran akan kami simpan</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary form-pendaftaran-siswa" onclick="submitForm('{{ route('pendaftaranSiswaSubmit') }}')">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('namespace-js')
    <script src="{{ asset('js/submit-pendaftaran-siswa.js') }}"></script>
@endsection