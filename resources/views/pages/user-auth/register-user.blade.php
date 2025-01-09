@extends('layouts.user-auth.nav-register')

@section('front-space')
    <section class="register-user h-100 h-custom gradient-custom-guest-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
                            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                            alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registrasi Akun Peserta Didik Baru</h3>
                            <form method="POST" action="{{ route('registerUserSubmit') }}" class="px-md-2">
                                @csrf
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="name" id="nama_murid" name="name" class="form-control" />
                                    <label class="form-label" for="nama_murid">Name Akun</label>
                                </div>
                                <div data-mdb-input-init class="form-outline mb-5">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                        <label class="form-label" for="email">Masukkan Email</label>
                                    </div>
                                <div class="mb-4">
                                    <div data-mdb-input-init class="form-outline mb-4">                                        
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" oninput="validateRegister()"/>
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <p id="password-wrong" class="password-requirement" hidden>
                                        *Password harus lebih dari 6 character
                                        <br>
                                        *Password harus memiliki angka dan huruf
                                    </p>
                                </div>
                                <a href="{{ route('loginShow') }}" class="btn btn-info btn-lg mb-1" role="button">Back</a>
                                <a href="/">
                                    <button type="submit" class="btn btn-success btn-lg mb-1" id="btn-submit">Submit</button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection