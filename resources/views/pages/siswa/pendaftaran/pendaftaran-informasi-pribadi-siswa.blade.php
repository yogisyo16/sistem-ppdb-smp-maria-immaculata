@extends('layouts.siswa.nav-siswa-ppdb')
@section('content-space')
<div class="container-fluid ">
    <form method="POST" action="{{ route('pendaftaranSiswaShowPage1SaveData') }}" class="container form-control mt-4 mb-2" enctype="multipart/form-data" >
        @csrf
        @error('any')
            <div class="alert alert-danger">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
            <h4>Data Diri Calon Murid</h4>
            <div class="mb-2 gradient-custom-3">
                <hr>
                {{-- Text for Name --}}
                <div class="mx-2 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $formData['nama_lengkap'] ?? '') }}">
                </div>
                @error('nama_lengkap')
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
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
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" min="2008-01-01" max="2070-12-31" value="{{ old('tanggal_lahir', $formData['tanggal_lahir'] ?? '') }}">
                </div>
                @error('tanggal_lahir')
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                   
                @enderror
                {{-- Input for Tempat Lahir--}}
                <div class="mx-2 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input class="form-control" name="tempat_lahir" id="tempat_lahir" cols="5" rows="3" value="{{ old('tempat_lahir', $formData['tempat_lahir'] ?? '') }}"></input>
                </div>
                @error('tempat_lahir')
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                {{-- text for Nomor Telpon --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="nohp" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" minlength="10" maxlength="14" onkeypress="return isNumber(event)" value="{{ old('nohp', $formData['nohp'] ?? '') }}">
                </div>
                @error('nohp')
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                {{-- Text for Anak ke & Text for Jumlah Saudara --}}
                {{-- Text for Anak ke--}}
                <div class="row g-2">
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="anak_ke" class="form-label">Anak Ke</label>
                        <input type="text" class="form-control" id="anak_ke" name="anak_ke" onkeypress="return isNumber(event) " value="{{ old('anak_ke', $formData['anak_ke'] ?? '') }}">
                    </div>
                    {{-- Text for Jumlah Saudara--}}
                    <div class="col-sm-2 mx-2 mb-3">
                        <label for="jumlah_saudara" class="form-label">Jumlah Saudara</label>
                        <input type="text" class="form-control" id="jumlah_saudara" name="jumlah_saudara" onkeypress="return isNumber(event)" value="{{ old('jumlah_saudara', $formData['jumlah_saudara'] ?? '') }}">
                    </div>
                </div>
                {{-- Select for Jenis Kelamin --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                        <option selected value="">Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $formData['jenis_kelamin']) == "Laki-laki" ? 'selected' : '' }} >Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $formData['jenis_kelamin']) == "Perempuan" ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </select>
                </div>
                {{-- Select for Agama --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="agama">
                        <option selected value="">Pilih Agama</option>
                        <option value="Islam" {{ old('agama', $formData['agama']) == "Islam" ? 'selected' : '' }} >Islam</option>
                        <option value="Katolik" {{ old('agama', $formData['agama']) == "Katolik" ? 'selected' : '' }} >Katolik</option>
                        <option value="Kristen" {{ old('agama', $formData['agama']) == "Kristen" ? 'selected' : '' }} >Kristen</option>
                        <option value="Hindu" {{ old('agama', $formData['agama']) == "Hindu" ? 'selected' : '' }} >Hindu</option>
                        <option value="Buddha" {{ old('agama', $formData['agama']) == "Buddha" ? 'selected' : '' }} >Buddha</option>
                        <option value="Konghucu" {{ old('agama', $formData['agama']) == "Konghucu" ? 'selected' : '' }} >Konghucu</option>
                    </select>
                </div>
                {{-- Radio for Jalur Pendaftaran --}}
                <div class="col-sm-2 mx-2 mb-3">
                    <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>
                    <select class="form-select" name="jalur_pendaftaran" id="jalur_pendaftaran">
                        <option selected value="">Jalur Pendaftaran</option>
                        <option value="Akademik" {{ old('jalur_pendaftaran', $formData['jalur_pendaftaran']) == "Akademik" ? 'selected' : '' }} >Prestasi Akademik</option>
                        <option value="NonAkademik" {{ old('jalur_pendaftaran', $formData['jalur_pendaftaran']) == "NonAkademik" ? 'selected' : '' }} >Prestasi : Sains, Olahraga dan Seni</option>
                        <option value="Reguler" {{ old('jalur_pendaftaran', $formData['jalur_pendaftaran']) == "Reguler" ? 'selected' : '' }} >Reguler</option>
                    </select>
                </div>

                <hr class="my-4">
                
                <h5 class="mb-4 mx-2">Alamat</h5>

                {{-- Text Area for Tempat Tinggal KK--}}
                <div class="mx-2 mb-3">
                    <label for="alamat_tinggal_c1_kk" class="form-label">Alamat Tempat Tinggal sesuai C1/KK</label>
                    <textarea class="form-control" name="alamat_tinggal_c1_kk" id="alamat_tinggal_c1_kk" cols="5" rows="3">{{ old('alamat_tinggal_c1_kk', $formData['alamat_tinggal_c1_kk'] ?? '') }}</textarea>
                </div>
                {{-- Text Area for Tempat Tinggal Sekarang --}}
                <div class="mx-2 mb-3">
                    <label for="alamat_tmpt_tinggal" class="form-label">Alamat Tempat Tinggal</label>
                    <textarea class="form-control" name="alamat_tmpt_tinggal" id="alamat_tmpt_tinggal" cols="5" rows="3">{{ old('alamat_tinggal_c1_kk', $formData['alamat_tinggal_c1_kk'] ?? '') }}</textarea>
                </div>
                <hr>
            </div>
            <button type="submit" class="btn btn-primary mt-2 form-pendaftaran-siswa">Selanjutnya</button>
    </form>
</div>
@endsection