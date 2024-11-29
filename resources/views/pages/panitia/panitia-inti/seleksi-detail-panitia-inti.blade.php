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
<div class="container mt-4">
    <form method="POST" action="{{ route('seleksiSiswaPanitiaIntiDetailSubmit', $seleksi[0]->user_id) }}">
        @csrf
        <h4>Hasil Keputusan Seleksi</h4>
        <hr>
        <div class="mb-2">
            <div class="mx-2 mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Calon Siswa:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $pendaftaran[0]->nama_lengkap }}">
                </div>
            </div>
            <div class="mx-2 mb-3 row">
                <label for="jalur_pendaftaran" class="col-sm-2 col-form-label">Jalur Pendaftaran Pilihan:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="jalur_pendaftaran" value="{{ $pendaftaran[0]->jalur_pendaftaran }}">
                </div>
            </div>
            <div class="mx-3 mb-3">
                <label for="dokumen" class="col-sm-2 col-form-label">Dokumen Siswa : </label>
                <a href="{{ route('dokumenDetailShow', $pendaftaran[0]->user_id) }}" class="btn btn-info">Detail</a>
            </div>
            <div class="mx-2 mb-3 row">
                <label for="nilai_siswa" class="col-sm-2 col-form-label">Nilai Siswa : </label>
            </div>
            <div class="mx-2 mb-3 row">
                <h5>Nilai Rapot Kelas V Semester 1</h5>
                <hr>
                <label for="nilai_siswa" class="form-label">Nilai Matematika Kelas V Semester 1 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_matematika_klsv_smt1" value="{{ $pendaftaran[0]->nilai_rapot_matematika_klsv_smt1 }}">
                <label for="nilai_siswa" class="form-label">Nilai Bahasa Indonesia Kelas V Semester 1 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_bhsindo_klsv_smt1" value="{{ $pendaftaran[0]->nilai_rapot_bhsindo_klsv_smt1 }}">
                <label for="nilai_siswa" class="form-label">Nilai IPA Kelas V Semester 1 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_ipa_klsv_smt1" value="{{ $pendaftaran[0]->nilai_rapot_ipa_klsv_smt1 }}">
                <label for="nilai_siswa" class="form-label">Nilai IPS Kelas V Semester 1 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_ips_klsv_smt1" value="{{ $pendaftaran[0]->nilai_rapot_ips_klsv_smt1 }}">
                <label for="nilai_siswa" class="form-label">Rata-rata nilai Kelas V Semester 1 :</label>
                <input type="text" readonly class="form-control-plaintext" id="rata_rata" value="{{ ($pendaftaran[0]->nilai_rapot_matematika_klsv_smt1 + $pendaftaran[0]->nilai_rapot_bhsindo_klsv_smt1 +  $pendaftaran[0]->nilai_rapot_ipa_klsv_smt1 + $pendaftaran[0]->nilai_rapot_ips_klsv_smt1)/4 }}">
                <hr>
                <h5>Nilai Rapot Kelas V Semester 2</h5>
                <hr>
                <label for="nilai_siswa" class="form-label">Nilai Matematika Kelas V Semester 2 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_matematika_klsv_smt2" value="{{ $pendaftaran[0]->nilai_rapot_matematika_klsv_smt2 }}">
                <label for="nilai_siswa" class="form-label">Nilai Bahasa Indonesia Kelas V Semester 2 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_bhsindo_klsv_smt2" value="{{ $pendaftaran[0]->nilai_rapot_bhsindo_klsv_smt2 }}">
                <label for="nilai_siswa" class="form-label">Nilai IPA Kelas V Semester 2 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_ipa_klsv_smt2" value="{{ $pendaftaran[0]->nilai_rapot_ipa_klsv_smt2 }}">
                <label for="nilai_siswa" class="form-label">Nilai IPS Kelas V Semester 2 : </label>
                <input type="text" readonly class="form-control-plaintext" id="nilai_rapot_ips_klsv_smt2" value="{{ $pendaftaran[0]->nilai_rapot_ips_klsv_smt2 }}">
                <label for="nilai_siswa" class="form-label">Rata-rata nilai Kelas V Semester 2 :</label>
                <input type="text" readonly class="form-control-plaintext" id="rata_rata" value="{{ ($pendaftaran[0]->nilai_rapot_matematika_klsv_smt2 + $pendaftaran[0]->nilai_rapot_bhsindo_klsv_smt2 +  $pendaftaran[0]->nilai_rapot_ipa_klsv_smt2 + $pendaftaran[0]->nilai_rapot_ips_klsv_smt2)/4 }}">
            </div>
            <div class="mx-2 mb-3 row">
                <select class="form-select" name="hasil_jalur_pendaftaran" aria-label="Default select example">
                    <option selected value="">Seleksi Jalur Pendaftaran</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Akademik">Akademik</option>
                    <option value="NonAkademik">Non Akademik</option>
                </select>
            </div>

            <div class="mx-2 mb-3 row">
                <select class="form-select" name="isLulus" aria-label="Default select example">
                    <option selected value="Menunggu">Hasil Seleksi</option>
                    <option value="Lulus">Lulus</option>
                    <option value="Tidak Lulus">Tidak Lulus</option>
                </select>
            </div>
        </div>
        <div class="btn-group my-2 mx-2">
            <a href="{{ route('homePanitiaIntiShow') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection