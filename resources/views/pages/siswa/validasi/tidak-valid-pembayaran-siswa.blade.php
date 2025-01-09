@extends('layouts.siswa.nav-siswa-ppdb')
@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/validation-pembayaran-style.css') }}">
@endsection
@section('content-space')
    <div class="container-fluid valid-page">
        @foreach ($pendaftaran as $daftar)
        @foreach ($pembayaran as $bayar)
        <form method="POST" action="{{route('pembayaranTidakValidSubmit', Auth::user()->id)}}" class="container form-control mt-4 mb-2 gradient-custom-5 border border-2 border-black rounded" enctype="multipart/form-data" id="form_dokumen">
            @csrf
            <div class="img-valid-page">
                <img class="img-bukti" src="{{ asset('storage/' . $daftar->file_bukti_pembayaran_pendaftaran) }}" alt="">
            </div>
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
            <button type="submit" class="btn btn-primary mt-2 mb-2 mx-2">Upload</button>
        </form>
        @endforeach
        @endforeach
    </div>
@endsection