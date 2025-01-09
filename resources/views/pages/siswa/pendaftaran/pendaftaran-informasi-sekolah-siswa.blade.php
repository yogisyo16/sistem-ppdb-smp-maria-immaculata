@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
<div class="container-fluid ">
    <form method="POST" class="container form-control mt-4 mb-2" enctype="multipart/form-data" id="form_pendaftaran_informasi_sekolah">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4>Informasi Sekolah Dasar</h4>
        <div class="mb-2 gradient-custom-3">
            <hr>
            {{-- Text for NISN --}}
            <div class="mx-2 mb-3">
                <label for="nisn" class="form-label">NISN(Nomor Induk Siswa Nasional)
                    <div class="tooltip-custom">
                        <span class="tooltiptext-custom">
                            NISN (Nomor Induk Siswa Nasional).
                        </span>
                        <span class="material-symbols-outlined">
                            help
                        </span>
                    </div>
                </label>
                <input type="text" class="form-control" id="nisn" name="nisn" onkeypress="return isNumber(event)" value="{{ old('nisn', $formData['nisn'] ?? '') }}">
            </div>
    
            {{-- Text for Nama Sekolah SD --}}
            <div class="mx-2 mb-3">
                <label for="nama_sekolah_sd" class="form-label">Nama SD</label>
                <input type="text" class="form-control" id="nama_sekolah_sd" name="nama_sekolah_sd" value="{{ old('nama_sekolah_sd', $formData['nama_sekolah_sd'] ?? '') }}">
            </div>
    
            {{-- Option Daerah Sekolah --}}
            <div class="col-sm-2 mx-2 mb-3">
                <label for="is_diy" class="form-label">Asal Sekolah</label>
                <select class="form-select" name="is_diy" id="is_diy">
                    <option selected value="">Asal Sekolah</option>
                    <option value="1" {{ old('is_diy', $formData['is_diy'] ?? '') == "1" ? 'selected' : '' }}>DIY</option>
                    <option value="0" {{ old('is_diy', $formData['is_diy'] ?? '') == "0" ? 'selected' : '' }}>diluar DIY</option>
                </select>
            </div>
    
            {{-- Textarea for Alamat Sekolah SD --}}
            <div class="mx-2 mb-3">
                <label for="alamat_sekolah_sd" class="form-label">Alamat SD</label>
                <textarea class="form-control" name="alamat_sekolah_sd" id="alamat_sekolah_sd" cols="5" rows="3">{{ old('alamat_sekolah_sd', $formData['alamat_sekolah_sd'] ?? '') }}</textarea>
            </div>
    
            {{-- Select for Status Sekolah SD --}}
            <div class="col-sm-2 mx-2 mb-3">
                <label for="status_sekolah_sd" class="form-label">Status SD</label>
                <select class="form-select" name="status_sekolah_sd" id="status_sekolah_sd">
                    <option selected value="">Status Sekolah</option>
                    <option value="Swasta" {{ old('status_sekolah_sd', $formData['status_sekolah_sd'] ?? '') == "Swasta" ? 'selected' : '' }}>Swasta</option>
                    <option value="Negeri" {{ old('status_sekolah_sd', $formData['status_sekolah_sd'] ?? '') == "Negeri" ? 'selected' : '' }}>Negeri</option>
                </select>
            </div>
            <hr>
            {{-- Input Group for Nilai SD Kelas 5 Semester 1  --}}
            <div class="mb-4 mx-2">
                <h5>Nilai Rapot Kelas V Semester 1
                    <div class="tooltip-custom">
                        <span class="tooltiptext-custom">
                            Masukkan nilai sesuai dengan nilai rapot <br> Jika nilai rapot memiliki koma (,) gunakan titik (.)
                        </span>
                        <span class="material-symbols-outlined">
                            help
                        </span>
                    </div>
                </h5>
            </div>
            <div class="row g-4">
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_matematika_klsv_smt1" class="form-label">Matematika</label>
                    <input type="text" class="form-control" id="nilai_rapot_matematika_klsv_smt1" name="nilai_rapot_matematika_klsv_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_matematika_klsv_smt1', $formData['nilai_rapot_matematika_klsv_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_bhsindo_klsv_smt1" class="form-label">Bahasa Indonesia</label>
                    <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsv_smt1" name="nilai_rapot_bhsindo_klsv_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_bhsindo_klsv_smt1', $formData['nilai_rapot_bhsindo_klsv_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ipa_klsv_smt1" class="form-label">IPA</label>
                    <input type="text" class="form-control" id="nilai_rapot_ipa_klsv_smt1" name="nilai_rapot_ipa_klsv_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ipa_klsv_smt1', $formData['nilai_rapot_ipa_klsv_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ips_klsv_smt1" class="form-label">IPS</label>
                    <input type="text" class="form-control" id="nilai_rapot_ips_klsv_smt1" name="nilai_rapot_ips_klsv_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ips_klsv_smt1', $formData['nilai_rapot_ips_klsv_smt1'] ?? '') }}">
                </div>
            </div>
    
            {{-- Input Group for Nilai SD Kelas 5 Semester 2  --}}
    
            <h5 class="my-4 mx-2">Nilai Rapot Kelas V Semester 2</h5>
            <div class="row g-4">
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_matematika_klsv_smt2" class="form-label">Matematika</label>
                    <input type="text" class="form-control" id="nilai_rapot_matematika_klsv_smt2" name="nilai_rapot_matematika_klsv_smt2" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_matematika_klsv_smt2', $formData['nilai_rapot_matematika_klsv_smt2'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_bhsindo_klsv_smt2" class="form-label">Bahasa Indonesia</label>
                    <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsv_smt2" name="nilai_rapot_bhsindo_klsv_smt2" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_bhsindo_klsv_smt2', $formData['nilai_rapot_bhsindo_klsv_smt2'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ipa_klsv_smt2" class="form-label">IPA</label>
                    <input type="text" class="form-control" id="nilai_rapot_ipa_klsv_smt2" name="nilai_rapot_ipa_klsv_smt2" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ipa_klsv_smt2', $formData['nilai_rapot_ipa_klsv_smt2'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ips_klsv_smt2" class="form-label">IPS</label>
                    <input type="text" class="form-control" id="nilai_rapot_ips_klsv_smt2" name="nilai_rapot_ips_klsv_smt2" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ips_klsv_smt2', $formData['nilai_rapot_ips_klsv_smt2'] ?? '') }}">
                </div>
            </div>
    
            {{-- Input Group for Nilai SD Kelas 6 Semester 1  --}}
    
            <h5 class="my-4 mx-2">Nilai Rapot Kelas VI Semester 1
                <div class="tooltip-custom">
                    <span class="tooltiptext-custom">
                        Jika belum ada nilai rapot kelas VI, dapat dikosongkan.
                    </span>
                    <span class="material-symbols-outlined">
                        help
                    </span>
                </div>
            </h5>
            <div class="row g-4">
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_matematika_klsvi_smt1" class="form-label">Matematika</label>
                    <input type="text" class="form-control" id="nilai_rapot_matematika_klsvi_smt1" name="nilai_rapot_matematika_klsvi_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_matematika_klsvi_smt1', $formData['nilai_rapot_matematika_klsvi_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_bhsindo_klsvi_smt1" class="form-label">Bahasa Indonesia</label>
                    <input type="text" class="form-control" id="nilai_rapot_bhsindo_klsvi_smt1" name="nilai_rapot_bhsindo_klsvi_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_bhsindo_klsvi_smt1', $formData['nilai_rapot_bhsindo_klsvi_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ipa_klsvi_smt1" class="form-label">IPA</label>
                    <input type="text" class="form-control" id="nilai_rapot_ipa_klsvi_smt1" name="nilai_rapot_ipa_klsvi_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ipa_klsvi_smt1', $formData['nilai_rapot_ipa_klsvi_smt1'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_rapot_ips_klsvi_smt1" class="form-label">IPS</label>
                    <input type="text" class="form-control" id="nilai_rapot_ips_klsvi_smt1" name="nilai_rapot_ips_klsvi_smt1" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)" onchange="checkValue(this)" value="{{ old('nilai_rapot_ips_klsvi_smt1', $formData['nilai_rapot_ips_klsvi_smt1'] ?? '') }}">
                </div>
            </div>
            <div class="row-g3" id="nilai_aspd">
                <h5 class="my-4 mx-2">Nilai ASPD
                    <div class="tooltip-custom">
                        <span class="tooltiptext-custom">
                            Jika belum memiliki nilai ASPD, dapat dikosongkan.
                        </span>
                        <span class="material-symbols-outlined">
                            help
                        </span>
                    </div>
                </h5>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_literasi_membaca_aspd" class="form-label">Literasi Membaca</label>
                    <input type="text" class="form-control" id="nilai_literasi_membaca_aspd" name="nilai_literasi_membaca_aspd" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)"  onchange="checkValue(this)"value="{{ old('nilai_literasi_membaca_aspd', $formData['nilai_literasi_membaca_aspd'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_literasi_numerasi_aspd" class="form-label">Literasi Numerasi</label>
                    <input type="text" class="form-control" id="nilai_literasi_numerasi_aspd" name="nilai_literasi_numerasi_aspd" min="1" max="100" maxLength="4" onkeypress="return isNumber(event)"  onchange="checkValue(this)"value="{{ old('nilai_literasi_numerasi_aspd', $formData['nilai_literasi_numerasi_aspd'] ?? '') }}">
                </div>
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nilai_literasi_sains_aspd" class="form-label">Literasi Sains</label>
                    <input type="text" class="form-control" id="nilai_literasi_sains_aspd" name="nilai_literasi_sains_aspd"  onkeypress="return isNumber(event)"  onchange="checkValue(this)"value="{{ old('nilai_literasi_sains_aspd', $formData['nilai_literasi_sains_aspd'] ?? '') }}">
                </div>
            </div>
            <hr>
        </div>
        <div class="btn-group" role="group" aria-label="Button Choose">
            <button type="button" class="btn btn-primary mt-2 form-pendaftaran-siswa" onclick="submitForm('{{ route('pendaftaranSiswaShowpage1Back') }}')">Kembali</butt>
            <button type="button" class="btn btn-info mt-2 form-pendaftaran-siswa" onclick="submitForm('{{ route('pendaftaranSiswaShowPage2SaveData') }}')" >Selanjutnya</button>
        </div>
    </form>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Nilai Rapot Kelas V Semester 1 dan 2</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Masukkan nilai sesuai dengan nilai rapot <br> Jika nilai rapot memiliki koma (,) gunakan titik (.)</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
@endsection
@section('namespace-js')
    <script src="{{ asset('js/informasi-sekolah.js') }}"></script>
    <script src="{{ asset('js/submit-pendaftaran-siswa.js') }}"></script>
@endsection