@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
    <div class="container-fluid ">
        @foreach ($dokumen as $dok)
        @foreach ($pendaftaran as $daftar)
        <form method="POST" action="{{ route('dokumenSiswashow1Save', Auth::user()->id) }}" class="container form-control mt-4 mb-2 gradient-custom-5 border border-2 border-black rounded" enctype="multipart/form-data" id="form_dokumen">
            @csrf
            @if(session()->has('haveData'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('haveData') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h4 class="modal-title">Upload Dokumen</h4>
            <hr>
            @if ($daftar->file_bukti_pembayaran_pendaftaran == null)
                <div class="mx-2 mb-3">
                    <label for="file_bukti_pembayaran_pendaftaran" class="form-label">Bukti Pembayaran</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_bukti_pembayaran_pendaftaran" name="file_bukti_pembayaran_pendaftaran">
                    <div class="col-auto">
                        <span id="file_bukti_pembayaran_pendaftaranHelper" class="form-text">
                            Transfer ke rekening : BRI 0245-01-019053-53-1 a/n <b>SMP MARIA IMMACULATA CAB.KATAMSO</b>
                        </span>
                    </div>
                    <div class="form-text text-danger" id="helpFileBuktiPembayaran">*Bukti screenshot transfer bank</div>
                    <div class="form-text" id="valueOfFileBukti">{{ old('file_bukti_pembayaran_pendaftaran', $formData['file_bukti_pembayaran_pendaftaran'] ?? '') }}</div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="file_foto_terbaru" class="form-label">Foto 3x4</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_foto_terbaru" name="file_foto_terbaru">
                    <div class="form-text text-danger" id="helpFileFotoTerbaru">*Foto Terbaru</div>
                    <div class="form-text" id="valueOfFileFoto">{{ old('file_foto_terbaru', $formData['file_foto_terbaru'] ?? '') }}</div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="file_kartu_keluarga" class="form-label">File Kartu Keluarga</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_kartu_keluarga" name="file_kartu_keluarga">
                    <div class="form-text text-danger" id="helpFileKartuKeluarga">*File yang dapat di Upload .pdf/.png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKartu">{{ old('file_kartu_keluarga', $formData['file_kartu_keluarga'] ?? '') }}</div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="file_akta_kelahiran" class="form-label">File Akta Kelahiran</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_akta_kelahiran" name="file_akta_kelahiran">
                    <div class="form-text text-danger" id="helpFileAktaKelahiran">*File yang dapat di Upload .pdf/.png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileAkta">{{ old('file_akta_kelahiran', $formData['file_akta_kelahiran'] ?? '') }}</div>
                </div>
                @if ($daftar->nama_ayah == null)
                    <div class="mx-2 mb-3" hidden>
                        <label for="file_ktp_orang_tua_ayah" class="form-label">Foto KTP Ayah</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ayah" name="file_ktp_orang_tua_ayah">
                        <div class="form-text text-danger" id="helpFileKtpOrtuAyah">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpAyah">{{ old('file_ktp_orang_tua_ayah', $formData['file_ktp_orang_tua_ayah'] ?? '') }}</div>
                    </div>
                @else
                    <div class="mx-2 mb-3">
                        <label for="file_ktp_orang_tua_ayah" class="form-label">Foto KTP Ayah</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ayah" name="file_ktp_orang_tua_ayah">
                        <div class="form-text text-danger" id="helpFileKtpOrtuAyah">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpAyah">{{ old('file_ktp_orang_tua_ayah', $formData['file_ktp_orang_tua_ayah'] ?? '') }}</div>
                    </div>
                @endif
                @if ($daftar->nama_ibu == null)
                    <div class="mx-2 mb-3" hidden>
                        <label for="file_ktp_orang_tua_ibu" class="form-label">Foto KTP Ibu</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ibu" name="file_ktp_orang_tua_ibu">
                        <div class="form-text text-danger" id="helpFileKtpOrtuIbu">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpIbu">{{ old('file_ktp_orang_tua_ibu', $formData['file_ktp_orang_tua_ibu'] ?? '') }}</div>
                    </div>
                @else
                    <div class="mx-2 mb-3">
                        <label for="file_ktp_orang_tua_ibu" class="form-label">Foto KTP Ibu</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ibu" name="file_ktp_orang_tua_ibu">
                        <div class="form-text text-danger" id="helpFileKtpOrtuIbu">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpIbu">{{ old('file_ktp_orang_tua_ibu', $formData['file_ktp_orang_tua_ibu'] ?? '') }}</div>
                    </div>
                @endif
                @if ($daftar->nama_wali == null)
                <div class="mx-2 mb-3" hidden>
                    <label for="file_ktp_orang_tua_wali" class="form-label">Foto KTP wali</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_wali" name="file_ktp_orang_tua_wali">
                    <div class="form-text text-danger" id="helpFileKtpOrtuWali">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKtpWali">{{ old('file_ktp_orang_tua_wali', $formData['file_ktp_orang_tua_wali'] ?? '') }}</div>
                </div>
                @else
                <div class="mx-2 mb-3">
                    <label for="file_ktp_orang_tua_wali" class="form-label">Foto KTP wali</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_wali" name="file_ktp_orang_tua_wali">
                    <div class="form-text text-danger" id="helpFileKtpOrtuWali">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKtpWali">{{ old('file_ktp_orang_tua_wali', $formData['file_ktp_orang_tua_wali'] ?? '') }}</div>
                </div>
                @endif
                <hr>
                <button type="submit" class="btn btn-primary mt-2 mb-2 mx-2 dokumen-page1-siswa">Selanjutnya</button>
            @else
            <div class="mx-2 mb-3">
                    <label for="file_foto_terbaru" class="form-label">Foto 3x4</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_foto_terbaru" name="file_foto_terbaru">
                    <div class="form-text text-danger" id="helpFileFotoTerbaru">*Foto Terbaru</div>
                    <div class="form-text" id="valueOfFileFoto">{{ old('file_foto_terbaru', $formData['file_foto_terbaru'] ?? '') }}</div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="file_kartu_keluarga" class="form-label">File Kartu Keluarga</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_kartu_keluarga" name="file_kartu_keluarga">
                    <div class="form-text text-danger" id="helpFileKartuKeluarga">*File yang dapat di Upload .pdf/.png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKartu">{{ old('file_kartu_keluarga', $formData['file_kartu_keluarga'] ?? '') }}</div>
                </div>
                <div class="mx-2 mb-3">
                    <label for="file_akta_kelahiran" class="form-label">File Akta Kelahiran</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_akta_kelahiran" name="file_akta_kelahiran">
                    <div class="form-text text-danger" id="helpFileAktaKelahiran">*File yang dapat di Upload .pdf/.png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileAkta">{{ old('file_akta_kelahiran', $formData['file_akta_kelahiran'] ?? '') }}</div>
                </div>
                @if ($daftar->nama_ayah == null)
                    <div class="mx-2 mb-3" hidden>
                        <label for="file_ktp_orang_tua_ayah" class="form-label">Foto KTP Ayah</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ayah" name="file_ktp_orang_tua_ayah">
                        <div class="form-text text-danger" id="helpFileKtpOrtuAyah">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpAyah">{{ old('file_ktp_orang_tua_ayah', $formData['file_ktp_orang_tua_ayah'] ?? '') }}</div>
                    </div>
                @else
                    <div class="mx-2 mb-3">
                        <label for="file_ktp_orang_tua_ayah" class="form-label">Foto KTP Ayah</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ayah" name="file_ktp_orang_tua_ayah">
                        <div class="form-text text-danger" id="helpFileKtpOrtuAyah">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpAyah">{{ old('file_ktp_orang_tua_ayah', $formData['file_ktp_orang_tua_ayah'] ?? '') }}</div>
                    </div>
                @endif
                @if ($daftar->nama_ibu == null)
                    <div class="mx-2 mb-3" hidden>
                        <label for="file_ktp_orang_tua_ibu" class="form-label">Foto KTP Ibu</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ibu" name="file_ktp_orang_tua_ibu">
                        <div class="form-text text-danger" id="helpFileKtpOrtuIbu">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpIbu">{{ old('file_ktp_orang_tua_ibu', $formData['file_ktp_orang_tua_ibu'] ?? '') }}</div>
                    </div>
                @else
                    <div class="mx-2 mb-3">
                        <label for="file_ktp_orang_tua_ibu" class="form-label">Foto KTP Ibu</label>
                        <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_ibu" name="file_ktp_orang_tua_ibu">
                        <div class="form-text text-danger" id="helpFileKtpOrtuIbu">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                        <div class="form-text" id="valueOfFileKtpIbu">{{ old('file_ktp_orang_tua_ibu', $formData['file_ktp_orang_tua_ibu'] ?? '') }}</div>
                    </div>
                @endif
                @if ($daftar->nama_wali == null)
                <div class="mx-2 mb-3" hidden>
                    <label for="file_ktp_orang_tua_wali" class="form-label">Foto KTP wali</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_wali" name="file_ktp_orang_tua_wali">
                    <div class="form-text text-danger" id="helpFileKtpOrtuWali">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKtpWali">{{ old('file_ktp_orang_tua_wali', $formData['file_ktp_orang_tua_wali'] ?? '') }}</div>
                </div>
                @else
                <div class="mx-2 mb-3">
                    <label for="file_ktp_orang_tua_wali" class="form-label">Foto KTP wali</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png" type="file" id="file_ktp_orang_tua_wali" name="file_ktp_orang_tua_wali">
                    <div class="form-text text-danger" id="helpFileKtpOrtuWali">*File yang dapat di Upload .png/.jpeg/.jpg</div>
                    <div class="form-text" id="valueOfFileKtpWali">{{ old('file_ktp_orang_tua_wali', $formData['file_ktp_orang_tua_wali'] ?? '') }}</div>
                </div>
                @endif
                <hr>
                <button type="submit" class="btn btn-primary mt-2 mb-2 mx-2 dokumen-page1-siswa">Selanjutnya</button>
            @endif
        </form>
        @endforeach
        @endforeach
    </div>
@endsection