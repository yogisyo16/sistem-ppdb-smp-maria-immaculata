@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
    <div class="container-fluid ">
        @foreach ($dokumen as $dok)
        @foreach ($pendaftaran as $daftar)
        <form method="POST" class="container form-control mt-4 mb-2 gradient-custom-5 border border-2 border-black rounded" enctype="multipart/form-data" id="form_dokumen">
            @csrf
            <div class="mx-2 mb-3">
                <label for="file_rapor_kelasv_semester1" class="form-label">Rapor kelas V Semester 1</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_rapor_kelasv_semester1" name="file_rapor_kelasv_semester1">
                <div class="form-text text-danger" id="helpRaporKelasV1">*Rapor murid kelas V semester 1 dapat berupa .pdf, .png, .jpg, .jpeg</div>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_rapor_kelasv_semester1', $formData['file_rapor_kelasv_semester1'] ?? '') }}</div>
            </div>
            <div class="mx-2 mb-3">
                <label for="file_rapor_kelasv_semester2" class="form-label">Rapor kelas V Semester 2</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_rapor_kelasv_semester2" name="file_rapor_kelasv_semester2">
                <div class="form-text text-danger" id="helpRaporKelasV2">*Rapor murid kelas V semester 2 dapat berupa .pdf, .png, .jpg, .jpeg</div>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_rapor_kelasv_semester2', $formData['file_rapor_kelasv_semester2'] ?? '') }}</div>
            </div>
            @if ($daftar->is_diy == true)
            <div class="mx-2 mb-3">
                <label for="file_sertifikat_aspd" class="form-label">Sertifikat ASPD</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_sertifikat_aspd" name="file_sertifikat_aspd">
                <div class="col-auto">
                    <span id="file_sertifikat_aspd" class="form-text">
                        Dapat diisi jika sudah mempunyai sertifikat aspd
                    </span>
                </div>
                <div class="form-text text-danger" id="helpSertifikatAspd">*Dapat berupa .pdf, .png, .jpg, .jpeg</div>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_sertifikat_aspd', $formData['file_sertifikat_aspd'] ?? '') }}</div>
            </div>
            @else
            <div class="mx-2 mb-3" hidden>
                <label for="file_sertifikat_aspd" class="form-label">Sertifikat ASPD</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_sertifikat_aspd" name="file_sertifikat_aspd">
                <div class="form-text text-danger" id="helpSertifikatAspd">*Dapat berupa .pdf, .png, .jpg, .jpeg</div>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_sertifikat_aspd', $formData['file_sertifikat_aspd'] ?? '') }}</div>
            </div>
            @endif
            <div class="mx-2 mb-3">
                <label for="file_sertifikat_kejuaraan[]" class="form-label">Sertifikat Kejuaraan</label>
                <div id="inputFields">
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_sertifikat_kejuaraan[]" name="file_sertifikat_kejuaraan[]">
                </div>
                <div class="form-text text-danger" id="helpSertirikatKejuaraan">*Sertifikat Kejuaraan</div>
                <button type="button" class="btn btn-info" onClick="addInput()">Tambah File</button>
                <button type="button" class="btn btn-danger" onClick="removeInput()">Hapus File</button>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_sertifikat_kejuaraan[]', $formData['file_sertifikat_kejuaraan[]'] ?? '') }}</div>
            </div>
            <div class="mx-2 mb-3">
                <label for="file_kms_kip" class="form-label">File KMS/KIP</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_kms_kip" name="file_kms_kip">
                <div class="form-text text-danger" id="helpFileKmsKip">*Jika Memiliki</div>
                <div class="form-text" id="valueOfFileFoto">{{ old('file_kms_kip', $formData['file_kms_kip'] ?? '') }}</div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary mt-2 form_dokumen" onclick="submitDokumen('{{ route('dokumenSiswaBackPage1', Auth::user()->id) }}')">Kembali</button>
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
                    <button type="button" class="btn btn-primary form_dokumen" onclick="submitDokumen('{{ route('dokumenSiswaSave', Auth::user()->id) }}')">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
@endsection
@section('namespace-js')
    <script src="{{ asset('js/submit-dokumen-siswa.js') }}"></script>
    <script src="{{ asset('js/dokumen-siswa.js') }}"></script>
@endsection