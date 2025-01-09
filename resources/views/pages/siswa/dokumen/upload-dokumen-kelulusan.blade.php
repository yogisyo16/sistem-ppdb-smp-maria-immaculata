@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
    <div class="container-fluid ">
        @foreach ($dokumen as $dok)
        @foreach ($pendaftaran as $daftar)
        <form method="POST" action="{{ route('dokumenKelulusanSubmit', Auth::user()->id) }}" class="container form-control mt-4 mb-2 gradient-custom-5 border border-2 border-black rounded" enctype="multipart/form-data"">
            @csrf
            <div class="mx-2 mb-3">
                <label for="file_surat_keterangan_lulus" class="form-label">Surat Keterangan Lulus</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_surat_keterangan_lulus" name="file_surat_keterangan_lulus">
                <div class="form-text text-danger" id="helpRaporKelasV2">*Rapor murid kelas V semester 2 dapat berupa .pdf, .png, .jpg, .jpeg</div>
            </div>
            <div class="mx-2 mb-3">
                <label for="file_ijazah" class="form-label">File Ijazah</label>
                <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_ijazah" name="file_ijazah">
                <div class="form-text text-danger" id="helpRaporKelasV2">*Ijazah di legalisir</div>
            </div>
            @if ($daftar->is_diy == true)
                <div class="mx-2 mb-3">
                    <label for="file_sertifikat_aspd" class="form-label">File Sertifikat ASPD</label>
                    <input class="form-control" accept="image/jpeg, image/jpg, image/png, application/pdf" type="file" id="file_sertifikat_aspd" name="file_sertifikat_aspd">
                    <div class="form-text text-danger" id="helpRaporKelasV2">*File berupa .pdf, .png, .jpg, .jpeg</div>
                </div>
            @endif
        @endforeach
        @endforeach
        <div class="btn-group">
            <a href="{{ route('siswaSeragamShow', $dok->user_id) }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
@endsection