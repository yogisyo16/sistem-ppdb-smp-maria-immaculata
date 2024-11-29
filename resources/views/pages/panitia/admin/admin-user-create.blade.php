@extends('layouts.panitia.admin.nav-admin')

@section('home-space')
    {{ route('adminShowhome') }}
@endsection

@section('add-account-space')
    {{ route('adminCreateShow') }}
@endsection

@section('add-periodic-space')
    {{ route('adminCreatePeriodShow') }}
@endsection

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('content-space')
    <div class="container mt-2">
        <form method="POST" action="{{ route('adminCreateSubmit') }}">
            @csrf
            <h4>Akun Panitia</h4>
            <div class="mb-2 gradient-custom-3">
                <hr>
                <div class="mx-2 mb-3">
                    <label for="name" class="form-label">Nama Akun</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
    
                {{-- email --}}
                <div class="mx-2 mb-3">
                    <label for="email" class="form-label">Email Akun</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                {{-- password --}}
                <div class="mx-2 mb-3">
                    <label for="password" class="form-label">Password Akun</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>

                <div class="mx-2 mb-3">
                    <label for="role" class="form-label">Roles :</label>
                    <input type="checkbox" name="role[]" value="admin"> Admin
                    <input type="checkbox" name="role[]" value="inti"> inti
                    <input type="checkbox" name="role[]" value="keuangan"> keuangan
                    <input type="checkbox" name="role[]" value="wawancara"> wawancara
                    <input type="checkbox" name="role[]" value="seragam"> seragam
                </div>
                <hr>
                <button type="submit" class="btn btn-primary mx-2 form-pendaftaran-siswa">Submit</button>
                <hr>
            </div>
        </form>
    </div>
@endsection

@section('script-js')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection