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
        <h5 class="mt-4">Pengguna Sistem PPDB</h5>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Tanggal Daftar</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $no=>$dataUser)
                <tr>
                    <td scope="row">{{ $no +1 }}</td>
                    <td>{{ $dataUser->name }}</td>
                    <td>{{ $dataUser->email }}</td>
                    <td>{{ implode(', ', $dataUser->role) }}</td>
                    <td>{{ $dataUser->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('adminEditShow', $dataUser->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('adminDeleteUser', $dataUser->id) }}" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Periode Pendaftaran</h5>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Periode Tahun</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periodic as $no=>$periode)
                <tr>
                    <td scope="row">{{ $no +1 }}</td>
                    <td>{{ $periode->tahun_ajaran }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                        </button>
                    </td>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Periode Tahun Ajaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin menghapus periode {{ $periode->tahun_ajaran }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('deletePeriodic', $periode->id) }}" class="btn btn-danger">Delete</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection