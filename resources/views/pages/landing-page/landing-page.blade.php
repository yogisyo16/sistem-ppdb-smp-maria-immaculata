@extends('layouts.landing-page.nav-landing-page')

@section('css-site')
    <link rel="stylesheet" href="{{ asset('css/body-landingpage-style.css') }}">
@endsection

@section('content-landing')
<div class="body-web gradient-custom-6">
    <div class="container landing-logo d-flex justify-content-center mt-4">
        <img class="img-imex-landing" src="{{ asset('image/logoPutihImex.png') }}" alt="">
    </div>
    <div class="container container-fluid bg-container-landing mt-4">
        <div class="col">
            <section> {{-- section Header --}}
                <div class="row">
                    <div class="d-flex justify-content-center mt-4 mb-2">
                        <h3>Muda Disiplin Kreatif & Berbudaya</h3>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <h4>Selamat datang di Sistem PPDB SMP Maria Immaculata</h4>
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-1">
                        <h4>Kebutuhan Pendaftaran Sistem PPDB</h4>
                    </div>
                </div>
            </section>
            <section> {{-- section Informasi kebutuhan pendaftaran --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-7">
                            <h4>Formulir Pendaftaran :</h4>
                            <div class="row">
                                <p>1. Mempersiapkan data pribadi calon murid :</p>
                                <p style="text-indent: 30px">a. Nama lengkap</p>
                                <p style="text-indent: 30px">b. Akta Kelahiran</p>
                                <p style="text-indent: 30px">c. NISN</p>
                                <p style="text-indent: 30px">d. Hasil Nilai Kelas 5 Semester 1 dan 2, Kelas 6 Semester 1 Mata Pelajaran :</p>
                                <p style="text-indent: 60px">I. Bahasa Indonesia</p>
                                <p style="text-indent: 60px">II. Matematika</p>
                                <p style="text-indent: 60px">III. IPA</p>
                                <p style="text-indent: 60px">IV. IPS</p>
                                <p style="text-indent: 30px">e. Bukti Pembayaran formulir pendaftaran</p>
                            </div>
                        </div>
                        <div class="col-lg">
                            <h4>Dokumen Pendaftaran :</h4>
                            <div class="row">
                                <p>1. Pas Foto 3x4 Berwarna Terbaru</p>
                                <p>2. Kartu Keluarga (KK)</p>
                                <p>3. akta kelahiran</p>
                                <p>4. KTP Orang Tua/Wali</p>
                                <p>5. Rapor kelas V semester 1 dan 2 (dilegalisir)</p>
                                <p>6. Surat ASPD (Khusus DIY)</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <h4>Prosedur Pendaftaran SMP Maria Immaculata</h4>
                    </div>
                </div>
            </section>
            <section> {{-- section button --}}
                <div class="btn-group d-flex justify-content-center mb-2">
                    <a href="{{ route('registerUserShow') }}" class="btn btn-light rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                    <a href="{{ route('loginShow') }}" class="btn btn-info rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('script-landing')
    
@endsection