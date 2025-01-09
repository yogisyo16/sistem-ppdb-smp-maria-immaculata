<?php

namespace App\Http\Controllers;

use App\Models\Seragam;
use App\Models\Wawancara;
use App\Models\WawancaraFinansial;
use Illuminate\Http\Request;

class WawancaraController extends Controller
{
    public function jadwalWawancaraSiswaShow($id){
        $wawancara = Wawancara::where('wawancara.user_id', $id)
        ->join('users', 'users.id', '=', 'wawancara.user_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->join('wawancara_finansial', 'wawancara_finansial.wawancara_id', '=', 'wawancara.id')
        ->join('wawancara_murid', 'wawancara_murid.wawancara_id', '=', 'wawancara.id')
        ->select('users.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*', 'wawancara_finansial.*', 'wawancara_murid.*')
        ->get();

        return view('pages.siswa.wawancara.jadwal-wawancara-siswa', compact('wawancara'));
    }

    public function hasilWawancaraFinansialShow($id){
        $wawancara_finansial = WawancaraFinansial::where('wawancara_finansial.user_id', $id)
        ->join('users', 'users.id', '=', 'wawancara_finansial.user_id')
        ->join('wawancara', 'wawancara.id', '=', 'wawancara_finansial.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*', 'wawancara_finansial.*')
        ->get();

        $check_finansial = WawancaraFinansial::where('wawancara_finansial.user_id', $id)->get();
        
        $seragam = Seragam::where('user_id', $id)->get();

        return view('pages.siswa.wawancara.wawancara-finansial-siswa', compact('wawancara_finansial', 'check_finansial', 'seragam'));
    }
}
