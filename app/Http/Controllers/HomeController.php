<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Wawancara;
use App\Models\Pembayaran;
use App\Models\Seleksi;
use App\Models\Seragam;
use App\Models\Sistem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeSiswaShow()
    {
        // For Now isn't use for anything

        // $pendaftaran = Pendaftaran::where('user_id', Auth::id())->get();
        // $dokumen = Dokumen::where('user_id', Auth::id())->get();
        // $userActive = User::where('id', Auth::id())->get();
        // $countPendaftaran = $pendaftaran->count();
        // $countDokumen = $dokumen->count();
        // if(($countPendaftaran == 0) && ($countDokumen == 0)){
        //     $classHomePendaftaranSiswa = 'empty';
        //     $textValuePendaftaranSiswa = 'Belum mengisi';
        //     $classHomeDokumenSiswa = 'empty';
        //     $textValueDokumenSiswa = 'Belum mengupload';
        //     return view('layouts.siswa.home-siswa', [
        //         "title" => "Home"
        //     ], compact('classHomePendaftaranSiswa', 'textValuePendaftaranSiswa', 'classHomeDokumenSiswa', 'textValueDokumenSiswa', 'pendaftaran'));
        // } elseif(($countPendaftaran == 1) && ($countDokumen == 0)){
        //     $classHomePendaftaranSiswa = 'notEmpty';
        //     $textValuePendaftaranSiswa = 'Menunggu Validasi';
        //     $classHomeDokumenSiswa = 'empty';
        //     $textValueDokumenSiswa = 'Belum mengupload';
        //     return view('layouts.siswa.home-siswa', [
        //         "title" => "Home"
        //     ],compact('classHomePendaftaranSiswa', 'textValuePendaftaranSiswa', 'classHomeDokumenSiswa', 'textValueDokumenSiswa', 'pendaftaran'));
        // } elseif (($countPendaftaran == 1) && ($countDokumen == 1)){
        //     $classHomePendaftaranSiswa = 'notEmpty';
        //     $textValuePendaftaranSiswa = 'Menunggu Validasi';
        //     $classHomeDokumenSiswa = 'notEmpty';
        //     $textValueDokumenSiswa = 'Sudah mengupload';
        //     return view('layouts.siswa.home-siswa', [
        //         "title" => "Home"
        //     ], compact('classHomePendaftaranSiswa', 'textValuePendaftaranSiswa', 'classHomeDokumenSiswa', 'textValueDokumenSiswa', 'pendaftaran'));
        // }
    }

    public function homeAdminShow(User $user, Pendaftaran $pendaftaran)
    {

        $user = User::get();

        return view('layouts.panitia.admin.home-panitia-admin',[
            "title" => "Home"
        ],compact('user'));
    }

    public function homePanitiaShow(User $user, Pendaftaran $pendaftaran, Dokumen $dokumen, Seleksi $seleksi, Seragam $seragam, Sistem $sistem)
    {
        $siswa = User::where('role', 5)
        ->get();

        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
        ->select('users.name', 'users.email', 'pendaftaran.*')
        ->get();

        $buktiPendaftaran = Pendaftaran::where('file_bukti_pembayaran_pendaftaran')
        ->get();

        $dokumen = Dokumen::get()
            ->where('user_id', $siswa);


        // ->whereNull('file_bukti_pembayaran_pendaftaran')

        return view('layouts.panitia.panitia-inti.home-panitia-inti', [
            "title" => "Home"
        ], compact('siswa', 'pendaftaran', 'dokumen'));
    }

    public function homeTimKeuanganShow(User $user, Pembayaran $pembayaran)
    {
        $siswa = User::where('role', 5)
        ->get();

        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.user_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'pembayaran.pendaftaran_id')
        ->select('users.name', 'users.email', 'pendaftaran.file_bukti_pembayaran_pendaftaran', 'pembayaran.*')
        ->get();
        
        return view('layouts.panitia.keuangan-tu.home-tim-keuangan', [
            "title" => "Home"
        ], compact('siswa', 'pembayaran'));
    }
    
    public function homeTimWawancaraShow(User $user, Wawancara $wawancara)
    {
        return view('layouts.panitia.tim-wawancara.home-tim-wawancara', [
            "title" => "Home"
        ]);
    }

    public function homeTimSeragam(User $user, Seragam $seragam) 
    {
        return view('layouts.panitia.tim-seragam.home-tim-seragam', [
            "title" => "Home"
        ]);
    }
}
