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
    selamat datang admin Sistem PPDB
@endsection

@section('content-space')
    <div class="container mt-2">
        @foreach ($users as $user)
            <form method="POST" action="{{ route('adminEditSubmit', $user->id) }}">
            @csrf
            <h4>Akun Panitia</h4>
                <div class="mb-2 gradient-custom-3">
                    <hr>
                    <div class="mx-2 mb-3">
                        <label for="name" class="form-label">Nama Akun</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
        
                    {{-- email --}}
                    <div class="mx-2 mb-3">
                        <label for="email" class="form-label">Email Akun</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    {{-- password --}}
                    <div class="mx-2 mb-3">
                        <label for="password" class="form-label">New Password Akun</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>

                    <div class="mx-2 mb-3">
                        <label for="role" class="form-label">Roles :</label>
                        @if (in_array('admin', $user->role))
                            <input type="checkbox" name="role[]" value="admin" checked> Admin
                        @else
                            <input type="checkbox" name="role[]" value="admin"> Admin
                        @endif
                        @if (in_array('inti', $user->role))
                            <input type="checkbox" name="role[]" value="inti" checked> Panitia Inti
                        @else
                            <input type="checkbox" name="role[]" value="inti"> Panitia Inti
                        @endif
                        @if (in_array('keuangan', $user->role))
                            <input type="checkbox" name="role[]" value="keuangan" checked> Panitia keuangan
                        @else
                            <input type="checkbox" name="role[]" value="keuangan"> Panitia keuangan
                        @endif
                        @if (in_array('wawancara', $user->role))
                            <input type="checkbox" name="role[]" value="wawancara" checked> Panitia wawancara
                        @else
                            <input type="checkbox" name="role[]" value="wawancara"> Panitia wawancara
                        @endif
                        @if (in_array('seragam', $user->role))
                            <input type="checkbox" name="role[]" value="seragam" checked> Panitia seragam
                        @else
                            <input type="checkbox" name="role[]" value="seragam"> Panitia seragam
                        @endif
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary mx-2 form-pendaftaran-siswa">Update</button>
                    <hr>
                </div>
            </form>
        @endforeach
    </div>
@endsection

@section('script-js')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection