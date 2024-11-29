<?php

namespace App\Http\Controllers;

use App\Models\Wawancara;
use App\Models\WawancaraFinansial;
use App\Models\WawancaraMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanitiaWawancaraController extends Controller
{
    public function homePanitiaWawancaraShow()
    {
        $check_wawancara = Wawancara::where('nama_pewawancara', Auth::user()->name)->get();
        // dd($wawancara);

        $wawancara = Wawancara::where('wawancara.nama_pewawancara', Auth::user()->name)
        ->join('users', 'users.id', '=', 'wawancara.user_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->join('wawancara_finansial', 'wawancara_finansial.wawancara_id', '=', 'wawancara.id')
        ->join('wawancara_murid', 'wawancara_murid.wawancara_id', '=', 'wawancara.id')
        ->select('users.*', 'seleksi.*', 'wawancara.*', 'pendaftaran.*', 'wawancara_finansial.*', 'wawancara_murid.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;

        // dd($wawancara);
        return view('pages.panitia.panitia-wawancara.home-panitia-wawancara', compact('wawancara', 'roles'));
    }
    public function wawancaraFinansialDetailShow($id)
    {
        $wawancara = Wawancara::where('wawancara.user_id', $id)
        ->join('users', 'users.id', '=', 'wawancara.user_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*','wawancara.*', 'seleksi.*', 'pendaftaran.*')
        ->get();

        $wawancaraFinansial = WawancaraFinansial::where('user_id', $id)->get();

        $role_now = Auth::user();
        $roles = $role_now->role;

        // dd($wawancaraFinansial);
        return view('pages.panitia.panitia-wawancara.wawancara-finansial.detail-wawancara-finansial', compact('wawancara', 'roles', 'wawancaraFinansial'));
    }
    public function wawancaraFinansialSubmit(Request $request, $id){
        $check_data = WawancaraFinansial::where('wawancara_id', $id)->get();
        $data_type = $check_data[0]->hsl_udp;
        
        $validated = $request->validate([
            'hsl_udp' => 'required',
            'hsl_spp' => 'required',
            'hsl_ups' => 'required',
            'hsl_uang_seragam' => 'required',
            'hsl_uang_kegiatan' => 'required',
            'hsl_uang_alat' => 'required',
            'total_tunai' => 'required',
            'pembayaran_udp' => 'required',
            'pembayaran_spp' => 'required',
            'pembayaran_ups' => 'required',
            'pembayaran_uang_seragam' => 'required',
            'pembayaran_uang_kegiatan' => 'required',
            'pembayaran_uang_alat' => 'required',
            'total_dibayar' => 'required',
            'total_uang' => 'required',
        ]);
        
        $check_this = WawancaraFinansial::where('wawancara_id', $id)->update([
            'hsl_udp' => $validated['hsl_udp'],
            'hsl_spp' => $validated['hsl_spp'],
            'hsl_ups' => $validated['hsl_ups'],
            'hsl_uang_seragam' => $validated['hsl_uang_seragam'],
            'hsl_uang_kegiatan' => $validated['hsl_uang_kegiatan'],
            'hsl_uang_alat' => $validated['hsl_uang_alat'],
            'total_tunai' => $validated['total_tunai'],
            'pembayaran_udp' => $validated['pembayaran_udp'],
            'pembayaran_spp' => $validated['pembayaran_spp'],
            'pembayaran_ups' => $validated['pembayaran_ups'],
            'pembayaran_uang_seragam' => $validated['pembayaran_uang_seragam'],
            'pembayaran_uang_kegiatan' => $validated['pembayaran_uang_kegiatan'],
            'pembayaran_uang_alat' => $validated['pembayaran_uang_alat'],
            'total_dibayar' => $validated['total_dibayar'],
            'total_uang' => $validated['total_uang'],
        ]);

        // dd(gettype($data_type), $request->hsl_udp, $validated['hsl_udp'], $check_this);
        return redirect(route('homePanitiaWawancaraShow'));
    }
    public function wawancaraMuridDetailShow($id){
        $wawancara = Wawancara::where('wawancara.user_id', $id)
        ->join('users', 'users.id', '=', 'wawancara.user_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->join('wawancara_murid', 'wawancara_murid.wawancara_id', '=', 'wawancara.id')
        ->select('users.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*', 'wawancara_murid.*')
        ->get();

        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-wawancara.wawancara-siswa.detail-wawancara-siswa', compact('wawancara', 'roles'));
    }
    public function wawancaraMuridDetailSubmit(Request $request, $id){
        $validated = $request->validate([
            'penilaian_wawancara_anak' => 'required',
            'catatan_wawancara_anak' => 'required',
        ]);

        WawancaraMurid::where('wawancara_id', $id)->update([
            'penilaian_wawancara_anak' => $validated['penilaian_wawancara_anak'],
            'catatan_wawancara_anak' => $validated['catatan_wawancara_anak'],
        ]);
        return redirect(route('homePanitiaWawancaraShow'));
    }
}
