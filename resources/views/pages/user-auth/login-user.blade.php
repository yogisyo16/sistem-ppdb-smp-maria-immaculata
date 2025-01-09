@extends('layouts.user-auth.nav-login')

@section('front-space')
    <section class="h-100 gradient-form body-login">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-guest">
                                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">SMP Maria Immaculata</h4>
                                    <h6>Visi</h6>
                                    <p class="small mb-0">SMP Maria Immaculata Marsudirini menjadi lembaga pendidikan yang cerdas, berlandaskan iman kepada Tuhan, mencintai sesama dan alam ciptaan-Nya</p>
                                    <h6>Misi</h6>
                                    <p class="small mb-0">1. Menjadikan peserta didik yang beriman, cerdas, berkarakter dan berbudaya</p>
                                    <p class="small mb-0">2. Membantu peserta didik menggali dan mengembangkan minat bakat, dan kreatifitas</p>
                                    <p class="small mb-0">3. Meningkatkan keedulian peserta didik terhadap lingkungan sosial dan lingkungan ciptaan-Nya</p>
                                    <p class="small mb-0">4. Membatu peserta didik mampu menguasai dan menggunakan teknologi secara tepat di era globalisasi</p>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="image/LogoPutihImex.png"
                                            style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">SMP Maria Immaculata</h4>
                                    </div>
                                    <hr>
                                    @if(Session::has('berhasil'))
                                        <div class="alert alert-success">
                                            {{ Session::get('berhasil') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('punyaAkun'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('punyaAkun') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <br>
                                    <form method="POST" action="{{ route('loginUserSubmit') }}">
                                        @csrf
                                        <p>Silahkan masuk ke akun anda</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="name" id="name" class="form-control" name="name"
                                                placeholder="Masukkan Nama Anda" />
                                            <label class="form-label" for="name">Username</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="password" class="form-control" name="password">
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div class="text-center pt-2 mb-5 pb-1">
                                            <a>
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-guest-2 mb-3" type="submit">Log in</button>
                                            </a>
                                            <a class="text-muted" href="#!">Lupa Password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Mendaftarkan Diri?</p>
                                            <a href="{{ route('registerUserShow') }}">
                                                Buat Akun
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 offset-md-3">
                                                <a href="{{ route('redirectGoogleShow') }}">
                                                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                                                </a>
                                            </div>
                                        </div>
                                        @if(Session::has('error'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection