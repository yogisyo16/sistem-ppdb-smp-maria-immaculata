<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Wawancara;
use App\Models\WawancaraFinansial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanitiaKeuanganController extends Controller
{
    Public function homePanitiaKeuanganShow(){
        $user = User::whereJsonContains('role', 'siswa')->get();
        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
        ->select('users.name', 'users.email', 'pendaftaran.nama_lengkap', 'pendaftaran.file_bukti_pembayaran_pendaftaran')
        ->get();
        
        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.user_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'pembayaran.pendaftaran_id')
        ->select('users.name', 'users.email', 'pendaftaran.*', 'pembayaran.*')
        ->get();

        $role_now = Auth::user();
        $roles = $role_now->role;

        $wawancara = Wawancara::count();
        $finan = WawancaraFinansial::count();
        if ($wawancara > 0) {
            if ($finan > 0) {
                $wawancara = WawancaraFinansial::join('wawancara', 'wawancara.id', '=', 'wawancara_finansial.wawancara_id')
                ->join('users', 'users.id', '=', 'wawancara_finansial.user_id')
                ->select('users.name', 'users.email', 'wawancara.*', 'wawancara_finansial.*')
                ->get();
            }
        }

        return view('pages.panitia.panitia-keuangan-tu.home-panitia-keuangan', compact('user', 'pendaftaran', 'pembayaran', 'wawancara', 'roles'));
    }

    public function getFileBuktiKeuangan($id){
        $path = Pendaftaran::where('user_id', '=', $id)->value('file_bukti_pembayaran_pendaftaran');
        $pathNew = storage_path('app/private/' . $path);

        return response()->file($pathNew);
    }

    public function validasiBuktiTableShow(){
        $user = User::whereJsonContains('role', 'siswa')->get();
        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
        ->select('users.name', 'users.email', 'pendaftaran.nama_lengkap', 'pendaftaran.file_bukti_pembayaran_pendaftaran')
        ->get();
        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.user_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'pembayaran.pendaftaran_id')
        ->select('users.name', 'users.email', 'pendaftaran.file_bukti_pembayaran_pendaftaran', 'pembayaran.*')
        ->get();
        return view();
    }

    Public function validasiBuktiShow($id){
        $pendaftaran = Pendaftaran::where('user_id', '=', $id)
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        // dd($pendaftaran);
        return view('pages.panitia.panitia-keuangan-tu.detail-panitia-verifikasi', compact('pendaftaran', 'roles'));
    }

    public function validasiBuktiSubmit(Request $request, $id){
        $validated = $request->validate([
            'isValid' => 'required',
        ]);
        Pembayaran::where('user_id', $id)->update([
            'isValid' => $validated['isValid'],
        ]);

        $user = User::whereJsonContains('role', 'siswa')->get();
        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
        ->select('users.name', 'users.email', 'pendaftaran.nama_lengkap', 'pendaftaran.file_bukti_pembayaran_pendaftaran')
        ->get();

        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.user_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'pembayaran.pendaftaran_id')
        ->select('users.name', 'users.email', 'pendaftaran.file_bukti_pembayaran_pendaftaran', 'pembayaran.*')
        ->get();

        $wawancara = Wawancara::count();
        $finan = WawancaraFinansial::count();
        if ($wawancara > 0) {
            if ($finan > 0) {
                $wawancara = WawancaraFinansial::join('wawancara', 'wawancara.id', '=', 'wawancara_finansial.wawancara_id')
                ->join('users', 'users.id', '=', 'wawancara_finansial.user_id')
                ->select('users.name', 'users.email', 'wawancara.*', 'wawancara_finansial.*')
                ->get();
            }
        }

        return redirect(route('homePanitiaKeuanganShow'));
    }
}
