<?php

namespace App\Http\Controllers;

use App\Models\Seragam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanitiaSeragamController extends Controller
{
    public function homePanitiaSeragamShow(){
        $seragam = Seragam::join('users', 'users.id', '=', 'seragam.user_id')
        ->join('wawancara', 'wawancara.id', '=', 'seragam.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*', 'seragam.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        // dd($seragam[0]->pengambilan_seragam == null);
        return view('pages.panitia.panitia-seragam.home-panitia-seragam', compact('seragam', 'roles'));
    }

    public function seragamDetailShow($id){
        $seragam = Seragam::where('seragam.user_id', $id)
        ->join('users', 'users.id', '=', 'seragam.user_id')
        ->join('wawancara', 'wawancara.id', '=', 'seragam.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*', 'seragam.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        return view('pages.panitia.panitia-seragam.detail-panitia-seragam', compact('seragam', 'roles'));
    }

    public function seragamJadwalSubmit(Request $request, $id){
        $validated = $request->validate([
            'pengambilan_seragam' => 'required',
            'waktu_pengambilan_seragam' => 'required',
        ]);

        Seragam::where('seragam.user_id', $id)->update([
            'pengambilan_seragam' => $validated['pengambilan_seragam'],
            'waktu_pengambilan_seragam' => $validated['waktu_pengambilan_seragam'],
        ]);
        return redirect(route('homePanitiaSeragamShow'));
    }

    public function seragamBajuShow($id) {
        $seragam = Seragam::where('seragam.user_id', $id)
        ->join('users', 'users.id', '=', 'seragam.user_id')
        ->join('wawancara', 'wawancara.id', '=', 'seragam.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('users.*', 'seragam.*', 'wawancara.*', 'seleksi.*', 'pendaftaran.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        return view('pages.panitia.panitia-seragam.detail-baju-panitia-seragam', compact('seragam', 'roles'));
    }

    public function seragamBajuUpdate(Request $request, $id){
        $validated = $request->validate([
            'seragam_senin' => 'required',
            'seragam_selasa' => 'required',
            'seragam_rabu' => 'required',
            'seragam_kamis' => 'required',
            'seragam_jumat' => 'required',
        ]);

        Seragam::where('seragam.user_id', $id)->update([
            'seragam_senin' => $validated['seragam_senin'],
            'seragam_selasa' => $validated['seragam_selasa'],
            'seragam_rabu' => $validated['seragam_rabu'],
            'seragam_kamis' => $validated['seragam_kamis'],
            'seragam_jumat' => $validated['seragam_jumat'],
        ]);

        return redirect(route('homePanitiaSeragamShow'));
    }
}
