<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Periodic;
use App\Models\Seleksi;
use App\Models\Seragam;
use App\Models\Sistem;
use App\Models\User;
use App\Models\Wawancara;
use App\Models\WawancaraFinansial;
use App\Models\WawancaraMurid;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanitiaIntiController extends Controller
{
    public function homePanitiaIntiShow(){
        //Siswa dan penanggung jawab wawancara mengambil dari role
        $users = User::whereJsonContains('role', 'siswa')->get();
        $penanggungjawab = User::whereJsonContains('role', 'wawancara')->get();

        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->select('users.name', 'users.email', 'pendaftaran.*')->
            get();
        $dokumen = Dokumen::join('users', 'users.id', '=', 'dokumen.user_id')
            ->join('pendaftaran', 'pendaftaran.id', '=', 'dokumen.pendaftaran_id')
            ->join('pembayaran', 'pembayaran.id', '=', 'dokumen.pembayaran_id')
            ->select('users.name', 'users.email', 'pendaftaran.*', 'dokumen.*')
            ->get();

        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayaran.user_id')
            ->join('pendaftaran', 'pendaftaran.id', '=', 'pembayaran.pendaftaran_id')
            ->select('users.name', 'users.email', 'pendaftaran.*', 'pembayaran.*')
            ->get();

        $seleksi = Seleksi::join('users', 'users.id', '=', 'seleksi.user_id')
            ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
            ->join('dokumen', 'dokumen.id', '=', 'seleksi.dokumen_id')
            ->select('users.name', 'users.email', 'pendaftaran.*', 'dokumen.*', 'seleksi.*')
            ->get();

        $wawancara = Wawancara::join('users', 'users.id', '=', 'wawancara.user_id')
            ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
            ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
            ->select('users.*', 'seleksi.*', 'wawancara.*', 'pendaftaran.*')
            ->get();

        $seragam = Seragam::join('users', 'users.id', '=', 'seragam.user_id')
            ->join('wawancara', 'wawancara.id', '=', 'seragam.wawancara_id')
            ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
            ->select('seragam.*', 'wawancara.*', 'seleksi.*')
            ->get();
        
        $periodic = Periodic::get();

        $sistem = Sistem::leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'sistem.user_id');
            })
            ->join('periodic','periodic.id', '=', 'sistem.periodic_id')
            ->join('dokumen','dokumen.id', '=', 'sistem.dokumen_id')
            ->join( 'pendaftaran','pendaftaran.id', '=', 'sistem.pendaftaran_id')
            ->join( 'pembayaran','pembayaran.id', '=', 'sistem.pembayaran_id')
            ->join( 'seleksi','seleksi.id', '=', 'sistem.seleksi_id')
            ->select('users.*', 'pendaftaran.*', 'dokumen.*', 'pembayaran.*', 'seleksi.*','periodic.*', 'sistem.*')
            ->get();

        $checkWawancara = Wawancara::all();
        $checkSeleksi = Seleksi::all();

        $checkWawancara = $checkWawancara->whereIn('seleksi_id', $checkSeleksi->pluck('id'));
        
        // $oldPeriode = Periodic::last()
        // ->get();
        $countPeriode = Periodic::count();
        // dd($checkWawancara);

        $role_now = Auth::user();
        $roles = $role_now->role;
        
        $checkSeragam = $seragam->isEmpty();
        // dd($sistem[0]->isValid, $checkSeragam);
        return view('pages.panitia.panitia-inti.home-panitia-inti', compact('users', 'pendaftaran', 'dokumen', 'penanggungjawab', 'pembayaran', 'seleksi', 'wawancara', 'sistem', 'periodic', 'roles', 'seragam', 'checkWawancara', 'checkSeragam', 'countPeriode'));
    }

    public function pendaftaranListShow(){
        $pendaftaran = Pendaftaran::join('users', 'users.id', '=', 'pendaftaran.user_id')
        ->select('users.name', 'users.email', 'pendaftaran.*')->get();
        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-inti.pendaftaran-panitia-inti-list', compact('pendaftaran', 'roles'));
    }

    public function pendaftaranDetailShow($id){
        $users = User::where('id', '=', $id)->get();
        $pendaftaran = Pendaftaran::where('user_id', '=', $id)
        ->get();

        $dokumens = Dokumen::where('user_id', '=', $id)
        ->get();

        $fileName = Pendaftaran::where('user_id', '=', $id)->value('file_bukti_pembayaran_pendaftaran');

        $fullPath = storage_path('app/private/' . $fileName);
        
        $role_now = Auth::user();
        $roles = $role_now->role;
        
        // dd(response()->download($fullPath));
        // dd($pathNew);
        return view('pages.panitia.panitia-inti.pendaftaran-panitia-inti-detail', compact('pendaftaran', 'users', 'fileName', 'fullPath', 'roles'));
    }

    public function getFileBuktiPendaftaran($id)
    {
        $path = Pendaftaran::where('user_id', '=', $id)->value('file_bukti_pembayaran_pendaftaran');
        $pathNew = storage_path('app/private/' . $path);
        
        return response()->file($pathNew);
    }

    public function generatePDF($id){
        $users = User::where('id', '=', $id)->get();
        $pendaftaran = Pendaftaran::where('user_id', '=', $id)
        ->get();
        $fileName = Pendaftaran::where('user_id', '=', $id)->value('file_bukti_pembayaran_pendaftaran');

        $fullPath = storage_path('app/private/' . $fileName);
        $pdf = PDF::loadView('pages.panitia.panitia-inti.pdf-pendaftaran-panitia-inti', compact('pendaftaran', 'users', 'fullPath'));
        $pendaftaran_nama = $pendaftaran[0]->nama_lengkap;
        return $pdf->stream($pendaftaran_nama.'.pdf');
    }

    public function dokumenDetailShow($id){
        $users = User::where('id', $id)->get();
        $dokumens = Dokumen::where('dokumen.user_id', $id)
        ->join('pendaftaran', 'pendaftaran.id', '=', 'dokumen.pendaftaran_id')
        ->select('dokumen.*', 'pendaftaran.*')
        ->get();
        $pendaftaran = Pendaftaran::where('user_id', $id)->get();

        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-inti.dokumen-panitia-inti-detail', compact('dokumens', 'users', 'pendaftaran', 'roles'));
    }

    public function seleksiSiswaPanitiaIntiDetailShow($id){
        $users = User::where('id', '=', $id)->get();
        $pendaftaran = Pendaftaran::where('user_id', '=', $id)
        ->get();
        $dokumens = Dokumen::where('user_id', '=', $id)
        ->get();
        $seleksi = Seleksi::where('user_id', '=', $id)
        ->get();

        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-inti.seleksi-detail-panitia-inti', compact('pendaftaran', 'users', 'dokumens', 'seleksi', 'roles'));
    }

    public function seleksiSiswaPanitiaIntiDetailSubmit(Request $request, $id){
        // dd($request->hasil_jalur_pendaftaran);
        $validated = $request->validate([
            'hasil_jalur_pendaftaran' => 'required',
            'isLulus' => 'required',
        ]);
        $seleksi = Seleksi::where('user_id', $id)->update([
            'hasil_jalur_pendaftaran' => $validated['hasil_jalur_pendaftaran'],
            'isLulus' => $validated['isLulus'],
        ]);
        return redirect(route('homePanitiaIntiShow'));
    }

    public function createWawancaraPanitiaInti($id){
        $checkUser = Wawancara::where('user_id', $id)->get();

        if ($checkUser->count() > 0) {
            return redirect(route('viewWawancaraPanitiaIntiShow', $id));
        }
        $userSiswa = Seleksi::where('seleksi.user_id', $id)
            ->join('users', 'users.id', '=', 'seleksi.user_id')
            ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
            ->join('dokumen', 'dokumen.id', '=', 'seleksi.dokumen_id')
            ->join('pembayaran', 'pembayaran.pendaftaran_id', '=', 'seleksi.pembayaran_id')
            ->select('users.*', 'pendaftaran.*', 'dokumen.*', 'seleksi.*', 'pembayaran.*')
            ->get();
        $userWawancara = User::whereJsonContains('role', 'wawancara')->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        // dd($userSiswa,$userWawancara);
        return view('pages.panitia.panitia-inti.wawancara-panitia-inti-create', compact('userSiswa', 'userWawancara', 'roles'));
    }

    public function createWawancaraPanitiaIntiSubmit(Request $request, $id){
        $validated = $request->validate([
            'nama_pewawancara'=> 'required',
            'waktu_wawancara' => 'required',
            'tgl_wawancara'=> 'required',
        ]);

        // dd($request->all());
        
        $pendaftaran_id = Pendaftaran::where('user_id', $id)->value('id');
        $seleksi_id = Seleksi::where('user_id', $id)->value('id');
        $dataToCreate = [
            'user_id' => $id,
            'seleksi_id' => $seleksi_id,
            'nama_pewawancara' => $validated['nama_pewawancara'],
            'waktu_wawancara' => $validated['waktu_wawancara'],
            'tgl_wawancara' => $validated['tgl_wawancara'],
        ];

        Wawancara::create($dataToCreate);

        $wawancara_id = Wawancara::where('user_id', $id)->value('id');

        $dataWawancaraFinanCreate = [
            'user_id' => $id,
            'wawancara_id' => $wawancara_id,
        ];

        WawancaraFinansial::create($dataWawancaraFinanCreate);

        $dataWawancaraMuridCreate = [
            'user_id' => $id,
            'wawancara_id' => $wawancara_id,
            'penilaian_wawancara_anak' => 'belum ada nilai',
            'catatan_wawancara_anak' => 'belum ada catatan',
        ];

        WawancaraMurid::create($dataWawancaraMuridCreate);
        
        Seragam::create([
            'user_id' => $id,
            'wawancara_id' => $wawancara_id,
        ]);

        return redirect(route('homePanitiaIntiShow'));
    }

    public function viewWawancaraPanitiaIntiShow($id){
        $wawancara = Wawancara::where('wawancara.user_id', $id)
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('seleksi.*', 'wawancara.*', 'pendaftaran.*')
        ->get();
        $wawancaraFinansial = WawancaraFinansial::where('user_id', $id)->get();
        $wawancaramurid = WawancaraMurid::where('user_id', $id)->get();
        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-inti.wawancara-view-panitia-inti', compact('wawancara', 'wawancaraFinansial', 'wawancaramurid', 'roles'));
    }

    public function viewWawancaraFinansialPanitiaIntiShow($id){
        $wawancaraFinansial = WawancaraFinansial::where('wawancara_finansial.user_id', $id)
        ->join('wawancara', 'wawancara.id', '=', 'wawancara_finansial.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('seleksi.*', 'wawancara.*', 'wawancara_finansial.*', 'pendaftaran.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;

        // dd(($wawancaraFinansial[0]->hsl_udp == null), $wawancaraFinansial[0]->hsl_spp == null, $wawancaraFinansial[0]->hsl_ups == null, $wawancaraFinansial[0]->hsl_uang_seragam == null, $wawancaraFinansial[0]->hsl_uang_kegiatan == null, $wawancaraFinansial[0]->hsl_uang_alat == null);
        return view('pages.panitia.panitia-inti.wawancara-finansial-panitia-inti', compact('wawancaraFinansial', 'roles'));
    }

    public function viewWawancaraMuridPanitiaIntiShow($id){
        $wawancaramurid = WawancaraMurid::where('wawancara_murid.user_id', $id)
        ->join('wawancara', 'wawancara.id', '=', 'wawancara_murid.wawancara_id')
        ->join('seleksi', 'seleksi.id', '=', 'wawancara.seleksi_id')
        ->join('pendaftaran', 'pendaftaran.id', '=', 'seleksi.pendaftaran_id')
        ->select('seleksi.*', 'wawancara.*', 'wawancara_murid.*', 'pendaftaran.*')
        ->get();
        $role_now = Auth::user();
        $roles = $role_now->role;

        return view('pages.panitia.panitia-inti.wawancara-murid-panitia-inti', compact('wawancaramurid', 'roles'));
    }
}