<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanitiaIntiController;
use App\Http\Controllers\PanitiaKeuanganController;
use App\Http\Controllers\PanitiaSeragamController;
use App\Http\Controllers\PanitiaWawancaraController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RolePanitiaController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RegisterPanitiaController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\SeragamController;
use App\Http\Controllers\UploadDokumenController;
use App\Http\Controllers\WawancaraController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;



// Route::get('/siswa/pendaftaran', [PendaftaranController::class, 'pendaftaranSiswaShowTest'])->name('pendaftaranSiswaShowTest');

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('pages.landing-page.landing-page');
    });
    //UserRegister
    Route::get('/register', [UserAuthController::class, 'registerUserShow'])->name('registerUserShow');
    Route::post('/register/submit', [UserAuthController::class, 'registerUserSubmit'])->name('registerUserSubmit');
    //UserLogin
    Route::get('/login', [UserAuthController::class, 'loginShow'])->name('loginShow');
    Route::post('/login/submit', [UserAuthController::class, 'loginUserSubmit'])->name('loginUserSubmit');
    //GoogleLogin
    Route::get('/auth/google', [UserAuthController::class, 'redirectGoogleShow'])->name('redirectGoogleShow');
    Route::get('/auth/google/callback', [UserAuthController::class, 'googleCallbackSubmit'])->name('googleCallbackSubmit');
});

Route::middleware('auth')->group(function () {
    //Pendaftaran Siswa
    Route::get('/pendaftaran/siswa/page1', [PendaftaranController::class, 'pendaftaranSiswaShowPage1'])->name('pendaftaranSiswaShowPage1')->middleware('role:siswa');
    Route::post('/pendaftaran/siswa/page1-save', [PendaftaranController::class, 'pendaftaranSiswaShowPage1SaveData'])->name('pendaftaranSiswaShowPage1SaveData')->middleware('role:siswa');
    Route::post('/pendaftaran/siswa/back/page1', [PendaftaranController::class, 'pendaftaranSiswaShowpage1Back'])->name('pendaftaranSiswaShowpage1Back')->middleware('role:siswa');
    Route::get('/pendaftaran/siswa/page2', [PendaftaranController::class, 'pendaftaranSiswaShowPage2'])->name('pendaftaranSiswaShowPage2')->middleware('role:siswa');
    Route::post('/pendaftaran/siswa/page2-save', [PendaftaranController::class, 'pendaftaranSiswaShowPage2SaveData'])->name('pendaftaranSiswaShowPage2SaveData')->middleware('role:siswa');
    Route::post('/pendaftaran/siswa/back', [PendaftaranController::class, 'pendaftaranSiswaShowPage2Back'])->name('pendaftaranSiswaShowPage2Back')->middleware('role:siswa');
    Route::get('/pendaftaran/siswa/page3', [PendaftaranController::class, 'pendaftaranSiswaShowPage3'])->name('pendaftaranSiswaShowPage3')->middleware('role:siswa');
    Route::post('/pendaftaran/siswa/submit', [PendaftaranController::class, 'pendaftaranSiswaSubmit'])->name('pendaftaranSiswaSubmit')->middleware('role:siswa');

    //Upload Dokumen
    Route::get('/dokumen/siswa/page1/{id}', [UploadDokumenController::class, 'dokumenSiswaShow1'])->name('dokumenSiswaShow1')->middleware('role:siswa');
    Route::post('/dokumen/siswa/page1/next/{id}', [UploadDokumenController::class, 'dokumenSiswashow1Save'])->name('dokumenSiswashow1Save')->middleware('role:siswa');
    Route::post('/dokumen/siswa/page2/back/{id}', [UploadDokumenController::class, 'dokumenSiswaBackPage1'])->name('dokumenSiswaBackPage1')->middleware('role:siswa');
    Route::get('/dokumen/siswa/page2/{id}', [UploadDokumenController::class, 'dokumenSiswaShowPage2'])->name('dokumenSiswaShowPage2')->middleware('role:siswa');
    Route::post('/dokumen/siswa/page2/save/{id}', [UploadDokumenController::class, 'dokumenSiswaSave'])->name('dokumenSiswaSave')->middleware('role:siswa');

    Route::get('/seleksi/siswa/{id}', [SeleksiController::class, 'seleksiSiswaShow'])->name('seleksiSiswaShow')->middleware('role:siswa');
    Route::get('/wawancara/siswa/{id}', [WawancaraController::class, 'jadwalWawancaraSiswaShow'])->name('jadwalWawancaraSiswaShow')->middleware('role:siswa');
    Route::get('/wawancara/siswa/finansial/{id}', [WawancaraController::class, 'hasilWawancaraFinansialShow'])->name('hasilWawancaraFinansialShow')->middleware('role:siswa');
    Route::get('/seragam/siswa/{id}', [SeragamController::class, 'siswaSeragamShow'])->name('siswaSeragamShow')->middleware('role:siswa');
    Route::get('/dokumen/kelulusan/{id}', [UploadDokumenController::class, 'dokumenKelulusanShow'])->name('dokumenKelulusanShow')->middleware('role:siswa');
    Route::post('/dokumen/kelulusan/submit/{id}', [UploadDokumenController::class, 'dokumenKelulusanSubmit'])->name('dokumenKelulusanSubmit')->middleware('role:siswa');
    Route::get('/siswa/smpmariaimmaculata/{id}', [UploadDokumenController::class, 'bergabungShow'])->name('bergabungShow')->middleware('role:siswa');

    //Choose Account for Panitia
    Route::get('/account/panitia', [RolePanitiaController::class, 'roleManyShow'])->name('roleManyShow')->middleware('role:admin,inti,keuangan,wawancara,seragam');

    //Admin
    Route::get('/account/panitia/admin', [AdminController::class, 'adminShowhome'])->name('adminShowhome')->middleware('role:admin');

    Route::get('/account/panitia/admin/create', [AdminController::class, 'adminCreateShow'])->name('adminCreateShow')->middleware('role:admin');
    Route::post('/account/panitia/admin/create/submit', [AdminController::class, 'adminCreateSubmit'])->name('adminCreateSubmit')->middleware('role:admin');
    Route::get('/account/panitia/admin/edit/{id}', [AdminController::class, 'adminEditShow'])->name('adminEditShow')->middleware('role:admin');
    Route::post('/account/panitia/admin/edit/submit/{id}', [AdminController::class, 'adminEditSubmit'])->name('adminEditSubmit')->middleware('role:admin');
    Route::get('/account/panitia/admin/delete/{id}', [AdminController::class, 'adminDeleteUser'])->name('adminDeleteUser')->middleware('role:admin');

    Route::get('/account/panitia/admin/periodic', [AdminController::class, 'adminCreatePeriodShow'])->name('adminCreatePeriodShow')->middleware('role:admin');
    Route::post('/account/panitia/admin/periodic/submit', [AdminController::class, 'adminCreatePeriodSubmit'])->name('adminCreatePeriodSubmit')->middleware('role:admin');
    Route::get('/account/panitia/admin/periodic/delete/{id}', [AdminController::class, 'deletePeriodic'])->name('deletePeriodic')->middleware('role:admin');
    
    //Panitia
    
    //Inti
    Route::get('/account/panitia/inti', [PanitiaIntiController::class, 'homePanitiaIntiShow'])->name('homePanitiaIntiShow')->middleware('role:inti');
    //Data Pendaftaran inti
    Route::get('/account/panitia/inti/pendaftaran', [PanitiaIntiController::class, 'pendaftaranListShow'])->name('pendaftaranListShow')->middleware('role:inti'); // View Pendaftaran
    Route::get('/account/panitia/inti/pendaftaran/detail/{id}', [PanitiaIntiController::class, 'pendaftaranDetailShow'])->name('pendaftaranDetailShow')->middleware('role:inti'); // View Pendaftaran Detail per Siswa
    Route::get('/account/panitia/inti/download/pdf/{id}', [PanitiaIntiController::class, 'generatePDF'])->name('generatePDF')->middleware('role:inti'); // View Pendaftaran Detail per Siswa
    // Route::get('/account/panitia/{id}', [PanitiaIntiController::class, 'getFileBuktiPendaftaran'])->name('getFileBuktiPendaftaran')->middleware('role:inti'); // View Pendaftaran Detail per Siswa
    
    Route::get('/account/panitia/inti/dokumen/detail/{id}', [PanitiaIntiController::class, 'dokumenDetailShow'])->name('dokumenDetailShow')->middleware('role:inti'); // View Dokumen

    Route::get('/account/panitia/inti/seleksi/detail/{id}', [PanitiaIntiController::class, 'seleksiSiswaPanitiaIntiDetailShow'])->name('seleksiSiswaPanitiaIntiDetailShow')->middleware('role:inti');
    Route::post('/account/panitia/inti/seleksi/detail/submit/{id}', [PanitiaIntiController::class, 'seleksiSiswaPanitiaIntiDetailSubmit'])->name('seleksiSiswaPanitiaIntiDetailSubmit')->middleware('role:inti');

    Route::get('/account/panitia/inti/create/wawancara/{id}', [PanitiaIntiController::class, 'createWawancaraPanitiaInti'])->name('createWawancaraPanitiaInti')->middleware('role:inti');
    Route::post('/account/panitia/inti/create/wawancara/submit/{id}', [PanitiaIntiController::class, 'createWawancaraPanitiaIntiSubmit'])->name('createWawancaraPanitiaIntiSubmit')->middleware('role:inti');
    Route::get('/account/panitia/inti/view/wawancara/{id}', [PanitiaIntiController::class, 'viewWawancaraPanitiaIntiShow'])->name('viewWawancaraPanitiaIntiShow')->middleware('role:inti');
    Route::get('/account/panitia/inti/wawancara/finansial/{id}', [PanitiaIntiController::class, 'viewWawancaraFinansialPanitiaIntiShow'])->name('viewWawancaraFinansialPanitiaIntiShow')->middleware('role:inti');
    Route::get('/account/panitia/inti/wawancara/murid/{id}', [PanitiaIntiController::class, 'viewWawancaraMuridPanitiaIntiShow'])->name('viewWawancaraMuridPanitiaIntiShow')->middleware('role:inti');  
    
    //Panitia Keuangan
    Route::get('/account/panitia/keuangan/home', [PanitiaKeuanganController::class, 'homePanitiaKeuanganShow'])->name('homePanitiaKeuanganShow')->middleware('role:keuangan');
    Route::get('/account/panitia/keuangan/verifikasi/{id}', [PanitiaKeuanganController::class, 'validasiBuktiShow'])->name('validasiBuktiShow')->middleware('role:keuangan');
    Route::post('/account/panitia/keuangan/verifikasi/submit/{id}', [PanitiaKeuanganController::class, 'validasiBuktiSubmit'])->name('validasiBuktiSubmit')->middleware('role:keuangan');
    Route::get('/account/panitia/show/bukti/{id}', [PanitiaKeuanganController::class, 'getFileBuktiKeuangan'])->name('getFileBuktiKeuangan')->middleware('role:keuangan');
    
    //Panitia Wawancara
    Route::get('/account/panitia/wawancara/home', [PanitiaWawancaraController::class, 'homePanitiaWawancaraShow'])->name('homePanitiaWawancaraShow')->middleware('role:wawancara');
    Route::get('/account/panitia/wawancara/finansial/detail/{id}', [PanitiaWawancaraController::class, 'wawancaraFinansialDetailShow'])->name('wawancaraFinansialDetailShow')->middleware('role:wawancara');
    Route::post('/account/panitia/wawancara/finansial/detail/submit/{id}', [PanitiaWawancaraController::class, 'wawancaraFinansialSubmit'])->name('wawancaraFinansialSubmit')->middleware('role:wawancara');
    Route::get('/account/panitia/wawancara/murid/detail/{id}', [PanitiaWawancaraController::class, 'wawancaraMuridDetailShow'])->name('wawancaraMuridDetailShow')->middleware('role:wawancara');
    Route::post('/account/panitia/wawancara/murid/detail/submit/{id}', [PanitiaWawancaraController::class, 'wawancaraMuridDetailSubmit'])->name('wawancaraMuridDetailSubmit')->middleware('role:wawancara');
    
    //Panitia Seragam
    Route::get('/account/panitia/seragam/home', [PanitiaSeragamController::class, 'homePanitiaSeragamShow'])->name('homePanitiaSeragamShow')->middleware('role:seragam');
    Route::get('/account/panitia/seragam/detail/{id}', [PanitiaSeragamController::class, 'seragamDetailShow'])->name('seragamDetailShow')->middleware('role:seragam');
    Route::post('/account/panitia/seragam/detail/submit/{id}', [PanitiaSeragamController::class, 'seragamJadwalSubmit'])->name('seragamJadwalSubmit')->middleware('role:seragam');
    Route::get('/account/panitia/seragam/baju/{id}', [PanitiaSeragamController::class, 'seragamBajuShow'])->name('seragamBajuShow')->middleware('role:seragam');
    Route::post('/account/panitia/seragam/baju/update/{id}', [PanitiaSeragamController::class, 'seragamBajuUpdate'])->name('seragamBajuUpdate')->middleware('role:seragam');

    Route::get('/account/panitia/panitia/wawancara', [RolePanitiaController::class, 'roleManyShow4'])->name('roleManyShow4')->middleware('role:wawancara');
    Route::get('/account/panitia/panitia/seragam', [RolePanitiaController::class, 'roleManyShow5'])->name('roleManyShow5')->middleware('role:seragam');

    //Panitia atau Staff

    //All Role
    Route::get('/logout', [UserAuthController::class, 'logoutUser'])->name('logoutUser');
});
