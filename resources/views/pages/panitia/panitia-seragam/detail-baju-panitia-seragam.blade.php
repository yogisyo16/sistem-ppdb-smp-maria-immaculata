@extends('layouts.panitia.role-panitia.nav-role-panitia')

@section('jenis-panitia')
    selamat datang {{ Auth::user()->name }} di Sistem PPDB
@endsection

@section('sidebar-space')
    <li class="sidebar-item">
        <a href="{{ route('homePanitiaSeragamShow') }}" class="sidebar-link">
            <i class="material-icons">
                home
                <span>Home</span>
            </i>
        </a>
    </li>
@endsection

@section('content-space')
    <div class="container mt-4">
        <form method="POST" action="{{ route('seragamBajuUpdate', $seragam[0]->user_id) }}">
            @csrf
            <h4 class="mx-2">Tanggal Pengambilan Seragam : {{ $seragam[0]->nama_lengkap }}</h4>
            <hr>
            {{-- Tanggal Pengambilan Seragam --}}
            <div class="mx-2 mb-3">
                <label for="pengambilan_seragam" class="form-label">Pengambilan Seragam</label>
                <input type="date" readonly class="form-control" name="pengambilan_seragam" id="pengambilan_seragam" value="{{ $seragam[0]->pengambilan_seragam }}">
            </div>
            <div class="mx-2 mb-3">
                <label for="waktu_pengambilan_seragam" class="form-label">Waktu Pengambilan Seragam</label>
                <input type="time" readonly class="form-control" id="waktu_pengambilan_seragam" name="waktu_pengambilan_seragam" value="{{ $seragam[0]->waktu_pengambilan_seragam }}">
            </div>
            <div class="mx-2 mb-3">
                <h4 class="mx-2">List Seragam</h4>
                <hr>
                <div class="mx-2 mb-3">
                    <label for="seragam_senin" class="form-label">Seragam Senin : </label>
                    <input type="radio" class="form-check-input" name="seragam_senin" value="0" @if ($seragam[0]->seragam_senin == 0)
                        checked
                    @endif> Belum mengambil
                    <input type="radio" class="form-check-input" name="seragam_senin" value="1" @if ($seragam[0]->seragam_senin == 1)
                        checked
                    @endif> Sudah mengambil
                </div>
                <div class="mx-2 mb-3">
                    <label for="seragam_selasa" class="form-label">Seragam Selasa : </label>
                    <input class="form-check-input" type="radio" name="seragam_selasa" value="0" @if ($seragam[0]->seragam_selasa == 0)
                        checked
                    @endif> Belum mengambil
                    <input type="radio" class="form-check-input" name="seragam_selasa" value="1" @if ($seragam[0]->seragam_selasa == 1)
                        checked
                    @endif> Sudah mengambil
                </div>
                <div class="mx-2 mb-3">
                    <label for="seragam_rabu" class="form-label">Seragam Rabu : </label>
                    <input type="radio" class="form-check-input" name="seragam_rabu" value="0" @if ($seragam[0]->seragam_rabu == 0)
                        checked
                    @endif> Belum mengambil
                    <input type="radio" class="form-check-input" name="seragam_rabu" value="1" @if ($seragam[0]->seragam_rabu == 1)
                        checked
                    @endif> Sudah mengambil
                </div>
                <div class="mx-2 mb-3">
                    <label for="seragam_kamis" class="form-label">Seragam Kamis : </label>
                    <input type="radio" class="form-check-input" name="seragam_kamis" value="0" @if ($seragam[0]->seragam_kamis == 0)
                        checked
                    @endif> Belum mengambil
                    <input type="radio" class="form-check-input" name="seragam_kamis" value="1" @if ($seragam[0]->seragam_kamis == 1)
                        checked
                    @endif> Sudah mengambil
                </div>
                <div class="mx-2 mb-3">
                    <label for="seragam_jumat" class="form-label">Seragam Jumat : </label>
                    <input type="radio" class="form-check-input" name="seragam_jumat" value="0" @if ($seragam[0]->seragam_jumat == 0)
                        checked
                    @endif> Belum mengambil
                    <input type="radio" class="form-check-input" name="seragam_jumat" value="1" @if ($seragam[0]->seragam_jumat == 1)
                        checked
                    @endif> Sudah mengambil
                </div>
            </div>
            <div class="btn-group">
                <a href="{{ route('homePanitiaSeragamShow') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
@endsection