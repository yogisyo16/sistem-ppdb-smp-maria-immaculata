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
    <div class="container mt-4">
        <form method="POST" action="{{ route('adminCreatePeriodSubmit') }}">
            @csrf
            <h4>Periode Pendaftaran Calon Murid SMP Maria Immaculata</h4>
            <div class="mx-2 mb-3">
                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran">
            </div>
            <button class="btn btn-primary mx-2">Submit</button>
        </form>
    </div>
@endsection