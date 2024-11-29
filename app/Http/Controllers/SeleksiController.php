<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Seleksi;
use App\Models\Wawancara;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    public function seleksiSiswaShow($id){
        $seleksi = Seleksi::where('seleksi.user_id', $id)
        ->join('users', 'users.id', '=', 'seleksi.user_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->join('dokumen', 'dokumen.id', '=', 'seleksi.dokumen_id')
        ->join('pembayaran', 'pembayaran.pendaftaran_id', '=', 'seleksi.pembayaran_id')
        ->select('users.*', 'pendaftaran.*', 'dokumen.*', 'seleksi.*', 'pembayaran.*')
        ->get();
        $pendaftaran = Pendaftaran::get();
        $jalur_reguler = Pendaftaran::where('jalur_pendaftaran', 'Reguler')->count();
        $jalur_akademik = Pendaftaran::where('jalur_pendaftaran', 'Akademik')->count();
        $jalur_nonakademik = Pendaftaran::where('jalur_pendaftaran', 'NonAkademik')->count();
        $check_wawancara = Wawancara::where('user_id', $id)->get();
        if ($check_wawancara->isEmpty()) {
            $wawancara = null;
        } else {
            $wawancara = Wawancara::where('user_id', $id)->get();
        }
        return view ('pages.siswa.seleksi.status-seleksi-siswa', compact('seleksi', 'pendaftaran', 'jalur_reguler', 'jalur_akademik', 'jalur_nonakademik', 'wawancara'));
    }
}
