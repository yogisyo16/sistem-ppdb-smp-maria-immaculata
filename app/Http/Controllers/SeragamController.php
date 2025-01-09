<?php

namespace App\Http\Controllers;

use App\Models\Seragam;
use Illuminate\Http\Request;

class SeragamController extends Controller
{
    public function siswaSeragamShow($id){
        $seragam = Seragam::where('seragam.user_id', $id)
        ->join('users', 'users.id', '=', 'seragam.user_id')
        ->join('wawancara', 'wawancara.id', '=', 'seragam.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*', 'seragam.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*')
        ->get();
        return view('pages.siswa.seragam.jadwal-seragam-siswa', compact('seragam'));
    }
}
